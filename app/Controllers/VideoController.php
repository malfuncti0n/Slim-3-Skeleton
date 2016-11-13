<?php
/**
 * Created by PhpStorm.
 * User: savva
 * Date: 11/13/2016
 * Time: 9:38 PM
 */

namespace App\Controllers;
use Slim\Views\Twig as View;

class VideoController extends Controller
{

    public function getVideoUpload($request,$response){
        return $this->container->view->render($response, 'vide.upload.twig');
    }
}