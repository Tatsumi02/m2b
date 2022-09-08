<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\TranslatableMessage;


class TestController extends AbstractController
{
    #[Route('/{_locale}/test', name: 'app_test',
      requirements: [
         '_locale' => 'en|fr|de',
      ],
    )]
    public function index(TranslatorInterface $translator,Request $request): Response
    {


        $translated = $translator->trans('Symfony is great');
        $locale = $request->getLocale();
       
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'nom' => 'tatsumi',
            'locale' =>$locale,
        ]);
    }
}
