<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Unos teme</title>
         <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
      

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Studentski projekti</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="sort_student.php">Pregled studenata</a></li>
      <li><a href="table_mentor.php">Pregled mentora</a></li>
         <li class="dropdown active">
            <a class="dropdown-toggle" data-toggle="dropdown" href="unos_raspored.php">Unos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="unos_student.php">Unos studenata</a></li>
              <li><a href="unos_mentor.php">Unos mentora</a></li>
              <li class="active"><a href="unos_tema.php">Unos tema</a></li>
              <li><a href="unos_raspored.php">Unos rasporeda</a></li>
            </ul>
        </li>
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

       <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>

    </head>

    <body>


    <?php
    
		$dbuser = "DB_USER";
		$dbpass = "DB_PASS";
		$dbname = "DB_NAME";

        $conn = mysqli_connect("localhost", $dbuser, $dbpass)
        or die("Pogreska spajanja: " . mysqli_error($conn)); 

        mysqli_select_db($conn, $dbname);

    ?>
      
      <div class="container pull-left">
       <div class="row">
          <div class="col-lg-5">
          <form class="well" action="unos_tema.php" method="GET">    
              <table style="width: auto"; class="table table-bordered">
                <tr><th>Jezik</th><td><input class="form-control" type="textbox" name="jezik" value="<?php if (isset($_GET['jezik']))echo $_GET['jezik']?>"></td></tr>
				<tr><th>Prezentacija</th><td><input class="form-control" type="textbox" name="prezentacija" value="<?php if (isset($_GET['prezentacija']))echo $_GET['prezentacija']?>"></td></tr>
                <tr><th>Seminar</th><td><input class="form-control" type="textbox" name="seminar" value="<?php if (isset($_GET['seminar']))echo $_GET['seminar']?>"></td></tr>
                <tr><th>Broj studenata</th><td><input class="form-control" type="textbox" name="brStudenti" value="<?php if (isset($_GET['brStudenti']))echo $_GET['brStudenti']?>"></td></tr>
                <tr><th>Opis</th><td><input class="form-control" type="textbox" name="opis" value="<?php if (isset($_GET['opis']))echo $_GET['opis']?>"></td></tr>
                <tr><th>Termin prezentacije</th><td>
                     <?php 
                   $sql = "SELECT id, datum, prostorija FROM raspored ORDER BY id";
                   $result = mysqli_query($conn, $sql);
                   echo "<select class='form-control' name='idRasporedDropDown'>";
                   while ($row = mysqli_fetch_array($result)) {
					   if ($row['id'] == $idRas or $row['id'] == $_GET['idRasporedDropDown']) {
							echo "<option selected = 'selected' value='" . $row['id'] . "'>" . $row['datum'] . " - " . $row['prostorija'] . "</option>";
					   }else{
							echo "<option value='" . $row['id'] . "'>" . $row['datum'] . " - " . $row['prostorija'] . "</option>";
					   }
                   }    
                    echo "</select>";?></td></tr>
                  
			  </table>
              <input  class="btn btn-success" name="insert" type="submit" id="insert" value="Insert">
          </form>
         </div>
      </div>
    </div>      
      
        
    <div class="row">
    
    </div>

        <?php
            if (isset($_GET['insert'])) {
                $jezik = $_GET['jezik'];
                $prez = $_GET['prezentacija'];
                $seminar = $_GET['seminar'];
                $brS = $_GET['brStudenti'];
                $opis = $_GET['opis'];
                $idRas = $_GET['idRasporedDropDown'];
                
                if ($jezik and $prez and $seminar and $brS and $idRas) {
                    $sql = "INSERT INTO `tema` (`idTema`, `jezik`, `prezentacija`, `seminar`, `brStudenti`, `opis`, `idRaspored`) VALUES (NULL, '$jezik', '$prez', '$seminar', '$brS', '$opis', '$idRas');";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                       $msg1='<div class="container pull-left">
                      <div class="row">
                      <div class="col-lg-5">
                      <div class="alert alert-success col-md-6">Podaci su uspjesno uneseni.</div>
                      </div>
                      </div>
                      </div>';
                      echo $msg1;
                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=unos_tema.php\">";
                    } else {
                        echo "Neispravan unos podataka:" . mysqli_error($conn);
                    }
                } else {
                   $msg2='<div class="container pull-left">
                   <div class="row">
                      <div class="col-lg-5">
                    <div class="alert alert-danger col-md-10">Obavezna polja: jezik, prezentacija, seminar, broj studenata i raspored!</div>
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