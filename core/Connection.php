<?php

class Connection
{
    private static $instance = null;

    private function __construct($config)
    {
        //kết nối db
        try {
            echo '<pre >';
            print_r($config);
            echo '</pre>';
            //Cấu hình dsn
            $dsn = 'mysql:dbname=' . $config['db'] . ';host=' . $config['host'];

            //cấu hình $options
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            $con = new PDO($dsn, $config['user'], $config['password']='', $options);
        } catch (Exception $exception) {
            $mess = $exception->getMessage();

            die($mess);
            // if(preg_match('/Access denied for user/'. $mess)){
            //     die('Lỗi kết nối cơ sở dữ liệu');
            // }
            // if(preg_match('/Unknow database/'. $mess)){
            //     die('Không tìm thấy cơ sở dữ liệu');
            // }
        }
    }
    public static function getInstance($config)
    {
        if (self::$instance == null) {

            self::$instance = new Connection($config);
        }

        return self::$instance;
    }
}
