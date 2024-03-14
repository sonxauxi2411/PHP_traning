<?php

class App
{
    private $__controller, $__action, $__params, $__routes;

    static public $app;
    function __construct()
    {
        global $routes, $config;

        self::$app = $this;

        $this->__routes = new Route();
        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }


        $this->__action = 'index';
        $this->__params = [];

        $this->handleUrl();

        // echo '<pre >';
        // echo 'ss : ';
        // print_r($config);
        // echo '</pre>';
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

        $url = $this->__routes->handleRoute($url);
        // array_filter : loại bỏ phần tử rỗng
        // explode : chia chuỗi thành mảng
        $urlArr = array_filter(explode("/", $url));
        //array_values : trả lại mảng đúng với value ban đầu
        $urlArr = array_values($urlArr);
        $urlCheck = '';
        if (!empty($urlArr)) {
            foreach ($urlArr as $key => $item) {
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);

                if (!empty($urlArr[$key - 1])) {
                    unset($urlArr[$key - 1]);
                }
                if (file_exists('app/controllers/' . ($fileCheck) . '.php')) {

                    $urlCheck = $fileCheck;
                    break;
                }
            }

            $urlArr = array_values($urlArr);
        }




        //xứ lý controller
        $this->__controller = !empty($urlArr[0]) ?  ucfirst($urlArr[0]) : ucfirst($this->__controller);

        //xứ lý khi url rỗng
        if (empty($urlCheck)) {
            $urlCheck = $this->__controller;
        }
        if (file_exists('app/controllers/' . $urlCheck . '.php')) {
            require_once 'app/controllers/' . $urlCheck  . '.php';
            //kiểm tra class $this->__controller tồn tại
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            } else {
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
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }
    }

    public function loadError($name = '404', $data=[])
    {
        extract($data);
        require_once 'errors/' . $name . '.php';
    }
}
