<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_home")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route ("/todo/list", name="todo_list")
     */
    public function listAction()
    {
      return $this->render('todo/list.html.twig');
    }
}
