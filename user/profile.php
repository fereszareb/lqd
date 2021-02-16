<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
} 
$id=$_SESSION["id"] ;
$username=$_SESSION["username"] ;
$nom=$_SESSION["nom"];
$prenom=$_SESSION["prenom"];
$email=$_SESSION["email"];
$phone=$_SESSION["phone"];
$adress=$_SESSION["adress"];
$username_err = $email_err = $nom_err = $prenom_err = $phone_err=$adress_err = "";
include '../function/config.php' ;
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if( !empty($_POST['submit_1'] )) {
                // Validate nom
                if(empty(trim($_POST["nom"]))){
                    $nom_err = "Please enter a name.";     
                } elseif(strlen(trim($_POST["nom"])) <= 3){
                    $nom_err = "first name must have atleast 3 characters.";
                } 
                    $nom =$_POST["nom"];

                // Validate prenom
                if(empty(trim($_POST["prenom"]))){
                    $prenom_err = "Please enter a Last name.";     
                } elseif(strlen(trim($_POST["prenom"])) <= 3){
                    $prenom_err = "Last name must have atleast 3 characters.";
                }
                    $prenom =$_POST["prenom"];
                // Validate phone
                if(! empty(trim($_POST["tel"]))){    
                if(strlen(trim($_POST["tel"])) <= 3){
                    $_err = "Incorrect number.";
                } }
                    $phone =$_POST["tel"];
                // Validate adress
                if(! empty(trim($_POST["adress"]))){
                    if(strlen(trim($_POST["adress"])) <= 6){
                    $nom_err = "Incorrect adress";
                } }
                    $adress =$_POST["adress"];

                    
                // Validate username
                if(empty(trim($_POST["username"]))){
                    $username_err = "Please enter a username.";
                }elseif(strlen(trim($_POST["username"])) <= 5){
                    $username_err = "username must have atleast 5 characters.";
                } else{
                    // Prepare a select statement
                    $new_username=$username;
                    if ($username != $_POST['username']) {
                            $new_username=$_POST['username'] ;
                                        $sql = "SELECT id FROM user WHERE username='$new_username'";
                                        $res=mysqli_query($link,$sql);

                                        if(! $result=mysqli_fetch_assoc($res)){
                                            $FZ_username= $new_username ;
                                        }else {
                                            $username_err = "This username is already taken.";
                                        }                       
                        } 
                            $username=$new_username;
                }
                // Validate email
                if(empty(trim($_POST["email"]))){
                    $email_err = "Please enter a email.";
                } else{
                    // Prepare a select statement
                    $new_email=$email;
                    if ($email != $_POST['email']) {
                            $new_email=$_POST['email'] ;
                                        $sql = "SELECT id FROM user WHERE email='$new_email'";
                                        $res=mysqli_query($link,$sql);

                                        if(! $result=mysqli_fetch_assoc($res)){
                                            $FZ_email= $new_email ;
                                        }else {
                                            $email_err = "This email is already taken.";
                                        }                       
                        } 
                        $email=$new_email;
                }

                 // Check input errors before inserting in database
                if(empty($email_err) && empty($nom_err) && empty($prenom_err) && empty($username_err)){
                        
                    // Prepare an insert statement
                    $sql100 = "UPDATE user set nom='$nom',prenom='$prenom',email='$email',username='$username',adress='$adress',phone='$phone' WHERE id=$id " ;
                    $res100=mysqli_query($link,$sql100);
                    $_SESSION["username"]= $username;
                    $_SESSION["nom"]=$nom;
                    $_SESSION["prenom"]=$prenom;
                    $_SESSION["email"]=$email;
                    $_SESSION["phone"]=$phone;
                    $_SESSION["adress"]=$adress;
                    header("Refresh:0");
                }
                
    }

    
}

/*--- we created a variables to display the error message on design page ------*/
$error = "";

