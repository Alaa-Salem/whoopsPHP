<?php
session_start();
require_once "../inc/dbConnection.php";



if (isset($_POST['reg_user'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 =$_POST['password_2'];
    $errors=[];



    $user_check_query = "SELECT * FROM users WHERE email='$email' ";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result)>0) {
        if ($user['email'] === $email) {
            $errors[] = "Email already exists";
        }
    }
  

    if (empty($username)) { 
        $errors[] = "Username is required"; 
    }else if(!preg_match('/^[a-zA-Z0-9_]+$/',$username)){
        $errors[] = "Username can contain letters, numbers, and underscores." ;     
    }

    if (empty($email)) { 
        $errors[] = "Email is required"; 
    }else if(strlen($email)>50){  
        $errors[] = 'Email: Max length 50 Characters Not allowed';
    }else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
        $errors[] = "You Entered An Invalid Email Format"; 
    }

    if (empty($password_1)) { 
        $errors[] = "Password is required"; 
    }else if(strlen($password_1)<6){
        $errors[] = "Password must have atleast 6 characters.";
    }


   
    if(empty($password_2)){
        $errors[] = "Please confirm the password.";
    }else if ($password_1 != $password_2) {
	    $errors[] =  "The two passwords do not match";
    }


    if(empty($errors)){ 
        
        $password = password_hash($password_1,PASSWORD_BCRYPT);

        $query = "INSERT INTO `users` (`username` , `email`, `password`  ) 
                VALUES('$username' , '$email', '$password' ) ";

        $runQuery=mysqli_query($conn,$query);

        // echo "welcome! Your account has been created ";

        // $success = "welcome! Your account has been created";
        // echo $success;

        header("location:../registration.php");


    }else {
        $_SESSION['errors']=$errors;
        header("location:../registration.php");

    }

}