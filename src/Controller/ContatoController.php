<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('contato/index.html.twig', [
            'contatos' => [
                [
                    'nome' => 'Tácio Teixeira',
                    'email' => 'tacio.7brito@gmail.com',
                    'telefone' => '61 99282-5546',
                ],
                [
                    'nome' => 'Mozart Teixeira',
                    'email' => 'mozartcomart@gmail.com',
                    'telefone' => '61 92135-1116',
                ],
            ],
        ]);
    }

    /**
     * @Route("/create", name="contatos_create", methods={"GET"})
     */
    public function create()
    {
        return $this->render('contato/create.html.twig');
    }
}
