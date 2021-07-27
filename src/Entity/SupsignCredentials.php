<?php

namespace Supsign\ContaoGeoDataApiBundle\Entity;
use \Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Log
 *
 * @ORM\Entity
 * @ORM\Table(name="tl_supsign_credential")
 * @ORM\Entity(repositoryClass="Supsign\ContaoGeoDataApiBundle\Repository\GeoDataApiRepositry")
 */
class SupsignCredentials
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", options={"default" : ""})
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", options={"default" : ""})
     */
    protected $client_id;

    /**
     * @var string
     * @ORM\Column(type="string", options={"default" : ""})
     */
    protected $client_secret;

    // Diese Funktion ist sehr hilfreich, um alle Daten als Array zu erhalten. 
    public function getData() {
        $arrData = [];
        foreach(preg_grep('|^get(?!Data)|', get_class_methods($this)) as $method) {
            $arrData[($Field = lcfirst(substr($method, 3)))] = $this->{$method}();
            if(is_object($arrData[$Field])) {
                $arrData[$Field] = $arrData[$Field]->getData();
            }
        }
        
        return $arrData;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        return $this->$name = $value;
    }
}