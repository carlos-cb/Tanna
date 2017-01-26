<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ShopBundle\Entity\Product;
use ShopBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('ShopBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('ShopBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setDiscountPrice($product->getPrice())->setIsSale(false)->setIsOferta(false)->setMaiUnit(0)->setSuanUnit(0);
            $file = $product->getFoto();
            $fileName = $this->get('shop.foto_uploader')->upload($file);
            $product->setFoto($fileName);

            $product->setIsNew(0)->setIsShow(1);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($product);
        
        //获取细节图
        $queryp = $em->createQuery("SELECT p FROM ShopBundle:Fotodetalle p WHERE p.product=$product order by p.color");
        $fotodetalles = $queryp->getResult();

        //尺码
        $queryt = $em->createQuery("SELECT t FROM ShopBundle:Size t WHERE t.product=$product");
        $sizes = $queryt->getResult();

        //颜色
        $queryh = $em->createQuery("SELECT h FROM ShopBundle:Color h WHERE h.product=$product");
        $colors = $queryh->getResult();

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'fotodetalles' => $fotodetalles,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction(Request $request, Product $product)
    {
        $fileOld = $product->getFoto();
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('ShopBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $product->getFoto();
            if($file != $fileOld)
            {
                $isRemoved = $this->get('shop.foto_uploader')->remove($fileOld);
                if($isRemoved){
                    $fileName = $this->get('shop.foto_uploader')->upload($file);
                    $product->setFoto($fileName);
                }
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //删除本身照片一张
            $file = $product->getFoto();
            if($file){
                $isRemoved = $this->get('shop.foto_uploader')->remove($file);
            }

            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a Product entity.
     *
     * @param Product $product The Product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function changeShowAction(Product $product)
    {
        $product->setIsShow(!$product->getIsShow());

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('product_index');
    }
}
