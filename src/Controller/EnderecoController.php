<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('endereco/index.html.twig', [
            'enderecos' => [
                [
                    'quadra' => 'QR 315',
                    'numero' => '25',
                    'observacao' => 'Fica na Santa maria norte',
                ],
                [
                    'quadra' => 'QR 313',
                    'numero' => '20',
                    'observacao' => 'Fica na santa maria norte',
                ],
            ],
        ]);
    }

    /**
     * @Route("/create", name="enderecos_create", methods={"GET"})
     */
    public function create()
    {
        return $this->render('endereco/create.html.twig');
    }
}
