<?php

namespace App\model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

class PaiementForm   
{
    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ Nom complet est vide, il doit etre rempli.")]
    private ?String $nomComplet ;


    public function getNomComplet():String
    {
        return $this->nomComplet;
    }
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;    
    }
    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ CVV est vide, il doit etre rempli.")]
    private ?int $CVV ;
    

    public function getCVV():int
    {
        return $this->CVV;
    }
    public function setCVV($CVV)
    {
        $this->CVV = $CVV;    
    } 


    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ numero de la carte est vide, il doit etre rempli.")]
    private ?int $num ;
    

    public function getNum():int
    {
        return $this->num;
    }
    public function setNum($num)
    {
        $this->num = $num;    
    } 



    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ mois est vide, il doit etre rempli.")]
    private ?int $mois ;
    

    public function getMois():int
    {
        return $this->mois;
    }
    public function setMois($mois)
    {
        $this->mois = $mois;    
    } 



    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ annee est vide, il doit etre rempli.")]
    private ?int $annee ;
    

    public function getAnnee():int
    {
        return $this->annee;
    }
    public function setAnnee($annee)
    {
        $this->annee = $annee;    
    } 




}