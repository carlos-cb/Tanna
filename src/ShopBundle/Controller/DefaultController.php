<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopBundle:Default:index.html.twig');
    }
    
    public function productListAction()
    {
        return $this->render('ShopBundle:Default:productList.html.twig');
    }

    public function productDetailAction()
    {
        return $this->render('ShopBundle:Default:productDetail.html.twig');
    }

    public function cartAction()
    {
        return $this->render('ShopBundle:Default:cart.html.twig');
    }
}
