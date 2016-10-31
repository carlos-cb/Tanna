<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ShopBundle\Entity\Color;
use ShopBundle\Entity\Product;
use ShopBundle\Form\ColorType;

/**
 * Color controller.
 *
 */
class ColorController extends Controller
{
    /**
     * Lists all Color entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colors = $em->getRepository('ShopBundle:Color')->findAll();

        return $this->render('color/index.html.twig', array(
            'colors' => $colors,
        ));
    }

    /**
     * Creates a new Color entity.
     *
     */
    public function newAction(Request $request, Product $product)
    {
        $color = new Color();
        $color->setProduct($product);
        $form = $this->createForm('ShopBundle\Form\ColorType', $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $color->getColorFoto();
            $fileName = $this->get('shop.foto_uploader')->upload($file);
            $color->setColorFoto($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('color/new.html.twig', array(
            'color' => $color,
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Color entity.
     *
     */
    public function showAction(Color $color)
    {
        $deleteForm = $this->createDeleteForm($color);

        return $this->render('color/show.html.twig', array(
            'color' => $color,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Color entity.
     *
     */
    public function editAction(Request $request, Color $color, Product $product)
    {
        $fileOld = $color->getColorFoto();
        $deleteForm = $this->createDeleteForm($color);
        $editForm = $this->createForm('ShopBundle\Form\ColorType', $color);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $color->getColorFoto();
            if($file != $fileOld)
            {
                $isRemoved = $this->get('shop.foto_uploader')->remove($fileOld);
                if($isRemoved){
                    $fileName = $this->get('shop.foto_uploader')->upload($file);
                    $color->setColorFoto($fileName);
                }
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('color/edit.html.twig', array(
            'color' => $color,
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Color entity.
     *
     */
    public function deleteAction(Request $request, Color $color)
    {
        $product = $color->getProduct();
        $form = $this->createDeleteForm($color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $color->getColorFoto();
            if($file){
                $isRemoved = $this->get('chisnbal.foto_uploader')->remove($file);
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($color);
            $em->flush();
        }

        return $this->redirectToRoute('product_show', array('id' => $product->getId()));
    }

    /**
     * Creates a form to delete a Color entity.
     *
     * @param Color $color The Color entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Color $color)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('color_delete', array('id' => $color->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Deletes a Fotodetalle entity.
     *
     */
    public function removeAction(Color $color)
    {
        $product = $color->getProduct();

        //删除本身照片一张
        $file = $color->getColorFoto();
        if($file){
            $isRemoved = $this->get('shop.foto_uploader')->remove($file);
        }

        //删除下属的fotodetalle
        $fotodetalles = $color->getFotodetalles();
        foreach ($fotodetalles as $fotodetalle)
        {
            $fileF = $fotodetalle->getFotodetalle();
            if($fileF){
                $isRemoved = $this->get('shop.foto_uploader')->remove($fileF);
            }

            $product->removeFotodetalle($fotodetalle);
            $em = $this->getDoctrine()->getManager();
            $em->remove($fotodetalle);
            $em->flush();
        }

        $product->removeColor($color);
        $em = $this->getDoctrine()->getManager();
        $em->remove($color);
        $em->flush();

        return $this->redirectToRoute('product_show', array('id' => $product->getId()));
    }
}
