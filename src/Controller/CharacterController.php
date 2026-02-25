<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CharacterController extends AbstractController
{
    #[Route('/character', name: 'app_character')]
    public function index(CharacterRepository $repository): Response
    {
        $character = $repository->findBy(['owner' => $this->getUser()]);
        return $this->render('character/index.html.twig', [
            'character' => $character,
        ]);
    }

    #[Route('/character/{id}/delete', name: 'app_character_delete')]
    public function delete(Character $character, EntityManagerInterface $entityManager): Response
    {
        if ($character->getOwner() !== $this->getUser()) {
        throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer ce personnage.');
    }
    $entityManager->remove($character);
    $entityManager->flush();
    return $this->redirectToRoute('app_character');
}


#[Route('/character/{id}/edit', name: 'app_character_edit')]
public function edit(Character $character, Request $request, EntityManagerInterface $entityManager): Response
{
    if ($character->getOwner() !== $this->getUser()) {
        throw $this->createAccessDeniedException('Vous ne pouvez pas modifier ce personnage.');
    }

    $form = $this->createForm(CharacterType::class, $character);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        $this->addFlash('success', 'Personnage modifié avec succès !');
        return $this->redirectToRoute('app_character');
    }

    return $this->render('character/edit.html.twig', [
        'form' => $form,
        'character' => $character,
    ]);
}

}
