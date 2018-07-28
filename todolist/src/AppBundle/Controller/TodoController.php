<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Model\TodoModel;



class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_home", methods={"GET"})
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route ("/todo/list", name="todo_list", methods={"GET"})
     */
    public function listAction()
    {
      $todos = TodoModel::findAll();
      return $this->render('todo/list.html.twig', [
        'todos' => $todos,
      ]);
    }

    /**
     * @Route("/todo/add", name="todo_add", methods={"POST"})
     */
    public function addAction(Request $request)
    {
        // On récupère l'intitulé de la tâche
        $task = $request->request->get('task');
        // Si tâche vide
        if( empty($task) ) {

        } else {
            // On l'enregistre dans la liste existante
            TodoModel::add($task);
        }
        // On redirige vers la page de liste des tâches
        return $this->redirectToRoute('todo_list');
    }

}
