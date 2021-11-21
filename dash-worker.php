<?php session_start();
if(isset($_SESSION["activeuser"])==false)
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Worker Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http) {});

    </script>
    <style>
        body {
            margin-top: 10px;
        }

        .h1 {
            padding-left: 20px;
        }

        .cards {
            margin-top: 80px;
        }

        .card {
            cursor: pointer;
        }

        .card:hover {
            box-shadow: 8px 8px 15px;
            transition: ease all 0.4s;
        }

        .card:active {
            transform: translate(15px, 15px);
            transition: ease all 1.2s;
        }

    </style>
    <script>
        $(document).ready(function() {
            $(".profile").click(function() {
                window.location.href = "Profile-worker-front.php";
            });

            $(".rating").click(function() {
                $("#modal-rating").modal('show');
            });

            $("#req_rating").click(function() {
                var querystring = $("#frm-rating").serialize();
                var actionurl = "ajax-req_rating.php?" + querystring;
                $.get(actionurl, function(resp) {
                    $("#status-rate").html(resp);
                });
                $("#cuid").val("");
                $("#wuid").val("");
            });
            $(".search").click(function(){
                window.location.href="search-work.php";
            });
            $(".logout").click(function(){
                location.href="logout.php";
            });
        });

    </script>
</head>

<body ng-app="mymodule" ng-controller="mycontroller">
    <div class="container-fluid">
        <div class="h1 heading bg-info">inneed.com <span>Welcome: <?php echo $_SESSION["activeuser"];?></span><button type="button" class="btn btn-danger logout" style="float:right; margin-top:5px;">Logout</button></div>
        <div class="container cards">
            <div class="card-deck ">
                <div class="card col-md-3 profile">
                    <center><img src="pics/update.png" class="card-img-top" alt="..." style="width: 250px; height: 250px; margin-top: 10px;"></center>
                    <div class="card-body">
                        <h5 class="card-title">Update Profile</h5>
                        <p class="card-text">Keep your profile uptodate</p>
                    </div>
                </div>
                <div class="card col-md-3 rating">
                    <center><img src="pics/review.png" class="card-img-top" alt="..." style="width: 250px; height: 250px; margin-top: 10px;"></center>
                    <div class="card-body">
                        <h5 class="card-title">Request/Get Ratings</h5>
                        <p class="card-text">Let people know about your work quality</p>
                    </div>
                </div>
                <div class="card col-md-3 search">
                    <center><img src="pics/search.png" class="card-img-top" alt="..." ></center>
                    <div class="card-body">
                        <h5 class="card-title">Search Work</h5>
                        <p class="card-text">Find the work you are specialized in</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  post work -->
    <div class="modal fade" id="modal-rating" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Request Rating</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-rating">

                        <div class="form-group">
                            <label for="cuid">Citizen UserID</label>
                            <input type="txt" class="form-control" name="cuid" id="cuid">
                            <span id="errcuid" class="form-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="wuid">Worker UserID</label>
                            <input type="text" class="form-control" ng-model="woid" ng-init="woid='<?php echo $_SESSION["activeuser"]?>'" name="wuid" readonly id="wuid">
                            <span id="errwuid" class="form-text"></span>
                        </div>

                        <div id="status-rate" style="display: inline-block;"></div>
                        <center><button type="button" class="btn btn-success" id='req_rating'>Send Request</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
