<?php
header('Content-Type: application/json; charset=utf-8');
require('db.php');

    $db = new Database();
    $id = $_GET["id"];
    $number = $_GET["number"];
    
    if ($id == null && $number == null) {
        echo json_encode(array('massage' => "失敗"),JSON_UNESCAPED_UNICODE); 
       exit();
    } 

    $sql = "SELECT `number` FROM `record` WHERE `number`= $number";
    $record = $db->select($sql);
 
     if($record[0]['number'] == null ){
        echo json_encode(array('massage' => "失敗"),JSON_UNESCAPED_UNICODE); 
     }
     
     if($record[0]['number'] != null) {
        echo json_encode(array('id' => $id, 'number' => $number,'massage' => "成功"),JSON_UNESCAPED_UNICODE); 
     }