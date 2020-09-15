<?php


namespace App\Interfaces;


interface IController
{
    public function index();

    public function setView(array $data);
}