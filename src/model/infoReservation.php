<?php

namespace App\model;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class infoReservation    
{
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"le champ date est vide, il doit etre rempli.")]
    private ?\DateTimeInterface $date ;


    public function getDate():\DateTimeInterface
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;    
    }
    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ nombre de mois est vide, il doit etre rempli.")]
    private ?int $nbMois ;
    

    public function getNbMois():int
    {
        return $this->nbMois;
    }
    public function setNbMois($nbMois)
    {
        $this->nbMois = $nbMois;    
    } 

}