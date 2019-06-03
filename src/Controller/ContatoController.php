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
        $entityManager = $this->getDoctrine()->getManager();
        $contatos = $entityManager->getRepository(Contato::class);
        return $this->json($contatos->findAll(), 200);
    }

    /**
     * @Route("/create", name="contatos_create", methods={"GET"})
     */
    public function create()
    {
        return $this->render('contato/create.html.twig');
    }

    /**
     * @Route("/store", name="contatos_store", methods={"POST"})
     */
    public function store(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $contato = new Contato();
        $contato->setNome($request->get('nome'));
        $contato->setEmail($request->get('email'));
        $contato->setTelefone($request->get('telefone'));

        $entityManager->persist($contato);
        $entityManager->flush();

        return $this->redirectToRoute('contatos');
    }

    /**
     * @Route("/{id}/edit", name="contatos_edit", methods={"GET"})
     */
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contatos = $entityManager->getRepository(Contato::class);
        $contato = $contatos->find($id);
        return $this->render('contato/edit.html.twig', compact('contato'));
    }

    /**
     * @Route("/{id}/update", name="contatos_update", methods={"POST"})
     */
    public function update(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contatos = $entityManager->getRepository(Contato::class);
        $contato = $contatos->find($id);
        
        $contato->setNome($request->get('nome'));
        $contato->setEmail($request->get('email'));
        $contato->setTelefone($request->get('telefone'));

        $entityManager->flush();

        return $this->redirectToRoute('contatos');
    }

    /**
     * @Route("/{id}/destroy", name="contatos_destroy", methods={"GET"})
     */
    public function destroy($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contatos = $entityManager->getRepository(Contato::class);
        $contato = $contatos->find($id);
        
        $entityManager->remove($contato);
        $entityManager->flush();

        return $this->redirectToRoute('contatos');
    }
}
