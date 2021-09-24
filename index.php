<?php
    session_start();
    require_once "inc/dbConnection.php";

  
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 5;
    $offset = ($pageno-1) * $no_of_records_per_page;
    

    $total_pages_sql = "SELECT COUNT(*) FROM  `questions`";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);




    $query = "SELECT  * FROM `questions`  LIMIT $offset, $no_of_records_per_page";
    $runQuery = mysqli_query($conn,$query);
    $results=mysqli_fetch_all($runQuery,MYSQLI_ASSOC);

    // print_r($results);








  





    
    

    

    

?>

<?php
require_once "inc/header.php";
?>




<div class="container py-5" >
    <?php if(!isset($_SESSION['email'])) {?>
        <a class="btn btn-primary" href="login.php">Login</a>
    <?php }?>
    <?php if(!isset($_SESSION['email'])) {?>
        <a class="btn btn-primary float-right" href="registration.php">Sign Up</a>
    <?php }?>

    
    <?php if(isset($_SESSION['email'])) {?>
        <a class="btn btn-primary " href="profile.php" name="submit" >My profile</a>
    <?php }?>

    <?php if(isset($_SESSION['email'])) {?>
        <a class="btn btn-primary " href="addQuestion.php">Add Question</a>
    <?php }?> 

    <?php if(isset($_SESSION['email'])) {?>
        <a class="btn btn-primary float-end" href="logout.php">Logout</a>
    <?php }?>



    

    <br>


   

    <form  class="d-flex  mt-4 " action="search.php" method="GET">  
        <input class="form-control  me-2" type="search" placeholder="Search about your question" aria-label="Search" name="search">
        <button type="subit" class="btn btn-success" name="submit">Search</button>


    </form> 
    <br>

    <h1>All Questions: </h1>


 
    <div class="row" >

        <?php foreach($results as $result) {?>
            <div class="col-md-12 mt-4 p-3 result "  >
                <div class="d-flex mb-3">
                   
                    <?php if(isset($_SESSION['email'])) {?>

                        <?php 
                            $idQ=$result['id'];
                        ?>
                            
                        <form method="POST" action="vote.php?id=<?php echo $idQ?>" class="vote">
                            <input name="up" type="submit" value="up">

                            <h5 class="count text-center"  name="vote">
                                <?php 

                                    $email = $_SESSION['email'];
                                    $userQuery = "SELECT id FROM users WHERE email='$email' ";
                                    $runQueryUser  = mysqli_query($conn, $userQuery);
                                    $user= mysqli_fetch_assoc($runQueryUser);
                                    $userID = $user['id'];


                                    $answerQuery = "SELECT id FROM answers where ques_id=$idQ ";
                                    $runQueryAnswer  = mysqli_query($conn, $answerQuery);
                                    $answer= mysqli_fetch_assoc($runQueryAnswer);
                                    $ansID = $answer['id'];

                    
                                    $queryVote = "SELECT * FROM `votes` where ans_id=$ansID and user_id=$userID";
                                    $runQueryVote  = mysqli_query($conn,$queryVote );
                                    $resultVote=mysqli_fetch_assoc($runQueryVote);
                               
                                  

                                    if(empty($resultVote['vote'])){
                                        echo 0;
                                    }else{
                                        echo $resultVote['vote'];
                                    }
                                  

                             
                                ?>
                            

                            </h5>
                            <input name="down" type="submit" value="down">

                                     

                        </form>

                            

                                    

                    <?php } ?>

                  

                    <div class="ml-4">
                            <h5><?php echo $result['question']?></h5>

                            
                            <p class="answer mb-3">
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
                            

                            


                            <a class="btn btn-info" href="showDetails.php?id=<?php echo $idQ?>">Show-Details</a>

                    </div>

                </div>

                
            
                <?php if(isset($_SESSION['email'])) {?>     
                   
                    <form  action="addAnswer.php" method="post"  class="d-flex">
                        <textarea  name="newanswer" class="form-control w-75 mr-3"  rows="3" >
                                                        
                        </textarea>

            
                        <button class="btn btn-success h-50 "  type="submit" name="ques_id" value=<?php echo $idQ?> >Add Answer</button>
                       


                    </form>  
                   
                      

                    
                                         
                   
                    

                <?php } ?>
              



            
            
            </div>

          

          


        <?php }?>

    </div>


  

    <ul class="pagination justify-content-center mt-4">
        <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
        <li class="page-item    <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li   class=" page-item   <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li class="page-item"><a  class="page-link"href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>



   
   

   

</div>












<?php
require_once "inc/footer.php";
?>