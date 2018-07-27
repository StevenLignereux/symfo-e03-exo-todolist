<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Model\TodoModel;


class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_home")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route ("/todo/list", name="todo_list")
     */
    public function listAction()
    {
      $todos = TodoModel::findAll();
      return $this->render('todo/list.html.twig', [
        'todos' => $todos,
      ]);
    }
}
