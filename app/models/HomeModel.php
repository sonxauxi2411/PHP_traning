<?php

//Kế thừa từ class Model

class HomeModel
{
    protected $table = 'products';

    public function getList()
    {
        $data =[
            "item 1", 
            "item 2", 
            "item 3", 
            "item 4", 
            "item 5", 
        ];
        return $data;
    }

    public function getDetail ($id){
        $data =[
            "item 1", 
            "item 2", 
            "item 3", 
            "item 4", 
            "item 5", 
        ];

        return $data[$id] ;
    }
}
