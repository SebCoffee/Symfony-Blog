<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 03/10/18
 * Time: 13:54
 */

namespace App\Controller\Admin;


use App\Controller\Form\PostType;
use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function index(PostRepository $repository)
    {
        $allPosts = $repository->findAll();
        return $this->render('Admin/Post/index.html.twig', ["allPosts"=>$allPosts,]);
    }

    public function edit($id, PostRepository $repository, Request $request, EntityManagerInterface $entityManager)
    {
        $post = $repository->find($id);
        // instancie la classe PostType, et on lui injecte les valeur du post
        $form = $this->createForm(PostType::class, $post);
        // le formulaire recupere les données en post dans $_POST
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // traitement des données du formulaire
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Post mis à jour');
            return $this->redirectToRoute('admin.post.index');
        }

        return $this->render('Admin/Post/post.html.twig',["post"=>$post, 'form'=>$form->createView()]);
    }

    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // traitement des données du formulaire
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Post crée');
            return $this->redirectToRoute('admin.post.index');
        }

        return $this->render('Admin/Post/create.html.twig',["post"=>$post, 'form'=>$form->createView()]);
    }

    public function delete()
    {

    }


}