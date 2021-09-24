<?php 
require_once "inc/dbConnection.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>

.register-form{
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.register-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.register-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>
    <div class="register-form">
        <form method="post" action="handlers/handle-register.php">
            <h2 class="text-center">Registration </h2>  

           
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" >
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password_1"  class="form-control" >
            </div>
            <div class="form-group">
                <label>Confirm password</label>
                <input type="password" name="password_2" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="reg_user">Register</button>
            </div>
            <p>
                Already a member? <a href="login.php">Login in</a>
            </p>


            <?php 
                session_start();

                if(isset($_SESSION['errors'])) {?>

                    <div class="alert alert-danger w-100">
                        <?php foreach($_SESSION['errors'] as $key => $value) {?>
                            <p> <?php echo "errors[ $key ] : $value <br>" ?> </p>
                        <?php } unset($_SESSION['errors'])?>

                    </div>

            <?php }  ?>




        </form>

    </div>


   

</body>
</html>

