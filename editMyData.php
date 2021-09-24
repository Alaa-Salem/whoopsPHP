
<?php 

session_start();

require_once "inc/dbConnection.php";

require_once "inc/header.php";


if(isset($_GET['id']))
{
    $id=$_GET['id'];

    $email = $_SESSION['email'];

    $query = "SELECT * FROM `users` WHERE  `email`= '$email'  " ;

    $runQuery = mysqli_query($conn,$query);
    $result=mysqli_fetch_assoc($runQuery);



}


?>


<div class="container mt-5">

    <?php if(isset($_SESSION['errors'])) {?>

        <div class="alert alert-danger w-50">
            <?php foreach($_SESSION['errors'] as $error) {?>
                <p><?php echo $error?></p>
            <?php } unset($_SESSION['errors'])?>
        </div>

    <?php }?>


   
    <form action="handlers/handle-editData.php?id=<?php echo $result['id']?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label"> Image </label>
            <input name="image" class="form-control" type="file" >
        </div>
        <div class="mb-3">
            <label  class="form-label">username</label>
            <input value="<?php echo $result['username']?>" required name="username" type="text" class="form-control">

        </div>
        <div class="mb-3">
            <label  class="form-label">email</label>
            <input value="<?php echo $result['email']?>" required name="email" type="text" class="form-control">

        </div>
       
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form> 


</div>



<?php 

require_once "inc/footer.php";

?>
