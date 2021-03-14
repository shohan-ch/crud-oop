<?php
include_once ("classes/Session.php");
Session::int();
Session::sessionCheck("login");
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

    <?php // $database = new Database();?>
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

                    <?php
        

          $login = Session::sessionGet('login');
          if(isset($login)){ 
          
          ?>

                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true" data-toggle="modal"
                            data-target="#logoutModal">Log Out</a>
                    </li>

                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                    <form action="" method="POST">
                                    <button  type="submit" name="logout-btn" class="btn btn-primary">Log out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
          

}else{ ?>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#" data-toggle="modal"
                            data-target="#exampleModa2">Login</a>
                    </li>

                    <?php
}
?>


                </ul>
            </div>
        </div>
    </nav>



    <?php  
    if(isset($_POST['logout-btn'])){
        Session::destroy();
    }
    
    ?>


 <?php
echo Session::sessionGet("success")."<br>". Session::sessionGet("email")."<br>". Session::sessionGet("login_email") ;
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>

</body>