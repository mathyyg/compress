<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Form\AvatarType;
use App\Repository\AvatarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    
    #[Route('/profile/avatar', name: 'app_avatar')]
    public function index(Request $request, AvatarRepository $avatarrepository): Response
    {
        $avatar = new Avatar();
        $form = $this->createForm(AvatarType::class, $avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $avatar->setUser($user);
            $avatarrepository->save($avatar, true);
        }

        return $this->render('avatar/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
