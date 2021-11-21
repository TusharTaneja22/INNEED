<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>INNEED</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style>
        body {
            margin-top: 5px;
        }

        .btn1 {
            margin-right: 10px;
        }

        #signup {
            margin-top: 15px;
        }

        #login {
            margin-top: 10px;
        }

    </style>
    <script>
        $(document).ready(function() {
            $("#signup").click(function() {
                var querystring = $("#frm-signup").serialize();
                var actionurl = "ajax-signup.php?" + querystring;
                $.get(actionurl, function(resp) {
                    $("#status-signup").html(resp);
                    $('#modal_signup').modal('hide');
                    $('#modal_login').modal('show');
                    
                });
            });
            $("#login").click(function() {
                var querystring = $("#frm-login").serialize();
                var actionurl = "ajax-login.php?" + querystring;
                $.get(actionurl, function(resp) {
                    if (resp == "Admin") {
                        location.href = "admin-dash.php";
                    } else if (resp == "Citizen") {
                        $.get("ajax-check-citizen.php?"+querystring,function(resp){
                            if(resp=="0")
                                {
                                    location.href="Profile-citizen-front.php";
                                }
                            else{
                                location.href="dash-citizen.php";
                            }
                        });
                    } else if (resp == "Worker") {
                        $.get("ajax-check-worker.php?"+querystring,function(resp){
                            if(resp=="0")
                                {
                                    location.href = "Profile-worker-front.php";
                                }
                            else{
                                location.href="dash-worker.php";
                            }
                        });
                        
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
    <style>
        #caro {
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .heading span {
            display: block;
            text-transform: uppercase;
            transform: skew(14deg);
        }

        .heading {
            background: #000;
            border-right: 6px solid deepskyblue;
            height: 60px;
            color: #fff;
            display: inline-block;
            font-size: 36px;
            line-height: 42px;
            padding: 10px 20px;
            transform: skew(-14deg);
            margin-left: 28vw;
            margin-bottom: 40px;
        }

        .heading1 span {
            display: block;
            text-transform: uppercase;
            transform: skew(14deg);
        }

        .heading1 {
            background: #000;
            border-right: 6px solid deepskyblue;
            height: 60px;
            color: #fff;
            display: inline-block;
            font-size: 36px;
            line-height: 42px;
            padding: 10px 20px;
            transform: skew(-14deg);
            margin-left: 25vw;
            margin-bottom: 40px;
        }
          .heading3 span {
            display: block;
            text-transform: uppercase;
            transform: skew(14deg);
        }

        .heading3 {
            background: #000;
            border-right: 6px solid deepskyblue;
            height: 60px;
            color: #fff;
            display: inline-block;
            font-size: 36px;
            line-height: 42px;
            padding: 10px 20px;
            transform: skew(-14deg);
            margin-left: 45vw;
            margin-bottom:40px;
        }
        #cd {
            border: 2px solid black;
        }

        #cd:hover {
            box-shadow: 15px 15px 15px black;
            animation-name: tilt;
            animation-duration: 2s;
        }

        @keyframes tilt {
            0% {
                transform: rotate(0);
                transition: ease all 1s;
            }

            25% {
                transform: rotate(10deg);
                transition: ease all 1s;
            }

            50% {
                transform: rotate(-10deg);
                transition: ease all 1s;
            }

            100% {
                transform: rotate(0);
                transition: ease all 1s;
            }
        }

        body {
            background-image: url(pics/grey_wash_wall.png);
            background-repeat: repeat;
        }

        #dev {
            margin-top: 50px;
        }

       

        footer {
            margin-top: 50px;
        }
        @media(max-width:375px){
            .heading span,.heading1 span,.heading3 span{
                font-size: 18px;
            }
            .heading{
                margin-left: -10px;
            }
        }
    </style>

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
                        <a class="nav-link" href="#dev">About US</a>
                    </li>
                </ul>
                <button class="btn btn-lg btn-outline-danger my-2 my-sm-0 btn1" type="button" data-toggle="modal" data-target="#modal_login">Login</button>
                <button class="btn btn-lg btn-outline-danger my-2 my-sm-0 btn1" type="button" data-toggle="modal" data-target="#modal_signup">SignUp</button>
            </div>
        </nav>


        <div id="caro">
            <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="pics/img1.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="pics/img2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="pics/img3.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div id="services">
            <div class="heading">
                <span>Our Features</span>
            </div>
            <div class="card-deck">
                <div class="card" id="cd">
                    <img src="pics/worker.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Worker Search</h5>
                        <p class="card-text">Search the worker you need</p>
                    </div>
                </div>
                <div class="card" id="cd">
                    <img src="pics/job.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Get Work</h5>
                        <p class="card-text">Choose your work in which you are specialized.</p>
                    </div>
                </div>
                <div class="card" id="cd">
                    <img src="pics/postwork.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Post Work</h5>
                        <p class="card-text">If you can't find ant worker, post your work to be seen by the workers.</p>
                    </div>
                </div>
                <div class="card" id="cd">
                    <img src="pics/customer.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rate Worker</h5>
                        <p class="card-text">Rate the worker according to their work.</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="dev">
            <div class="heading1">
                <span>Meet the Developers</span>
            </div>

            <div class="card mb-3" style="float:left;margin-right:20px;max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="pics/me.jpeg" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Chetan Bansal</h5>
                            <p class="card-text">Currently pursuing Computer Engineering At Thapar University</p>
                            <p class="card-text"><small class="text-muted"><a href="https://www.linkedin.com/in/chetan-bansal-808221192">Full Stack Developer</a></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="pics/mentor.PNG" class="card-img" alt="..." height="190">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Rajesh Bansal</h5>
                            <p class="card-text">My mentor who guided me along the project.</p>
                            <p class="card-text"><small class="text-muted">Mentor, <a href="http://www.realjavaonline.com/">Banglore Computer Education</a></small></p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>


    <!-- Modal  signup -->
    <div class="modal fade" id="modal_signup" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">SignUp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-signup">
                        <div class="form-group">
                            <label for="uid">UserID</label>
                            <input type="txt" class="form-control" name="uid" id="uid">
                            <span id="erruid" class="form-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" name="pwd" id="pwd">
                            <span id="errpwd" class="form-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="text" maxlength="10" name="mobile" class="form-control" id="mobile">
                            <span id="errmobile" class="form-text"></span>
                        </div>
                        <div class="from-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category">
                                <option>Select</option>
                                <option>Worker</option>
                                <option>Citizen</option>
                            </select>
                            <span id="errmobile" class="form-text"></span>
                        </div>
                        <div id="status-signup"></div>
                        <button type="button" class="btn btn-success" id='signup'>SignUp</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  login -->
    <div class="modal fade" id="modal_login" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-login">
                        <div class="form-group">
                            <label for="uid">UserID</label>
                            <input type="txt" class="form-control" name="luid" id="luid">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" name="lpwd" id="lpwd">
                        </div>
                        <div class="forgot"><a href="" data-toggle="modal" data-target="#modal_forgot">Forgot Password?</a></div>
                        <div id="status-login"></div>
                        <button type="button" class="btn btn-success" id='login'>Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  forgot -->
    <div class="modal fade" id="modal_forgot" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="uid">Username</label>
                            <input type="txt" class="form-control" name="fuid" id="fuid">
                        </div>
                        <button type="button" class="btn btn-success" id='getpwd'>Get Password</button>
                        <div class="status-forgot"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
<div><span class="heading3">Reach Us</span></div>
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4595.76199775283!2d76.36069368624743!3d30.35289783172467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39102f534a87b5c5%3A0xda1d3ed337e382b3!2sThapar%20University%2C%20Prem%20Nagar%2C%20Patiala%2C%20Punjab%20147004!5e0!3m2!1sen!2sin!4v1594747468966!5m2!1sen!2sin" width="700" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div><marquee behavior="alternate"><font color="black" size="6">Copyrights © by Chetan</font></marquee></div>
    </footer>
</body>

</html>
