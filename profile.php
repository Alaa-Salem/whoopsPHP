<?php

session_start();
require_once "inc/dbConnection.php";

$email = $_SESSION['email'];



$query = "SELECT * FROM `users` WHERE  `email`= '$email'  " ;

 $runQuery = mysqli_query($conn,$query);
    $result=mysqli_fetch_assoc($runQuery);


    // echo "<pre>";
    // print_r($results);
    // echo "</pre>";

    $id = $result['id'];

   
    
//     echo $id;


//     $sql  = "SELECT * FROM `questions` WHERE  `user_id`='$id' "; 

    $sql  = "SELECT * FROM `questions` WHERE questions.user_id='$id'  " ;
    $runSQl = mysqli_query($conn,$sql);
    $myQuestions=mysqli_fetch_all($runSQl,MYSQLI_ASSOC);


    

    // echo "<pre>";
    // print_r($myQuestions);
    // echo "</pre>";






?>


<?php
require_once "inc/header.php";
?>

<div class="w-50 m-auto border text-center mt-5">
    <h1>Personal Data</h1>
    <img style="width:300px; height:300px" src="uploads/<?php echo $result['img']?>" alt="">
    <p>Username: <?php echo $result['username'] ?></p>
    <p>Email:  <?php echo $result['email'] ?></p>

    <a class="btn btn-warning mb-3 w-50" href="editMyData.php?id=<?php echo $result['id']?>">Edit</a>

</div>

<div class="container">
    <div class="row">

   
        <?php foreach($myQuestions as $myQuestion) {?>
            <div class="col-md-12 mt-4 p-3 result"  >
                <h5><?php echo $myQuestion['question']?></h5>

                <p class="mb-3">
                    <?php
                        $idQ=$myQuestion['id'];
                        $queryA = "SELECT  * FROM `answers` where ques_id=$idQ";
                        $runQueryA = mysqli_query($conn,$queryA);
                        $resAnswer=mysqli_fetch_all($runQueryA,MYSQLI_ASSOC);   
                        foreach($resAnswer as $ans)
                        {
                            echo "-".$ans['answer']."<br>";
                                        
                                        
                        }
                    ?>

                </p>


                <a class="btn btn-warning" href="editMyQuestion.php?id=<?php echo  $idQ ?>">Edit</a>
                <a class="btn btn-danger" href="deleteMyQuestion.php?id=<?php echo  $idQ ?>">Delete</a>


            </div>
        <?php } ?>
    </div>

</div>





<?php
require_once "inc/footer.php";
?>



