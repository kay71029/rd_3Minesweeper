<?php

header('Content-Type: text/html; charset=utf-8');
require('db.php');

    $db = new Database();
    
    $id = $_GET["id"];
    $type = $_GET["type"];
    $number = $_GET["number"];
    $money = $_GET["money"];
    
    
    $sql = "SELECT `account` FROM `user` WHERE `id`= $id";
    $account = $db->select($sql);
 
    //提款 $type == 0
    if ($account[0]['account'] <= 0) {
      echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "餘額不足"),JSON_UNESCAPED_UNICODE); 
      exit();
    }
        if ($type == 0 && $money > 0) {
            $sql = "INSERT INTO `record`(`id`, `type`, `number`, `money`) 
                VALUES ('$id',$type,$number,$money)";
            $account = $db->select($sql);
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "提款成功"),JSON_UNESCAPED_UNICODE);
     
        } else {
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "失敗"),JSON_UNESCAPED_UNICODE);
            
        }
    