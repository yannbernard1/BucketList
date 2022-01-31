<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Form\AnimauxType;
use App\Repository\AnimauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_index")
     */
    public function home(
        Request                $request,
        EntityManagerInterface $entityManager
        //AnimauxRepository $animauxRepository
    ): Response
    {

        /* $tousLesAnimaux = $animauxRepository->findAll();
         $unAnimal = $animauxRepository->findOneBy(["nom" => "jean"], []);
         $chiensVegetariens = $animauxRepository->findRaceVegetarienneAvecQB('Chien');
         $vacheVegetariens = $animauxRepository->findRaceVegetarienne('Vache');
         dump($chiensVegetariens);
         dump($vacheVegetariens);

         dump($tousLesAnimaux);
         $zebre = new Animaux();
         $zebre->setNom("Michel");
         $entityManager->persist($zebre);
         $entityManager->flush();
         return $this->render('main/index.html.twig',
             compact("chiensVegetariens", "vacheVegetariens")
         );*/
        $animaux = new Animaux();
        $monFormulaire = $this->createForm(AnimauxType::class, $animaux);

        $monFormulaire->handleRequest($request);
        if ($monFormulaire->isSubmitted()
            && $monFormulaire->isValid()
        ) {
            $entityManager->persist($animaux);
            $entityManager->flush();
            $this->addFlash('bravo', 'le formulaire à bien été soumis');
            return $this->redirectToRoute('about_page');
        }

        return $this->renderForm('main/index.html.twig',
            compact("monFormulaire") // ["monFormulaire" => $monFormulaire]
        );

    }

    /*
     * @Route("/UnePage", name="main_page")
     */
    #[Route('/AboutUs', name: 'about_page')]
    public function pagex(): Response
    {
        return $this->render('main/Aboutus.html.twig');
    }

}
