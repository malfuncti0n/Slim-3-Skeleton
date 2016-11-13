<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Controllers\Controller;

class UsersController extends  Controller
{
    public function index($request, $response){
        $users = new User;
        $returnUser = $users->users();
        $this->view->getEnvironment()->addGlobal('users',$returnUser);
        return $this->view->render($response, 'admin/users.twig');
    }

    public function deleteUser($request, $response){
        $selection = $request->getParam('check');
        $deletionFinal = implode(',', $selection);
        if (!isset($deletionFinal)){
            return $response->withRedirect($this->router->pathFor('admin.users'));
        }
        $this->auth->user()->deleteUsers($selection);
        $this->flash->addMessage('info', 'The user deleted.');
        return $response->withRedirect($this->router->pathFor('admin.users'));
    }
}

