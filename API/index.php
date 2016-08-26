<?php 

if ("addUser" == $_GET['url']) {
    include ("addUser.php");
} 

if ("getUserBalance" == $_GET['url']) {
    include ("getUserBalance.php");
} 

if ("CheckId" == $_GET['url']) {
    include ("CheckId.php");
} 

if ("Transfer" == $_GET['url'] ) {
    include ("Transfer.php");
}