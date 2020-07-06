<?php
$host = 'localhost';
$db = 'menu';
$username = 'root';
$pwd = '';
$conn = new mysqli($host,$username,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);
if(isset($_POST['number']) && isset(isset($_POST['email']))){
    $number = $_POST['number'];
    $email = $_POST['email'];
    $party = implode['',$_POST['party']];
    $query = "INSERT INTO userinfo(id,number,email,party) VALUES('$number','$email','$party')";
    $result = $conn->query($query);
    if($conn->error) echo($conn->error)

}
?>