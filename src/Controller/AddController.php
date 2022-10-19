<?php

namespace App\Controller;

use App\Service\MotsAleatoire;
use App\Entity\Resource;
use App\Entity\Link;
use App\Entity\Utilisation;
use App\Repository\UtilisationRepository;
use App\Repository\ResourceRepository;
use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AddController extends AbstractController
{
    #[Route('/add', name: 'app_add')]
    public function index(Request $request,MotsAleatoire $motsaleatoire ,ResourceRepository $resourcerepository , LinkRepository $linkrepository ): Response
    {
        $user = $this->getUser();
        $info= $request->query->all();
        $mots= $motsaleatoire->getmots(6,$resourcerepository->findAll());
        if(array_key_exists('type', $info)){

            $resource= new Resource();
            $resource->setUrl($mots);
            if( array_key_exists('pass', $info) && $info['pass'] != '' ){
                $resource->setResourcePassword(password_hash($info['pass'], PASSWORD_DEFAULT));
            }
            if ($user) {
                $resource->setUser($user);
            }

            if($info['type'] == "link"){

                $resource->settype("link");
                $resourcerepository->save($resource,true);
                $link= new Link();
                $link->setInputLink($info['lien']);
                $link->setResource($resource);
                $linkrepository->save($link,true);
                
                return $this->render('add/success.html.twig', [
                    'ressource' => $resource
                ]);

            }else{

            }
        }

        
        return $this->render('add/index.html.twig', [
        ]);
    }

    #[Route('/l/{url}', name: 'app_view')]
    public function view(Resource $resource, LinkRepository $linkrepository,Request $request,UtilisationRepository $utilisationrepository): Response
    {

        $ip= $request->server->get('REMOTE_ADDR');
        $util= new Utilisation();
        $util->setIp($ip);
        $util->setResource($resource);
        

        $info= $request->query->all();
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
                return $this->render('add/pass.html.twig', [
                    'ressource' => $resource
                ]);
            }
        }else{


        }

        return $this->render('add/index.html.twig', [
        ]);
    }
}
