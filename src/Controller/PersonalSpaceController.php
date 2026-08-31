<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PersonalSpaceController extends AbstractController
{
    #[Route('/personal/space', name: 'app_personal_space')]
    public function index(): Response
    {
        return $this->render('personal_space/index.html.twig', [
            'controller_name' => 'PersonalSpaceController',
        ]);
    }
}
