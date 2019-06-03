<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Endereco;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EnderecoRepository;

/**
 * @Route("/enderecos")
 */
class EnderecoController extends AbstractController
{
    /**
     * @Route("/", name="enderecos", methods={"GET"})
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $enderecos = $entityManager->getRepository(Endereco::class);
        return $this->render('endereco/index.html.twig', $enderecos->findAll());
    }

    /**
     * @Route("/create", name="enderecos_create", methods={"GET"})
     */
    public function create()
    {
        return $this->render('endereco/create.html.twig');
    }
}
