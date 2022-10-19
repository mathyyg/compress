<?php
namespace App\Service;



class MotsAleatoire 
{

    function getmots($longueur = 6 , $ressources = null )
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++){
            
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }

        foreach ( $ressources as &$ressource) {
            if( $ressource->getUrl()== $chaineAleatoire ){
                return getmots();
            }
        }

        return $chaineAleatoire;
        
    }
}
?>