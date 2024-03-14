<?php

class Database
{
    private $__conn;
    //kết nối db
    function __construct()
    {
        global $db_config;
        $this->__conn =  Connection::getInstance($db_config);
        // var_dump($this->__conn);
    }

    //thêm dữ liệu
    function insert($table, $data)
    {
        if (!empty($data)) {
            $fieldStr = '';
            $valueStr = '';

            foreach ($data as $key => $value) {
                $fieldStr .= $key . ',';
                $valueStr .= "'" . $value . "',";
            }
            $fieldStr = rtrim($fieldStr, ',');
            $valueStr = rtrim($valueStr, ',');

            $sql = "INSERT INTO $table($fieldStr) VALUES ($valueStr)";

            $status = $this->query($sql);

            if ($status) {
                return true;
            }
        }
        return false;
    }

    //sữa dữ liệu
    function update($table, $data, $condition = '')
    {


        if (!empty($data)) {
            $updateStr = '';

            foreach ($data as $key => $value) {
                $updateStr .= $key . "='" . $value . "',";
            }
            $updateStr = rtrim($updateStr, ",");
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updateStr ";
            }
            $status = $this->query($sql);

            if ($status) {
                return true;
            }
        }
        return false;
    }
    //xóa dữ liệu
    function delete($table, $condition = '')
    {

        if (!empty($condition)) {
            $sql = "DELETE FROM $table WHERE $condition";
        } else {
            $sql = "DELETE FROM $table ";
        }
        $status = $this->query($sql);

        if ($status) {
            return true;
        }
        return false;
    }

    //query 
    function query($sql)
    {
      try {
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        return $statement;
      } catch (Exception $exception) {
        $mess = $exception->getMessage();
        $data['message'] = $mess;
        App::$app->loadError('database', $data);
        die();
      }
    }

    //trả về id mới nhất sau khi đã insert
    function lastInsertId()
    {

        return $this->__conn->lastInsertId();
    }
}
