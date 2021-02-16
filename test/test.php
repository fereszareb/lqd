<?php


$sql9="SELECT COUNT(id) as number FROM social WHERE id_user=$id" ;
$res9=mysqli_query($link,$sql9);
$result9=mysqli_fetch_assoc($res9);
$nb_socia9=$result9['number']   ;
$date= date("Y-m-d", time() -4* 60 * 60 * 24);


$sql2="SELECT * ,COUNT(view.id) as vu FROM `view`,social WHERE (view.id_user=$id and social.id_user=view.id_user and social.id=view.id_social) GROUP BY view.id_social" ;
$res2=mysqli_query($link,$sql2);
echo "['Day'" ; $k=0 ;
while ( $result2=mysqli_fetch_assoc($res2)) { 
  $k++ ;
echo (",'".$result2['name_social']."'") ;
}
echo ("], \n");
for($i=0; $i<5; $i++) {
echo ("['".$date."'") ;

                    $sql3="SELECT * ,COUNT(view.id) as vu FROM `view`,social WHERE (view.id_user=$id and social.id_user=view.id_user and social.id=view.id_social and view.date_jour='$date') GROUP BY view.id_social" ;
                    $res3=mysqli_query($link,$sql3);
                    $z=0;
                                        while ( $result3=mysqli_fetch_assoc($res3) ) { 
                                          $z++ ;
                                          echo (",".$result3['vu']) ;
                                          }
                                          $l = $k-$z ;
                                          for($f=0; $f<$l;$f++){
                                              echo ",0";
                                          }
                      $date= date("Y-m-d", time() -(3-$i)* 60 * 60 * 24);




echo ("], \n");
}


?>