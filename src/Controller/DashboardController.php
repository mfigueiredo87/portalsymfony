<?php

namespace App\Controller;

use App\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
//        Trazer todos os resultados do banco de dados
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Posts::class)->findAll();
//        selecionar apenas dado pelo id
        $post = $em->getRepository(Posts::class)->find(5);
//        Filtrar por um valor especifico
        $postF = $em->getRepository(Posts::class)->findOneBy(['titulo'=>'Linguagem C']);
//        Filtar por alguns criterios
        $postCriterios = $em->getRepository(Posts::class)->findBy(['likes'=>'']);


        return $this->render('dashboard/index.html.twig', [
            'posts' => $posts,
            'post'=>$post,
            'postF' => $postF,
            'postCriterios'=>$postCriterios
        ]);
    }
}
