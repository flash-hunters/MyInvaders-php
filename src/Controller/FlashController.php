<?php

namespace App\Controller;

use App\Entity\Flash;
use App\Entity\SpaceInvader;
use App\Form\FlashType;
use App\Repository\FlashRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Clock\now;

class FlashController extends AbstractController
{
    #[Route('/flash', name: 'app_flash')]
    public function index(): Response
    {
        return $this->render('flash/index.html.twig', [
            'controller_name' => 'FlashController',
        ]);
    }

    #[Route('/si/{name}/flash', name: 'flash_space_invader')]
    public function flashSpaceInvader(Request $request, SpaceInvader $spaceInvader, FlashRepository $repo, UserRepository $urepo): Response
    {
        $user = $urepo->findOneBy(['username' => 'Jack']);

        $flash = $repo->findOneBy([
            'flashUser' => $user,
            'spaceInvader' => $spaceInvader,
        ]);
        if (!$flash) {
            $flash = new Flash();
            $flash->setFlashUser($user);
            $flash->setSpaceInvader($spaceInvader);
        }

        $form = $this->createForm(FlashType::class, $flash)
            ->add('save', SubmitType::class, ['label' => 'Flashed!']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flash = $form->getData();
            $repo->save($flash, true);

            return $this->redirectToRoute('show_space_invader', ['name' => $spaceInvader->getName()]);
        }

        return $this->render('space_invader/new.html.twig', [
            'form' => $form
                ->createView(),
            'controller_name' => 'SpaceInvaderController',
        ]);
    }

}
