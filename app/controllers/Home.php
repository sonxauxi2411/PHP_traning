<?php

class Home extends Controller
{
    public $model_home;

    public function __construct()
    {
        $this->model_home = $this->model('HomeModel');
    }
    public function index()
    {
        $data = $this->model_home->get();

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
