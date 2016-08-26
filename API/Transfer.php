<?php
header('Content-Type: application/json; charset=utf-8');
require('db.php');

    $db = new Database();
    $id = $_GET["id"];
    $type = $_GET["type"];
    $number = $_GET["number"];
    $money = $_GET["money"];
    
    //存款 $type == 1
     if($type == 1){
         
         if ($money > 0) {
            $sql = "INSERT INTO `record`(`id`, `type`, `number`, `money`) 
                VALUES ('$id',$type,$number,$money)";
            $deposit = $db->select($sql);
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "存款成功"),JSON_UNESCAPED_UNICODE);
            exit();
         } else {
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "失敗"),JSON_UNESCAPED_UNICODE);
            exit();
         }
     }
    ////////////////////////////////////////////////////////////////////////////
    //提款 $type == 0
    if ($type == 0) {
        
        $sql = "SELECT `account` FROM `user` WHERE `id`= $id";
        $account = $db->select($sql);
     
        if ($account[0]['account'] <= 0) {
          echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "餘額不足"),JSON_UNESCAPED_UNICODE); 
          exit();
        }
        
        if ($money > 0) {
            $sql = "INSERT INTO `record`(`id`, `type`, `number`, `money`) 
                VALUES ('$id',$type,$number,$money)";
            $Withdrawal = $db->select($sql);
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "提款成功"),JSON_UNESCAPED_UNICODE);
              exit();
        } else {
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "失敗"),JSON_UNESCAPED_UNICODE);
            exit();
        }
    }