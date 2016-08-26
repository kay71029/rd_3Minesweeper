<?php

header('Content-Type: application/json; charset=utf-8');
require('db.php');

    $db = new Database();
    
    $id = $_GET["id"];
     
    $sql = "SELECT `account` FROM `user` WHERE `id`= '$id'";
    $account = $db->select($sql);
    
     
     if ($account == null) {
         
        echo json_encode(array('id' => $id, 'massage' => "沒有該帳戶"),JSON_UNESCAPED_UNICODE);
     } else {
         
        echo json_encode(array('id' => $id, 'massage' => $account),JSON_UNESCAPED_UNICODE);
     }
    