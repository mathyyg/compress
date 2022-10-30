<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SiteVariableRepository;
use App\Entity\SiteVariable;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(SiteVariableRepository $siteVariableRepository): Response
    {
        $site_variables = $siteVariableRepository->findOnlyOne();
        dd($site_variables);
        if($site_variables) {
            $titre = $site_variables['titre'];
            $description = $site_variables['description'];
        }
        else {
            $newvariables = new SiteVariable;
            $newvariables->setTitre('Compress');
            $newvariables->setDescription('Obtenez un lien plus court pour vos ressources et fichiers');
            $siteVariableRepository->save($newvariables, true);

            $titre = $newvariables->getTitre();
            $description = $newvariables->getDescription();
        }
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'titre' => $titre,
            'description' => $description
        ]);
    }
}