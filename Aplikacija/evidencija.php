<?php
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
    header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    exit;
    }

    $putanja = dirname($_SERVER['REQUEST_URI']);
    $direktorij = getcwd();

    if (isset($_POST['azuriraj_park'])) {
        $greska = "";
        $poruka = "";
        
        foreach ($_POST as $k => $v) {
            if (empty($v)) {
                $greska .= "Nije popunjeno: " . $k . "<br>";
            } 
        }

        $id = $_POST['id_parka_azuriranje'];
        $naziv_parka = $_POST['naziv_parka_azuriranje'];
        $broj_posjetitelja = $_POST['broj_posjetitelja_parka_azuriranje'];


        if(empty($greska)){

            $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

            $upit = "UPDATE parkovi SET park = '{$naziv_parka}' , posjeta = '{$broj_posjetitelja}' WHERE gid = {$id} ;";

            $rezultat = pg_query($veza, $upit);
            
            if($rezultat){
                $poruka = 'Park je uspješno ažuriran!';
                header('Location: '.$_SERVER['PHP_SELF']);
                exit();
            }else{
                $poruka = 'Neuspješno ažuriranje,pokušajte ponovo!';
            }
            
            pg_close($veza);

        }
    }

    if (isset($_POST['obrisi_park'])) {
        $greska = "";
        $poruka = "";
        
        foreach ($_POST as $k => $v) {
            if (empty($v)) {
                $greska .= "Nije popunjeno: " . $k . "<br>";
            } 
        }

        $id = $_POST['id_parka_brisanje'];


        if(empty($greska)){

            $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

            $upit = "DELETE FROM parkovi WHERE gid = {$id} ;";

            $rezultat = pg_query($veza, $upit);
            
            if($rezultat){
                $poruka = 'Park je uspješno obrisan!';
                header('Location: '.$_SERVER['PHP_SELF']);
                exit();
            }else{
                $poruka = 'Neuspješno brisanje,pokušajte ponovo!';
            }
            
            pg_close($veza);

        }
    }

    if (isset($_POST['azuriraj_grad'])) {
        $greska_grad = "";
        $poruka_grad = "";
        
        foreach ($_POST as $k => $v) {
            if (empty($v)) {
                $greska_grad .= "Nije popunjeno: " . $k . "<br>";
            } 
        }

        $id = $_POST['id_grada_azuriranje'];
        $naziv_grada = $_POST['naziv_grada_azuriranje'];
        $broj_posjetitelja = $_POST['broj_posjetitelja_grada_azuriranje'];

        if(empty($greska_grad)){

            $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

            $upit = "UPDATE gradovi SET grad = '{$naziv_grada}' , posjeta = '{$broj_posjetitelja}' WHERE gid = {$id} ;";

            $rezultat = pg_query($veza, $upit);
            
            if($rezultat){
                $poruka_grad = 'Grad je uspješno ažuriran!';
                header('Location: '.$_SERVER['PHP_SELF']);
                exit();
            }else{
                $poruka_grad = 'Neuspješno ažuriranje,pokušajte ponovo!';
            }
            
            pg_close($veza);

        }
    }

    if (isset($_POST['obrisi_grad'])) {
        $greska_grad = "";
        $poruka_grad = "";
        
        foreach ($_POST as $k => $v) {
            if (empty($v)) {
                $greska_grad .= "Nije popunjeno: " . $k . "<br>";
            } 
        }

        $id = $_POST['id_grada_brisanje'];

        if(empty($greska)){

            $veza = pg_connect("host=localhost port=5432 dbname=geo user=rgladoic password=rgladoic");

            $upit = "DELETE FROM gradovi WHERE gid = {$id} ;";

            $rezultat = pg_query($veza, $upit);
            
            if($rezultat){
                $poruka_grad = 'Grad je uspješno obrisan!';
                header('Location: '.$_SERVER['PHP_SELF']);
                exit();
            }else{
                $poruka_grad = 'Neuspješno brisanje,pokušajte ponovo!';
            }
            
            pg_close($veza);

        }
    }



