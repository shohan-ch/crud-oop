<?php
spl_autoload_register(function($class){
  include "classes/$class.php";

})

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Title</title>
</head>

<body>

<?php $database = new Database();?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Login system</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#" data-toggle="modal"
              data-target="#exampleModal">Register</a>
          </li>    
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#" data-toggle="modal" data-target="#exampleModa2">Login</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Register Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <label for="Email">Email: </label>
            <input type="text" name="email" class="form-control" id="email">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control" id="password">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="register-btn">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
if(isset($_POST['register-btn'])){
$database->insert('register',$_POST);
}
?>


  <!-- Login Modal -->
  <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <label for="Email">Email: </label>
            <input type="text" name="email" class="form-control" id="email">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control" id="password">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="login-btn">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
if(isset($_POST['login-btn'])){
  /*
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $result = $database->login($email,$pass);
  */
  $result = $database->login($_POST);
  


  
}
?>





<div class="container">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Pass</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
<?php
$result = $database->selectAll('register');
$i = 0;
foreach ($result as $row){
$i++;
?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $row['email']?></td>
          <td><?php echo $row['pass']?></td>
          <td>
            <!-----------------------------------######################################################################---------------->
            <form action="index.php" method="POST">
              <input type="hidden" name="id" value="<?php  echo $row['id'] ?>">
              <button class="btn btn-info edit-btn" id="<?php echo $row['id']?>" name="edit-btn">Edit</button>
            </form>
          </td>
        </tr>
        <?php  
  }
  ?>
      </tbody>
    </table>

  
    <?php
    if(isset($_POST["edit-btn"])){
      echo '<div id="edit-form" class="bg-warning mx-auto p-4 w-75">';
      echo"<h2>Update User</h2>";
      $id= $_POST['id'];
      $result = $database->selectByid('register',$id);
      foreach($result as $row){
        $id = $row['id'];
        $email = $row['email'];
        $pass  = $row['pass'];

        ?>
    <form action="" method="POST">
      <input type="hidden" name="update-id" value="<?php echo $id?>">
      <label for="Email">Email: </label>
      <input type="text" name="email" class="form-control" id="email" value="<?php echo $email?>">
      <label for="password">Password: </label>
      <input type="text" name="password" class="form-control" id="password" value="<?php echo $pass?>">
      <br>
      <button type="submit" class="btn btn-info" name="update-btn">Update</button>
      <a href="index.php" class="btn btn-danger mr-auto">Cancel</a>
    </form>
    <?php

      }
      echo" </div>";
      } 
      ?>

    <?php
          if(isset($_POST['update-btn'])){
            $id = $_POST['update-id'];
            $update= $database->updateByid('register',$id);
            if($update==true){
              echo "<p>Update success</p>";

            }
          }

 
  ?>


  </div>






  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>


  <script>
    /*
    $(document).ready(function () {


      $(".edit-btn").click(function (e) {
        // e.preventDefault();
        //   $("#edit-form").css("display","block");

        //  var editid = $(this).attr("id");
        /// alert(editid);
        // $('#editModel').modal('hide');




      })
    })
    */
  </script>
</body>

</html>