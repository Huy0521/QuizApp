<?php
session_start();
include_once("./middleware/loginCheck.php");  //if user doesn't login redirect to login page

include "./config/connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	  <!-- bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- CSS customize -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/style_index.css">

  <!-- google font -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <meta charset="utf-8">
  <title>Học JavaScript trên website</title>
</head>
<body>
	<?php 
    include_once("./layout/header.php");?>
  
         <?php
      $course = "";
      $sql = "SELECT * FROM `gio_hang` INNER JOIN khoa_hoc ON gio_hang.`id_khoa_hoc`= khoa_hoc.`id`  WHERE `username`='$_SESSION[username]'";
      $do = mysqli_query($connect, $sql);
      $count = mysqli_num_rows($do);
      if($count  == 0){ ?>
        <div class="row justify-content-center">
          <span>Hiện tại chưa có khóa học nào, vui lòng thêm khóa học.</span>
        </div>
    <?php  } else{
        while ($row = mysqli_fetch_assoc($do)) { ?>
          <div class="card col-md-4 mr-3 mt-4">
            <img class="card-img-top" src="https://www.tutorialrepublic.com/lib/images/javascript-illustration.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['name'] ?></h5>
              <p class="card-text"><?php echo $row['description'] ?></p>
               <a href="./course.php?course=<?php echo $row['id']?>" class="btn btn-primary">Vào học</a>
            </div>
          </div>
          <?php
        }
      }
?>
    <!-- footer -->
  <?php include_once("./layout/footer.php") ?>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- font awesome icon -->
  <script src="./js/fontAwesome.js"></script>
  <script src="./js/funtion.js"></script>
</body>
</html>