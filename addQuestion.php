
<?php 

session_start();


require_once "inc/header.php";

?>


<div class="container mt-5">

    <?php if(isset($_SESSION['errors'])) {?>

        <div class="alert alert-danger w-50">
            <?php foreach($_SESSION['errors'] as $error) {?>
                <p><?php echo $error?></p>
            <?php } unset($_SESSION['errors'])?>
        </div>

    <?php }?>


    <form action="handlers/handle-addQuestion.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label  class="form-label">Question</label>
            <input  name="question" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea name="answer" class="form-control"  rows="3"></textarea>
        </div>
        
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form>


</div>



<?php 

require_once "inc/footer.php";

?>
