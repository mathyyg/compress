<?php

namespace App\Controller;

use App\Service\MotsAleatoire;
use App\Entity\Resource;
use App\Entity\Link;
use App\Entity\Fichier;
use App\Entity\Utilisation;
use App\Repository\UtilisationRepository;
use App\Repository\ResourceRepository;
use App\Repository\LinkRepository;
use App\Repository\FichierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\FileAbstraction\ReplacingFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Form\ResourceFormType;


class ResourceController extends AbstractController
{
    #[Route('/add', name: 'app_add')]
    public function index(Request $request,MotsAleatoire $motsaleatoire ,ResourceRepository $resourcerepository , LinkRepository $linkrepository , FichierRepository $filesrepository): Response
    {
        $user = $this->getUser();
        $info= $request->request->all();
        $mots= $motsaleatoire->getmots($resourcerepository);

        $resource= new Resource();
        $resource->setUrl($mots);
        if( array_key_exists('pass', $info) && $info['pass'] != '' ){
            $resource->setResourcePassword(password_hash($info['pass'], PASSWORD_DEFAULT));
        }
        if ($user) {
            $resource->setUser($user);
        }

        if(array_key_exists('type', $info)){
            if($info['type'] == "link"){
                    $resource->settype("link");
                    $resourcerepository->save($resource,true);

                    $link= new Link();
                    $link->setInputLink($info['ressource'][0]);
                    $link->setResource($resource);
                    $linkrepository->save($link,true);
                    
            }else{
                    $resource->settype("file");
                    $resourcerepository->save($resource,true);

                    $file = new Fichier();
                    $file->setResource($resource);
                    $fichier = $request->files->get('ressource');
                    $file->setFile($fichier[0]);
                    $filesrepository->save($file,true);
            }
            return $this->render('Resource/success.html.twig', [
                'ressource' => $resource
            ]);
            }
        

            return $this->render('Resource/index.html.twig', [
            ]);

    }

    #[Route('/l/{url}', name: 'app_view')]
    public function view(Resource $resource, LinkRepository $linkrepository,Request $request,UtilisationRepository $utilisationrepository , FichierRepository $filesrepository): Response
    {

        $ip= $request->server->get('REMOTE_ADDR');
        $util= new Utilisation();
        $util->setIp($ip);
        $util->setResource($resource);
        $util->setUrl($resource->getUrl());
        

        $info= $request->request->all();
        if($resource->getType() == "link"){
            if($resource->getResourcePassword() == null){

                $utilisationrepository->save($util,true);
                $lien = $linkrepository->findOneByid($resource->getId());
                return $this->redirect($lien->getInputLink());

            }elseif(array_key_exists('pass', $info) && password_verify($info['pass'],$resource->getResourcePassword())  ){
                
                $utilisationrepository->save($util,true);
                $lien = $linkrepository->findOneByid($resource->getId());
                return $this->redirect($lien->getInputLink());

            }else{
                return $this->render('Resource/pass.html.twig', [
                    'ressource' => $resource
                ]);
            }
        }else{
            if($resource->getResourcePassword() == null){

                $utilisationrepository->save($util,true);
                $fichier = $filesrepository->findOneByid($resource->getId());
                return $this->render('Resource/affiche.html.twig', [
                    'fichier' => $fichier
                ]);

            }elseif(array_key_exists('pass', $info) && password_verify($info['pass'],$resource->getResourcePassword())  ){
                
                $utilisationrepository->save($util,true);
                $fichier = $filesrepository->findOneByid($resource->getId());
                return $this->render('Resource/affiche.html.twig', [
                    'fichier' => $fichier
                ]);

            }else{
                return $this->render('Resource/pass.html.twig', [
                    'ressource' => $resource
                ]);
            }

        }

    }

    #[Route('/profile/edit/{url}', name: 'app_edit_resource')]
    public function modifresource(Resource $resource ,Request $request, ResourceRepository $resourcerepository ): Response
    {
        $form = $this->createForm(ResourceFormType::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resource->setDateModified();
            $resourcerepository->save($resource, true);
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('Resource/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
