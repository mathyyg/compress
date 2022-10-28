<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\LinkRepository;
use App\Repository\FichierRepository;
use App\Repository\UtilisationRepository;
use App\Repository\ResourceRepository;

class RessourceController extends AbstractController
{

    #[Route('/stats/{url}', name: 'app_ressource')]
    public function index($url, Request $request, LinkRepository $link_repository, 
                        FichierRepository $file_repository, UtilisationRepository $use_repository,
                        ResourceRepository $resource_repository): Response
    {
        $info = $request->request->all();   
        $resource = $resource_repository->findOneBy(['url' => $url]);
        if($resource) {
            $user = $resource->getUser();

            if( ($user != null && $resource_repository->checkAccess($resource, $this->getUser())) || $user==null) {
                $isAdmin = false;
                if($this->getUser()) {
                    $isAdmin = $this->getUser()->hasRole("ROLE_ADMIN");
                }
                $utilisations = $use_repository->findAllForResource($resource->getId(), $user, $isAdmin);
                return $this->render('ressource/stats.html.twig', [
                    'controller_name' => 'RessourceController',
                    'utilisations' => $utilisations,
                    'ressource' => $resource
                ]);
            }
            else {
                return $this->redirectToRoute('app_accueil');
            }
        }
        else {
            return $this->redirectToRoute('app_accueil');
        }
    }
}
