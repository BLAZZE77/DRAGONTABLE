<?php

namespace App\Controller;

use App\Form\CharacterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Character;


final class NewcharacterController extends AbstractController
{
    #[Route('/newcharacter', name: 'app_newcharacter')]
    public function index(Request $request , EntityManagerInterface $entityManager): Response
    {
        $character = new Character();
        $form = $this->CreateForm(CharacterType::class,$character);

        if($form->isSubmitted() && $form->isValid()){
            $character->setUser($this->getUser());
            $entityManager->persist($character);
            $entityManager->flush();
            $this->addFlash('succes','Personnage créé avec succès !');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('newcharacter/index.html.twig', [
            'CharacterType'=>$form->createView(),
        ]);
    }
}
