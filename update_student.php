<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Unos </title>
        
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Studentski projekti</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="sort_student.php">Studenti</a></li>
            <li><a href="unos_student.php">Unos studenata</a></li>
			<li><a href="table_mentor.php">Mentori</a><li>
			<li><a href="unos_mentor.php">Unos mentora</a><li>
			<li><a href="unos_tema.php">Unos teme</a></li>
			<li><a href="unos_raspored.php">Unos rasporeda</a></li>
            <li><a href="find_student.php">Pretraga studenata</a></li>
          </ul>
          <form class="navbar-form navbar-left" action="find_student.php" method="GET">
              <div class="form-group">
               <input type="text" name="searching" class="form-control" placeholder="Search">
              </div> 
             <input type="submit" value="Search" class="btn btn-default">
             <!--<a class="btn btn-default" type="submit" href="find_student.php">Search</a>
             -->
            </form>
            </div>
      </nav>

        <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
      

       <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>

       

    </head>
    <body>

    <?php

        $errorMsg = 0;
        
        $dbuser = "DB_USER";
		$dbpass = "DB_PASS";
		$dbname = "DB_NAME";

        $conn = mysqli_connect("localhost", $dbuser, $dbpass)
        or die("Pogreska spajanja: " . mysqli_error($conn)); 

        mysqli_select_db($conn, $dbname);

    ?>

    <div class="container pull-left">
       <div class="row">
          <div class="col-lg-6">

        <form class="well" action ="update_student.php" method="GET">
                
        <?php
          if (isset($_GET['radioUpdate'])) {

             $idStudenta = $_GET['radioUpdate'];
             $imePrezimeStudenta = "SELECT * FROM student WHERE idStudent = '$idStudenta';";
             $resultImePrezime = mysqli_query($conn, $imePrezimeStudenta);
             $cijeliArrayStudent = mysqli_fetch_array($resultImePrezime);
        
             $ime = $cijeliArrayStudent['ime']; 
             $prezime = $cijeliArrayStudent['prezime']; 
             $jmbag = $cijeliArrayStudent['JMBAG'];
             $godRod = $cijeliArrayStudent['godRod'];
             $mob = $cijeliArrayStudent['mob'];                   
             $email = $cijeliArrayStudent['email'];
             $idTema = $cijeliArrayStudent['idTema'];
           } 

        ?>

         <?php
            if (isset( $_GET['ime']) && !empty( $_GET['ime']) and isset( $_GET['prezime']) && !empty( $_GET['prezime']) and isset( $_GET['jmbag']) && !empty( $_GET['jmbag']) and isset( $_GET['idTemaDropDown']) && !empty( $_GET['idTemaDropDown'])) {
              $errorMsg = 0;
              $ime = $_GET['ime'];
              $url = "sort_student.php?radioUpdate=" . $_GET['idStudenta'] . "&idStudenta=" . $_GET['idStudenta'] . "&ime=" . $_GET['ime'] . "&prezime=" . $_GET['prezime'] . "&jmbag=" . $_GET['jmbag'] . "&godRod=" . $_GET['godRod'] . "&email=" . $_GET['email']. "&mob=" . $_GET['mob'] . "&idTemaDropDown=" . $_GET['idTemaDropDown'] . "&update=Update";
              echo "<meta http-equiv=\"refresh\" content=\"0;URL=$url\">";
             // header('Location: sort_student.php');
            }
        ?>

		<!-- Visak koda -->
         <?php

          if (!isset($_GET['radioUpdate']) and isset($_GET['update'])) {
              if (!isset($_GET['ime']) and !isset($_GET['prezime']) and !isset($_GET['jmbag']) and !isset($_GET['idTemaDropDown'])) {
                echo "sve 5";
                $errorMsg = 0;
              } else {
                $idStudenta = $_GET['idStudenta'];
                 $imePrezimeStudenta = "SELECT * FROM student WHERE idStudent = '$idStudenta';";
                 $resultImePrezime = mysqli_query($conn, $imePrezimeStudenta);
                 $cijeliArrayStudent = mysqli_fetch_array($resultImePrezime);
          
                 $ime = $cijeliArrayStudent['ime']; $tempIme = $ime;
                 $prezime = $cijeliArrayStudent['prezime']; $tempPrezime = $prezime; 
                 $tempIdStudenta = $idStudenta;
                 $errorMsg = 1;
              }
          }

        ?>


         <p class="h5">Izmjena podataka za studenta: <?php  if (isset($_GET['radioUpdate'])) { echo "<b>"; echo $ime . " " . $prezime; echo "</b>";} else if (isset($_GET['update'])) { echo "<b>"; echo $tempIme . " " . $tempPrezime; echo "</b>";}?> </p> 

         <?php
          if (isset($_GET['ime'])) {
            $ime = $_GET['ime'];
          }
           if (isset($_GET['prezime'])) {
            $prezime = $_GET['prezime'];
          }
           if (isset($_GET['jmbag'])) {
            $jmbag = $_GET['jmbag'];
          }
           if (isset($_GET['godRod'])) {
            $godRod = $_GET['godRod'];
          }
           if (isset($_GET['email'])) {
            $email = $_GET['email'];
          }
           if (isset($_GET['mob'])) {
            $mob = $_GET['mob'];
          }
           if (isset($_GET['idTema'])) {
            $idTema = $_GET['idTema'];
          }

        ?>      


            <table style="width: auto"; class="table table-bordered">
                <?php if(isset($_GET['idStudenta'])) $idStudenta = $_GET['idStudenta'];?>
                <tr><th>ID</th><td><input class='form-control' id="idStudenta" name="idStudenta" readonly="true" value="<?php echo $idStudenta;?>"></input></td></tr>
                <tr><th>Ime</th><td><input class='form-control' type="textbox" name="ime" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['ime'])) { echo $ime;}?>"></td></tr>
                <tr><th>Prezime</th><td><input class='form-control' type="textbox" name="prezime" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['prezime'])) { echo $prezime;}?>"></td></tr>
                 <tr><th>JMBAG</th><td><input class='form-control' type="textbox" name="jmbag" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['jmbag'])) { echo $jmbag;}?>"></td></tr>
                <tr><th>God. rodenja</th><td><input class='form-control' type="textbox" name="godRod" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['godRod'])) { echo $godRod;}?>"></td></tr>
                <tr><th>E-mail</th><td><input class='form-control' type="textbox" name="email" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['email'])) { echo $email;}?>"></td></tr>
                <tr><th>Mobitel</th><td><input class='form-control' type="textbox" name="mob" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['mob'])) { echo $mob;}?>"></td></tr>
                <tr><th>Broj teme</th><td>
                   <?php 
                   $sql = "SELECT idTema, jezik, prezentacija FROM tema ORDER BY idTema";
                   $result = mysqli_query($conn, $sql);
                   echo "<select class='form-control' name='idTemaDropDown' >";
                   while ($row = mysqli_fetch_array($result)) {
                        if ($row['idTema'] == $idTema or $row['idTema'] == $_GET['idTemaDropDown']) {
                          echo "<option selected = 'selected' value='" . $row['idTema'] . "'>" . $row['idTema'] . " - " . $row['jezik'] . " - " . $row['prezentacija'] . "</option>";
                        } else {
                          echo "<option value='" . $row['idTema'] . "'>" . $row['idTema'] . " - " . $row['jezik'] . " - " . $row['prezentacija'] . "</option>";
                        }
                   }    
                    echo "</select>";?></td></tr>
  
            </table>

            <input class="btn btn-info" name="update" type="submit" id="update" value="Update">

        </form>

        </div>
      </div>
    </div>

    <?php
     
     if (!isset($_GET['radioUpdate'])) {
        if (empty($_GET['ime']) or empty($_GET['prezime']) or empty($_GET['jmbag']) or
          empty($_GET['idTemaDropDown'])) {
            $errorMsg = 0;
        $msg2='<div class="container pull-left">
                     <div class="row">
                        <div class="col-lg-5">
                      <div class="alert alert-danger col-md-10">Obavezna polja: ime, prezime, JMBAG
                       i broj teme!</div>
                   </div>
                  </div>
                   </div>';
                      echo $msg2;
        }
    }
    ?>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
            
    </body>
</html>