if (isset($_POST["btn_upload"]) == "Upload")
{           $file_tmp = $_FILES["fileImg"]["tmp_name"];
    if( !is_uploaded_file($file_tmp) ) {$error="Please add a picture .";}else{

                    $type_file = $_FILES['fileImg']['type'];
                if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {$error="This file is not a picture."; }
                else{

                    
                    $file_name = $_FILES["fileImg"]["name"];
                    //image directory where actual image will be store
                    $file_path = "../image/user/"."0".$file_name;

                    $target_file = $file_path . basename($file_name);	

                    /*-------- now insertion of image section has start -------------*/


                    $i=0;
                    while(file_exists($file_path)){
                        $i++ ;
                        $file_path = "../image/user/".$i.$file_name;
                        $target_file = $file_path . basename($file_name);
                    }
                    
                            
                            
                            mysqli_query($link,"UPDATE user set picture='$file_path' where id=$id") or die ("image not inserted". mysqli_error());
                            move_uploaded_file($file_tmp,$file_path);
                            $_SESSION["picture"]=$file_path;
                            header("Refresh:0");
                    
                }
        }
        
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/user.css">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" href="../image/icon.png" type="image/png" sizes="16x16">
    <title><?php echo($_SESSION['username']) ?> - Profil</title>

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

                    
                    <a href="profile.php"><li   class="active"> Profil  <p>></p></li></a>
                    
                    <a href="home.php"><li> Edit your page</li></a>
                    <a href="reset-password.php"><li> Resset password</li></a>
                    <a href="../function/logout.php"><li> Logout</li></a>
                    
                </ul>
           </div>     
     </div>
     <div id="dashboard">
     
        <div id="profile">
            <div id="picture-change">
                <img src="<?php echo htmlspecialchars($_SESSION["picture"]); ?>" alt="">
                <form method="Get" name="upfrm" action="" enctype="multipart/form-data">
                <input type="file" name="fileImg" class="file_input" /> <br>
                <span class="help-block"><?php echo $error; ?></span>
                <input type="submit" value="Upload" name="btn_upload" class="btn" />
                </form>
            </div>
            <div id="detail_change">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                                <ul class="formul">
                                    <li><label>Full Name </label>
                                        <input type="text" name="nom" class="field-divided" placeholder="First" value="<?php echo($nom); ?>" onblur="verifnom(this)" /> 
                                        <input type="text" name="prenom" class="field-divided" value="<?php echo($prenom); ?>" placeholder="Last" onblur="verifnom(this)" />
                                        <span class="help-block"><?php echo $nom_err; ?></span>
                                        <span class="help-block"><?php echo $prenom_err; ?></span> 
                                    </li>
                                    <li>
                                        <label>Username </label>
                                        <input type="text" name="username" class="field-long" value="<?php echo ($username); ?>" placeholder="Username"/>
                                        <span class="help-block"><?php echo $username_err; ?></span> 
                                    </li> 
                                    <li>
                                        <label>Email </label>
                                        <input type="email" name="email" class="field-long" placeholder="Email" value="<?php echo ($email); ?>" onblur="verifemail(this) "/>
                                        <span class="help-block"><?php echo $email_err; ?></span> 
                                    </li>
                                    <li>
                                        <label>Phone </label>
                                        <input type="tel" name="tel" class="field-long" placeholder="Phone" value="<?php echo ($phone); ?>" onblur="verifemail(this)"/>
                                       <span class="help-block"><?php echo $phone_err; ?></span> 
                                    </li>
                                    <li>
                                        <label>Address </label>
                                        <input type="text" name="adress" class="field-long" value="<?php echo ($adress); ?>" onblur="verifemail(this)"/>
                                       <span class="help-block"><?php echo $adress_err; ?></span> 
                                    </li>
                                    
                                        <input id="save_change" type="submit" name="submit_1" value="Save" />
                                    </li>
                                    
                                    </ul>
                                </form>
            </div>
        </div>









     </div>
</div>

</body>
</html>