?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="hr">
    <head>
        <title>Evidencija</title>
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

            form {
                width: 45%;
                margin: 50px auto;
                text-align: left;
                padding: 20px; 
                border: 1px solid #bbbbbb; 
                border-radius: 5px;
                
            }

            .input-group {
                margin: 10px 0px 10px 0px;
            }
            .input-group label {
                display: block;
                text-align: left;
                margin: 3px;
            }
            .input-group input {
                height: 30px;
                width: 93%;
                padding: 5px 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid gray;
            }
            .btn {
                padding: 10px;
                font-size: 20px;
                color: white;
                background: black;;
                border: none;
                border-radius: 5px;
            }
            
            .akcija_btn {
                text-decoration: none;
                padding: 2px 5px;
                color: white;
                border-radius: 3px;
                background: #800000;
                font-size: 22px;
            }

        </style>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    </head>
    <body style="background-color:powderblue;" onload="izborFormePark(); izborFormeGrad();">
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

    <h1 style="font-size: 40px"> Evidencija parkova</h1><br>

    <div id="greska_park" style="font-size: 18px; position: absolute; top: 600px; left: 1500px; color: red;">
                <?php
                if (isset($greska)) {
                    echo "<p>$greska</p>";
                }
                ?>
    </div>
    <div id="poruka_park" style="font-size: 18px; position: absolute; top: 600px; left: 1500px; color: red;">
                <?php
                if (isset($poruka)) {
                    echo "<p>$poruka</p>";
                }
                ?>
    </div>

    <div id="greska_grad" style="font-size: 18px; position: absolute; top: 1400px; left: 1500px; color: red;">
                <?php
                if (isset($greska_grad)) {
                    echo "<p>$greska_grad</p>";
                }
                ?>
    </div>
    <div id="poruka_grad" style="font-size: 18px; position: absolute; top: 1400px; left: 1500px; color: red;">
                <?php
                if (isset($poruka_grad)) {
                    echo "<p>$poruka_grad</p>";
                }
                ?>
    </div>
        
    <?php

    echo '<div>
            <div>
            <table id="tablica_parkovi" border="1" style="margin-left: auto; margin-right: auto; width: 55%;">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Naziv parka</th>
                      <th>Broj posjetitelja</th>
                      <th>Akcija</th>
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
                 <td>
                    <button class=\"akcija_btn button_azuriraj\" style=\"background: blue;\" value=\"$red[0].$red[2].$red[3]\">Ažuriraj</button> 
                    <button class=\"akcija_btn button_obrisi\" value=\"$red[0].$red[2].$red[3]\">Obriši</button>
			    </td>
               </tr>";

    } 
    
    echo "</tbody></table>";
    echo "</div></div>";

    pg_close($veza);    
    ?>
    
    <div style="position: absolute; top: 600px; background-color: #b7b29d; width: 20%;">
        <form id="azuriraj_park" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Ažuriranje</h1>
		    <div class="input-group">
			    <label>Naziv parka</label>
			    <input id="naziv_parka_azuriranje" type="text" name="naziv_parka_azuriranje" value="">
		    </div>
		    <div class="input-group">
			    <label>Broj_posjetitelja</label>
			    <input id="broj_posjetitelja_parka_azuriranje" type="text" name="broj_posjetitelja_parka_azuriranje" value="">
                <input id="id_parka_azuriranje" type="hidden" name="id_parka_azuriranje" value="">
		    </div>
		    <div class="input-group">
			    <input class="btn" type="submit" name="azuriraj_park" value="Ažuriraj" />
		    </div>
	    </form>
    </div>

    <div style="position: absolute; top: 600px; background-color: #b7b29d; width: 20%;">
        <form id="obrisi_park" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Brisanje</h1>
		    <div class="input-group">
			    <label>Naziv parka</label>
			    <input id="naziv_parka_brisanje" type="text" name="naziv_parka" value="">
		    </div>
		    <div class="input-group">
			    <label>Broj_posjetitelja</label>
			    <input id="broj_posjetitelja_parka_brisanje" type="text" name="broj_posjetitelja_parka_brisanje" value="">
                <input id="id_parka_brisanje" type="hidden" name="id_parka_brisanje" value="">
		    </div>
		    <div class="input-group">
			    <input class="btn" type="submit" name="obrisi_park" value="Obriši" />
		    </div>
	    </form>
    </div>
    
    <h1 style="font-size: 40px"> Evidencija gradova</h1><br>

    <?php

    echo '<div>
            <div>
            <table id="tablica_gradovi" border="1" style="margin-left: auto; margin-right: auto; width: 50%;">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Naziv grada</th>
                      <th>Broj posjetitelja</th>
                      <th>Akcija</th>
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
                 <td>
                    <button class=\"akcija_btn button_azuriraj_grad\" style=\"background: blue;\" value=\"$red[0].$red[2].$red[3]\">Ažuriraj</button> 
                    <button class=\"akcija_btn button_obrisi_grad\" value=\"$red[0].$red[2].$red[3]\">Obriši</button>
			    </td>
               </tr>";

    } 

    echo "</tbody></table>";
    echo "</div></div>";

    pg_close($veza);    
    ?>
    
    <div style="position: absolute; top: 1400px; background-color: #b7b29d; width: 20%;">
        <form id="azuriraj_grad" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Ažuriranje</h1>
		    <div class="input-group">
			    <label>Naziv grada</label>
			    <input id="naziv_grada_azuriranje" type="text" name="naziv_grada_azuriranje" value="">
		    </div>
		    <div class="input-group">
			    <label>Broj_posjetitelja</label>
			    <input id="broj_posjetitelja_grada_azuriranje" type="text" name="broj_posjetitelja_grada_azuriranje" value="">
                <input id="id_grada_azuriranje" type="hidden" name="id_grada_azuriranje" value="">
		    </div>
		    <div class="input-group">
			    <input class="btn" type="submit" name="azuriraj_grad" value="Ažuriraj" />
		    </div>
	    </form>
    </div>

    <div style="position: absolute; top: 1400px; background-color: #b7b29d; width: 20%;">
        <form id="obrisi_grad" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Brisanje</h1>
		    <div class="input-group">
			    <label>Naziv grada</label>
			    <input id="naziv_grada_brisanje" type="text" name="naziv_grada_brisanje" value="">
		    </div>
		    <div class="input-group">
			    <label>Broj_posjetitelja</label>
			    <input id="broj_posjetitelja_grada_brisanje" type="text" name="broj_posjetitelja_grada_brisanje" value="">
                 <input id="id_grada_brisanje" type="hidden" name="id_grada_brisanje" value="">
		    </div>
		    <div class="input-group">
			    <input class="btn" type="submit" name="obrisi_grad" value="Obriši" />
		    </div>
	    </form>
    </div>
    
    <script>
        jQuery(document).ready(function($) {
            $('#tablica_parkovi').DataTable();
            $('#tablica_gradovi').DataTable();
        } );
    </script>

    <script>
    
        function izborFormePark(){
    
            azuriraj_park = document.getElementById("azuriraj_park");
            obrisi_park = document.getElementById("obrisi_park");
                        
            azuriraj_park.style.display = "none";
            obrisi_park.style.display = "none";
            
            const btn = document.querySelectorAll('.btn');
            
                   
            ;(function($) {
                $(function() {
                   
                    $('.button_azuriraj').bind('click', function(e) {
                        e.preventDefault();
                        azuriraj_park.style.display = "block";
                        obrisi_park.style.display = "none";
                        
                        string = $(this).val();
                        
                        vrijednost = string.split('.');

                        $('#naziv_parka_azuriranje').val(vrijednost[1]);
                        
                        $('#broj_posjetitelja_parka_azuriranje').val(vrijednost[2]);
                        
                        $('#id_parka_azuriranje').val(vrijednost[0]);


                    });
                    $('.button_obrisi').bind('click', function(e) {
                        e.preventDefault();

                        azuriraj_park.style.display = "none";
                        obrisi_park.style.display = "block";

                        string = $(this).val();
                        
                        vrijednost = string.split('.');

                        $('#naziv_parka_brisanje').val(vrijednost[1]);
                        
                        $('#broj_posjetitelja_parka_brisanje').val(vrijednost[2]);
                
                        $('#id_parka_brisanje').val(vrijednost[0]);                        
                        
                    });
                });
            })(jQuery);
            
        }

        function izborFormeGrad(){
    
            azuriraj_grad = document.getElementById("azuriraj_grad");
            obrisi_grad = document.getElementById("obrisi_grad");
                        
            azuriraj_grad.style.display = "none";
            obrisi_grad.style.display = "none";
            
            const btn = document.querySelectorAll('.btn');
            
                   
            ;(function($) {
                $(function() {

                    $('.button_azuriraj_grad').bind('click', function(e) {
                        e.preventDefault();

                        azuriraj_grad.style.display = "block";
                        obrisi_grad.style.display = "none";
                        
                        string = $(this).val();
                        
                        vrijednost = string.split('.');

                        $('#naziv_grada_azuriranje').val(vrijednost[1]);
                        
                        $('#broj_posjetitelja_grada_azuriranje').val(vrijednost[2]);

                        $('#id_grada_azuriranje').val(vrijednost[0]);

                    });
                    $('.button_obrisi_grad').bind('click', function(e) {
                        e.preventDefault();

                        azuriraj_grad.style.display = "none";
                        obrisi_grad.style.display = "block";

                        string = $(this).val();
                        
                        vrijednost = string.split('.');

                        $('#naziv_grada_brisanje').val(vrijednost[1]);
                        
                        $('#broj_posjetitelja_grada_brisanje').val(vrijednost[2]);

                        $('#id_grada_brisanje').val(vrijednost[0]);                        
                        
                    });
                });
            })(jQuery);
            
        }
    
    </script>
    
    </body>
    <footer class="footer_style" style="text-align: center; margin-top: 90px;">             
            <img width="50" src="images/HTML5.png" alt="HTML5">
            <img width="50" src="images/CSS3.png" alt="CSS3"> 
            <p>&copy; 2023 </p>   
    </footer>
</html>
