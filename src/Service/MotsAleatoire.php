<?php
namespace App\Service;

use App\Repository\ResourceRepository;

class MotsAleatoire 
{

    function getmots(ResourceRepository $resourcerepository )
    {
        $longueur =6;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++){
            
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }

            if( $resourcerepository->findOneByurl($chaineAleatoire) != null){
                return getmots($resourcerepository);
            }


        return $chaineAleatoire;
        
    }
}
?>