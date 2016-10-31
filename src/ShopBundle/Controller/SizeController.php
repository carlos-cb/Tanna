<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ShopBundle\Entity\Size;
use ShopBundle\Entity\Product;
use ShopBundle\Form\SizeType;

/**
 * Size controller.
 *
 */
class SizeController extends Controller
{
    /**
     * Lists all Size entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sizes = $em->getRepository('ShopBundle:Size')->findAll();

        return $this->render('size/index.html.twig', array(
            'sizes' => $sizes,
        ));
    }

    /**
     * Creates a new Size entity.
     *
     */
    public function newAction(Request $request)
    {
        $size = new Size();
        $form = $this->createForm('ShopBundle\Form\SizeType', $size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($size);
            $em->flush();

            return $this->redirectToRoute('size_show', array('id' => $size->getId()));
        }

        return $this->render('size/new.html.twig', array(
            'size' => $size,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Size entity.
     *
     */
    public function showAction(Size $size)
    {
        $deleteForm = $this->createDeleteForm($size);

        return $this->render('size/show.html.twig', array(
            'size' => $size,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Size entity.
     *
     */
    public function editAction(Request $request, Size $size)
    {
        $deleteForm = $this->createDeleteForm($size);
        $editForm = $this->createForm('ShopBundle\Form\SizeType', $size);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($size);
            $em->flush();

            return $this->redirectToRoute('size_edit', array('id' => $size->getId()));
        }

        return $this->render('size/edit.html.twig', array(
            'size' => $size,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Size entity.
     *
     */
    public function deleteAction(Request $request, Size $size)
    {
        $form = $this->createDeleteForm($size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($size);
            $em->flush();
        }

        return $this->redirectToRoute('size_index');
    }

    /**
     * Creates a form to delete a Size entity.
     *
     * @param Size $size The Size entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Size $size)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('size_delete', array('id' => $size->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function addSizeAction(Product $product, $sizename)
    {
        $size = new Size();
        $size->setProduct($product)->setSizeName($sizename);

        $product->addSize($size);

        $em = $this->getDoctrine()->getManager();
        $em->persist($size);
        $em->flush();

        return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())). '#tallas');
    }

    public function minSizeAction(Product $product, Size $size)
    {
        $product->removeSize($size);

        $em = $this->getDoctrine()->getManager();
        $em->remove($size);
        $em->flush();

        return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())). '#tallas');
    }
}
