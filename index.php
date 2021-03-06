<?php
session_start();
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
  <!-- header -->
  <?php if(isset($_SESSION['username'])){
    include_once("./layout/header.php");
   ?>

  <main role="main" class="container mt-5">
    <div class="row justify-content-center">
         <?php
      $course = "";
      $sql = "SELECT * FROM khoa_hoc WHERE `id` NOT IN (SELECT `id_khoa_hoc` FROM gio_hang WHERE `username`='$_SESSION[username]');";
      $do = mysqli_query($connect, $sql);
      if(mysqli_num_rows($do)>0){
      while ($row = mysqli_fetch_assoc($do)) { ?>
        <form action="" method="post">
          <div class="card col-md-4 mr-3 mt-4">
            <img class="card-img-top" src="https://www.tutorialrepublic.com/lib/images/javascript-illustration.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['name'] ?></h5>
              <p class="card-text"><?php echo $row['description'] ?></p>
              <div class="row justify-content-center">
              <button name="<?php echo "course_".$row['id'] ?>" class="btn btn-primary">Thêm khóa học</button>
              </div>
            </div>
          </div>
        </form>
      <?php 
      $course = "course_".$row['id'];
      if(isset($_POST[$course])){
        $query = "INSERT INTO gio_hang VALUES(NULL,'$_SESSION[username]','$row[id]')";
        mysqli_query($connect,$query);
        header("Location:myclass.php");
      }
    }
  }
    else{
      echo "Hiện tại không có khóa học mới!";
    }
  }
  else{
      ?>
        <div class="row justify-content-center">
      <?php
      $sql = "SELECT * FROM khoa_hoc";
      $do = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_assoc($do)) { ?>
        <div class="card col-md-4 mr-3 mt-4">
          <img class="card-img-top" src="https://www.tutorialrepublic.com/lib/images/javascript-illustration.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['name'] ?></h5>
            <p class="card-text"><?php echo $row['description'] ?></p>
            <a href="./course.php?course=<?php echo $row['id']?>" class="btn btn-primary">Vào học</a>
          </div>
        </div>
      <?php }
    }
      ?>
    </div>
    </div>
  </main>
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