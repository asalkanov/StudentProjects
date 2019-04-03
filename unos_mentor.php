<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Unos mentora</title>
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
              <li class="active"><a href="unos_mentor.php">Unos mentora</a></li>
              <li><a href="unos_tema.php">Unos tema</a></li>
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
				<form class="well" action="unos_mentor.php" method="GET">    
					<table style="width: auto"; class="table table-bordered">                    
						<tr><th>Ime</th><td><input class="form-control" type="textbox" name="ime" value="<?php if (isset($_GET['ime']))echo $_GET['ime']?>"></td></tr>
						<tr><th>Prezime</th><td><input class="form-control" type="textbox" name="prezime" value="<?php if (isset($_GET['prezime']))echo $_GET['prezime']?>"></td></tr>
						<tr><th>OIB</th><td><input class="form-control" type="textbox" name="OIB" value="<?php if (isset($_GET['OIB']))echo $_GET['OIB']?>"></td></tr>
						<tr><th>Ured</th><td><input class="form-control" type="textbox" name="ured" value="<?php if (isset($_GET['ured']))echo $_GET['ured']?>"></td></tr>
						<tr><th>Status</th><td><input class="form-control" type="textbox" name="status" value="<?php if (isset($_GET['status']))echo $_GET['status']?>"></td></tr>
						<tr><th>Telefon</th><td><input class="form-control" type="textbox" name="tel" value="<?php if (isset($_GET['tel']))echo $_GET['tel']?>"></td></tr>
						<tr><th>E-mail</th><td><input class="form-control" type="textbox" name="email" value="<?php if (isset($_GET['email']))echo $_GET['email']?>"></td></tr>
                  
					</table>

					<input class="btn btn-success" name="insert" type="submit" id="insert" value="Insert">
				</form>
			 </div>
		  </div>
		</div>
        
        <?php
            if (isset($_GET['insert'])) {
                $ime = $_GET['ime'];
                $prezime = $_GET['prezime'];
                $oib = $_GET['OIB'];
                $ured = $_GET['ured'];
                $status = $_GET['status'];
                $tel = $_GET['tel'];
				$email = $_GET['email'];
                
                if ($ime and $prezime and $oib and $ured and $status) {
                    $sql = "INSERT INTO `mentor` (`id`, `ime`, `prezime`, `OIB`, `ured`, `status`, `tel`, `email`) VALUES (NULL, '$ime', '$prezime', '$oib', '$ured', '$status', '$tel', '$email');";
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
                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=unos_mentor.php\">";
                    } else {
                        echo "Neispravan unos podataka:" . mysqli_error($conn);
                    }
                } else {
                   $msg2='<div class="container pull-left">
                   <div class="row">
                      <div class="col-lg-5">
                    <div class="alert alert-danger col-md-10">Obavezna polja: ime, prezime, OIB, ured i status!</div>
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