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
            <li><a href="sort_student.php">Studenti</a></li>
            <li><a href="unos_student.php">Unos studenata</a></li>
			<li class="active"><a href="table_mentor.php">Mentori</a><li>
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

        <form class="well" action ="update_mentor.php" method="GET">
                
        <?php
          if (isset($_GET['radioUpdate'])) {

             $idMentora = $_GET['radioUpdate'];
             $imePrezime = "SELECT * FROM mentor WHERE id = '$idMentora';";
             $resultImePrezime = mysqli_query($conn, $imePrezime);
             $cijeliArray = mysqli_fetch_array($resultImePrezime);
        
             $ime = $cijeliArray['ime'];
             $prezime = $cijeliArray['prezime'];
             $OIB = $cijeliArray['OIB'];
             $ured = $cijeliArray['ured'];
             $status = $cijeliArray['status'];                   
             $tel = $cijeliArray['tel'];
             $email = $cijeliArray['email'];
           } 

        ?>

         <?php
            if (isset( $_GET['ime']) && !empty( $_GET['ime']) and isset( $_GET['prezime']) && !empty( $_GET['prezime']) and isset( $_GET['OIB']) && !empty( $_GET['OIB'])){
              $errorMsg = 0;
               if ($ime=$_GET['ime'] and $prezime=$_GET['prezime'] and $OIB=$_GET['OIB']) {
               	    $idMentora = $_GET['idMentora'];
               		if (isset($_GET['ured'])) $ured = $_GET['ured']; else $ured="";
               		if (isset($_GET['status'])) $status = $_GET['status']; else $status="";
               		if (isset($_GET['tel'])) $tel = $_GET['tel']; else $tel="";
               		if (isset($_GET['email'])) $email = $_GET['email']; else $email="";
                    $sql = "UPDATE `mentor` SET ime='$ime', prezime='$prezime', OIB='$OIB', ured='$ured', status='$status', tel='$tel', email='$email' WHERE id = '$idMentora';";
                    $resultUpdate = mysqli_query($conn, $sql);
                    if ($resultUpdate) {
                        echo 'Podaci su uspjesno izmjenjeni!';
                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=table_mentor.php\">";
                    } else {
                        echo "Neispravan unos podataka:" . mysqli_error($conn);
                    }
            	}
        	}
        ?>

         <p class="h5">Izmjena podataka za mentora: <?php  if (isset($_GET['radioUpdate'])) { echo "<b>"; echo $ime . " " . $prezime; echo "</b>"; } else if (isset($_GET['update'])) { echo "<b>"; echo $ime . " " . $prezime; echo "</b>";}?> </p> 

         <?php
          if (isset($_GET['ime'])) {
            $ime = $_GET['ime'];
          }
           if (isset($_GET['prezime'])) {
            $prezime = $_GET['prezime'];
          }
           if (isset($_GET['OIB'])) {
            $OIB = $_GET['OIB'];
          }
           if (isset($_GET['ured'])) {
            $ured = $_GET['ured'];
          }
           if (isset($_GET['status'])) {
            $status = $_GET['status'];
          }
           if (isset($_GET['tel'])) {
            $tel = $_GET['tel'];
          }
           if (isset($_GET['email'])) {
            $email = $_GET['email'];
          }

        ?>      


            <table style="width: auto"; class="table table-bordered">
                <?php if(isset($_GET['id'])) $idMentora = $_GET['radioUpdate'];?>
                <tr><th>ID</th><td><input class='form-control' id="idMentora" name="idMentora" readonly="true" value="<?php if (isset($_GET['radioUpdate'])) echo $idMentora; ?>"></input></td></tr>
                <tr><th>Ime</th><td><input class='form-control' type="textbox" name="ime" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['ime'])) { echo $ime;}?>"></td></tr>
                <tr><th>Prezime</th><td><input class='form-control' type="textbox" name="prezime" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['prezime'])) { echo $prezime;}?>"></td></tr>
                 <tr><th>OIB</th><td><input class='form-control' type="textbox" name="OIB" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['OIB'])) { echo $OIB;}?>"></td></tr>
                <tr><th>Ured</th><td><input class='form-control' type="textbox" name="ured" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['ured'])) { echo $ured;}?>"></td></tr>
                <tr><th>Status</th><td><input class='form-control' type="textbox" name="status" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['status'])) { echo $status;}?>"></td></tr>
                <tr><th>Telefon</th><td><input class='form-control' type="textbox" name="tel" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['tel'])) { echo $tel;}?>"></td></tr>
                <tr><th>E-mail</th><td><input class='form-control' type="textbox" name="email" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['email'])) { echo $email;}?>"></td></tr>  
  
            </table>

            <input class="btn btn-info" name="update" type="submit" id="update" value="Update">

        </form>

        </div>
      </div>
    </div>

    <?php
     
     if (!isset($_GET['radioUpdate'])) {
        if (empty($_GET['ime']) or empty($_GET['prezime']) or empty($_GET['OIB'])) {
            $errorMsg = 0;
        $msg2='<div class="container pull-left">
                     <div class="row">
                        <div class="col-lg-5">
                      <div class="alert alert-danger col-md-10">Obavezna polja: ime, prezime, OIB!</div>
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