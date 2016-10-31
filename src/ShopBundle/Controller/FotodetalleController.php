<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ShopBundle\Entity\Fotodetalle;
use ShopBundle\Entity\Product;
use ShopBundle\Form\FotodetalleType;

/**
 * Fotodetalle controller.
 *
 */
class FotodetalleController extends Controller
{
    /**
     * Lists all Fotodetalle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fotodetalles = $em->getRepository('ShopBundle:Fotodetalle')->findAll();

        return $this->render('fotodetalle/index.html.twig', array(
            'fotodetalles' => $fotodetalles,
        ));
    }

    /**
     * Creates a new Fotodetalle entity.
     *
     */
    public function newAction(Request $request, Product $product)
    {
        $fotodetalle = new Fotodetalle();
        $fotodetalle->setProduct($product);
        $traitChoices = $product->getColors();
        $form = $this->createForm('ShopBundle\Form\FotodetalleType', $fotodetalle, array(
            'trait_choices' => $traitChoices,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $fotodetalle->getFotodetalle();
            $fileName = $this->get('shop.foto_uploader')->upload($file);
            $fotodetalle->setFotodetalle($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($fotodetalle);
            $em->flush();

            return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())). '#fotodetalles');
        }

        return $this->render('fotodetalle/new.html.twig', array(
            'fotodetalle' => $fotodetalle,
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fotodetalle entity.
     *
     */
    public function showAction(Fotodetalle $fotodetalle)
    {
        $deleteForm = $this->createDeleteForm($fotodetalle);

        return $this->render('fotodetalle/show.html.twig', array(
            'fotodetalle' => $fotodetalle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fotodetalle entity.
     *
     */
    public function editAction(Request $request, Fotodetalle $fotodetalle, Product $product)
    {
        $fileOld = $fotodetalle->getFotodetalle();
        $deleteForm = $this->createDeleteForm($fotodetalle);
        $traitChoices = $product->getColors();
        $editForm = $this->createForm('ShopBundle\Form\FotodetalleType', $fotodetalle, array(
            'trait_choices' => $traitChoices,
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $fotodetalle->getFotodetalle();
            if($file != $fileOld)
            {
                $isRemoved = $this->get('shop.foto_uploader')->remove($fileOld);
                if($isRemoved){
                    $fileName = $this->get('shop.foto_uploader')->upload($file);
                    $fotodetalle->setFotodetalle($fileName);
                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($fotodetalle);
            $em->flush();

            return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())). '#fotodetalles');
        }

        return $this->render('fotodetalle/edit.html.twig', array(
            'fotodetalle' => $fotodetalle,
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Fotodetalle entity.
     *
     */
    public function deleteAction(Request $request, Fotodetalle $fotodetalle)
    {
        $product = $fotodetalle->getProduct();
        $form = $this->createDeleteForm($fotodetalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $fotodetalle->getFotodetalle();
            if($file){
                $isRemoved = $this->get('nubbe.foto_uploader')->remove($file);
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($fotodetalle);
            $em->flush();
        }

        return $this->redirectToRoute('product_show', array('id' => $product->getId()));
    }

    /**
     * Creates a form to delete a Fotodetalle entity.
     *
     * @param Fotodetalle $fotodetalle The Fotodetalle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fotodetalle $fotodetalle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fotodetalle_delete', array('id' => $fotodetalle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Deletes a Fotodetalle entity.
     *
     */
    public function removeAction(Fotodetalle $fotodetalle)
    {
        $product = $fotodetalle->getProduct();

        $file = $fotodetalle->getFotodetalle();
        if($file){
            $isRemoved = $this->get('shop.foto_uploader')->remove($file);
        }

        $product->removeFotodetalle($fotodetalle);
        $em = $this->getDoctrine()->getManager();
        $em->remove($fotodetalle);
        $em->flush();

        return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())). '#fotodetalles');
    }
}
