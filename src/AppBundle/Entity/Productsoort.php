<?php
// src/Entity/Product.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collection\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name= "productsoort")
  */
  class ProductSoort


  {
      /**
       * @ORM\Id
       * @ORM\GeneratedValue(strategy="AUTO")
       * @ORM\Column(type="integer")
       */
  private $Tid;

      /**
          * @ORM\Column(type="string", length=100)
          */
  private $Beschrijving;

  /**
  * @ORM\OneToMany(targetEntity="Product", mappedBy="ProductSoort")
  */

  private $producten;

  public function setTid($Tid){
    $this->$Tid =$Tid;
  }

  public function getTid(){
      return $this->$Tid;
    }

  public function setBeschrijving($Beschrijving){
    $this->$Beschrijving=$Beschrijving;
  }
  public function getBeschrijving(){
    return $this->$Beschrijving;
  }

  public function __construct()
  {
    $this->$producten = new ArrayCollection();
  }
  }
  ?>
