<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ShopBundle\Entity\Product;

class SaleController extends Controller
{
    public function indexAction()
    {
        return $this->render('sale/index.html.twig');
    }

    public function aAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('ShopBundle:Product')->findBy(array('isSale' => true));

        return $this->render('sale/a.html.twig', array(
            'products' => $products,
        ));
    }

    public function aAddSaleAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $price = $request->request->get('price');
        $priceA = $request->request->get('priceA');
        $repository = $this->getDoctrine()->getRepository('ShopBundle:Product');
        $product = $repository->findOneByCode($codigo);
        if($product){
            if($product->getIsSale() || $product->getIsOferta()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'El product ya está en esta lista'
                );
            }else{
                $product->setIsSale(true);
                $product->setDiscountPrice($price);
                $product->setDiscountPriceA($priceA);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Añadido con éxito'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                'No se puede añadir, por favor, compruebe el código del producto es correcto'
            );
        }
        return $this->redirectToRoute('saleA_index');
    }

    public function aDeleteSaleAction(Product $product)
    {
        if($product){
            if(!$product->getIsSale()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Ya ha quitado el producto de la lista'
                );
            }else{
                $product->setIsSale(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Quitado con éxito'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                'No se puede quitar, por favor, compruebe el código del producto es correcto'
            );
        }
        return $this->redirectToRoute('saleA_index');
    }

    public function bAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('ShopBundle:Product')->findBy(array('isOferta' => true));

        return $this->render('sale/b.html.twig', array(
            'products' => $products,
        ));
    }

    public function bAddSaleAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $price1 = $request->request->get('price1');
        $price2 = $request->request->get('price2');
        $repository = $this->getDoctrine()->getRepository('ShopBundle:Product');
        $product = $repository->findOneByCode($codigo);
        if($product){
            if($product->getIsOferta() || $product->getIsSale()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'El product ya está en esta lista de oferta'
                );
            }else{
                $product->setIsOferta(true)->setMaiUnit($price1)->setSuanUnit($price2);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Añadido con éxito'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                'No se puede añadir, por favor, compruebe el código del producto es correcto'
            );
        }
        return $this->redirectToRoute('saleB_index');
    }

    public function bDeleteSaleAction(Product $product)
    {
        if($product){
            if(!$product->getIsOferta()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Ya ha quitado el producto de la lista'
                );
            }else{
                $product->setIsOferta(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Ya ha quitado el producto de la lista'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                'No se puede quitar, por favor, compruebe el código del producto es correcto'
            );
        }
        return $this->redirectToRoute('saleB_index');
    }
    
    public function dAction()
    {
        $em = $this->getDoctrine()->getManager();

        $global = $em->getRepository('ShopBundle:Globals')->findOneById(1);

        return $this->render('sale/d.html.twig', array(
            'global' => $global,
        ));
    }

    public function dEditSaleAction(Request $request)
    {
        $man = $request->request->get('codigo');
        $jian = $request->request->get('price');

        $em = $this->getDoctrine()->getManager();
        $global = $em->getRepository('ShopBundle:Globals')->findOneById(1);

        $global->setMan($man)->setJian($jian);
        $em->persist($global);
        $em->flush();
        if(($global->getMan() == $man) && ($global->getJian() == $jian)){
            $this->get('session')->getFlashBag()->add(
                'success',
                'Modificado con éxito'
            );
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Modificación Fallo, inténtalo de nuevo por favor'
            );
        }
        return $this->redirectToRoute('saleD_index');
    }
}
