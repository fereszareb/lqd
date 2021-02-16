<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
} 
// Store other data in session variables
include '../function/config.php' ;
$id = $_SESSION["id"] ;
$req=" SELECT nom , prenom ,username , picture  FROM user WHERE (id=$id)";
$res=mysqli_query($link,$req);
$et=mysqli_fetch_assoc($res) ;
$_SESSION["nom"] =$et['nom'] ;
$_SESSION["prenom"] =$et['prenom'] ;
$_SESSION["picture"] =$et['picture'] ;
// select of design of social from database
$req2="SELECT * From design WHERE (id_user=$id )" ;
$res2=mysqli_query($link,$req2);
$et2=mysqli_fetch_assoc($res2) ;
//select of social from database
$req3="SELECT * From social WHERE (id_user=$id )" ;
$res3=mysqli_query($link,$req3);

// send a social to database
if($_SERVER["REQUEST_METHOD"] == "POST"){


    if( !empty($_POST['submit_1'] )) {

        $name_so=$link_so="" ;
    $name_social_err=$link_social_err="";
    // validate name social
    if(empty(trim($_POST["name_social"]))){
        $name_social_err = "Please enter a Name of social.";
    } else{
        $name_so=$_POST["name_social"] ; }

    // validate link of social 
    if(empty(trim($_POST["link_social"]))){
        $link_social_err = "Please enter a link of social.";
    } else{
        $link_so=$_POST["link_social"] ; }
    //send to database social
    if(empty($name_social_err) && empty($link_social_err) ){
        $TIME=date("Y-m-d H:i:s");
        $sql4="INSERT INTO social ( id_user , name_social , link_social , date_creation ) VALUES ('".$id."','".$name_so."','".$link_so."','".$TIME."')";
        $res4=mysqli_query($link,$sql4);
        header("Refresh:0");
    }
    
    }
    else if( !empty($_POST['submit_2']) ) {
        $new_link=$_POST['new_link_social'];
        $new_name=$_POST['new_name_social'];
        $id_social=$_POST['id_so'];
        $sql99="UPDATE social SET name_social = '$new_name', link_social='$new_link'    where   id=$id_social";
        $res99=mysqli_query($link,$sql99);
        header("Refresh:0");
      
    
    }else if( !empty($_POST['submit_3']) ) {
        $id_social=$_POST['id_so'];
        $sql50="DELETE FROM social WHERE id = $id_social ";
        $res50=mysqli_query($link,$sql50);
        header("Refresh:0");
    }


    

}









?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit your page</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/option.css">
    <link rel="icon" href="../image/icon.png" type="image/png" sizes="16x16">
<script>
  function background_change(x) {
      
    document.getElementById("view").style.background = x;

    }

    function style_border_change(x){
        for(let i=1;i<10;i++) {
        document.getElementById("social_number"+i).style.border= x;
    }}
    function border_radius_change(x){
        for(let i=1;i<10;i++) {
        document.getElementById("social_number"+i).style.borderRadius= x;
    }}


    function computer_size(w,h) {
            document.getElementById("view").style.width= w + "px";
            document.getElementById("view").style.heigth= h + "px";
    }
    function add_more() {
        document.getElementById("option").style.display = "none";
        document.getElementById("option3").style.display = "none";
        document.getElementById("option2").style.display = "block";
    }
    function delete_social(name,link,id_social) {
        document.getElementById("option").style.display = "none";
        document.getElementById("option3").style.display = "block";
        document.getElementById("option2").style.display = "none";
        document.getElementById("name_social").value = name ;
        document.getElementById("social_link").value = link ;
        document.getElementById("social_id_value").value = id_social ;
    }
    function cancel(){
        document.getElementById("option").style.display = "block";
        document.getElementById("option3").style.display = "none";
        document.getElementById("option2").style.display = "none";
    }
    function free_style(xa,xb,xc,xd,xe,xf,xg,xh,xi,xj,xk,xl,xm,xn,xo,xp,xq,xr,xs) {
        // global 
        document.getElementById("view").style.background = xa;
        document.getElementById("username_visible").style.color= xb;
        document.getElementById("username_visible").style.fontSize= xc;
        document.getElementById("username_visible").style.display= xd;
        // picture
        document.getElementById("img_view").style.border= xe;
        document.getElementById("img_view").style.borderColor= xf;
        document.getElementById("img_view").style.borderRadius= xg;
        document.getElementById("img_view").style.height= xh;document.getElementById("img_view").style.width= xh;
        // social 
        for(let i=1;i<10;i++) {
            document.getElementById("social_number"+i).style.background = xi;
            document.getElementById("social_number"+i).style.borderColor= xj;
            document.getElementById("social_number"+i).style.borderRadius= xk;
            document.getElementById("social_number"+i).style.height= xl;
            document.getElementById("social_number"+i).style.border= xm;
            document.getElementById("social_number"+i).style.width= xn;
        // text
            document.getElementById("social_number"+i).style.color= xo;
            document.getElementById("socialview"+i).style.fontSize= xp;
            document.getElementById("socialview"+i).style.fontFamily = xq;
        }
        inn = xr ;
        text_hover_1 = xo;
        text_hover_2 = xs ;
}

