<?php

header('Content-Type: application/json; charset=utf-8');
require('db.php');

    $db = new Database();
    
    $id = $_GET["id"];
    $sql = "SELECT `id` FROM `user` WHERE `id`= '$id'";
    $OregeneUser = $db->select($sql);
     
    if ($id == null || !preg_match("/^([A-Za-z0-9]+)$/",$id)) {
       echo json_encode(array('id' => $id, 'massage' => "帳號必須有數字及英文組成"),JSON_UNESCAPED_UNICODE); 
       exit();
    } 
    
    if ($OregeneUser[0]['id'] == null) {
        $sql = "INSERT INTO `user` (`id`) VALUES ('$id')";
        $ans = $db->insert($sql);
    } else {
        echo json_encode(array('id' => $id, 'massage' => "帳號重複"),JSON_UNESCAPED_UNICODE);
    }
    
    if ($ans == true) {
        echo json_encode(array('id' => $id, 'massage' => "成功"),JSON_UNESCAPED_UNICODE);
    }
?>