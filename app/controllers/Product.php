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
        // $this->data['title'] = $title;
        // $this->data['product_list'] = $data;
        // //render view
        // $this->render('products/list', $this->data);
        $this->data['sub_content']['title'] = $title;
        $this->data['sub_content']['data'] = $data;
        $this->data['content'] = 'products/list';
        $this->render('layouts/client_layout', $this->data);
    }

    public function detail($id=0)
    {
        $data = $this->model_product->getDetail($id);
        $this->data['sub_content']['data'] = $data ;
        $this->data['content'] = 'products/detail';
        $this->render('layouts/client_layout', $this->data);
    }
}
