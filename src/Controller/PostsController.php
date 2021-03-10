<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostsController extends AbstractController
{
    #[Route('/registar-posts', name: 'RegistarPosts')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $post = new Posts();
        $form = $this->createForm(type: PostsType::class, data: $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
                //Fazendo upload da imagem
                $fotoFile = $form->get('foto')->getData();
            if ($fotoFile) {
                $originalFilename = pathinfo($fotoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$fotoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $fotoFile->move(
                        $this->getParameter('fotos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Erro ao carregar a imagem. Tente novamente!');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setFoto($newFilename);
            }

            $user = $this->getUser();
            $post->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em ->persist($post);
            $em ->flush();
//            $this->addFlash('sucesso',message:Posts::REGISTO_SUCESSO);
           return $this->redirectToRoute(route: 'dashboard');
        }
        return $this->render('posts/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
