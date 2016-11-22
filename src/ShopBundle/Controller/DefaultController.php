<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Category;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Cart;
use ShopBundle\Entity\OrderInfo;
use ShopBundle\Entity\CartItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();
        
        return $this->render('ShopBundle:Default:index.html.twig', array(
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }
    
    public function avisoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        return $this->render('ShopBundle:Info:aviso.html.twig', array(
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }

    public function guiaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        return $this->render('ShopBundle:Info:guia.html.twig', array(
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }

    public function sobreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        return $this->render('ShopBundle:Info:sobre.html.twig', array(
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }
    
    public function productListAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        $query = $em->createQuery("SELECT p FROM ShopBundle:Product p WHERE p.category=$category and p.isShow=1");
        $products = $query->getResult();
        
        return $this->render('ShopBundle:Default:productList.html.twig', array(
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }

    public function productListNewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        $category = new Category();
        $category->setCategoryNameEs('NOVEDADES');
        
        $query = $em->createQuery("SELECT p FROM ShopBundle:Product p WHERE p.isNew=1 and p.isShow=1");
        $products = $query->getResult();

        return $this->render('ShopBundle:Default:productlist.html.twig', array(
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }

    public function productDetailAction(Product $product, $colorId)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        $colors = $product->getColors();
        $color = $colors[$colorId-1];

        return $this->render('ShopBundle:Default:productDetail.html.twig', array(
            'product' => $product,
            'categories' => $categories,
            'color' => $color,
            'userNow' => $userNow,
            'colorId' => $colorId,
        ));
    }

    public function cartAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();
        if(!$userNow)
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $cart = $this->getUser()->getCart();
        if(!$cart) {
            $cart = new Cart();
            $cart->setCartState('buying')
                ->setCreateDate(new \DateTime('now'))
                ->setUser($this->getUser());
            $em->persist($cart);
            $em->flush();
        }
        else if($cart->getCartState() == 'over')
        {
            $cart->setCartState('buying')
                ->setCreateDate(new \DateTime('now'));
            $em->persist($cart);
            $em->flush();
        }

        $cartItems = $cart->getCartItems();

        return $this->render('ShopBundle:Default:cart.html.twig', array(
            'categories' => $categories,
            'cartItems' => $cartItems,
            'userNow' => $userNow,
        ));
    }

    public function backEndAction()
    {
        $em = $this->getDoctrine()->getManager();

        $numUser = $em->getRepository('ShopBundle:User')->createQueryBuilder('a')->select('COUNT(a.id)')->getQuery()->getSingleScalarResult();
        $numOrder = $em->getRepository('ShopBundle:OrderInfo')->createQueryBuilder('b')->select('COUNT(b.id)')->getQuery()->getSingleScalarResult();
        $numProduct = $em->getRepository('ShopBundle:Product')->createQueryBuilder('c')->select('COUNT(c.id)')->getQuery()->getSingleScalarResult();

        $queryU = $em->createQuery("SELECT p FROM ShopBundle:User p WHERE 1=1 order by p.id DESC")->setMaxResults(10);
        $users = $queryU->getResult();

        $queryO = $em->createQuery("SELECT t FROM ShopBundle:OrderInfo t WHERE 1=1 order by t.id DESC")->setMaxResults(10);
        $orders = $queryO->getResult();

        $day6Orders = array();
        for($i=0; $i<6; $i++){
            $queryday6Orders[$i] = $em->createQuery("SELECT COUNT(o) FROM ShopBundle:OrderInfo o where o.orderDate <= DATE_ADD(CURRENT_DATE(), (1-$i), 'day') and o.orderDate >= DATE_SUB(CURRENT_DATE(), $i, 'day')");
            $day6Orders[$i] = $queryday6Orders[$i]->getSingleScalarResult();
        }

        return $this->render('ShopBundle:BackEnd:overview.html.twig', array(
            'numUser' => $numUser,
            'numOrder' => $numOrder,
            'numProduct' => $numProduct,
            'users' => $users,
            'orders' => $orders,
            'day6Orders' => $day6Orders,
        ));
    }

    public function ajaxUpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $isAdd = $request->get('val1');
        $cartItemId = $request->get('val2');
        $repository = $this->getDoctrine()->getRepository('ShopBundle:CartItem');
        $cartItem = $repository->find($cartItemId);
        $cartItem->setQuantity($cartItem->getQuantity()+$isAdd);
        $em->persist($cartItem);
        $em->flush();
        return new Response();
    }

    /**
     * Deletes a CartItem entity in Cart.
     *
     */
    public function cartdeleteAction(CartItem $cartItem)
    {
        $cart = $this->getUser()->getCart();
        $cart->removeCartItem($cartItem);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cartItem);
        $em->flush();

        return $this->redirectToRoute('shop_cart');
    }

    public function guestinfoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        return $this->render('ShopBundle:Default:guestinfo.html.twig', array(
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }

    public function autonomoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        return $this->render('ShopBundle:Info:autonomo.html.twig', array(
            'categories' => $categories,
            'userNow' => $userNow,
        ));
    }

    public function changeAutonomoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userNow = $this->getUser();
        $user = $em->getRepository('ShopBundle:User')->find($userNow);
        $user->setIsAutonomo(!$user->getIsAutonomo());
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('autonomo_index');
    }

    public function pedidoAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();

        $repository = $this->getDoctrine()->getRepository('ShopBundle:OrderInfo');
        $orderInfos = $repository->findByUser($user, array('orderDate' => 'DESC'));

        return $this->render('ShopBundle:Default:pedido.html.twig', array(
            'categories' => $categories,
            'orderInfos' => $orderInfos,
            'userNow' => $user,
        ));
    }

    public function productlistclientAction(OrderInfo $orderInfo)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $userNow = $this->getUser();

        $query = $em->createQuery("SELECT p FROM ShopBundle:OrderItem p WHERE p.orderInfo=$orderInfo");
        $orderItems = $query->getResult();

        return $this->render('ShopBundle:Default:productlistclient.html.twig', array(
            'categories' => $categories,
            'orderItems' => $orderItems,
            'orderInfo' => $orderInfo,
            'userNow' => $userNow,
        ));
    }

    public function addToCartAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $this->getUser()->getCart();
        if(!$cart) {
            $cart = new Cart();
            $cart->setCartState('buying')
                ->setCreateDate(new \DateTime('now'))
                ->setUser($this->getUser());
            $em->persist($cart);
            $em->flush();
        }
        else if($cart->getCartState() == 'over')
        {
            $cart->setCartState('buying')
                ->setCreateDate(new \DateTime('now'));
            $em->persist($cart);
            $em->flush();
        }

        //获取ajax参数
        $productId = $request->get('id');
        $colorId = $request->get('color');
        $sizeName = $request->get('size');

        $repository = $this->getDoctrine()->getRepository('ShopBundle:Product');
        $productshiti = $repository->find($productId);
        $repository = $this->getDoctrine()->getRepository('ShopBundle:Color');
        $colorshiti = $repository->find($colorId);

        $exsiteColor = $this->getDoctrine()->getRepository('ShopBundle:CartItem')->findOneBy(array('cart' => $cart, 'product' => $productshiti, 'colorId' => $colorId, 'sizeName' => $sizeName));

        if($exsiteColor)
        {
            $exsiteColor->setQuantity($exsiteColor->getQuantity()+1);
            $em->persist($exsiteColor);
            $em->flush();
        }
        else
        {
            $newCartItem = new CartItem();
            $newCartItem->setCart($cart)
                ->setProduct($productshiti)
                ->setQuantity(2)
                ->setColorId($colorId)
                ->setColorName($colorshiti->getColorNameEs())
                ->setFoto($colorshiti->getColorFoto())
                ->setSizeName($sizeName);
            $cart->addCartItem($newCartItem);
            $em->persist($newCartItem);
            $em->flush();
        }
        return new Response();
    }
}
