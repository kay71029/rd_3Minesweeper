<?php

header('Content-Type: text/html; charset=utf-8');
require('db.php');

    $db = new Database();
    
    $id = $_GET["id"];
    $type = $_GET["type"];
    $number = $_GET["number"];
    $money = $_GET["money"];
    
    
    //存款 $type == 1
     if ($type == 1 && $money > 0) {
         
        $sql = "INSERT INTO `record`(`id`, `type`, `number`, `money`) 
            VALUES ('$id',$type,$number,$money)";
        $account = $db->select($sql);
        echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "存款成功"),JSON_UNESCAPED_UNICODE);
        exit();
        
     } else {
        echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "失敗"),JSON_UNESCAPED_UNICODE);
        exit();
     }