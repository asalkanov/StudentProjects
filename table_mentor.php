<?php


if (isset( $_GET['searching']) && !empty( $_GET['searching'])) {
              echo "<meta http-equiv=\"refresh\" content=\"0;URL=find_student.php\">";
} 

// pocetne vrijednosti varijabli i pocetni query (koji uzima sve iz tablice)
$linkAscDescIme = "asc";
$linkAscDescPrezime = "desc";
$linkAscDescID = "desc";
$linkAscDescNaslov = "desc";
$redoslijed = "SELECT * FROM mentor";
$result = izvrsiQuery($redoslijed);

// provjera linka za asc ili desc za sortiranje imena
if (isset($_GET['sortIme'])) {
    $linkAscDescIme = $_GET['sortIme'];
    if(isset($linkAscDescIme) and $linkAscDescIme=="asc"){
        $linkAscDescIme="desc";
    } else { 
        $linkAscDescIme="asc";
    }
}

// provjera asc/desc za prezimena 
if (isset($_GET['sortPrezime'])) {
    $linkAscDescPrezime = $_GET['sortPrezime'];
    if(isset($linkAscDescPrezime) and $linkAscDescPrezime=="asc"){
        $linkAscDescPrezime="desc";
    } else { 
        $linkAscDescPrezime="asc";
    }
}

// provjera asc/desc za ID 
if (isset($_GET['sortID'])) {
    $linkAscDescID= $_GET['sortID'];
    if(isset($linkAscDescID) and $linkAscDescID=="asc"){
        $linkAscDescID="desc";
    } else { 
        $linkAscDescID="asc";
    }
}

// sortiraj iz baze po imenima i posalji query u izvrsiQuery funkciju
if (isset($_GET['sortIme'])) {

    switch ($_GET['sortIme']) {
            
               case "asc":
                    $redoslijed = "SELECT * FROM mentor ORDER BY ime ASC";
                    break;
               case "desc":
                     $redoslijed = "SELECT * FROM mentor ime ORDER BY ime DESC";
                     break;
               default:
                    $redoslijed = "SELECT * FROM mentor";
                    break;
    }

    $result = izvrsiQuery($redoslijed);

 // mozda je dosao zahtjev za sortiranjem prezimena
} else {

    if (isset($_GET['sortPrezime'])) {

    switch ($_GET['sortPrezime']) {
            
               case "asc":
                    $redoslijed = "SELECT * FROM mentor ORDER BY prezime ASC";
                    break;
               case "desc":
                     $redoslijed = "SELECT * FROM mentor ORDER BY prezime DESC";
                     break;
               default:
                     $redoslijed = "SELECT * FROM mentor";
                    break;
    }

    $result = izvrsiQuery($redoslijed);

    }
}


//sortiranje po ID-evima mentora
if (isset($_GET['sortID'])) {

    switch ($_GET['sortID']) {
            
               case "asc":
               $redoslijed = "SELECT * FROM mentor ORDER BY id ASC";
                     break;
               case "desc":
                     $redoslijed = "SELECT * FROM mentor ORDER BY id DESC";
                     break;
               default:
                    $redoslijed = "SELECT * FROM mentor";
                    break;
    }

    $result = izvrsiQuery($redoslijed);
}

if (isset($_GET['radioUpdate'])) {
    $idMen = $_GET['radioUpdate'];
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=update_mentor.php?radioUpdate=$idMen\">";
} else {
    //echo "Odaberite studenta za izmjenu podataka.";
}


function izvrsiQuery($query)
{
    
   $dbuser = "DB_USER";
   $dbpass = "DB_PASS";
   $dbname = "DB_NAME";
    
    $conn = mysqli_connect("localhost", $dbuser, $dbpass) 
    or die("Pogreska spajanja: " . mysqli_error($conn)); 

    mysqli_select_db($conn, $dbname);

    $result = mysqli_query($conn, $query);
    return $result;
}

            //brisanje iz baze check-iranih redova u tablici mentor
            $count=mysqli_num_rows($result);
            $successDel = false;
            // provjera je li Delete button pretisnut, tj. poslan zahtjev za brisanjem
            if (isset($_GET['delete']) and isset($_GET['checkboxDelete'])) {
                for($i=0;$i<$count;$i++){
                     $del_id = $_GET['checkboxDelete'];
                     $sql = "DELETE FROM mentor WHERE id='$del_id'";
                     $successDel = mysqli_query($conn, $sql);
                }
                // ako je delete uspjesan, preusmjeri nazad na table_mentor.php 
                if($successDel){
                   echo "<meta http-equiv=\"refresh\" content=\"0;URL=table_mentor.php\">";
                }
            }
        
