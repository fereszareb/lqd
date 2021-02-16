<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "../function/config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE user SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
    header("Refresh:0");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/user.css">
    <link rel="icon" href="../image/icon.png" type="image/png" sizes="16x16">

</head>
<body>

<div id="navbar">
                                        <ul>
                                        <li>  <a>
                                                    <div id="user-navbar-home">
                                                        <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                                                        <img src="<?php echo htmlspecialchars($_SESSION["picture"]); ?>">
                                                    </div></a>
                                            <ul>
                                                <li><a href="dashboard.php"> statistics</a></li>
                                                <li><a href="profile.php">profile</a> </li>
                                                <li><a href="../function/logout.php">logout</a> </li>
                                            </ul>
                                        </li>             
                                        </ul>
</div>
<div id="user">
     <div id="controle">
       <div id="controle-profile">

       
                <div id="logo">
                <img src="../image/logo.png" >                </div>
                <img src="<?php echo htmlspecialchars($_SESSION["picture"]); ?>">
                <h3><?php echo htmlspecialchars($_SESSION["nom"]); ?> <?php echo htmlspecialchars($_SESSION["prenom"]); ?></h3>
      </div> 
        <div id="controle-menu">  <ul>
                    <a href="dashboard.php"><li> Dashboard</li></a>

                    
                    <a href="profile.php"><li> Profil</li></a>
                    
                    <a href="home.php"><li> Edit your page</li></a>
                    <a href="reset-password.php"><li  class="active"> Resset password  <p>></p></li></a>
                    <a href="../function/logout.php"><li> Logout</li></a>
                    
                </ul>
           </div>     
     </div>
     <div id="dashboard">
     <div class="reset_pass">
        <h2>Reset Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
            <ul>
                <li><label>New Password</label></li>
                <li><input type="password" name="new_password" class="form_pass" value="<?php echo $new_password; ?>"></li>
                <li><span class="help-block"><?php echo $new_password_err; ?></span></li>
            </ul>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <ul>
                <li><label>Confirm Password</label></li>
                <li><input type="password" name="confirm_password" class="form_pass"></li>
                <li><span class="help-block"><?php echo $confirm_password_err; ?></span></li>
            </ul>
            </div>
            
                <input type="submit" class="btn" style="width:100%" value="Submit">
            
        </form>
    </div>
     </div>
</div>



































        
</body>
</html>