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
        return $this->render('endereco/index.html.twig', ['enderecos' => $enderecos->findAll()]);
    }

    /**
     * @Route("/create", name="enderecos_create", methods={"GET"})
     */
    public function create()
    {
        return $this->render('endereco/create.html.twig');
    }

    /**
     * @Route("/store", name="enderecos_store", methods={"POST"})
     */
    public function store(Request $request): Response
    {
        echo "<pre>";
        print_r($request);
        exit;
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->getConnection()->beginTransaction();
        try {
            $endereco = new Endereco();
            $endereco->setQuadra($request->get('quadra'));
            $endereco->setNumero($request->get('numero'));
            $endereco->setObservacao($request->get('observacao'));

            $entityManager->persist($endereco);
            $entityManager->flush();

            $entityManager->getConnection()->commit();

            return $this->json([], 201);
        } catch (Exception $e) {
            $entityManager->getConnection()->rollBack();
            return $this->json([], 400);
        }

    }

    /**
     * @Route("/{id}/edit", name="enderecos_edit", methods={"GET"})
     */
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $enderecos = $entityManager->getRepository(Endereco::class);
        $endereco = $enderecos->find($id);
        return $this->render('endereco/edit.html.twig', compact('endereco'));
    }

    /**
     * @Route("/{id}/update", name="enderecos_update", methods={"POST"})
     */
    public function update(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->getConnection()->beginTransaction();
        try {
            $enderecos = $entityManager->getRepository(endereco::class);
            $endereco = $enderecos->find($id);
            
            $endereco->setQuadra($request->get('quadra'));
            $endereco->setNumero($request->get('numero'));
            $endereco->setObservacao($request->get('observacao'));

            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollBack();
            echo $e->getMessage();
            exit;
        }

        return $this->redirectToRoute('enderecos');
    }

    /**
     * @Route("/{id}/destroy", name="enderecos_destroy", methods={"GET"})
     */
    public function destroy($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $enderecos = $entityManager->getRepository(Endereco::class);
        $endereco = $enderecos->find($id);
        
        $entityManager->remove($endereco);
        $entityManager->flush();

        return $this->redirectToRoute('enderecos');
    }
}
