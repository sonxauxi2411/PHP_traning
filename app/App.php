<?php

class App
{
    private $__controller, $__action, $__params;
    function __construct()
    {   
        global $routes;
        if (!empty($routes['default_controller'])){
            $this->__controller = $routes['default_controller'];
        }
      
        $this->__action = 'index';
        $this->__params = [];

        $this->handleUrl();
    }

    function getUrl()
    {
        // lấy url 
        $url = (!empty($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '/';

        return $url;
    }

    public function handleUrl()
    {
        $url = $this->getUrl();

        // array_filter : loại bỏ phần tử rỗng
        // explode : chia chuỗi thành mảng
        $urlArr = array_filter(explode("/", $url));
        //array_values : trả lại mảng đúng với value ban đầu
        $urlArr = array_values($urlArr);

        //xứ lý controller
        $this->__controller = !empty($urlArr[0]) ?  ucfirst($urlArr[0]) : ucfirst($this->__controller);


        if (file_exists('app/controllers/' . ($this->__controller) . '.php')) {
            require_once 'app/controllers/' . ($this->__controller) . '.php';
            //kiểm tra class $this->__controller tồn tại
            if(class_exists($this->__controller)){
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            }else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }


        //xứ lý action
        if (!empty($urlArr[1])) {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        
        //xử lý params
        $this->__params = array_values($urlArr);


        //kiểm tra method tồn tại
        if(method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        }else {
            $this->loadError();
        }
     



        // echo '<pre >';
        // print_r($this->__params);
        // echo '</pre>';
    }

    public function loadError($name = '404')
    {
        require_once 'errors/' . $name . '.php';
    }
}
