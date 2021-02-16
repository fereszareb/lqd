<?php
include '../function/config.php' ;
$id=$_GET['id'];
$id_social=$_GET['social'] ;
$req="SELECT * From social WHERE (id_user=$id AND id=$id_social)" ;
$res=mysqli_query($link,$req);
$et=mysqli_fetch_assoc($res) ;







$date_jour =date("Y-m-d") ;
$date_time =date("h:i a");
$ip= $_SERVER["REMOTE_ADDR"];
            $query=@unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success') {
            $country = $query['country'] ;} 
            else $country="default"  ;



$req="INSERT INTO view (id_user , id_social , date_jour , date_time , IP ,  country ) VALUES ($id ,$id_social,'".$date_jour."','".$date_time."','".$ip."','".$country."')" ;
$res=mysqli_query($link,$req);
header('location:'.$et['link_social']);

?>
