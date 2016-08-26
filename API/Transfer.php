<?php
header('Content-Type: application/json; charset=utf-8');
require('db.php');

    $db = new Database();
    $id = $_GET["id"];
    $type = $_GET["type"];
    $number = $_GET["number"];
    $money = $_GET["money"];
    
    //不能是空值
    if ($id == null || $type == null || $number == null || $money == null) { 
        echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "參數值漏填"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    //判斷帳號
    $sql = "SELECT `id` FROM `user` WHERE `id`= '$id'";
    $dbId = $db->select($sql);
    
    if ($dbId[0]['id'] != $id) {
        echo json_encode(array('massage' => "沒有此帳號"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    //判斷存款代號
    if ($type != 1 && $type != 0) {
        echo json_encode(array('massage' => "存款提款代號錯誤"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    //判斷序號格式
    if (!is_numeric($number)) {
        echo json_encode(array('massage' => "序號格式錯誤"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    //判斷序號重複
    $sql = "SELECT `number` FROM `record` WHERE `number`= '$number'";
    $bdNumber = $db->select($sql);
    
    if ($bdNumber[0]['number'] == $number) {
        echo json_encode(array('massage' => "序號重複失敗"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    //判斷金錢格式
    if (!is_numeric($money)) {
        echo json_encode(array('massage' => "數字格式錯誤"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    //存款 $type == 1
     if($type == 1){
         
         if ($money >= 0) {
            $sql = "INSERT INTO `record`(`id`, `type`, `number`, `money`) 
                VALUES ('$id','$type','$number','$money')";
            $deposit = $db->select($sql);
            
            $sql = "UPDATE `user` SET `account` = `account` + $money WHERE `id` = '$id'" ;
            $db->update($sql);
            
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
        
        $sql = "SELECT `account` FROM `user` WHERE `id`= '$id'";
        $account = $db->select($sql);
     
        if ($money > $account[0]['account']) {
          echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "餘額不足"),JSON_UNESCAPED_UNICODE); 
          exit();
        }
        
        if ($money > 0) {
            $sql = "INSERT INTO `record`(`id`, `type`, `number`, `money`) 
                VALUES ('$id','$type','$number','$money')";
            $Withdrawal = $db->select($sql);
            
            $sql = "UPDATE `user` SET `account` = `account` - $money WHERE `id` = '$id'" ;
            $db->update($sql);
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "提款成功"),JSON_UNESCAPED_UNICODE);
              exit();
        } else {
            echo json_encode(array('id' => $id, 'type' => $type,'number' => $number,'money' => $money,'massage' => "失敗"),JSON_UNESCAPED_UNICODE);
            exit();
        }
    }