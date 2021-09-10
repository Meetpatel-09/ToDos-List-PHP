<?php
	$title = "Sign In";
?>
<?php
     ob_start();
	require_once "config.php";
	include ('header.php');
     
     if(isset($_SESSION['email'])) {
		header("location: index.php");
		exit;
	}

     $email = $password = "";
	$email_err = $password_err = "";

     // if request method is post
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if (empty(trim($_POST['exampleInputEmail1']))) {
			$email_err = "Please enter email";
		} else {
			$email = trim($_POST['exampleInputEmail1']);
		}

		if (empty(trim($_POST['exampleInputPassword1']))) {
			$password_err = "Please enter password";
		} else {
			$password = trim($_POST['exampleInputPassword1']);
		}

        if (empty($email_err) && empty($password_err)) {
			$sql = "SELECT id, email, password FROM users WHERE email = ?";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, "s", $param_email);
			$param_email = $email;
    
			// Try to execute this statement
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1){
					
					mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
					if(mysqli_stmt_fetch($stmt)){
						if (password_verify($password, $hashed_password))
						{
							// this means the password is corrct. Allow user to login
							session_start();
							$_SESSION["userEmail"] = $email;
							$_SESSION["uid"] = $id;
							$_SESSION["loggedin"] = true;

							//Redirect user to welcome page
							header("location: index.php");

						}
					}
				}
			}
        }
    }
    
?>
<div style="margin-top: 15px;">
        <h3 style="text-align: center">Sign In</h3>
    </div>
    <div class="form-design">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">       
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-groupmt-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div style="text-align:center" class="mt-3">
                         <button type="submit" class="btn btn-primary col-6">Login</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
    </div>
<?php
	include ('footer.php');
?>