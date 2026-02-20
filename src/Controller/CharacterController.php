<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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


}
