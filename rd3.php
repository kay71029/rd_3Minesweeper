<?php
header('Content-Type: text/html; charset=utf-8');

    //畫出陣列
    for($x = 0; $x < 10; $x++) {
        for($y = 0; $y < 10; $y++) {
            $place[$x][$y] = "0";
        }
    }
    //產生炸彈
    $Rand = Array();
    for($i = 0; $i < 40; $i++) {
        $m = rand(0,99);
        for($j = 0; $j < count($Rand); $j++) {
            if ($Rand[$j] === $m) {
                $i--;
                continue 2;
            }
        }
        $Rand[] = $m;
    }
    
     for($i = 0; $i < 40; $i++) {
        $temp = $Rand[$i];
        $x = floor($temp/10);
        $y = $temp % 10;
        $place[$x][$y] = "M";
    }
    
    for($x = 0; $x < 10; $x++) {
        for($j = 0; $j < 10; $j++) {
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
   
    for($x = 0; $x < 10; $x++) {
        for($y = 0; $y < 10; $y++) {
            $data = $data.$place[$x][$y];
            if($y === 9) {
                if($x != 9) {
                    $data = $data."N";
                }
            }
        }
         
    }

    echo $data;
    