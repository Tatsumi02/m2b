<?php

namespace App\Controller;

use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     *@Route("/open-your-file", name="your_file")
     */
    public function your_file(){

        return $this->render('home/open_your_file.html.twig',[]);
    }

    /**
     * @Route("/etape-2", name="step2")
     */
    public function step2(Request $request){
        $id = $request->query->get('id');
        return $this->render('home/step2.html.twig',['id' => $id]);
    }

    /**
     * @Route("/app-save-part-2/{id}", name="app_save_part_2")
     */
    public function app_save_part_2(Request $request,FilesRepository $filesRepo,$id){
        $datas = $request->request->all();
        $file = $filesRepo->find($id);
        $file->setMotivation($datas['motivation']);

        $list = '';

        foreach($datas['c'] as $c ){
            $list .= $c .',';
        }

        $file->setPrincipauxInteret($list);
        $file->setActivites($datas['activites']);
        $file->setCible($datas['cible']);
        $file->setFournisseur($datas['fournisseur']);
        $file->setConcurent($datas['concurent']);
        $file->setStrategieCommercial($datas['sc']);
        $file->setObjectifCommerciaux($datas['oc']);
        $file->setPartiePrenante($datas['perso']);

        $filesRepo->add($file,true);


        return $this->redirectToRoute('step3',['id'=>$id]);
    }

    /**
     * @Route("/step3/{id}", name="step3")
     */
    public function step3($id){

        return $this->render('home/step3.html.twig',['id' => $id]);
    }

    /**
     * @Route("/save-step3/{id}", name="app_save_step_3")
     */
    public function app_save_step_3(Request $request,$id, FilesRepository $filesRepo){
        $datas = $request->request->all();
        $file = $filesRepo->find($id);
        $file->setCoupInvestissement($datas['coup_investissement']);
        $file->setCapitalSocial($datas['capital_social']);
        $file->setCreditASolicite($datas['credit_solisite']);
        $file->setBeneficeEscompte($datas['benefice_escompte']);
        $file->setNbEmployer($datas['effectif']);
        $file->setApportPersonnel($datas['apport_personnel']);
        $file->setDelaiRetourInvestissement($datas['delai_retour_investissement']);
        $file->setQuantiteProduit($datas['quantite_produit']);
        $file->setRentabilitePrevu($datas['rentabilite_prevu']);
        $file->setFormeJuridique($datas['fj']);
        $file->setInformationComplementaire($datas['rentabilite_prevu']);
        
        // on save
        $filesRepo->add($file, true);
        
        return $this->render('home/finish_step.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(){

        return $this->render('home/contact.html.twig');
    }

}
 
