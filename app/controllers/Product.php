<?php

class Product extends Controller
{
    public $model_product;
    public function __construct()
    {
        $this->model_product = $this->model('ProductModel');
    }
    public function index()
    {
        $data = $this->model_product->getList();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    public function list_product()
    {
        $data = $this->model_product->getList();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
