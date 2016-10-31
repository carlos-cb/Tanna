<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\OrderInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    public function prepareStripeAction(OrderInfo $orderInfo)
    {
        $gatewayName = 'stripe_js';

        $storage = $this->get('payum')->getStorage('ShopBundle\Entity\Payment');

        $payment = $storage->create();
        $payment->setNumber($orderInfo->getId());
        $payment->setCurrencyCode('EUR');
        $payment->setTotalAmount($orderInfo->getTotalPrice() * 100); // 1.23 EUR
        $payment->setClientId($orderInfo->getUser());

        $storage->update($payment);

        $captureToken = $this->get('payum')->getTokenFactory()->createCaptureToken(
            $gatewayName,
            $payment,
            'payment_paymentDone' // the route to redirect after capture
        );

        return $this->redirect($captureToken->getTargetUrl());
    }

    public function doneAction(Request $request)
    {
        $token = $this->get('payum')->getHttpRequestVerifier()->verify($request);
        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

        $gateway->execute($status = new GetHumanStatus($token));
        $payment = $status->getFirstModel();

        $paymentStatus = false;
        if ($token->getGatewayName() === 'stripe_js'&& $status->isCaptured())
        {
            if ($status->getValue() === 'captured')
            {
                $paymentStatus = true;
            }
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $orderInfoId = $payment->getNumber();
        $orderInfo = $em->getRepository('ShopBundle:OrderInfo')->findOneById($orderInfoId);
        
        if ($paymentStatus === true)
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('Nuevo Pedido En tannamoda.com')
                ->setFrom(array('info@nubbemoda.com' => 'Tanna Moda'))
                ->setTo($user->getEmail())
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        'ShopBundle:Payment:successpaymentEmail.html.twig', array(
                            'status' => $status->getValue(),
                            'orderInfo' => $orderInfo,
                            'userNow' => $user,
                    )),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            //修改订单状态

            $orderInfo->setIsConfirmed(true)->setState('preparando');
            $em->persist($orderInfo);
            $em->flush();

            return $this->render('ShopBundle:Payment:successpayment.html.twig', array(
                'status' => $status->getValue(),
                'orderInfo' => $orderInfo,
                'userNow' => $user,
            ));
        } else {
            return $this->render('ShopBundle:Payment:errorpayment.html.twig', array(
                'orderInfo' => $orderInfo,
            ));
        }
    }
}