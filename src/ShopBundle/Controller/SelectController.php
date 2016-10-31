<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ShopBundle\Entity\Product;

class SelectController extends Controller
{
    public function selectNewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $query = $em->createQuery("SELECT p FROM ShopBundle:Product p WHERE p.isNew=1");
        $products = $query->getResult();
        return $this->render('select/new.html.twig', array(
            'products' => $products,
            'categories' => $categories,
        ));
    }

    public function addNewAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $repository = $this->getDoctrine()->getRepository('ShopBundle:Product');
        $product = $repository->findOneByCode($codigo);
        if($product){
            if($product->getIsNew()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'El producto ya está en la lista de novedades'
                );
            }else{
                $product->setIsNew(true);
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
        return $this->redirectToRoute('select_new');
    }

    public function deleteNewAction(Product $product)
    {
        if($product){
            if(!$product->getIsNew()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Ya ha quitado el producto de la lista'
                );
            }else{
                $product->setIsNew(false);
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
        return $this->redirectToRoute('select_new');
    }
}
