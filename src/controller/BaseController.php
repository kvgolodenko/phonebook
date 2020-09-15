<?php


namespace App\Controller;


use App\Interfaces\IController;

abstract class BaseController implements IController
{
    public $title;

    const TITLE = 'Phonebook';

    public function __construct()
    {
        $this->setTitle();
        $this->setLayout();
    }

    public function setTitle()
    {
        $this->title = self::TITLE;
    }
    public function setLayout()
    {
        $title = $this->title;
        include('src/views/layout.php');
    }

    public function setView(array $data)
    {
        // TODO: Implement setView() method.
    }
}