</script>
</head>
<body>
<div id="container">
                                        <div id="navbar">
                                            <img class="logo_lqd" src="../image/logo.png" alt="">
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

    <div id="option">

            <h3>Option of your Page</h3>
            <h5 style="margin-bottom: 10px">Free style for you </h5>
            <div id="free-style"> <!--free_style(background,gloabl_username_color,gloabl_username_size,gloabl_username,picture_border,picture_border_color,picture_radius,picture_size,	social_background,social_border_color,
            social_radius,social_heigth,social_border,social_width,text_color,text_size,text_family,social_hover,text_color_hover)-->
                    <div onclick="free_style('linear-gradient(45deg, rgb(136, 228, 253) 0%, rgb(97, 129, 162) 50%, rgb(98, 50, 133) 100%)','white','20px','block','solid white','white','60px','120px','rgb(99, 161, 148)','white','60px','60px','solid white','70%','white','16px','cursive','white','black')" class="style">
                            <img src="../image/style/style_1.PNG" alt="Style 1">
                    </div>
                    <div onclick="free_style('pink','white','20px','none','dotted red','red','20px','100px','rgb(255, 102, 102)','red','15px 5px','50px','double red','80%','white','16px','cursive','white','black')" class="style">
                            <img src="../image/style/style_2.PNG" alt="Style 1">
                    </div>
                    <div onclick="free_style('linear-gradient(90deg, rgb(131, 58, 180) 0%, rgb(253, 29, 29) 50%, rgb(252, 176, 69) 100%)','white','16px','block','solid white','white','15px','120px','transparent','white','4px','50px','solid white','70%','white','16px','cursive','white','black')" class="style">
                            <img src="../image/style/style_3.PNG" alt="Style 1">
                    </div>
                    <div onclick="free_style('linear-gradient(rgb(230, 100, 101), rgb(145, 152, 229))','white','22px','block','none','initial','15px 5px','120px','rgb(255, 102, 102)','initial','4px','50px','none','90%','white','24px','Arial','white','black')" class="style">
                            <img src="../image/style/style_4.PNG" alt="Style 1">
                    </div>
            </div>

