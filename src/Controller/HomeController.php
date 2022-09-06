<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Entity\Questions;
use App\Entity\User;
use App\Repository\ArticlesRepository;
use App\Repository\ContactsRepository;
use App\Repository\FilesRepository;
use App\Repository\QuestionsRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticlesRepository $articlesRepo, QuestionsRepository $questionRepos): Response
    {    
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'article1' => $articlesRepo->findBy([],['id' => 'desc'])[0],
            'article2' => $articlesRepo->findBy([],['id' => 'desc'])[1],
            'article3' => $articlesRepo->findBy([],['id' => 'desc'])[1],
            'questions' => $questionRepos ->findBy(['statut'=>'repondu'],['id' => 'desc']),  // recuperation de la liste des questions pour les afficher sur la page d'accueil.

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

    /**
     * @Route("/save-contact", name="save_contact")
     */
    public function save_contact(Request $request, ContactsRepository $contactsRepo){
        $datas = $request->request->all();
        $contact = new Contacts();
        $contact->setNom('indef');
        $contact->setPrenom($datas['nom']);
        $contact->setMessage($datas['message']);
        $contact->setPhone($datas['phone']);
        $contact->setEmail($datas['email']);
        $contact->setCreateAt(new \DateTimeImmutable());  
        $contactsRepo->add($contact,true);


        return $this->redirectToRoute('contact_send');
    }

    /**
     * @Route("/contact-enregistre", name="contact_send")
     */
    public function contact_send(){
        return $this->render('home/contact_send.html.twig');
    }

    /**
     * @Route("/init", name="app_init")
     */
    public function init(UserPasswordHasherInterface $userPasswordHasher, UserRepository $userRepo){
        $user = new User();
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setNom('Tiffa');
        $user->setPrenom('Loic');
        $user->setEmail('tiffa.loic02@gmail.com');
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                'mmmmmm'
            )
        );

        $user->setCreateAt(new \DateTimeImmutable());
        $user->setStatut('Actif');

        $userRepo->add($user,true);

        return $this->redirectToRoute('app_admin');

    }

    /**
     * @Route("/ask-question", name="ask_question")
     */
    public function ask_question(){

        return $this->render('home/ask_question.html.twig');
    }

    /**
     * @Route("/app_save_contact", name="app_save_contact")
     */
    public function app_save_contact(Request $request,QuestionsRepository $questionRepo){

        $datas = $request->request->all();
        $question = new Questions();
        $question->setQuestion($datas['question']);
        $question->setStatut('sans reponse');
        $question->setContact($datas['contact']);
        $question->setCreateAt(new DateTimeImmutable());

        $questionRepo->add($question, true); 

        return $this->redirectToRoute('app_been_question');

    }

    /**
     * @Route("/blog", name="app_blog_home")
     */
    public function app_blog(ArticlesRepository $articlesRepo){

        return $this->render('home/blog.html.twig',[
            'articles' => $articlesRepo->findBy([],['id'=>'desc']),
        ]);
    }

    /**
     * @Route("/been-question", name="app_been_question")
     */
    public function app_been_question(){
        return $this->render('home/been_question.html.twig');
    }

    /**
     * @Route("/Qui-sommes-nous", name="app_aboute")
     */
    public function app_aboute(){
        return $this->render('home/app_aboute.html.twig',[]);
    }

    /**
     * @Route("/nos-services", name="nos_clients")
     */
    public function nos_clients(){

        return $this->render('home/nos_clients.html.twig',[]);
    }

    /**
     * @Route("/assistance-comptable-et-fiscal", name="service_opt1")
     */
    public function service_opt1(){
        return $this->render('home/service_opt1.html.twig',[]);
    }

    /**
     * @Route("/Audit-et-conseils", name="service_opt2")
     */
    public function service_opt2(){
        return $this->render('home/service_opt2.html.twig',[]);
    }

    /**
     * @Route("/financement", name="financement")
     */
    public function financement(){
        return $this->render('home/financement.html.twig',[]);
    }

    /**
     * @Route("/ingenierie_finance", name="ingenierie_finance")
     */
    public function ingenierie_finance(){
        return $this->render('home/ingenierie_finance.html.twig',[]);
    }


}
 
