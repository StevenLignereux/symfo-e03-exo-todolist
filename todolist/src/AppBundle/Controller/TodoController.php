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
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('todo/index.html.twig');
    }
    /**
     * @Route("/todo/list", name="todo_list", methods={"GET"})
     */
    public function listAction(Request $request)
    {
        // On récupère la liste des tâches
        $todos = TodoModel::findAll();

        // On renvoie la liste afin de l'afficher
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

            TodoModel::add($task);

        // On redirige vers la page de liste des tâches
        return $this->redirectToRoute('todo_list');
    }

}
