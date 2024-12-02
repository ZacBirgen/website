<?php 
require_once("includes/dbh.inc.php");
$query = "SELECT T.Semester, T.Week, T.Day, T.StartTime, T.EndTime, D.Name, H.TeacherID FROM teacherscheduledslot S JOIN teacher H ON S.teacherID = H.teacherID JOIN timeslot T ON S.TimeSlotID = T.TimeSlotID JOIN student D ON S.StudentID = D.StudentID";
$stmt = $pdo->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Hostit</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>Scheduler</span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="studentform.php">Schdeule (Student)<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="teachform.php">Schdeule (Techer)</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="search.php">View</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Check Your Schdeule
        </h2>
      </div>
    </div>
    <div class="container ">
      <div class="row">
        <div class="col-md-6 col-lg-12">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <div>
                  <input type="text" placeholder="Professor Full Name" name="name"/>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered text-center">
                  <tr class="bg-light text black">
                    <td> Semester </td>
                    <td> Week </td>
                    <td> Day </td>
                    <td> Start Time </td>
                    <td> End time </td>
                    <td> Student Name </td>
                  </tr>
                  
                    <?php 
                    foreach ($results as $result){
                      ?>
                      <tr>
                      <td><?php echo $result["Semester"]?></td>
                      <td><?php echo $result["Week"]?></td>
                      <td><?php echo $result["Day"]?></td>
                      <td><?php echo $result["StartTime"]?></td>
                      <td><?php echo $result["EndTime"]?></td>
                      <td><?php echo $result["Name"]?></td>
                      </tr>
                      <?php
                    };?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>


</body>

</html>