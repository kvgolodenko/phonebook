<?php
namespace App\Controller;
use App\Route\Router;

class Controller
{
    public function run()
    {
        try {
            $route = new Router();
            $route();

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}