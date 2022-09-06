<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(TranslatorInterface $translator): Response
    {

        $translated = $translator->trans('Symfony is great');
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
