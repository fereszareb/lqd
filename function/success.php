<?php
// Initialize the session
session_start();
include 'config.php' ;
   $id= $_SESSION["id"];
   $a=$_GET['a'];
   $b=$_GET['b'];
   $c=$_GET['c'];
   $d=$_GET['d'];
   $e=$_GET['e'];
   $f=$_GET['f'];
   $g=$_GET['g'];
   $h=$_GET['h'];
   $i=$_GET['i'];
   $j=$_GET['j'];
   $k=$_GET['k'];
   $l=$_GET['l'];
   $m=$_GET['m'];
   $n=$_GET['n'];
   $o=$_GET['o'];
   $p=$_GET['p'];
   $q=$_GET['q'];
   $r=$_GET['r'];
   $s=$_GET['s'];

if($a != "") {
   $sql= "UPDATE design SET background='".$a."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($b != "") {
   $sql= "UPDATE design SET social_background='".$b."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($c != "") {
   $sql= "UPDATE design SET social_border='".$c."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($d != "") {
   $sql= "UPDATE design SET social_radius='".$d."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($e != "") {
   $sql= "UPDATE design SET picture_radius='".$e."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($f != "") {
   $sql= "UPDATE design SET text_color='".$f."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($g != "") {
   $sql= "UPDATE design SET picture_border='".$g."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($h != "") {
   $sql= "UPDATE design SET picture_size='".$h."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($i != "") {
   $sql= "UPDATE design SET social_border_color='".$i."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($j != "") {
   $sql= "UPDATE design SET social_heigth='".$j."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($k != "") {
   $sql= "UPDATE design SET social_width='".$k."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($l != "") {
   $sql= "UPDATE design SET text_size='".$l."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($m != "") {
   $sql= "UPDATE design SET text_family='".$m."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($n != "") {
   $sql= "UPDATE design SET social_hover='".$n."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($o != "") {
   $sql= "UPDATE design SET text_color_hover='".$o."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($p != "") {
   $sql= "UPDATE design SET global_username='".$p."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($q != "") {
   $sql= "UPDATE design SET global_username_color='".$q."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($r != "") {
   $sql= "UPDATE design SET global_username_size='".$r."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
if($s != "") {
   $sql= "UPDATE design SET picture_border_color='".$s."' WHERE (id_user = $id)";
   $res=mysqli_query($link,$sql);
}
echo "<script>window.close();</script>" ;
?>