<?php

require_once "inc/dbConnection.php";

if(isset($_GET['id']))
{
   
    $id=$_GET['id'];
    


    $query1="DELETE FROM `answers` WHERE ques_id=$id";
    $runQuery1=mysqli_query($conn,$query1);

    $query2="DELETE FROM `questions` WHERE id=$id ";
    $runQuery2=mysqli_query($conn,$query2);




    header("location: profile.php");




}


?>