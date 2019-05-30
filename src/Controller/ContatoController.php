<?php

namespace App\Controller;

use App\Entity\Contato;
use App\Form\ContatoType;
use App\Repository\ContatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contato")
 */
class ContatoController extends AbstractController
{
    /**
     * @Route("/", name="contato_index", methods={"GET"})
     */
    public function index(ContatoRepository $contatoRepository): Response
    {
        return $this->render('contato/index.html.twig', [
            'contatos' => $contatoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contato = new Contato();
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contato);
            $entityManager->flush();

            return $this->redirectToRoute('contato_index');
        }

        return $this->render('contato/new.html.twig', [
            'contato' => $contato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contato_show", methods={"GET"})
     */
    public function show(Contato $contato): Response
    {
        return $this->render('contato/show.html.twig', [
            'contato' => $contato,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contato $contato): Response
    {
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contato_index', [
                'id' => $contato->getId(),
            ]);
        }

        return $this->render('contato/edit.html.twig', [
            'contato' => $contato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contato_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contato $contato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contato->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contato_index');
    }
}
