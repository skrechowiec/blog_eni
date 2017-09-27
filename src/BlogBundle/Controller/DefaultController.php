<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;
use BlogBundle\Entity\Commentaires;
use BlogBundle\Form\ArticleType;
use BlogBundle\Form\CommentairesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('BlogBundle:Article');
        $articles = $repo->lesCinqDerniersArticles(15);

        return $this->render('BlogBundle:Default:index.html.twig', [
            "articles" => $articles
        ]);
    }

}
