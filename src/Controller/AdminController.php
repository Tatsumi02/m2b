<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Repository\ContactsRepository;
use App\Repository\FilesRepository;
use App\Repository\QuestionsRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Crypto\DkimSigner;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController', 
        ]);
    }

    /**
     * @Route("/look-contact", name="app_look_contact")
     */
    public function app_look_contact(ContactsRepository $contactsRepo){

        return $this->render('admin/look_contact.html.twig',[
            'contacts' => $contactsRepo->findBy([],['id'=>'desc']),
        ]);
    }

    /**
     *@Route("/blog-admin", name="app_blog")
     */
    public function app_blog(){

        return $this->render('admin/form-blog.html.twig',[]);
    }

    /**
     * @Route("/save-article", name="app_save_article")
     */
    public function app_save_article(Request $request, ArticlesRepository $articleRepo ){

        $datas = $request->request->all();
        $file = $request->files->get('image');

        $article = new Articles();
        $article->setTitre($datas['titre']);
        $article->setContenu($datas['contenu']);
        $article->setStatut('actif');
        $article->setCreateAt(new \DateTimeImmutable());

        $extension = $file->guessExtension();
        $someNewFilename = $this->getUser().'-user-'.md5(uniqid());
        $file->move('assets/files', $someNewFilename.'.'.$extension);
        $article->setImage($someNewFilename.'.'.$extension);


        $articleRepo->add($article,true);

        return $this->redirectToRoute('app_list_article');
    }

    /**
     * @Route("/list-article", name="app_list_article")
     */
    public function app_list_article(ArticlesRepository $articleRepo){

        return $this->render('admin/app_list_article.html.twig',[
            'articles' => $articleRepo->findBy([],['id' => 'desc']),
        ]);
    }

     
    /**
     * @Route("/les-dossier", name="app_dossier")
     */
    public function app_dossier(FilesRepository $filesRepository){

        return $this->render('admin/app_dossier.html.twig',[
            'dossiers' => $filesRepository->findBy([],['id' => 'desc']),
        ]);
    }

    /**
     * @Route("/detail-dossier/{id}", name="detail_dossier")
     */
    public function detail_dossier($id, FilesRepository $filesRepo){
        return $this->render('admin/detail_dossier.html.twig',[
            'dossier' => $filesRepo->find($id),
        ]);
    }

    /**
     * @Route("/account-view", name="account_view")
     */
    public function account_view(UserRepository $usersRepo){
        return $this->render('admin/account_view.html.twig',[
            'users' => $usersRepo->find($this->getUser()),
        ]);
    }

    /**
     * @Route("/update-user-form", name="app_update_user_form")
     */
    public function app_update_user_form(){
        return $this->render('admin/update_user_form.html.twig',[]);
    }

    /**
     * @Route("/data-user", name="updating_data_user")
     */
    public function updating_data_user(UserRepository $userRepo, Request $request){
        $datas = $request->request->all();
        $user = $userRepo->find($this->getUser());
        $user->setNom($datas['nom']);
        $user->setPrenom($datas['prenom']);
        $user->setEmail($datas['email']);

        $userRepo->add($user,true);

        return $this->redirectToRoute('account_view');

    }

    /**
     * @Route("/question-list", name="app_question")
     */
    public function app_question(QuestionsRepository $questionsRepo){
        return $this->render('admin/question-list.html.twig',[
            'questions' => $questionsRepo->findBy([],['id'=>'desc']),
        ]);
    }

    /**
     * @Route("/reponse_q/{id}", name="reponse_q")
     */
    public function reponse_q($id,QuestionsRepository $questionsRepo){
        return $this->render('admin/reponse_q.html.twig',['id' => $id, 'question' => $questionsRepo->find($id)]);
    }

    /**
     * @Route("/save-rep/{id}", name="save_rep")
     */
    public function save_rep($id, QuestionsRepository $questionRepo, Request $request){
        $datas = $request->request->all();
        $question = $questionRepo->find($id);
        $question->setReponse($datas['reponse']);
        $question->setStatut('Repondu');
        $questionRepo->add($question,true);

        return $this->redirectToRoute('app_question');
    }

    


}
