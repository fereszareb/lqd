<?php
include '../function/config.php';
$sql ='SELECT * from design where id_user= 14';
$res=mysqli_query($link,$sql);
$et=mysqli_fetch_assoc($res) ;

/*free_style(background,gloabl_username_color,gloabl_username_size,gloabl_username,picture_border,picture_border_color,picture_radius,picture_size,	social_background,social_border_color,
            social_radius,social_heigth,social_border,social_width,text_color,text_size,text_family,social_hover,text_color_hover)-*/
echo  ( "free_style('".$et['background']."','".$et['global_username_color']."','".$et['global_username_size']."','".$et['global_username']."','".$et['picture_border']."','".$et['picture_border_color']."','".$et['picture_radius']."','".$et['picture_size']."','".$et['social_background']."','".$et['social_border_color']."','".$et['social_radius']."','".$et['social_heigth']."','".$et['social_border']."','".$et['social_width']."','".$et['text_color']."','".$et['text_size']."','".$et['text_family']."','".$et['social_hover']."','".$et['text_color_hover']."')"  );




?>