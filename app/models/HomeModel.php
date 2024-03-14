<?php

//Kế thừa từ class Model

class HomeModel extends Model
{
    private $__table = 'city';
    // function __construct (){
    //     parent::__construct();
    // }

    function tableFill()
    {
        return 'city';
    }
    function fieldFill()
    {
        return 'ID, Name';
    }
    public function getList()
    {
        // $data = $this->db->query("SELECT * FROM $this->__table")->fetchAll(PDO::FETCH_ASSOC);
        // return $data;
    }

    public function getDetail($id)
    {
        $data = [
            "item 1",
            "item 2",
            "item 3",
            "item 4",
            "item 5",
        ];

        return $data[$id];
    }
}
