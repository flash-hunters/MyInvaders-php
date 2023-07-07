<?php

namespace App\Controller;

use App\Entity\Area;
use App\Repository\AreaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AreaController extends AbstractController
{

//     #[Route('/area/new', name: 'new_area')]
//     public function new(Request $request, AreaRepository $repo): Response
//     {
//         $area = new Area;
//
//         $form = $this->createForm(AreaType::class, $area);
//            ->add('save', SubmitType::class, ['label' => 'Add Area']);
//
//         $form->handleRequest($request);
//
//         if ($form->isSubmitted() && $form->isValid()) {
//             $area = $form->getData();
//             $repo->save($area, true);
//
//             return $this->redirectToRoute('list_area');
//         }
//
//         return $this->render('area/new.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }

    #[Route('/area', name: 'list_area')]
    public function listAll(AreaRepository $repo): Response
    {
        $areas = $repo->findBy([], orderBy: ['name' => 'ASC']);

        return $this->render('area/index.html.twig', [
            'areas' => $areas
        ]);
    }

    #[Route('/area/{code}', name: 'show_area')]
    public function showOne(Area $area): Response
    {
        return $this->render('area/info.html.twig', [
            'area' => $area,
        ]);
    }
    
}
