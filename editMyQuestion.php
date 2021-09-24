
<?php 

session_start();

require_once "inc/dbConnection.php";

require_once "inc/header.php";


if(isset($_GET['id']))
{
    $id=$_GET['id'];

    $query  = "SELECT * FROM `questions` JOIN `answers`
    ON questions.id=answers.ques_id WHERE questions.id=$id  " ;
    $runQuery=mysqli_query($conn,$query);
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


   
    <form action="handlers/handle-editQuestion.php?id=<?php echo $result['ques_id']?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label  class="form-label">Question</label>
            <input value="<?php echo $result['question']?>" required name="question" type="text" class="form-control">

        </div>
        <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea  name="answer" class="form-control"  rows="3">
                <?php echo  $result['answer']?>

            </textarea>
        </div>
        
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form> 


</div>



<?php 

require_once "inc/footer.php";

?>
