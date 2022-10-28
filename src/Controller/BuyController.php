<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;

class BuyController extends AbstractController
{
    #[Route('/buy', name: 'app_buy')]
    public function index(Request $request,UserRepository $userrepository): Response
    {
        $info= $request->request->all();
        //dd($info);
        if( array_key_exists('numero_de_carte', $info) && $info['numero_de_carte'] != '' ){
            $user = $this->getUser();
            $user->addRole("ROLE_VIP");
            $userrepository->save($user,true);
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('buy/index.html.twig', [
        ]);
    }
}
