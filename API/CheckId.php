<?php
header('Content-Type: application/json; charset=utf-8');
require('db.php');

    $db = new Database();
    $id = $_GET["id"];
    $number = $_GET["number"];
    
    if ($id == null || $number == null) {
        echo json_encode(array('id' => $id,'number' => $number,'massage' => "參數設定錯誤"),JSON_UNESCAPED_UNICODE); 
        exit();
    } 
    
    //判斷帳號是否存在
     $sql = "SELECT `id` FROM `user` WHERE `id`= '$id'";
     $OregeneUser = $db->select($sql);
     
    if ($id == null || $OregeneUser[0]['id'] != $id || !preg_match("/^[A-Za-z0-9]+$/",$id) ) {
       echo json_encode(array('id' => $id, 'massage' => "沒有此帳號"),JSON_UNESCAPED_UNICODE); 
       exit();
    } 
    
    //判斷編號格式
    if ($record[0]['number'] == preg_match("/^[0-9]+$/",$number)) {
        echo json_encode(array('massage' => "編號格式錯誤"),JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    $sql = "SELECT `number` FROM `record` WHERE `number`= $number";
    $record = $db->select($sql);
 

    if($record[0]['number'] != $number ){
        echo json_encode(array('massage' => "沒有該交易"),JSON_UNESCAPED_UNICODE);
        exit();
    }
     
    if($record[0]['number'] != null) {
        echo json_encode(array('id' => $id, 'number' => $number,'massage' => "此筆交易成功"),JSON_UNESCAPED_UNICODE);
        exit();
    }