<?php

require_once "inc/dbConnection.php";

if(isset($_GET['id'])){


    $id = $_GET['id'];
  
    $query = "SELECT *  FROM `users` JOIN `questions` ON users.id=questions.user_id WHERE questions.id=$id ";

    $runQuery = mysqli_query($conn,$query);
    
    $result = mysqli_fetch_assoc($runQuery);



}


?>


<?php


require_once "inc/header.php";

?>


<div class="container  my-5">

    <div class="row">
        <div class="col-md-12 result p-3" >


      
            <h5><?php echo $result['question'] ?></h5>

                 
            <p class=" mb-3">
                <?php
                    $idQ=$result['id'];
                    $queryA = "SELECT  * FROM `answers` where ques_id=$idQ";
                    $runQueryA = mysqli_query($conn,$queryA);
                    $resAnswer=mysqli_fetch_all($runQueryA,MYSQLI_ASSOC);
                                
                    foreach($resAnswer as $ans)
                    {
                        echo "- ".$ans['answer']."<br>";
                                        
                                        
                    }
                ?>

            </p>
            <p>created_at: <?php echo $result['created_at'] ?></p>
            <p>username: <?php echo $result['username'] ?></p>

               
         

        </div>

    </div>

</div>





<?php

require_once "inc/footer.php";

?>