<!--------------------here we add the link of option------------------->
<h2>Global</h2>
<?php include '../home/option/global/background_color.php' ?>
<?php include '../home/option/global/show_name.php' ?>
<?php include '../home/option/global/name_size.php' ?>
<?php include '../home/option/global/name_color.php' ?>
<h2>Picture</h2>
<?php include '../home/option/picture/border_image.php' ?>
<?php include '../home/option/picture/border_image_color.php' ?>
<?php include '../home/option/picture/border_radius.php' ?>
<?php include '../home/option/picture/size_of_picture.php' ?>
<h2>Profiles</h2>
<?php include '../home/option/social/background_color.php' ?>
<?php include '../home/option/social/heigth.php' ?>
<?php include '../home/option/social/width.php' ?>
<?php include '../home/option/social/hover.php' ?>
<?php include '../home/option/social/style_border.php' ?>
<?php include '../home/option/social/border_color.php' ?>
<?php include '../home/option/social/border_radius.php' ?>
<h2>Text</h2>
<?php include '../home/option/text/text_family.php' ?>
<?php include '../home/option/text/size_text.php' ?>
<?php include '../home/option/text/color_text.php' ?>
<?php include '../home/option/text/hover_text.php' ?>





    </div>    
    <div id="option2">
    <div onclick="cancel()" id="cancel"></div>
        <h2>Add a new social :</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
        <h4>Name of the social network :</h4>
                <input type="text" name="name_social"> 
        <h4>Link of your profile :</h4>
                <input type="text" name="link_social">
        <input  type="submit" name="submit_1" value="Add">
            
        </form>
    </div>
    <div id="option3">
        <div onclick="cancel()" id="cancel"></div>
        <h2>Delete or update :</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
        <h4>Name of Social Network :</h4>
                <input type="text" name="new_name_social" id="name_social" value=""> 
        <h4>Link of your social network :</h4>
                <input type="text" name="new_link_social" id="social_link" value="">
                <input type="text" name="id_so" id="social_id_value" style="display: none">
        <input  type="submit" name="submit_2" value="Update">
        <input type="submit" name="submit_3" value="Delete">
            
        </form>
    </div>



                            <div id="view-zone">
                            <div id="version">  
                                <ul>
                                    
                                    <div  onclick="computer_size(1000,600)"><li class="icon-size computer"></li></div>
                                    <div onclick="computer_size(800,700)"><li class="icon-size tablet"></li></div>
                                    <div onclick="computer_size(400,780)"><li class="icon-size phone"></li></div>
                                    <div onclick="computer_size(574.84,700)"><li class="icon-size standar"></li></div>
                                    <li><div onclick="send()" id="save-change">Save</div></li>
                                    <li><a href="social.php?id=<?php echo $id ; ?> " target="_blank" id ="go-link">Go to see your work</a></li>
                                </ul>
                            </div>








                                        <div id="view" style="background: <?php echo($et2['background']) ?>">
                                            <img id="img_view" style="border-radius :<?php echo($et2['picture_radius']) ?>; width: <?php echo($et2['picture_size']) ?> ; height:<?php echo($et2['picture_size']) ?> ; border: <?php echo($et2['picture_border']) ?>" src="<?php echo htmlspecialchars($_SESSION["picture"]); ?>">
                                            <h4 id="username_visible" style="display :<?php echo($et2['global_username']) ?> ; color : <?php echo($et2['global_username_color']) ?> ; font-size : <?php echo($et2['global_username_size']) ?>">@<?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
                                            <?php $i=0;
                                                                         while ( $et3=mysqli_fetch_assoc($res3)) { $i=$i+1?>
                                                                        <script type='text/javascript'>
                                                                     <?php
                                                                                    echo("social_name".$i."= '".$et3['name_social']."' ;\n") ; 
                                                                                    echo("social_link".$i."= '".$et3['link_social'])."' ;" ;

                                                                    ?>
                                                                     
                                                                     </script>
                                            <div onmouseover="this.style.background=inn;this.style.color=text_hover_2;" onmouseout="this.style.background=outt;this.style.color=text_hover_1;" onclick="delete_social(<?php echo('social_name'.$i.', social_link'.$i.', '.$et3['id']) ; ?> ) " class="social" id="<?php echo("social_number".$i)?>" style="background:<?php echo($et2['social_background']) ?> ;color: <?php echo($et2['text_color']) ?>; border: <?php echo($et2['social_border']) ?> ; border-radius : <?php echo($et2['social_radius']) ?> ; height: <?php echo($et2['social_heigth']) ?> ; width: <?php echo($et2['social_width']) ?> ; border-color: <?php echo($et2['social_border_color']) ?>">
                                            
                                            <h3  id="<?php echo("socialview".$i)?>" style=" font-size : <?php echo($et2['text_size']) ?> ; font-family : <?php echo($et2['text_family']) ?> "><?php echo($et3['name_social']) ?></h3>
                                                                         </div> 
                                                                         <?php } ;?>
                                            <div onclick="add_more()" id="add_more"><a><h3>Add a link</h3></a>
                                            </div>
                                        </div>
                                    
                                    
                                    
                            </div>
</div>

<a href="../function/logout.php">Sign Out of Your Account</a>

<script type="text/javascript" >
inn = <?php echo("'".$et2['social_hover']."'") ?>;
outt = <?php echo("'".$et2['social_background']."'") ?>;
text_hover_1 = <?php echo("'".$et2['text_color']."'") ?>;
text_hover_2 = <?php echo("'".$et2['text_color_hover']."'") ?>;
function send() {
            const xhr = new XMLHttpRequest() ;
            var a=b=c=d=e=f=g=h=i=j=k=l=m="" ;
            a = document.getElementById("view").style.background ;
            b = document.getElementById("social_number1").style.background ;
            c = document.getElementById("social_number1").style.border ;
            d = document.getElementById("social_number1").style.borderRadius ;
            e = document.getElementById("img_view").style.borderRadius ;
            f = document.getElementById("social_number1").style.color ;
            g = document.getElementById("img_view").style.border ;
            h = document.getElementById("img_view").style.height ;
            i = document.getElementById("social_number1").style.borderColor ;
            j = document.getElementById("social_number1").style.height ;
            k = document.getElementById("social_number1").style.width ;
            l = document.getElementById("socialview1").style.fontSize ;
            m = document.getElementById("socialview1").style.fontFamily ;
            n = inn ;
            o = text_hover_2 ;
            p = document.getElementById("username_visible").style.display ;
            q = document.getElementById("username_visible").style.color ;
            r = document.getElementById("username_visible").style.fontSize ;
            s = document.getElementById("img_view").style.borderColor ;
           open("../function/success.php"+"?a="+a+"&b="+b+"&c="+c+"&d="+d+"&e="+e+"&f="+f+"&g="+g+"&h="+h+"&i="+i+"&j="+j+"&k="+k+"&l="+l+"&m="+m+"&n="+n+"&o="+o+"&p="+p+"&q="+q+"&r="+r+"&s="+s);
}




</script>
<?php 












?>
</body>
</html>