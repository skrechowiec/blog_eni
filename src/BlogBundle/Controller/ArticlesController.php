<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;
use BlogBundle\Entity\Commentaires;
use BlogBundle\Form\ArticleType;
use BlogBundle\Form\CommentairesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{
    public function detailAction($id, Request $request)
    {
        //le repository sert à faire des SELECT dans cette table
        $repo = $this->getDoctrine()->getRepository('BlogBundle:Article');
        $article = $repo->find($id);

        $commentaire = new Commentaires();
        $commentaire->setArticle($article);
        $commentaire->setDateCreation(new \DateTime());
        $commentaire->setHeureCreation(new \DateTime());

        $form = $this->createForm(CommentairesType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            $this->addFlash("success", "votre commentaire a été prise en compte");
            return $this->redirectToRoute("article_detail", ["id" => $article->getId()]);

        }

        return $this->render('BlogBundle:Avis:detail.html.twig', [
            "form" => $form->createView(),
            "article" => $article
        ]);
    }
    public function creationAction(Request $request)
    {
        $article = new Article();
        $article->setDateCreation(new \DateTime());
        $article->setDateModification(new \DateTime());
        $article->setAuteur($this->getUser());

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash("success", "votre événement a bien été enregistré");
            return $this->redirectToRoute("article_detail", ["id" => $article->getId()]);
        }

        return $this->render('BlogBundle:Article:create.html.twig', [
            "form" => $form->createView()
        ]);
    }
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('BlogBundle:Article');
        $articles = $repo->lesCinqDerniersArticles(15);

        return $this->render('BlogBundle:Article:create.html.twig', [
            "articles" => $articles
        ]);
    }

}
