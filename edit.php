<?php 
     
     $title = "Edit";
     require_once "config.php";
     include ('header.php');

     if (isset($_SESSION["uid"])) {

     $id = $_GET['id'];
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
          if(empty($title_err) && empty($desc_err)) {
     
               $sql = "UPDATE list SET title = '{$title}', description = '{$desc}' WHERE id = {$id}";

               $result = mysqli_query($conn, $sql);
               
               header("location: index.php");
          }
     }

?>

<?php 
     $sql1 = mysqli_query($conn, "SELECT * FROM list where id = $id");
     while($row = mysqli_fetch_array($sql1)) {
?>

     <div class="container" style="max-width: 720px; margin-top: 25px;">
          <h3 class="text-center">Add a todo</h3>
          <form  method="POST" action="" > 
               <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title'] ?>" required>
               </div>
               <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required><?php echo $row['description'] ?></textarea>
               </div>
               <div class="mt-2">
                    <input type="submit" id="submit" value="Update" name="submit" class="btn btn-sm btn-primary" style="width: 100px;">
                    <input type="reset" id="reset" value="Reset" name="reset" class="btn btn-sm btn-warning" style="width: 100px;">
               </div>  
          </form>
     </div>

<?php
     }
?>

<?php
     }
     include ('footer.php');
?>