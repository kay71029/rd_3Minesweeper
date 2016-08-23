<?php
header('Content-Type: text/html; charset=utf-8');
    
    $row = 10;
    $Columns = 10;
    $n = $Columns + 1; 
    $bomb = 40; 
    $length = $row * $n;
    
    $id  = $_GET["map"];
    $idLength = strlen( $id );
    //var_dump($idLength);
     
    //檢查長度
     if( $idLength > $length-1) {
         
        echo "不符合 長度太長";
        
     }else if($idLength < $length-1) {
         
        echo "不符合 長度太短";
        
     }else if($idLength = $length-1) {
        
        //echo "正確";
     } 
    
    
    //檢查炸彈
    $bombTest = substr_count($id, "M");
    
    if( $bombTest > $bomb) {
         
        echo "不符合 炸彈數太多";
        
     }else if($bombTest < $bomb) {
         
        echo "不符合 炸彈數太少";
        
     }else if($bombTest = $bomb) {
        
        //echo "正確";
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
    //var_dump($place);

    for($x = 0; $x < 10; $x++) {
        for($j = 0; $j < 10; $j++) {
            if($place[$x][$j] !=="0") {
                $num = 0;
                //左上
                if($place[$x-1][$j-1] === "M") {
                    $num++;
                }
                //上
                if($place[$x-1][$j] === "M") {
                    $num++;
                }
                //右上
                if($place[$x-1][$j+1] === "M") {
                    $num++;
                }
                //左
                if($place[$x][$j-1] === "M") {
                    $num++;
                }
                //右
                if($place[$x][$j+1] === "M") {
                    $num++;
                }
                //左下
                if($place[$x+1][$j-1] === "M") {
                    $num++;
                }
                //下
                if($place[$x+1][$j] === "M") {
                    $num++;
                }
                //右下
                if($place[$x+1][$j+1] === "M"){
                    $num++;
                }
                //$place[$x][$j] = $num;
                if( $num != $place[$x][$j]){
                    echo "不符合 ";
                    break 2;
                    
                }
            }
        }
    }
   
    // for($x = 0; $x < 10; $x++) {
    //     for($y = 0; $y < 10; $y++) {
    //         $data = $data.$place[$x][$y];
    //         if($y === 9) {
    //             if($x != 9) {
    //                 $data = $data."N";
    //             }
    //         }
    //     }
         
    // }
    // echo $data;