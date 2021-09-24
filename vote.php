<?php

session_start();
require_once "inc/dbConnection.php";



$idQ = $_GET['id'];
// echo $idQ;

$email = $_SESSION['email'];

$userQuery = "SELECT id FROM users WHERE email='$email' ";
$runQueryUser  = mysqli_query($conn, $userQuery);
$user= mysqli_fetch_assoc($runQueryUser);

$userID = $user['id'];
// echo $userID;




$answerQuery = "SELECT id FROM answers where ques_id=$idQ ";
$runQueryAnswer  = mysqli_query($conn, $answerQuery);
$answer= mysqli_fetch_assoc($runQueryAnswer);
$ansID = $answer['id'];
// echo $ansID;



$queryVote = "SELECT * FROM `votes` where ans_id=$ansID and user_id=$userID";
$runQueryVote  = mysqli_query($conn,$queryVote );
$resultVote=mysqli_fetch_assoc($runQueryVote);


if(isset($_POST['up'])){
    if(empty($resultVote['vote'])){
        $queryUp="INSERT INTO votes (user_id,ans_id,vote) VALUES($userID,$ansID,'1')";
        $runQuery=mysqli_query($conn,$queryUp);
        var_dump($runQuery);

        header("location: index.php");

    }else{
        
        $queryUp="INSERT INTO votes (user_id,ans_id,vote) VALUES($userID, $ansID,'0')";
        $runQuery=mysqli_query($conn,$queryUp);
        var_dump($runQuery);
        
        header("location: index.php");

    }

   
} else if(isset($_POST['down'])){
    if(empty($resultVote['vote'])){
        
        $queryDown="INSERT INTO votes (user_id,ans_id,vote) VALUES($userID, $ansID,'-1')";
        $runQuery=mysqli_query($conn,$queryDown);
        var_dump($runQuery);

        header("location: index.php");

        
    }else{
        
        $queryDown="INSERT INTO votes (user_id,ans_id,vote) VALUES($userID, $ansID,'0')";
        $runQuery=mysqli_query($conn,$queryDown);
        var_dump($runQuery);

        header("location: index.php");

       
    }


}






?> 