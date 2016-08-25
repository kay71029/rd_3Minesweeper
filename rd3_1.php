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
    $gonb = 1200;
    $a = 0;
    while( !$Rand[$a] ){
        if( $a > $gonb-1 ) break;
        $sn = mt_rand(1,3000); 
        if(!in_array($sn,$Rand)){
           
            $Rand[$a] = $sn;
            $a++;
        }
    }
 //var_dump($Rand);
     for($i = 0; $i < 1200; $i++) {
        $temp = $Rand[$i];
        $x = floor($temp/50);
        $y = $temp % 60;
        $place[$x][$y] = "M";
    }
    
    for($x = 0; $x < 50; $x++) {
        for($y = 0; $y < 60; $y++) {
            if($place[$x][$y] === "0") {
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
                $place[$x][$y] = $num;
            }
        }
    }
   //var_dump($place);
    for($x = 0; $x < 50; $x++) {
        for($y = 0; $y < 60; $y++) {
            $data = $data.$place[$x][$y];
            if($y == 59) {
                if($x != 49) {
                    $data = $data."N";
                }
            }
        }
    }
    echo $data;
 $end = microtime(true); 
 echo "<br>" .($end - $time_start);