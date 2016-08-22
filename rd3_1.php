<?php
header('Content-Type: text/html; charset=utf-8');
$time_start = microtime(true); 
    //畫出陣列
    for($x = 0; $x < 50; $x++) {
        for($y = 0; $y < 60; $y++) {
            $place[$x][$y] = "0";
        }
    }
    //產生炸彈
    $Rand = Array();
    for($i = 0; $i < 1200; $i++) {
        $m = rand(0,2999);
        if (in_array($m , $Rand)){
            $i--;
            // continue 2;
        }
        $Rand[] = $m;
    }
     for($i = 0; $i < 1200; $i++) {
        $temp = $Rand[$i];
        $x = floor($temp/50);
        $y = $temp % 60;
        $place[$x][$y] = "M";
    }
    
    for($x = 0; $x < 50; $x++) {
        for($j = 0; $j < 60; $j++) {
            if($place[$x][$j] === "0") {
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
                $place[$x][$j] = $num;
            }
        }
    }
   
    for($x = 0; $x < 50; $x++) {
        for($y = 0; $y < 60; $y++) {
            $data = $data.$place[$x][$y];
            if($y === 59) {
                if($x != 49) {
                    $data = $data."N";
                }
            }
        }
         
    }

    echo $data;
 $end = microtime(true); 
 //echo "<br>" .($end - $time_start);