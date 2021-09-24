<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit']) && isset($_GET['id'])){
    
    $username=trim($_POST['username']);
    $email= trim($_POST['email']);
    $image=$_FILES['image'];
    $id = $_GET['id'];

    $imageName=$image['name'];
    $imageTmpName=$image['tmp_name'];
    $imageError=$image['error'];
    $imageSize=$image['size'];
    $imageSizeMb=$imageSize/(1024**2);
    $ext=pathinfo($imageName,PATHINFO_EXTENSION);
    $errors=[];


    if (empty($username)) { 
        $errors[] = "Username is required"; 
    } else if (strlen($username)<5 || strlen($username)>255)
    {
        $errors[]="username Length between [5-255]";
    } else if(is_numeric($username))
    {
        $errors[]="username must String";
    }

    if (empty($email)) { 
        $errors[] = "Email is required"; 
    }else if(strlen($email)>50){  
        $errors[] = 'Email: Max length 50 Characters Not allowed';
    }

   

    if(empty($errors))
    {  
        if(!empty($imageName))
        {
            $rand=uniqid();
            $imgNewName="$rand.$ext";
            move_uploaded_file($imageTmpName,"../uploads/$imgNewName");
            // echo $imgNewName,$username , $email , $id;
            $query="UPDATE `users` SET `username`='$username' ,`email`='$email', `img`='$imgNewName' where id=$id";
            
            $runQuery=mysqli_query($conn,$query);
            header("location:../profile.php");

        } else {

            $query="UPDATE `users` SET `username`='$username' ,`email`='$email' where id=$id";

            $runQuery=mysqli_query($conn,$query);
    
            header("location:../profile.php");
        }
        
        
    } else {
        $_SESSION['errors']=$errors;
        header("location:../editMyData.php?id=$id");

    }



    }




?>