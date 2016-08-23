<?php
header('Content-Type: text/html; charset=utf-8');
    
    $row = 10;
    $Columns = 10;
    $n = $Columns + 1; 
    $bomb = 40; 
    $length = $row * $n;
    
    $id  = $_GET["map"];
    $idLength = strlen( $id );
    $ans = 1;
 
    //檢查正則
    if (!preg_match("/^([0-8MN]+)$/", $id)) {
        
        if (preg_match("/^([0-8mN]+)$/", $id)){
            
            echo "炸彈大小寫錯誤";
            
        } else if (preg_match("/^([0-9MN]+)$/", $id)){
            echo "數字錯誤出現9";
        }
        exit();
    }
   
    //檢查長度
     if ($idLength > $length-1) {
         
        echo "不符合 長度太長 長度為:$idLength";
        exit();
        
     } else if ($idLength < $length-1) {
         
        echo "不符合 長度太短 長度為:$idLength";
        exit();
        
        
     } else if ($idLength = $length-1) {
        //echo "正確";
     } 
    
    //檢查炸彈
    $bombTest = substr_count($id, "M");
    if ( $bombTest > $bomb || $bombTest < $bomb ) {
        echo "地雷數量有錯 有".$bombTest."顆地雷";
        exit();
    } else if($bombTest = $bomb) {
       
     }
     
 
     //切割n
     $newId = str_replace("N", "",$id);
     //var_dump( $newId);
     
     $i =0 ;
    //畫出陣列
    for($x = 0; $x < 10; $x++) {
        for($y = 0; $y < 10; $y++) {
            $place[$x][$y] = $newId [$i];
            $i++;
        }
    }

    for($x = 0; $x < 10; $x++) {
        for($y = 0; $y < 10; $y++) {
            if($place[$x][$y] !=="M") {
                $num = 0;
                //左上
                if($place[$x-1][$y-1] === "M") {
                    $num++;
                }
                //上
                if($place[$x-1][$y] === "M") {
                    $num++;
                }
                //右上
                if($place[$x-1][$y+1] === "M") {
                    $num++;
                }
                //左
                if($place[$x][$y-1] === "M") {
                    $num++;
                }
                //右
                if($place[$x][$y+1] === "M") {
                    $num++;
                }
                //左下
                if($place[$x+1][$y-1] === "M") {
                    $num++;
                }
                //下
                if($place[$x+1][$y] === "M") {
                    $num++;
                }
                //右下
                if($place[$x+1][$y+1] === "M"){
                    $num++;
                }
                //$place[$x][$y] = $num;
                if($num != $place[$x][$y]){
                    echo "位置在[".$x."][".$y."]應該是 $num";
                    $ans = 0;
                    break 2;
                }
            }
        }
    }
     if ($ans == 1) {
        echo "符合 ";
     }