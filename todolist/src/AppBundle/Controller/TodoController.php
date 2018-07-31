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

        // On controle si la tâche est vide
        if (empty($task))
        {

          $this->addFlash('warning', 'Veuillez indiquer une tâche.');

        }
        else
        {
          TodoModel::add($task);
          $this->addFlash('success', 'Tâche ajoutée.');
        }

        // On redirige vers la page de liste des tâches
        return $this->redirectToRoute('todo_list');
    }

    /**
     * @Route("/todo/show/{id}", name="todo_show", methods={"GET"})
     */
    public function showAction($id)
    {
      $todo = TodoModel::find($id);

     if (!$todo) {
        throw $this->createNotFoundExeption();
      } 

      return $this->render('todo/show.html.twig', [
        'todo' => $todo,
      ]);
    }

     /**
     * @Route("/todo/delete/{id}", name="todo_delete", methods={"POST"})
     */
      public function deleteAction($id)
      {
        // Delete via le model
        $success = TodoModel::delete($id);
        if ($success) {
          $this->addFlash(
            'success',
            'Tâche supprimée :muscle:'
          );
        } else {
          $this->addFlash(
            'danger',
            'Tâche non trouvée. '
          );
        }
        return $this->redirectToRoute('todo_list');
        
      }

    /**
     * @Route("todo/{id}/status/{status}", name="todo_set_status", methods={"GET"}, requirements={"id"="\d+", "status"="done|undone"})
     */
    public function setStatus($id, $status)
    {
      $success = TodoModel::setStatus($id, $status);
      if (!$success) {
        throw $this->createNotFoundExeption();
      } 
      return $this->redirectToRoute('todo_list');
    }

    /**
     * @Route("todo/reset", name="todo_reset", methods="GET")
     */
    public function resetAction()
    {
      TodoModel::reset();

      $this->addFlash('success' , 'Tâches réinitialisées. ');
      return $this->redirectToRoute('todo_list');
    }



}
