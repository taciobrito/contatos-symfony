<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contato;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContatoRepository;

/**
 * @Route("/contatos")
 */
class ContatoController extends AbstractController
{
    /**
     * @Route("/", name="contatos", methods={"GET"})
     */
    public function index()
    {
        return $this->render('contato/index.html.twig');
    }

    /**
     * @Route("/api/list", name="api_contatos", methods={"GET"})
     */
    public function contatos()
    {
        return $this->json(
            $this->getDoctrine()
                ->getRepository(Contato::class)
                ->all(), 200);
    }

    /**
     * @Route("/create", name="contatos_create", methods={"GET"})
     */
    public function create()
    {
        return $this->render('contato/create.html.twig');
    }

    /**
     * @Route("/product", name="contatos_store", methods={"POST"})
     */
    public function store(Request $request): Response
    {
        echo "<pre>";
        print_r($request);
        exit();
        $entityManager = $this->getDoctrine()->getManager();

        $contato = new Contato();
        $contato->setNome();
        // $contato->setPrice(1999);
        // $contato->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the contato (no queries yet)
        $entityManager->persist($contato);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}
