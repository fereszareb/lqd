<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
} 
$id=$_SESSION["id"];
include '../function/config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/user.css">
    <link rel="icon" href="../image/icon.png" type="image/png" sizes="16x16">
    <title><?php echo($_SESSION['username']) ?> - Dashboard</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'number of view'],
            <?php 
            $sql79="SELECT country, COUNT(id) as number FROM `view` WHERE (id_user= $id and not country='default' ) GROUP BY country ORDER BY number DESC" ;
            $res79=mysqli_query($link,$sql79);
            while ( $result79=mysqli_fetch_assoc($res79)) { 
                echo"['".$result79['country']."',".$result79['number']."]," ;
            } 
                ?>
       ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['tasks', 'hour'],
            <?php 
            $sql="SELECT COUNT(view.id_social) as number_view ,view.id_social , social.name_social , social.id FROM social , view WHERE (view.id_social=social.id and social.id_user = $id ) GROUP by social.name_social" ;
            $res=mysqli_query($link,$sql);
            while ( $result=mysqli_fetch_assoc($res)) { 
                echo"['".$result['name_social']."',".$result['number_view']."]," ;
            } 
                ?>
       ]);

        var options = {
          title: 'Number of social network view',
          pieHole: 0.4,
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          <?php include '../test/test.php' ?>
        ]);

        var options = {
          title : 'Daily view of your social network',
          vAxis: {title: 'Views'},
          hAxis: {title: 'Day'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Country');
        data.addColumn('number', 'visitor');
        data.addRows([
          <?php 
            $sql1="SELECT country, COUNT(id) as number FROM `view` WHERE (id_user=$id and not country='default' ) GROUP BY country ORDER BY number DESC" ;
            $res1=mysqli_query($link,$sql1);
            while ( $result1=mysqli_fetch_assoc($res1)) { 
                echo"['".$result1['country']."',".$result1['number']."]," ;
            } 
                ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php include '../test/test.php' ?>
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart2_div'));
        chart.draw(data, options);
      }
    </script>


<?php

$req2="SELECT COUNT(*) as social_view , COUNT(DISTINCT(IP)) as unique_view FROM `view` WHERE id_user= $id" ;
$res2=mysqli_query($link,$req2);
$et2=mysqli_fetch_assoc($res2) ;
$social_view= $et2['social_view'];
$unique_view= $et2['unique_view'] ;
$date= date("Y-m-d");
$req5="SELECT COUNT(*) as today_view FROM `view` WHERE id_user= $id and date_jour='$date'" ;
$res5=mysqli_query($link,$req5);
$et5=mysqli_fetch_assoc($res5) ;
$today_view= $et5['today_view'];
$req5="SELECT view FROM `design` WHERE id_user= $id" ;
$res5=mysqli_query($link,$req5);
$et5=mysqli_fetch_assoc($res5) ;
$pofil_vue = $et5['view'] + $social_view ;
?>

</head>
<body>
<div id="navbar" style="position:absolute; background-color: #383a3c ; box-shadow: 0px 1px 3px #888888; border-bottom: 0.5px solid black;">
                                        <ul>
                                        <li>  <a>
                                                    <div id="user-navbar-home">
                                                        <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                                                        <img src="<?php echo htmlspecialchars($_SESSION["picture"]); ?>">
                                                    </div></a>
                                        </li>             
                                        </ul>
</div>
<div id="user">
     <div id="controle">
       <div id="controle-profile">

       
                <div id="logo">
                      <img src="../image/logo.png" >
                </div>
                <img src="<?php echo htmlspecialchars($_SESSION["picture"]); ?>">
                <h3><?php echo htmlspecialchars($_SESSION["nom"]); ?> <?php echo htmlspecialchars($_SESSION["prenom"]); ?></h3>
      </div> 
        <div id="controle-menu">  <ul>
                    <a href="dashboard.php"><li class="active"> Dashboard <p>></p></li></a>

                    
                    <a href="profile.php"><li> Profil</li></a>
                    
                    <a href="home.php"><li> Edit your page</li></a>
                    <a href="reset-password.php"><li> Resset password</li></a>
                    <a href="../function/logout.php"><li> Logout</li></a>
                    
                </ul>
           </div>     
     </div>
     <div id="dashboard">
       <div>
       <div id="stat">
          <div class="stat_logo" style="background-color:#F44336 "><img src="../image/eye.png" >
</div>
          <div class="barre_stat"></div>
          <div class="zone_stat">
           <h2><?php echo $pofil_vue ?></h2>
            <p>Total visitors</p>
            <h6><?php echo (date("Y/m/d  h:i"));?></h6>
          </div>
      </div>
       <div id="stat" >
       <div class="stat_logo" style="background-color:#ff9800"><img src="../image/user.png" ></div>
          <div class="barre_stat"></div>
          <div class="zone_stat">
           <h2><?php echo $social_view ?></h2>
            <p>Socials visitors</p>
            <h6><?php echo (date("Y/m/d  h:i"));?></h6>
          </div>
       </div>
       <div id="stat">
       <div class="stat_logo" style="background-color:#2196F3 "><img src="../image/group.png" ></div>
          <div class="barre_stat"></div>
          <div class="zone_stat">
           <h2><?php echo $unique_view ?></h2>
            <p>Visitors Unique</p>
            <h6><?php echo (date("Y/m/d  h:i"));?></h6>
          </div>
       </div>
       <div id="stat">
       <div class="stat_logo" style="background-color:#30cc7b "><img src="../image/user.png" ></div>
          <div class="barre_stat"></div>
          <div class="zone_stat">
           <h2><?php echo $today_view ?></h2>
            <p>Today's visitors</p>
            <h6><?php echo (date("Y/m/d  h:i"));?></h6>
          </div>
       </div>
      </div>
        <div class="chart regions_div">
                <div id="regions_div" style="width: 65%; height: 250px ;"></div>
                <div id="country-regions">
                  <ul>
                    <?php $res77=mysqli_query($link,$sql79);
                      while ( $result77=mysqli_fetch_assoc($res77)) {?>
                    <li><p><?php echo($result77['country']) ;?></p></li>
                     <?php }; ?>
                  </ul>

                </div>
        </div>
      <div class="chart table-div">
        <div id="table_div" style="width:100%"></div>
      </div>
      <div class="chart bagette-div">
         <div id="chart_div" style="width: 100%; height: 300px;"></div>
         </div>
        <div class="chart donutchart">
                <div id="donutchart" style="width: 100%; height: 100%;"></div>
         </div>
         <div  class="chart bagette-div">
                <div id="chart2_div" style="width: 100%; height: 400px;"></div>
         </div>
  </div>
</div>

<?php mysqli_close($link); ?>




</body>
</html>