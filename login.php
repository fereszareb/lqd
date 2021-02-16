<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: user/home.php");
  exit;
}
 
// Include config file
require_once "function/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username ,  password FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;  
                            $_SESSION["loggedin"] = true;
                            $req=" SELECT nom , prenom , picture ,email , phone , adress  FROM user WHERE (id=$id)";
                            $res=mysqli_query($link,$req);
                            $et=mysqli_fetch_assoc($res) ;
                            $_SESSION["nom"] =$et['nom'] ;
                            $_SESSION["prenom"] =$et['prenom'] ;
                            $_SESSION["picture"] =$et['picture'] ;
                            $_SESSION["email"] =$et['email'] ;
                            $_SESSION["phone"] =$et['phone'] ;
                            $_SESSION["adress"] =$et['adress'] ;
                            
                            
                            
                                                      

                            //Create a design for this id 
                                    $sql2="SELECT id FROM user WHERE ( username = '".$username."')";
                                    $res=mysqli_query($link,$sql2);
                                    $row = mysqli_fetch_array($res) ;
                                    $id=$row['id'] ;
                                    $sql3="INSERT INTO design (id_user) values ($id) ";
                                    $res=mysqli_query($link,$sql3);


                            // Redirect user to welcome page
                            header("location: user/home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="icon" href="image/icon.png" type="image/png" sizes="16x16">

</head>
<body>
<section>
    <div id="place">
        <div id="picture"></div>
                           <div id="login">
<!--debut login -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <ul class="formul">
                                        <li>
                                            <label>Username <span class="required">*</span></label>
                                            <input type="text" name="username" class="field-long" value="<?php echo $username; ?>">
                                            <span class="help-block"><?php echo $username_err; ?></span>
                                        </li>
                                        <li>
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" name="password" class="field-long">
                                            <span class="help-block"><?php echo $password_err; ?></span>
                                        </li>
                                        
                                    <li>
                                        <input type="submit"  value="Log In"/>
                                    </li>
                                    <li><p>Don't have an account? <a href="register.php">Sign up now</a>.</p></li>
                                    </ul>
</form>



















<!--fin login -->
                        
                            </div>
    </div>
</section>
</body>
</html>