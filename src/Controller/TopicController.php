<?php

namespace App\Controller;

use App\Entity\Topic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TopicController extends AbstractController
{
    #[Route('/topic', name: 'app_topic')]
    public function index(EntityManagerInterface $entityManager): Response
    {   
        $topics = $entityManager->getRepository(Topic::class)->findAll();
        return $this->render('topic/index.html.twig', [
            'controller_name' => 'TopicController',
        ]);
    }


    // fonction ajout + edit une session
    #[Route('/topic/add', name: 'add_topic')]
    #[Route('/topic/{id}/edit', name: 'edit_topic')]
    public function add(EntityManagerInterface $entityManager, Topic $topic = null, Request $request): Response 
    {
        if (!$topic){ // si la topic n'existe pas 
             $topic = new Topic();  // alors crée un nouvel objet topic 
        }
        // on crée le formulaire 
        $form = $this->createForm(topicType::class, $topic);
        $form->handleRequest($request);
 
        //quand on sousmet le formulaire 
        if($form->isSubmitted() && $form->isValid()){
 
            $topic = $form->getData();
            $entityManager->persist($topic);// = prepare
            $entityManager->flush();// execute, on envoie les données dans la db 

            return $this->redirectToRoute('app_topic');
 
        }

        // vue pour afficher le formulaire 
        return $this->render('topic/addTopic.html.twig', [
        'form' => $form->createView(),
        'edit'=> $topic->getId(),
        'topicId' => $topic->getId()
            
        ]);
 
    }
 
     // fonction delete d'une topic 
     #[Route('/topic/{id}/delete', name: 'delete_topic')]
     public function delete(EntityManagerInterface $entityManager, Topic $topic): Response
     {
         $entityManager->remove($topic);
         $entityManager->flush();
 
         return $this->redirectToRoute('app_topic');
 
     }
 


    
}
