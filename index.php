<?php
	$title = "Home";

     require_once "config.php";
	include ('header.php');

     if (isset($_SESSION["uid"])) {
    
     ob_start();
     
     $uid = $_SESSION["uid"];
     $title = $desc =  "";
     $title_err = $desc_err = "";
     
     if ($_SERVER['REQUEST_METHOD'] == "POST") {
         // Check if full name is empty
         if (empty(trim($_POST["title"]))) {
                $title_err = "Please enter title";
         } else {
                $title = trim($_POST['title']);
         }
         if (empty(trim($_POST["desc"]))) {
                $desc_err = "Please enter description";
         } else {
                $desc = trim($_POST['desc']);
         }
     
         // If there were no error insert list lst in database
         if(empty($title_err)&& empty($desc_err)) {
     
             $query = "INSERT INTO list(uid,title,description) VALUES (?, ?, ?)";
             $stmt = mysqli_prepare($conn, $query);
             if($stmt) {
                 mysqli_stmt_bind_param($stmt, "sss", $param_uid, $param_title, $param_desc);
     
                 // Set this parameters
     
                 $param_uid = $uid;
                 $param_title = $title;
                 $param_desc = $desc;
     
                 // Try to execute the query
                 if(mysqli_stmt_execute($stmt)) {
                     header("location: index.php");
                 } else {
                     echo "Something went wrong";
                 }
             }
             mysqli_stmt_close($stmt);
         }
         mysqli_close($conn);
     }

?>

<main>

     <div class="container" style="max-width: 720px; margin-top: 25px;">
          <h3 class="text-center">Add a todo</h3>
                <form  method="POST" action="" > 
                    <div class="form-group">
                         <label for="title">Title</label>
                         <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                         <label for="desc">Description</label>
                         <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                    </div>
                    <div class="mt-2">
                         <input type="submit" id="submit" value="Add" name="submit" class="btn btn-sm btn-success" style="width: 100px;">
                         <input type="reset" id="reset" value="Reset" name="reset" class="btn btn-sm btn-warning" style="width: 100px;">
                     </div>  
               </form>
          	</div>

          	<div class="container" style="max-width: 1280px">
               <h3 class="text-center my-3">Todos List</h3>
               <div class="container mb-3">
               <?php
                    $sql1 = mysqli_query($conn, "SELECT * FROM list where uid = $uid");
                    while($row = mysqli_fetch_array($sql1)) {
                    $aid = $row['id'];
               ?>
                    
                    <h4><?php echo $row['title'] ?></h4>
                    <p><?php echo $row['description'] ?></p>
                    <a href="edit.php?id=<?php echo $aid ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete.php?id=<?php echo $aid ?>" class="btn btn-sm btn-danger">Delete</a>
                    <hr />
                    <?php
                              }
                    ?>
               </div>
          </div>
</main>

<?php
	include ('footer.php');
     } else {
          header("location: signin.php");
     }
?>