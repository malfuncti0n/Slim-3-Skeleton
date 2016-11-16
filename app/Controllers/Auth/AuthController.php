<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getSignUp($request, $response){
        return $this->view->render($response, 'auth/signup.twig');

    }
    public function postSignUp($request, $response){

        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name' => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed())
        {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $user = User:: create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'token' => bin2hex(random_bytes(32))
        ]);

        $message = "     
                      Hello $user->name,
                      <br /><br />
                      Welcome to Series!<br/>
                      To complete your registration  please , just click following link<br/>
                      <br /><br />
                      <a href='http://www.test.com/verification.php?id=$user->id&code=$user->token'>Click HERE to Activate :)</a>
                      <br /><br />
                      Thanks,";

        $this->msg->sendMail($user->email, $message, 'Verification Email');

        $this->flash->addMessage('info', 'You have been signed up.');

        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));

    }

    public function getSignIn($request, $response){
        return $this->view->render($response, 'auth/signin.twig');
    }
    public function postSignIn($request, $response){
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );
        if (!$auth){
            $this->flash->addMessage('error', 'Could not sign you in with those details. Please try again.');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignOut($request, $response){
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }

//    public function getVerify($request, $response){
//        return $this->view->render($response, 'auth/verify.twig');
//
//    }
//    public function postVerify($request, $response){
//
//        $validation = $this->validator->validate($request, [
//            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
//            'name' => v::notEmpty()->alpha(),
//            'password' => v::noWhitespace()->notEmpty(),
//        ]);
//
//        if ($validation->failed())
//        {
//            return $response->withRedirect($this->router->pathFor('auth.verify'));
//        }
//
//        $this->auth->user()->setVerified();
//        $this->flash->addMessage('info', 'You have been verified.');
//        return $response->withRedirect($this->router->pathFor('home'));
//
//    }
}