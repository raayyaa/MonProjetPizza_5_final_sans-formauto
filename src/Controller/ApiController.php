<?php


namespace App\Controller;

use App\Entity\Hotel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ApiController extends AbstractController
{
    /**
     * @Route("/api/pizza",  name="Pizzajson", methods={"GET","HEAD"})
     */
    public function jsonpizza()
    {
        $con = mysqli_connect('localhost', 'root', '', 'pizzabox');
        mysqli_query($con, "SET CHARACTER SET 'utf8'");
        /****************SELECT INFO PIZZA**********************/
        $sql_req = "select * from pizza;";
        $req = mysqli_query($con, $sql_req);

        $tablopizza = mysqli_fetch_all($req, MYSQLI_ASSOC);

        //var_dump($tablopizza);
        //die();

        mysqli_close($con);


        return $this->json(['pizzas' => $tablopizza]);
    }

    /**
     * @Route("/api/pizza/{id}", name="OnePizzajson", requirements={"id"="\d+"},methods={"GET"})
     */
    public function indexonePizza($id)
    {
        $con = mysqli_connect('localhost', 'root', '', 'pizzabox');
        mysqli_query($con, "SET CHARACTER SET 'utf8'");
        /****************SELECT INFO PIZZA**********************/
        $sql_req = "select * from pizza where NroPizz =" . $id;
        $req = mysqli_query($con, $sql_req);

        $tablopizza = mysqli_fetch_all($req, MYSQLI_ASSOC);

        //var_dump($tablopizza);
        //die();

        mysqli_close($con);


        return $this->json(['pizzas' => $tablopizza]);
    }
}