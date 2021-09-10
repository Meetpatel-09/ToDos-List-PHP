<?php
	require_once "config.php";
     
     $title = "Sign Up";
	include ('header.php');

ob_start();

$fname = $email = $password = $con_password = $p_number =  "";
$fname_err = $email_err= $address_err = $password_err = $con_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if full name is empty
    if (empty(trim($_POST["inputFristName"]))) {
           $fname_err = "Please enter your name";
    } else {
           $fname = trim($_POST['inputFristName']);
    }

    if (empty(trim($_POST["inputPhonenumber"]))) {
           $p_number_err = "Please enter your mobile number";
    } else {
        $query = "SELECT id FROM users WHERE p_number = ?";
        $stmt = mysqli_prepare($conn, $query);
        if($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $param_p_number);

            // Set the variable of param email
            $param_p_number = trim($_POST['inputPhonenumber']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1) {
                    $p_number_err = "Your mobile number is already regisered";
                } else {
                    $p_number = trim($_POST['inputPhonenumber']);
                }
            } else {
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Check if email is empty
    if (empty(trim($_POST["inputEmail4"]))) {
        $email_err = "Please enter your email address";
    } else {
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        if($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $param_email);

            // Set the variable of param email
            $param_email = trim($_POST['inputEmail4']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "You Already have a account";
                } else {
                    $email = trim($_POST['inputEmail4']);
                }
            } else {
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
    
    // Check for password
    if(empty(trim($_POST['inputPassword']))) {
        $password_err = "Password cannot be blank";
    } elseif(strlen(trim($_POST['inputPassword'])) < 4 ) {
        $password_err = "Password cannot be less than 4 character";
    } else {
        $password = trim($_POST['inputPassword']);
    }

    // Check for confirm password
    if(trim($_POST['inputConfirmPassword4']) != trim($_POST['inputPassword'])) {
        $con_password_err = "Password should match";
    }

    // If there were no error insert user details in database
    if(empty($fname_err)&& empty($email_err) && empty($password_err) && empty($con_password_err) && empty($mobile_err)) {

        $query = "INSERT INTO users(f_name,email,p_number,password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        if($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_fname, $param_email, $param_p_number, $param_password);

            // Set this parameters

            $param_fname = $fname;
            $param_email = $email;
            $param_p_number = $p_number;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Try to execute the query
            if(mysqli_stmt_execute($stmt)) {
                header("location: signin.php");
            } else {
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<div style="margin-top: 15px; margin-bottom: -15px;">
    <h3 style="text-align: center">Sign Up</h3>
</div>
<div class="form-design">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">       
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="inputFristName">Full Name</label>
                            <input type="text" class="form-control" id="inputFristName" name="inputFristName" placeholder="Full Name">
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputPhonenumber">Phone number</label>
                        <input type="text" class="form-control" id="inputPhonenumber" name="inputPhonenumber" placeholder="Phone number">
                    </div>
                    
                    <div class="form-group mt-2">
                         <label for="inputPassword">Password</label>
                         <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                    </div>
                    <div class="form-group mt-2">
                         <label for="inputConfirmPassword4">Confirm Password</label>
                         <input type="password" class="form-control" id="inputConfirmPassword4" name="inputConfirmPassword4" placeholder="Confirm Password">
                    </div>
                    <div style="text-align:center" class="mt-3">
                         <button type="submit" class="btn btn-primary col-6">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
</div>
<?php
	include ('footer.php');
?>