<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Pretraga studenata </title>
	
         <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">

      <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="home.php">Studentski projekti</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="sort_student.php">Pregled studenata</a></li>
      <li><a href="table_mentor.php">Pregled mentora</a></li>
         <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="unos_raspored.php">Unos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="unos_student.php">Unos studenata</a></li>
              <li><a href="unos_mentor.php">Unos mentora</a></li>
              <li><a href="unos_tema.php">Unos tema</a></li>
              <li><a href="unos_raspored.php">Unos rasporeda</a></li>
            </ul>
        </li>
          <li class="active"><a href="find_student.php">Pretraga studenata</a></li>
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


    </head>
    <body>

    <div class="container pull-left">
       <div class="row">
          <div class="col-lg-6">
        
        <form class="form-group well" action="find_student.php" method="GET">
            <p class="lead">Pretraga po imenu, prezimenu ili temi seminara:</p>
                  <div class="form-group">
                   <input style="width: auto"; type="text" name="searching" class="form-control" placeholder="Search">
                  </div> 
                 <input type="submit" value="Search" class="btn btn-default">
                 <!--<a class="btn btn-default" type="submit" href="find_student.php">Search</a>
                 -->
        </form>

            </div>
        </div>
    </div>

    <div class="row">
        <p id="ovdje"></p>
    </div>
		<?php

            $dbuser = "DB_USER";
            $dbpass = "DB_PASSWORD";
            $dbname = "DB_NAME";

			$conn = mysqli_connect("localhost", $dbuser, $dbpass)
			or die("Pogreska spajanja: " . mysqli_error($conn)); 

			mysqli_select_db($conn, $dbname);

            if (isset($_GET['searching']) and !empty($_GET['searching'])) {
                $searching = $_GET['searching'];     
            

                $stringArray = explode(' ',trim($searching));
                $imeOdvojeno1 = $stringArray[0];  
                if (isset($stringArray[1]))
                    $imeOdvojeno2 = $stringArray[1];
                else $imeOdvojeno2 = $searching;

                $sql = "SELECT * FROM student JOIN tema ON student.idTema = tema.idTema WHERE prezime LIKE '%$searching%' OR ime LIKE '%$searching%' OR jezik LIKE '%$searching%' OR ime LIKE '%$imeOdvojeno1%' OR prezime LIKE '%$imeOdvojeno2%';"; 
                $result = mysqli_query($conn, $sql);
                
            }
		?>

    			
			<?php
                if (empty($_GET['searching']) and isset($_GET['searching'])) {
                    $msg='<div class="container pull-left">
                   <div class="row">
                      <div class="col-lg-5 ">
                    <div class="alert alert-warning col-md-7">Unesite vrijednost za pretrazivanje!</div>
                     </div>
                    </div>
                     </div>';
                    echo $msg;
                }
                if (isset($_GET['searching']) and !empty($_GET['searching'])) {
                    if (mysqli_num_rows($result) == 0) {
                    $msg2='<div class="container pull-left">
                   <div class="row">
                      <div class="col-lg-5">
                    <div class="alert alert-danger col-md-4">Nema rezultata.</div>
                 </div>
                </div>
                 </div>';
                    echo $msg2;
                } else {
			
            ?>

                  <table class="table">
					<th>ID</th>
					<th>Ime</th>
					<th>Prezime</th>
                    <th>JMBAG</th>
                    <th>Godina rođenja</th>
                    <th>E-mail</th>
                    <th>Mobitel</th>
                    <th>Broj teme</th>
                    <th>Naslov teme</th>
					<th>Prezentacija</th>
                    <th>Seminar</th>
                    <th>Broj studenata</th>
                    <th>Opis</th>
                <?php 
                     while ($row = mysqli_fetch_array($result)):?>
                <tr>
                    <td><?php echo $row['idStudent'];?></td>
                    <td><?php echo $row['ime'];?></td>
                    <td><?php echo $row['prezime'];?></td>
                    <td><?php echo $row['JMBAG'];?></td>
                    <td><?php echo $row['godRod'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['mob'];?></td>
                    <td><?php echo $row['idTema'];?></td>
                    <td><?php echo $row['jezik'];?></td>
                    <td><?php echo $row['prezentacija'];?></td>
                    <td><?php echo $row['seminar'];?></td>
                    <td><?php echo $row['brStudenti'];?></td>
                    <td><?php echo $row['opis'];?></td>

                </tr>

			<?php endwhile;}}?>

            </table>
			

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    </body>
</html>