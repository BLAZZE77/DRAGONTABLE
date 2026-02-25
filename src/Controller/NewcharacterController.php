<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\ClasseRepository;
use App\Repository\RaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class NewcharacterController extends AbstractController
{
    #[Route('/new/character', name: 'app_newcharacter')]
    public function index(Request $request, EntityManagerInterface $entityManager, ClasseRepository $classeRepository,RaceRepository $raceRepository): Response
    {
        $character = new Character();
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $character->setOwner($this->getUser());
            $entityManager->persist($character);
            $entityManager->flush();
            $this->addFlash('succes', 'Personnage créé avec succès !');
            return $this->redirectToRoute('app_character');
        }

        return $this->render('newcharacter/index.html.twig', [
            'CharacterType' => $form->createView(),
            'classe' => $classeRepository->findAll(),
            'races' => $raceRepository->findAll(),
        ]);
    }
}