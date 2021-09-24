<?php

session_start();
require_once "inc/dbConnection.php";

$newanser = trim($_POST['newanswer']);
$idQuestion = $_POST['ques_id'];

echo $newanser, $idQuestion ;

$email = $_SESSION['email'];



$query1 = "SELECT * FROM `users` WHERE `email`= '$email'  " ;

$runQuery1 = mysqli_query($conn,$query1);
$user=mysqli_fetch_assoc($runQuery1);

$id = $user['id'];
echo  $id;

$query2 = "INSERT INTO answers (answer,user_id,ques_id) VALUES ('$newanser',$id,$idQuestion) ";
$runQuery = mysqli_query($conn,$query2);
var_dump($runQuery );

header("location:index.php");



?>