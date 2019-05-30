<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrincipalController extends AbstractController
{
	/**
	* @Route("/")
	*/	
  public function index()
  {
    return $this->render('principal.html.twig', ['mensagem' => 'Sucesso muleque']);
  }
}