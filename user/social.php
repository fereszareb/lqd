<?php 
session_start();
include '../function/config.php' ;
$id=$_GET['id'];
$req5="SELECT * From user WHERE (id=$id )" ;
$res5=mysqli_query($link,$req5);
$et5=mysqli_fetch_assoc($res5) ;
if(empty($et5['id'])){
    header("location: ../index.html");
    exit;
  }

$req3="SELECT * From social WHERE (id_user=$id )" ;
$res3=mysqli_query($link,$req3);

// select of design of social from database
$req2="SELECT * From design WHERE (id_user=$id )" ;
$res2=mysqli_query($link,$req2);
$et2=mysqli_fetch_assoc($res2) ;
// select of 

if (empty($id)== FALSE) {
    $sql="UPDATE  design SET view = view+1  WHERE id_user=$id" ;
    $res2=mysqli_query($link,$sql);
}

?>

<script>
inn = <?php echo("'".$et2['social_hover']."'") ?>;
outt = <?php echo("'".$et2['social_background']."'") ?>;
text_hover_1 = <?php echo("'".$et2['text_color']."'") ?>;
text_hover_2 = <?php echo("'".$et2['text_color_hover']."'") ?>;

</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/social.css">
    <link rel="icon" href="../image/icon.png" type="image/png" sizes="16x16">
    <title><?php echo $et5['username'] ?> - Social Media</title>
</head>
<body>
<div id="view" style="background: <?php echo($et2['background']) ?>">
                                            <img id="img_view" style="border-radius :<?php echo($et2['picture_radius']) ?>; width: <?php echo($et2['picture_size']) ?> ; height:<?php echo($et2['picture_size']) ?> ; border: <?php echo($et2['picture_border']) ?>" src="<?php echo ($et5["picture"]); ?>">
                                            <h4 id="username_visible" style="display :<?php echo($et2['global_username']) ?> ; color : <?php echo($et2['global_username_color']) ?> ; font-size : <?php echo($et2['global_username_size']) ?>">@<?php echo ($et5["username"]); ?></h4>
                                            <?php $i=0;
                                                                         while ( $et3=mysqli_fetch_assoc($res3)) { $i=$i+1?>
                                                                         
                                            <div  class="social" id="<?php echo("social_number".$i)?>" <?php echo("social_number".$i)?>" style="background:<?php echo($et2['social_background']) ?> ;color: <?php echo($et2['text_color']) ?>; border: <?php echo($et2['social_border']) ?> ; border-radius : <?php echo($et2['social_radius']) ?> ; height: <?php echo($et2['social_heigth']) ?> ; width: <?php echo($et2['social_width']) ?> ; border-color: <?php echo($et2['social_border_color']) ?>">
                                            <a onmouseover="this.style.background=inn;this.style.color=text_hover_2;" onmouseout="this.style.background=outt;this.style.color=text_hover_1;" href="<?php echo($id.'/'.$et3['id']) ?>" style="border-radius : <?php echo($et2['social_radius']) ?> ;color: <?php echo($et2['text_color']) ?>">
                                            <h3 id="<?php echo("socialview".$i)?>" style=" font-size : <?php echo($et2['text_size']) ?> ; font-family : <?php echo($et2['text_family']) ?> "><?php echo($et3['name_social']) ?></h3></a>
                                                                         </div> <?php } ;?>
                                            </div>
                                        </div>
</body>
</html>