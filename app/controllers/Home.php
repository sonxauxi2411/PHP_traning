<?php 

class Home {
    public function index (){

    }
    public function detail ($id='', $sulg=''){

        echo 'id: ' . $id;
        echo 'sulg: ' . $sulg;
    }

    public function search (){
        $keyword = $_GET['keyword'];
        echo 'search :'.$keyword ;

    }

  
}