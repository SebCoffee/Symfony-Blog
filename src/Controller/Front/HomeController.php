<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 03/10/18
 * Time: 10:42
 */

namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('index.html.twig');
    }
}