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

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Make New Office Hour
        </h2>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
          <div class="form_container">
            <form action="includes/teachformhandler.php" method="post">
              <div>
                <input type="text" placeholder="Name" name="name"/>
              </div>
              <div>
                <input type="time" placeholder="StartTime" name="starttime"/>
              </div>
              <div>
                <input type="time" placeholder="EndTime" name="endtime"/>
              </div>
              <div>
                <input class="checkbox" type="checkbox" id="Monday" name="day[]" value="Monday" />
                <label for="Monday">Monday</label><br>
                <input class="checkbox" type="checkbox" id="Tuedsay" name="day[]" value="Tuedsay" />
                <label for="Tuedsay">Tuedsay</label><br>
                <input class="checkbox" type="checkbox" id="Wednesday" name="day[]" value="Wednesday" />
                <label for="Wednesday">Wednesday</label><br>
                <input class="checkbox" type="checkbox" id="Thursday" name="day[]" value="Thursday" />
                <label for="Thursday">Thursday</label><br>
                <input class="checkbox" type="checkbox" id="Friday" name="day[]" value="Friday" />
                <label for="Friday">Friday</label><br>
                <input class="checkbox" type="checkbox" id="Saturday" name="day[]" value="Saturday" />
                <label for="Saturday">Saturday</label><br>
                <input class="checkbox" type="checkbox" id="Sunday" name="day[]" value="Sunday" />
                <label for="Sunday">Sunday</label><br>
              </div>
              <div class="boxcontain">
                <input class="checkbox" type="checkbox" id="All" name="week[]" value="All" />
                <label for="All">All Weeks</label><br>
                <div class="column">
                  <input class="weekbox" type="checkbox" id="1" name="week[]" value="1" />
                  <label for="1">Week 1</label><br>
                  <input class="weekbox" type="checkbox" id="5" name="week[]" value="5" />
                  <label for="5">Week 5</label><br>
                  <input class="weekbox" type="checkbox" id="9" name="week[]" value="9" />
                  <label for="9">Week 9</label><br>
                  <input class="weekbox" type="checkbox" id="13" name="week[]" value="13" />
                  <label for="13">Week 13</label><br>
                </div>
                <div class="column">
                  <input class="weekbox" type="checkbox" id="2" name="week[]" value="2" />
                  <label for="2">Week 2</label><br>
                  <input class="weekbox" type="checkbox" id="6" name="week[]" value="6" />
                  <label for="6">Week 6</label><br>
                  <input class="weekbox" type="checkbox" id="10" name="week[]" value="10" />
                  <label for="10">Week 10</label><br>
                  <input class="weekbox" type="checkbox" id="14" name="week[]" value="14" />
                  <label for="14">Week 14</label><br>
                </div>
                <div class="column">
                  <input class="weekbox" type="checkbox" id="3" name="week[]" value="3" />
                  <label for="3">Week 3</label><br>
                  <input class="weekbox" type="checkbox" id="7" name="week[]" value="7" />
                  <label for="7">Week 7</label><br>
                  <input class="weekbox" type="checkbox" id="11" name="week[]" value="11" />
                  <label for="11">Week 11</label><br>
                  <input class="weekbox" type="checkbox" id="15" name="week[]" value="15" />
                  <label for="15">Week 15</label><br>
                </div>
                <div class="column">
                  <input class="weekbox" type="checkbox" id="4" name="week[]" value="4" />
                  <label for="4">Week 4</label><br>
                  <input class="weekbox" type="checkbox" id="8" name="week[]" value="8" />
                  <label for="8">Week 8</label><br>
                  <input class="weekbox" type="checkbox" id="12" name="week[]" value="12" />
                  <label for="12">Week 12</label><br>
                  <input class="weekbox" type="checkbox" id="16" name="week[]" value="16" />
                  <label for="16">Week 16</label><br>
                </div>
              </div>
              <div>
                <input class="checkbox" type="radio" id="fall" name="semester" value="fall">
                <label for="fall">Fall</label><br>
                <input class="checkbox" type="radio" id="spring" name="semester" value="spring">
                <label for="spring">Spring</label><br>
                <input class="checkbox" type="radio" id="summer" name="semester" value="summer">
                <label for="summer">Summer</label>
              </div>
              <div class="btn_box ">
                <button>
                  SEND
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

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