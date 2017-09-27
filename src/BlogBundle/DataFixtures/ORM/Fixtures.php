<?php
namespace AppBundle\DataFixtures\ORM;

use BlogBundle\Entity\Article;
use BlogBundle\Entity\Commentaires;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Users;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;


class Fixtures extends Fixture implements ContainerAwareInterface
{
    protected $container;
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 5; $i++){
            $user = new Users();
            $user -> setUsername( $faker->userName);
            $user -> setEmail( $faker->email);
            $user -> setRoles("ROLES_REDACTOR");

            $user -> setPassword($user -> getUsername());
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($encoded);

            $user -> setDateregistration($faker->dateTimeBetween('-1 years'));
            $manager->persist($user);
        }

        $manager->flush();

        $userRepo = $manager->getRepository("BlogBundle:Users");
        $allUsers = $userRepo->findAll();

        for ($i = 0; $i < 30; $i++) {
            $article = new Article();
            $article -> setTitre( $faker->sentence());
            $article -> setDateCreation ( $faker->dateTimeBetween('-1 years'));
            $article -> setDateModification  ($faker->dateTimeBetween('-6 month'));
            $article -> setArticle ($faker->paragraph($nbSentences = 3, $variableNbSentences = true));

            $randomIndex = array_rand($allUsers);
            $randomUser = $allUsers[$randomIndex];
            $article -> setAuteur($randomUser);

            $manager->persist($article);
        }

        $manager->flush();

        $articlesRepo = $manager->getRepository("BlogBundle:Article");
        $allArticles = $articlesRepo->findAll();

        for ($i = 0; $i < 300; $i++) {
            $commentaire = new Commentaires();
            $commentaire -> setAvis( $faker->paragraph($nbSentences = 2, $variableNbSentences = true));
            $commentaire -> setDateCreation ( $faker->dateTimeBetween('-1 years'));
            $commentaire -> setHeureCreation( $faker->dateTimeBetween('-6 month'));
            $commentaire -> setPseudo($faker->userName);

            $randomIndex = array_rand($allArticles);
            $randomArticle = $allArticles[$randomIndex];
            $commentaire -> setArticle($randomArticle);

            $manager->persist($commentaire);
        }

        $manager->flush();



    }
}