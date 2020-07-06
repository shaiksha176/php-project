<?php
$host = 'localhost';
$db = 'menu';
$username = 'root';
$pwd = '';
$conn = new mysqli($host,$username,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<body>
     
     <input type="email" name="mail" id="" placeholder = "Email"class="input" size="30">
</body>
</html>
