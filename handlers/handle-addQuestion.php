<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit'])){




    $question=trim($_POST['question']);

    $answer=trim($_POST['answer']);

    
    $email = $_SESSION['email'];




    $query = "SELECT * FROM `users` WHERE  `email`= '$email'  " ;

    $runQuery = mysqli_query($conn,$query);
    $results=mysqli_fetch_assoc($runQuery);



    $id = $results['id'];




    // echo $question , $id;
    

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

        

        $query = "INSERT INTO questions (question,user_id) VALUES ('$question','$id' ) ";
        $runQuery=mysqli_query($conn,$query);

        $query2 = "SELECT MAX(id) from questions ";
        $runQuery2=mysqli_query($conn,$query2);
        $maxId=mysqli_fetch_assoc($runQuery2);

        // print_r($maxId);
        $lastId = $maxId['MAX(id)'];

        // echo $lastId;


        $query3 = "INSERT INTO answers (answer,user_id,ques_id) VALUES ('$answer',$id,$lastId) ";
        mysqli_query($conn,$query3);


        header("location:../index.php");

        
    } else {
        $_SESSION['errors']=$errors;
        header("location:../addQuestion.php");

    }

  
    



}


?>