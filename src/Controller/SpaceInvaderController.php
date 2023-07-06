<?php

namespace App\Controller;

use App\Entity\SpaceInvader;
use App\Form\SpaceInvaderType;
use App\Repository\SpaceInvaderRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaceInvaderController extends AbstractController
{
    // #[Route('/si/new', name: 'app_space_invader')]
    // public function new(Request $request, ManagerRegistry $doctrine): Response
    // {
    //     $spaceInvader = new SpaceInvader;

    //     $form = $this->createForm(SpaceInvaderType::class, $spaceInvader);

    //     return $this->render('space_invader/index.html.twig', [
    //         'form' => $form->createView(),
    //         'controller_name' => 'SpaceInvaderController',
    //     ]);
    // }

    #[Route('/si', name: 'list_space_invader')]
    public function listAll(Request $request, SpaceInvaderRepository $repo): Response
    {
        $spaceInvaders = $repo->findBy([], orderBy: ['name' => 'ASC']);

        return $this->render('space_invader/index.html.twig', [
            'spaceInvaders' => $spaceInvaders,
        ]);
    }

    #[Route('/si/{name}', name: 'show_space_invader')]
    public function showOne(SpaceInvader $spaceInvader): Response
    {
        return $this->render('space_invader/info.html.twig', [
            'spaceInvader' => $spaceInvader,
        ]);
    }

    
}