?>


<?php
            if (isset($_GET['update'])) {
                $idMentora = $_GET['idMentora'];
                $ime = $_GET['ime'];
                $prezime = $_GET['prezime'];
                $OIB = $_GET['OIB'];
                $ured = $_GET['ured'];
                $status = $_GET['status'];
                $tel = $_GET['tel'];
				$email = $_GET['email'];
                if ($ime and $prezime and $OIB) {
                    $sql = "UPDATE `mentor` SET ime='$ime', prezime='$prezime', OIB='$OIB', ured='$ured', status='$status', tel='$tel', email='$email' WHERE mentor.id='$idMentora';";
                    $resultUpdate = mysqli_query($conn, $sql);
                    if ($resultUpdate) {
                        $msg1='<div class="container pull-left">
                      <div class="row">
                      <div class="col-lg-5">
                      <div class="alert alert-success col-md-6">Podaci su uspjesno uneseni.</div>
                      </div>
                      </div>
                      </div>';
                      echo $msg1;
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=table_mentor.php\">";
                    } else {
                        echo "Neispravan unos podataka:" . mysqli_error($conn);
                    }
                } else  {
                    echo "<b>";
                    echo "Obavezna polja: ime, prezime i OIB!";
                    echo "</b>";
                }
            }
?>


<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Mentori</title>

      <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
       

       <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>


<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Studentski projekti</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="sort_student.php">Pregled studenata</a></li>
      <li class="active"><a href="table_mentor.php">Pregled mentora</a></li>
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


    </head>
    <body>
      
        <form action="table_mentor.php" method="GET">
          
        <!--    <input type="submit" name="sortPrezime" value="asc"><br><br>
            <input type="submit" name="sortPrezime" value="desc"><br><br>    -->
          
            <table class="table table-bordered table-hover">
                <tr>
                    <td align="center"><span class="glyphicon glyphicon-trash"></span> Izbrisi</td>
                    <td align="center"><span class="glyphicon glyphicon-edit"></span> Uredi</td>
                    <?php echo "<th><a href='table_mentor.php?sortID=$linkAscDescID'>ID</a></th>" ?>
                    <?php echo "<th><a href='table_mentor.php?sortIme=$linkAscDescIme'>Ime</a></th>" ?>
                    <?php echo "<th><a href='table_mentor.php?sortPrezime=$linkAscDescPrezime'>Prezime</a></th>" ?>
                    <th>OIB</th>
                    <th>Ured</th>
                    <th>Status</th>
                    <th>Telefon</th>
                    <th>E-mail</th>
                </tr>
                <!-- popuni tablicu iz sql baze -->
                <?php while ($row = mysqli_fetch_array($result)):?>	
                <tr>
                <td align="center"><input name="checkboxDelete" type="checkbox" id="checkbox" value="<?php echo $row['id']?>"></td>
                 <td align="center"><input name="radioUpdate" type="radio" id="radio" value="<?php echo $row['id']?>"></td>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['ime'];?></td>
                    <td><?php echo $row['prezime'];?></td>
                    <td><?php echo $row['OIB'];?></td>
                    <td><?php echo $row['ured'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td><?php echo $row['tel'];?></td>
                    <td><?php echo $row['email'];?></td>
					<?php endwhile;?>

				
				</tr>
            </table>

            <div class="container pull-left">
             <div class="row">
                <div class="col-lg-5">
                                         
                <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete"></input>
                <input class="btn btn-info" type ="submit" value="Update"></input>

                 </div>
                 </div>
             </div>

        </form>

        
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    </body>
</html>