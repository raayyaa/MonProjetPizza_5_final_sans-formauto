<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class PizzaController extends AbstractController
{

    /**
     * @Route("/pizza", name="pizza")
     */
    public function indexallormpizza()
    {
        $repo = $this->getDoctrine()->getRepository(Pizza::class);
        $tablopizza = $repo->findAll();
        // var_dump($tablopizza);

        return $this->render('listepizzaorm.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'Liste des Pizzas',
            'tablopizza' => $tablopizza
        ]);
    }

    /**
     * @Route("/pizzainjdep", name="pizzainjdep")
     */
    public function indexallormpizzainjdep( PizzaRepository $repo )
    {
         $tablopizza = $repo->findAll();
        // var_dump($tablopizza);

        return $this->render('listepizzaorm.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'Liste des Pizzas par injection de dépendances',
            'tablopizza' => $tablopizza
        ]);
    }

    /**
     * @Route("/pizza/{id}", name="OnePizza", requirements={"id"="\d+"},methods={"GET"})
     */
    public function indexonePizza($id)
    {
        $repo = $this->getDoctrine()->getRepository(Pizza::class);
        $maPizza = $repo->find($id);

        var_dump($maPizza);
        // die();

        return $this->render('Onepizza.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'Just One Pizza',
            'maPizza' => $maPizza
        ]);
    }
    /**
     * @Route("/pizzainjdep/{id}", name="OnePizzainjdep", requirements={"id"="\d+"},methods={"GET"})
     */
    public function indexonePizzainjdep(Pizza $maPizza)
    {

       // grace au paramconverter il se débrouille   pour trouver la pizza du bin id
      // et encore au service container
        var_dump($maPizza);
        // die();

        return $this->render('Onepizza.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'Just One Pizza',
            'maPizza' => $maPizza
        ]);
    }

    /**
     * @Route("/creerpizza", name="creerpizza" )
     */
    public function creationPizza()
    {

        $maPizza = new Pizza();

        var_dump($maPizza);


        return $this->render('newpizza.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'create One Pizza'
        ]);
    }

    /**
     * @Route("/pizza/{id}/update2", name="modifOnePizza", requirements={"id"="\d+"},methods={"GET"})
     */
    public function modifOnePizza2(Pizza $maPizza)
    {



        var_dump($maPizza);
          die();


        return $this->render('modifOnepizza.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'Just One Pizza',
            'maPizza' => $maPizza
        ]);
    }

    /**
     * @Route("/pizza/{id}/update", name="modifOnePizza", requirements={"id"="\d+"},methods={"GET"})
     */
    public function modifOnePizza($id)
    {


        $repo = $this->getDoctrine()->getRepository(Pizza::class);
        $maPizza = $repo->find($id);

        var_dump($maPizza);
        // die();


        return $this->render('modifOnepizza.html.twig', [
            'controller_name' => 'PizzaController',
            'titre' => 'Just One Pizza',
            'maPizza' => $maPizza
        ]);
    }

    /**
     * @Route("/pizza/{id}/updateOnePizza", name="updateOnePizza",  requirements={"id"="\d+"},methods={"POST"})
     */
    public function UpdateOnePizza($id,ManagerRegistry $managerRegistry)
    {


        echo("retour du formulaire");
        var_dump($_POST);

        echo("a faire : update dans la base .. idem pour l'insert ");

        $request = Request::createFromGlobals();
        // retrieves $_SERVER variables
        $request->server->get('HTTP_HOST');
        var_dump($request->request->all());

        $content = $request->getContent();
        var_dump($content);


        $repo = $this->getDoctrine()->getRepository(Pizza::class);
        $maPizza = $repo->find($id);

        $maPizza->setDesignationPizza($request->request->get('designation'))
            ->setTarifPizza($request->request->get('tarif'));
        var_dump($maPizza);
        echo("********************************");
        dump($maPizza); // pour symphony
        
        $em = $managerRegistry->getManager(); // il faut ManagerRegistry $managerRegistry et le use doctrine\...
        $em->persist($maPizza);
        $em->flush();
        return $this->redirectToRoute('pizza');
    }
    /**
     * @Route("/newPizza", name="newPizza", methods={"POST"})
     */
    public function createOnePizza(Request $request, ManagerRegistry $managerRegistry)
    {
        if ( $request->request->count() > 0){
            // si on revient du formulaire avec des datas post
                                  }
        var_dump($request);
        echo("********************************");
        var_dump($request->files);
        echo("********************************");
        var_dump($request->request);
        var_dump($request->request->get('designation'));
        var_dump($request->request->get('tarif'));
        echo("********************************");
        echo("retour du formulaire");
        var_dump($_POST);
        var_dump($_FILES);
        echo("a faire : insert dans la base .. idem pour l'insert ");
        echo("ou par injection de dépendance et entity ");
        $request = Request::createFromGlobals();
        // retrieves $_SERVER variables
        $request->server->get('HTTP_HOST');
        var_dump($request->request->all());

        $content = $request->getContent();
        var_dump($content);
        echo("********************************");
        echo("creation d'une pizza");
        $mapizza1 = new Pizza();
        $mapizza1->setDesignationPizza($request->request->get('designation'));
        $mapizza1->setTarifPizza($request->request->get('tarif'));
        // il est possible de "piper"
        $mapizza2 = new Pizza();
        $mapizza2->setDesignationPizza($request->request->get('designation'))
                  ->setTarifPizza($request->request->get('tarif'));
        var_dump($mapizza1);
        echo("********************************");
        dump($mapizza1); // pour symphony

        $em = $managerRegistry->getManager(); // il faut ManagerRegistry $managerRegistry et le use doctrine\...
        $em->persist($mapizza1);
        $em->flush();
         die();
        return $this->redirectToRoute('pizza');

    }
    /**
     * @Route("/visu", name="visu", methods={"POST"})
     */
    public function visualiseImage()
    {


        $con = mysqli_connect('localhost', 'root', '', 'pizzabox');
        $sql_req = "SELECT MAX(id) from t_pizza";
        $req = mysqli_query($con, $sql_req);
        $results = mysqli_fetch_array($req);
        $cur_auto_id = $results['MAX(id)'] + 1;


        if(is_array($_FILES)) {

            if(is_uploaded_file($_FILES['photoupload']['tmp_name'])) {

                $sourcePath = $_FILES['photoupload']['tmp_name'];



                $targetPath = "./images/".$cur_auto_id.".jpg";



                if(move_uploaded_file($sourcePath,$targetPath)) {

                    return new Response($cur_auto_id.".jpg");
                }
            }
        }



    }

    /**
     * @Route("/pizza/{id}/delete", name="deleteOnePizza", requirements={"id"="\d+"},methods={"GET"})
     * @param $id
     * @param $managerRegistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteOnePizza($id, ManagerRegistry $managerRegistry)
    {


        $repo = $this->getDoctrine()->getRepository(Pizza::class);
        $maPizza = $repo->find($id);

        //var_dump($maPizza);
        // die();


        $em = $managerRegistry->getManager(); // il faut ManagerRegistry $managerRegistry et le use doctrine\...
        $em->remove($maPizza);
        $em->flush();

        return $this->redirectToRoute('pizza');
    }



    /**
     * @Route("/visupload/{id}", name="visupload",requirements={"id"="\d+"}, methods={"POST"})
     */
    public function visualiseImageUpload($id)
    {



        if(is_array($_FILES)) {

            if(is_uploaded_file($_FILES['imageUpload']['tmp_name'])) {

                $sourcePath = $_FILES['imageUpload']['tmp_name'];



                $targetPath = "./images/".$id.".jpg";



                if(move_uploaded_file($sourcePath,$targetPath)) {

                    return new Response($id.".jpg");
                }
            }
        }



    }
}
