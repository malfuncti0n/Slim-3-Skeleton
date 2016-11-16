<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function (){
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));

$app->group('', function (){
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');
    $this->get('/video/upload', 'VideoController:getVideoUpload')->setName('video.upload');

    $this->get('/admin/users', 'UsersController:index')->setName('admin.users');
    $this->delete('/admin/users', 'UsersController:deleteUser')->setName('admin.users.delete');

    $this->get('/auth/verify', 'AuthController:getVerify')->setName('auth.verify');
    $this->post('/auth/verify', 'AuthController:postVerify');

})->add(new AuthMiddleware($container));