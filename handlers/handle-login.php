<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    

    $query = "SELECT * FROM `users` JOIN `questions` JOIN `answers` ON users.id=questions.user_id AND users.id=answers.user_id WHERE email='$email' ";

    $runQuery=mysqli_query($conn,$query);
    if(mysqli_num_rows($runQuery)>0){
        $user=mysqli_fetch_assoc($runQuery);
        $userhashPassword=$user['password'];

        $isCorrect=password_verify($password,$userhashPassword);
        
        if($isCorrect)
        {
            $_SESSION['email']=$user['email'];
            header("location:../index.php");
        } else {
            $_SESSION['errors']="Password not match";
            header("location:../login.php");
        }

    } else {
        $_SESSION['errors']="Email not match";
        header("location:../login.php");
    } 
}

?>





