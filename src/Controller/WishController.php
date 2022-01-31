<?php

namespace App\Controller;


use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function list(
        WishRepository $wishRepository
    ): Response
    {

        $touteLaListe = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);

        return $this->render('wish/list.html.twig',
            compact("touteLaListe")
        );

    }

    #[Route('/detail/{id}', name: '_detail')]
    public function detail(
        Wish $wish
    ): Response
    {
        return $this->render('wish/detail.html.twig',
            compact("wish")
        );
    }

    #[Route('/form', name: '_form')]
    public function form(
        Request                $request,
        EntityManagerInterface $entityManager
    ): Response
    {


        $wish = new Wish();
        $monFormulaireIdee = $this->createForm(WishType::class, $wish);

        $monFormulaireIdee->handleRequest($request);
        $wish->setIsPublished('true');
        $wish->setDateCreated(new \DateTime());
        if ($monFormulaireIdee->isSubmitted()
            && $monFormulaireIdee->isValid()
        ) {
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash('bravo', 'le formulaire à bien été soumis');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->renderForm('wish/AjoutIdee.html.twig',
            compact("monFormulaireIdee") // ["monFormulaireIdee" => $monFormulaireIdee]
        );

    }
}
