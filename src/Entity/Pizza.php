<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 * @ORM\Table(name="t_pizza")
 */
class Pizza
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="DesignPizz", type="string", length=255)
     */
    private $designationPizza;

    /**
     * @ORM\Column(name="TarifPizz", type="decimal", precision=5, scale=2)
     */
    private $tarifPizza;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationPizza(): ?string
    {
        return $this->designationPizza;
    }

    public function setDesignationPizza(string $designationPizza): self
    {
        $this->designationPizza = $designationPizza;

        return $this;
    }

    public function getTarifPizza(): ?string
    {
        return $this->tarifPizza;
    }

    public function setTarifPizza(string $tarifPizza): self
    {
        $this->tarifPizza = $tarifPizza;

        return $this;
    }
}
