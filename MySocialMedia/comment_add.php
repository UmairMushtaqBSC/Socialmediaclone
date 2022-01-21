<?php
include('config.php');
$db=$conn;// database connection  
//legal input values
echo $_POST['comment'];
if($_POST['comment'] != ""){
 $post_id = $_POST['post_id'];
 $comment = $_POST['comment']; 
 $user = $_POST['user_name'];

    $query="INSERT INTO post_comments(post_id,comment,user) VALUES('$post_id','$comment','$user')";
    $execute=mysqli_query($db,$query);
     if($execute==true)
     {
       echo "User data was inserted successfully";
     }
     else{
      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
     }
    }

?>