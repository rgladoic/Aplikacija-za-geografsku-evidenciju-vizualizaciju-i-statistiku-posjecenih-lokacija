<?php
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
    header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    exit;
    }

    $putanja = dirname($_SERVER['REQUEST_URI']);
    $direktorij = getcwd();

    if (!strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
    header("Location: index.php");
    exit();
    }

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="hr">
    <head>
        <style>

            nav {
                width: 100%;
                float: left;
                text-align: center;
            }
            nav > ul{
                list-style: none;
                width: 100%;
                margin: 0;
                padding: 0;
            }

            nav > ul li {
                display: inline;
                list-style-type: none;
                position: relative;
                line-height: 3;
            }

            nav > ul li a {
                background-color: #34322B;
                border-style: solid;
                color: white;
                border-width: 3px;
                border-color: #5A5549;
                text-transform: uppercase;
                padding: 10px 40px;
                font-size: 22px;
            }

            nav > ul li a:hover {
                color: black;
                background: #b7b29d;
            }

            table, th, td {
                font-family: "Arial";
                font-style: italic;
                font-size: 26px;
                text-align: center;
                background-color: #b7b29d;
                color: black;
                border: 3px solid #5A5549;
                border-collapse: collapse;
            }

            .header {
                left: 0;
                top: 0;
                width: 100%;
                height:400px;
                background-image: url('https://wallpapercave.com/wp/wp1823646.jpg');"
              }

            .footer_style{
                background-color: black;
                color: white;
                border-width: 3px;
                border-color: #34322B;
                font-size: 32px;
                margin-bottom: 10px;
            }

            .dataTables_length,
            .dataTables_filter,
            .dataTables_info {
            background-color: #b7b29d;
            }
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
        <title>Aplikacija</title>
    </head>

   
    <body style="background-color:powderblue;">
    <div class="header">
        <img style="float: right" src="images/RSS.png" alt="RSS icon" width="50" />
        <img style="float: right" src="images/Instagram.png" alt="Instagram icon" width="50" />
        <img style="float: right" src="images/Facebook.png" alt="Facebook icon" width="50"  />
     <?php
    
    echo "<nav id=\"nav\" style=\"padding: 50px 0;\"><ul>
          <li><a href=\"$putanja/index.php\">Statistika</a></li>
          <li><a href=\"$putanja/vizualizacija.html\">Vizualizacija</a></li>
          <li><a href=\"$putanja/evidencija.php\">Evidencija</a></li> 
          </ul></nav>";
    ?>
    </div>
    
    <h1 style="font-size: 40px"> Statistika parkova</h1><br>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['Bar']});

      google.charts.setOnLoadCallback(drawChart);

 

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

           ['Parkovi','Broj posjetitelja'],

         <?php 
        
        $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

        $upit = "SELECT * FROM parkovi ";

        $rezultat = pg_query($veza, $upit);

        if(!$rezultat) {
          echo pg_last_error($veza);
          exit;
       }
    

        while ($red = pg_fetch_row($rezultat)){            

           echo "['".$red[2]."',".$red[3]."],";

          }
        pg_close($veza); 
         ?>

        ]);

        var options = {

          chart: {

            title: '',          

          },

          bars: 'vertical',

          vAxis: {format: 'decimal'},

          height: 400,

          colors: ['#d95f02']

        };

        var chart = new google.charts.Bar(document.getElementById('bar-graph-location'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

      }

    </script> 
    
    <div id="bar-graph-location" style="width: 100%;">

    </div><br><br>
    
    <?php

    echo '<div>
            <div>
            <table id="tablica_parkovi" border="1" style="margin-left: auto; margin-right: auto; width: 50%; ">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Naziv parka</th>
                      <th>Broj posjetitelja</th>
                    </tr></thead><tbody>';
                    
    $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

    $upit = "SELECT * FROM parkovi ";

    $rezultat = pg_query($veza, $upit);

    if(!$rezultat) {
      echo pg_last_error($veza);
      exit;
   }


    while ($red = pg_fetch_row($rezultat)){

        echo "<tr>
                 <td>".$red[0]."</td>
                 <td>".$red[2]."</td>
                 <td>".$red[3]."</td>
               </tr>";

    } 
    
    echo "</tbody></table>";
    echo "</div></div>";

    pg_close($veza);    
    ?>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['Bar']});

      google.charts.setOnLoadCallback(drawChart);

 

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

           ['Gradovi','Broj posjetitelja'],

         <?php 
        
        $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

        $upit = "SELECT * FROM gradovi ";

        $rezultat = pg_query($veza, $upit);

        if(!$rezultat) {
          echo pg_last_error($veza);
          exit;
       }
    

        while ($red = pg_fetch_row($rezultat)){            

           echo "['".$red[2]."',".$red[3]."],";

          }
        pg_close($veza); 
         ?>

        ]);

        var options = {

          chart: {

            title: '',          

          },

          bars: 'vertical',

          vAxis: {format: 'decimal'},

          height: 400,

          colors: ['#d95f02']

        };

        var chart = new google.charts.Bar(document.getElementById('bar-graph1-location'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

      }

    </script> 
    <br>
    <h1 style="font-size: 40px">Statistika gradova</h1>
    <div id="bar-graph1-location" style="width: 100%;">

    </div>
    <br><br>  
    
    <?php

    echo '<div>
            <div>
            <table id="tablica_gradovi" border="1" style="margin-left: auto; margin-right: auto; width: 50%;">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Naziv grada</th>
                      <th>Broj posjetitelja</th>
                    </tr></thead><tbody>';
                    
    $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

    $upit = "SELECT * FROM gradovi ";

    $rezultat = pg_query($veza, $upit);

    if(!$rezultat) {
      echo pg_last_error($veza);
      exit;
   }


    while ($red = pg_fetch_row($rezultat)){

        echo "<tr>
                 <td>".$red[0]."</td>
                 <td>".$red[2]."</td>
                 <td>".$red[3]."</td>
               </tr>";

    } 

    echo "</tbody></table>";
    echo "</div></div>";

    pg_close($veza);    
    ?>

    
    
    <script>
        jQuery(document).ready(function($) {
            $('#tablica_parkovi').DataTable();
            $('#tablica_gradovi').DataTable();
        } );
    </script>  
    
    </body>

    <footer class="footer_style" style="text-align: center; margin-top: 90px;">             
            <img width="50" src="images/HTML5.png" alt="HTML5">
            <img width="50" src="images/CSS3.png" alt="CSS3"> 
            <p>&copy; 2023 </p>   
    </footer>
</html>
