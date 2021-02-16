<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: user/home.php");
  exit;
}
// Include config file
require_once "function/config.php";
 
// Define variables and initialize with empty values
$username = $password = $email =$nom = $prenom = $confirm_password = "";
$username_err = $email_err = $password_err = $nom_err = $prenom_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE username = ?";
        
        if($stmt0 = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt0, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt0)){
                /* store result */
                mysqli_stmt_store_result($stmt0);
                
                if(mysqli_stmt_num_rows($stmt0) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt0);
        }
    }



    // Validate Email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql1 = "SELECT id FROM user WHERE email = ?";
        
        if($stmt1 = mysqli_prepare($link, $sql1)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt1)){
                /* store result */
                mysqli_stmt_store_result($stmt1);
                
                if(mysqli_stmt_num_rows($stmt1) == 1){
                    $email_err = "This Email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt1);
        }
    }
    
    // Validate nom
    if(empty(trim($_POST["nom"]))){
        $nom_err = "Please enter a name.";     
    } elseif(strlen(trim($_POST["nom"])) < 2){
        $nom_err = "first name must have atleast 2 characters.";
    } else{
        $nom = trim($_POST["nom"]);
    }
    // Validate prenom
    if(empty(trim($_POST["prenom"]))){
        $prenom_err = "Please enter a Last name.";     
    } elseif(strlen(trim($_POST["prenom"])) < 2){
        $prenom_err = "Last name must have atleast 2 characters.";
    } else{
        $prenom = trim($_POST["prenom"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($nom_err) && empty($prenom_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user ( nom, prenom , email , password , username , country) VALUES ( ? , ? , ? , ? , ? , ? )";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss" ,$param_nom , $param_prenom , $param_email , $param_password , $param_username , $country );
            
            // Set parameters
            $ip= $_SERVER["REMOTE_ADDR"];
            $query=@unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success') {
            $country = $query['country'] ;} 
            else $country="default"  ;
            $param_nom = $nom ;
            $param_prenom = $prenom ;
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash


            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Register</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="icon" href="image/icon.png" type="image/png" sizes="16x16">

</head>
<body>
<section>
    <div id="place">
        <div id="picture"></div>
                           <div id="login">

<!--debut registerrr-->

                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                                <ul class="formul">
                                    <li><label>Full Name <span class="required">*</span></label>
                                        <input type="text" name="nom" class="field-divided" placeholder="First name" onblur="verifnom(this)" /> 
                                        <input type="text" name="prenom" class="field-divided" placeholder="Last name" onblur="verifnom(this)" />
                                        <span class="help-block"><?php echo $nom_err; ?></span>
                                        <span class="help-block"><?php echo $prenom_err; ?></span>
                                    </li>
                                    <li>
                                        <label>Username <span class="required">*</span></label>
                                        <input type="text" name="username" class="field-long" value="<?php echo $username; ?>"/>
                                        <span class="help-block"><?php echo $username_err; ?></span>
                                    </li> 
                                    <li>
                                        <label>Email <span class="required">*</span></label>
                                        <input type="email" name="email" class="field-long"  onblur="verifemail(this)"/>
                                        <span class="help-block"><?php echo $email_err; ?></span>
                                    </li>
                                    <li>
                                        <label>Password <span class="required">*</span></label>
                                        <input type="password" name="password" class="field-long"  value="<?php echo $password; ?>"/>
                                        <span class="help-block"><?php echo $password_err; ?></span>
                                    </li>
                                    <li>
                                        <label>Confirm Password <span class="required">*</span></label>
                                        <input type="password" name="confirm_password" class="field-long"  value="<?php echo $confirm_password; ?>"/>
                                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                        </li>
                                    <li>
                                        <input type="submit" value="Register" />
                                    </li>
                                    <li><p>Already have an account? <a href="login.php">Log in here</a>.</p></li>
                                    </ul>
                                </form>  
                                
<!--fin register-->
                        
                            </div>
    </div>
</section>
</body>
</html>