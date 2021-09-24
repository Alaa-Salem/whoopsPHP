<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit']) && isset($_GET['id'])){
    
   
    $question=trim($_POST['question']);

    $answer=trim($_POST['answer']);

   
    $id = $_GET['id'];

   
    $errors=[];

    if(empty($question))
    {
        $errors[]="Question is Required";
    } else if (strlen($question)<10 || strlen($question)>255)
    {
        $errors[]="Question Length between [10-255]";
    } else if(is_numeric($question))
    {
        $errors[]="Question must String";
    }

    if(empty($answer))
    {
        $errors[]="Answer is Required";
    } else if (strlen($answer)<10 || strlen($answer)>1000)
    {
        $errors[]="AnswerLength between [10-1000]";
    } 


    if(empty($errors))
    {  
            $query1="UPDATE `answers` SET `answer`='$answer' where ques_id=$id";

            $runQuery1=mysqli_query($conn,$query1);

            $query2="UPDATE `questions` SET `question`='$question' where id=$id";

            $runQuery2=mysqli_query($conn,$query2);

    
            header("location:../index.php");
    
        
        
    } else {
        $_SESSION['errors']=$errors;
        header("location:../editMyQuestion.php.php?id=$id");

    }



    }




?>