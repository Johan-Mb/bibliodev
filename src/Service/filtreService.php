<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class filtreService extends AbstractController
{
    // On récupère les sous-thèmes liés aux thèmes de chaque utilisateur
    public function getSubthemes()
    {
        $getSubthemes = [];
        foreach ($this->getUser()->getThemes() as $s) {
            $subtheme = $s->getSubthemes();
            array_push($getSubthemes);
        }
        //Group by name ASC
        usort($getSubthemes, function($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });
        return $getSubthemes;
    }
}
