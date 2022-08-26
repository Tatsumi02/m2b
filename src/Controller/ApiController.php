<?php

namespace App\Controller;

use App\Entity\Files;
use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     *@Route("/save-step-1", name="step1")
     */
    public function save_step1(Request $request, FilesRepository $filesRepo, ){

        $datas = $request->request->all();
        $file = new Files();
        $file-> setEntrepreneur($datas['entrepreneur']);
        $file-> setTitreProjet($datas['titre_projet']);
        $file-> setContact($datas['contact']);
        $file-> setProfession($datas['profession']);
        $file-> setDateLancement(new \DateTime($datas['date_lancement']));
        $file->setCreateAt(new \DateTimeImmutable());
        $filesRepo->add($file,true);

        return new JsonResponse([['msg' => 'step 1 ass been saved', 'code' => 200]]);
    }
}
