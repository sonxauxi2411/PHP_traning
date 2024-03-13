<?php

class Product extends Controller
{
    public $data = [];
    public $model_product;
    public function __construct()
    {
        $this->model_product = $this->model('ProductModel');
    }
    public function index()
    {
        $data = $this->model_product->getList();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }
    public function list_product()
    {
        $data = $this->model_product->getList();
        $title = 'danh sach san pham';
        $this->data['title'] = $title;
        $this->data['product_list'] = $data;
        //render view
        $this->render('products/list', $this->data);
    }

    public function detail($id=0)
    {
        $data = $this->model_product->getDetail($id);
        $this->data['product'] = $data ;
        $this->render('products/detail', $this->data);
    }
}
