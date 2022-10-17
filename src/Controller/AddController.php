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
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/lien')]
class AddController extends AbstractController
{
    #[Route('/add', name: 'app_add')]
    public function index(Request $request,MotsAleatoire $motsaleatoire ,ResourceRepository $resourcerepository , LinkRepository $linkrepository , UserInterface $user): Response
    {
        $info= $request->query->all();
        $mots= $motsaleatoire->getmots();
        if(array_key_exists('type', $info)){
            if($info['type'] == "link"){
                $resoucre= new Resource();
                $resoucre->setUrl($mots);
                $resoucre->settype("link");
                if($info['pass'] != ''){
                    $resoucre->setResourcePassword($info['pass']);
                }
                if ($user) {
                    $resoucre->setUser($user);
                }
                $resourcerepository->save($resoucre,true);
                $link= new Link();
                $link->setInputLink($info['lien']);
                $link->setResource($resoucre);
                $linkrepository->save($link,true);

            }else{

            }
        }

        return $this->render('add/index.html.twig', [
        ]);
    }

    #[Route('/{url}', name: 'app_view')]
    public function view(Resource $resoucre, LinkRepository $linkrepository,Request $request,UtilisationRepository $utilisationrepository): Response
    {
        $ip= $request->server->get('REMOTE_ADDR');
        $util= new Utilisation();
        $util->setIp($ip);
        $util->setResource($resoucre);
        

        $info= $request->query->all();
        if($resoucre->getType() == "link"){
            if($resoucre->getResourcePassword() == null){

                $utilisationrepository->save($util,true);
                $lien = $linkrepository->findOneByid($resoucre->getId());
                return $this->redirect($lien->getInputLink());

            }elseif(array_key_exists('pass', $info) && $info['pass']== $resoucre->getResourcePassword()  ){
                
                $utilisationrepository->save($util,true);
                $lien = $linkrepository->findOneByid($resoucre->getId());
                return $this->redirect($lien->getInputLink());

            }else{
                return $this->render('add/pass.html.twig', [
                    'ressource' => $resoucre
                ]);
            }
        }

        return $this->render('add/index.html.twig', [
        ]);
    }
}
