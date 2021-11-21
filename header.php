<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#signup").click(function() {
                var querystring = $("#frm-signup").serialize();
                var actionurl = "ajax-signup.php?" + querystring;
                $.get(actionurl, function(resp) {
                    $("#status-signup").html(resp);
                });
            });
            $("#login").click(function() {
                var querystring = $("#frm-login").serialize();
                var actionurl = "ajax-login.php?" + querystring;
                $.get(actionurl, function(resp) {
                    if (resp == "Admin") {
                        location.href = "admin-dash.php";
                    } else if (resp == "Citizen") {
                        location.href = "Profile-citizen-front.php";
                    } else if (resp == "Worker") {
                        location.href = "Profile-worker-front.php";
                    } else
                        $("#status-login").html(resp);
                });
            });
            $("#getpwd").click(function() {
                var uid = $("#fuid").val();
                var actionurl = "ajax-getpwd.php?uid=" + uid;
                $.get(actionurl, function(resp) {
                    $(".status-forgot").html(resp);
                });
            });
            $('#modal_forgot').on('show.bs.modal', function() {
                //            alert();
                $('#modal_login').modal('hide');
            });
        });

    </script>
    
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <a class="navbar-brand" href="#"><img src="pics/logo.png" width="50" height="50" alt="" loading="lazy">inneed.com</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Our Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About US</a>
                    </li>
                </ul>
                <button class="btn btn-lg btn-outline-danger my-2 my-sm-0 btn1" type="button" data-toggle="modal" data-target="#modal_login">Login</button>
                <button class="btn btn-lg btn-outline-danger my-2 my-sm-0 btn1" type="button" data-toggle="modal" data-target="#modal_signup">SignUp</button>
            </div>
        </nav>
