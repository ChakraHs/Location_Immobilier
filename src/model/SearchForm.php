<?php

namespace App\model;

use Doctrine\ORM\Mapping as ORM;

class SearchForm    
{
    #[ORM\Column]
    private ?string $ville = '';


    public function getVille():string
    {
        return $this->ville;
    }
    public function setVille($ville)
    {
        $this->ville = $ville;    
    }
    #[ORM\Column]
    private ?string $type = '';
    

    public function getType():string
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;    
    }

    #[ORM\Column]
    private ?float $prixMin = 0;
    

    public function getPrixMin():float
    {
        return $this->prixMin;
    }
    public function setPrixMin($prixMin)
    {
        $this->prixMin = $prixMin;    
    }



    #[ORM\Column]
    private ?float $prixMax;
    

    public function getPrixMax():float
    {
        return $this->prixMax;
    }
    public function setPrixMax($prixMax)
    {
        $this->prixMax = $prixMax;    
    }


    #[ORM\Column]
    private ?float $surfaceMin;
    
    public function getSurfaceMin():float
    {
        return $this->surfaceMin;
    }
    public function setSurfaceMin($surfaceMin)
    {
        $this->surfaceMin = $surfaceMin;    
    }

    #[ORM\Column]
    private ?float $surfaceMax = 0;
    
    public function getSurfaceMax():float
    {
        return $this->surfaceMax;
    }
    public function setSurfaceMax($surfaceMax)
    {
        $this->surfaceMax = $surfaceMax;    
    }


    #[ORM\Column]
    private ?int $chambres;
    
    public function getChambres():int
    {
        return $this->chambres;
    }
    public function setChambres($chambres)
    {
        $this->chambres = $chambres;    
    }


    


}