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
    <title>Citizen Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <style>
        body {
            margin-top: 10px;
        }

        .h1 {
            padding-left: 20px;
        }

        .heading {
            margin-bottom: 80px;
        }

        .card {
            cursor: pointer;
        }

        .card:hover {
            box-shadow: 15px 15px 15px;
            transition: ease all 0.2s;
        }

        .card:active {
            transform: translate(15px, 15px);
            transition: ease all 1.2s;
        }

        .data,.data1 {
            display: none;
        }
        .stars span{
            font-size:200%;
        }
        .stars span:hover{
            color: yellow;
            cursor: pointer;
        }
        body{
            background-image: url(pics/grey_wash_wall.png);
            background-repeat: repeat;
        }
    </style>
    <script>
        $(document).ready(function() {
            $(".profile").click(function() {
                window.location.href = "Profile-citizen-front.php";
            });

            $(".work").click(function() {
                $("#modal-work").modal('show');
            });

            $(".requirement").click(function() {
                $("#modal-requirement").modal("show");
            });

            $("#postwork").click(function() {
                var querystring = $("#frm-work").serialize();
                var actionurl = "ajax-postwork.php?" + querystring;
                $.get(actionurl, function(resp) {
                    $("#status-work").html(resp);
                    $("#uid").val("");
                    //                    $("#category").selected=0; error
                    $("#prob").val("");
                    $("#pos").val("");
                    $("#city").val("");
                });
            });

            $(".search").click(function() {
                window.location.href = "worker-search.php";
            });

            $(".rate").click(function() {
                $("#modal-rateme").modal("show");
            });
            
            $(".logout").click(function(){
                location.href="logout.php";
            });
        });

    </script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http) {
            $scope.reqAry;
            $scope.fetchreq = function() {
                $http.get("JSON-fetch-requirement.php?uid=" + $scope.uid).then(ok, notok);

                function ok(resp) {
                    $scope.reqAry = resp.data;
                    if ($scope.reqAry.length == 0) {
                        $scope.msg = "No requirements posted";
                        return;
                    }
                    $(".data").css("display", "block");

                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
            
            $scope.dodel = function(rid, i) {
                $http.get("delete-work-from-requirements.php?rid=" + rid).then(ok, notok);

                function ok(resp) {
                    $scope.reqAry.splice(i, 1);
                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
            
            $scope.fetchrating = function() {
                $http.get("JSON-fetch-ratigs.php?uid=" + $scope.uid).then(ok, notok);

                function ok(resp) {
                    $scope.ratingAry = resp.data;
                    if ($scope.ratingAry.length == 0) {
                        $scope.rating_msg = "No requests available";
                        return;
                    }
                    $(".data1").css("display", "block");

                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
            
            $scope.r=function(val,indx){
                for(i=1;i<=5;i++)
                    {
                        var id="r"+i+indx;
                        $("#"+id).css("color","");
                    }
                $scope.rate=val;
                for(i=1;i<=val;i++)
                    {
                        var id="r"+i+indx;
                        $("#"+id).css("color","yellow");
                    }
            }
            
            $scope.sendrating=function(obj,i){
                $http.get("set-worker-rating.php?uid="+obj.workeruid+"&rate="+$scope.rate).then(ok,notok);
                function ok(resp){
                    alert(resp.data);
                }
                function notok(resp){
                    alert(resp.data);
                }
                
                $http.get("delete-entry-from-ratings.php?rid=" + obj.rid).then(ok, notok);

                function ok(resp) {
                    $scope.ratingAry.splice(i,1);
                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
        });

    </script>
</head>

<body ng-app="mymodule" ng-controller="mycontroller">
    <div class="container-fluid">
        <div class="h1 heading bg-info">inneed.com <span>Welcome: <?php echo $_SESSION["activeuser"];?></span><button type="button" class="btn btn-danger logout" style="float:right; margin-top:5px;">Logout</button></div>
        <div class="container">
            <div class="row row-cols-md-4">
                <div class="col mb-3">
                    <div class="card profile">
                        <center><img src="pics/update.png" class="card-img-top" alt="..."></center>
                        <div class="card-body">
                            <h5 class="card-title">Update Profile</h5>
                            <p class="card-text">Keep your profile uptodate</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card work">
                        <center><img src="pics/maintenance.png" class="card-img-top" alt="..."></center>
                        <div class="card-body">
                            <h5 class="card-title">Post Work</h5>
                            <p class="card-text">What work do you have</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card requirement">
                        <center><img src="pics/checklist.png" class="card-img-top" alt="..."></center>
                        <div class="card-body">
                            <h5 class="card-title">Requirement Manager</h5>
                            <p class="card-text">Post your pending work here</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card search">
                        <center><img src="pics/search.png" class="card-img-top" alt="..."></center>
                        <div class="card-body">
                            <h5 class="card-title">Search Worker</h5>
                            <p class="card-text">Find the worker whose services you want</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card rate">
                        <center><img src="pics/review.png" class="card-img-top" alt="..."></center>
                        <div class="card-body">
                            <h5 class="card-title">Rate the worker</h5>
                            <p class="card-text">Rate the worker to increase their popularity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal  post work -->
        <div class="modal fade" id="modal-work" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="staticBackdropLabel">Post Requirement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-work">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="uid">UserID</label>
                                    <input type="txt" class="form-control" ng-model="postwork" ng-init="postwork='<?php echo $_SESSION["activeuser"];?>'" disabled name="uid" id="uid">
                                    <span id="erruid" class="form-text"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">Category</label>
                                    <select id="category" name="category" class="form-control">
                                        <option>---select---</option>
                                        <option>Carpenter</option>
                                        <option>Electrician</option>
                                        <option>Plumber</option>
                                        <option>Painter</option>
                                        <option>Internet Services</option>
                                        <option>AC Services</option>
                                        <option>RO Services</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="prob">Problem/Fault</label>
                                <input type="text" class="form-control" name="prob" id="prob">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="pos">Location of Task</label>
                                    <input type="text" class="form-control" name="pos" id="pos">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city">
                                </div>
                            </div>
                            <div id="status-work" style="display: inline-block;"></div>
                            <center><button type="button" class="btn btn-success" id='postwork'>Post Work</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal  requirement -->
        <div class="modal fade" id="modal-requirement" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="staticBackdropLabel">Manage Your Requirements</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="uid">UserID</label>
                            <input type="txt" class="form-control" disabled ng-model="uid" ng-init="uid='<?php echo $_SESSION["activeuser"]?>'">
                        </div>
                        <div id="status-login"></div>
                        <center><button type="button" class="btn btn-success" ng-click="fetchreq();">Fetch Requirements</button><br><br></center>
                        {{msg}}
                        <div class="data">
                            <table border="1" width="475">
                                <tr bgcolor="gray">
                                    <th>SNo.</th>
                                    <th>Category</th>
                                    <th>Problem</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                                <tr ng-repeat="obj in reqAry">
                                    <td>{{$index+1}}</td>
                                    <td>{{obj.category}}</td>
                                    <td>{{obj.problem}}</td>
                                    <td>{{obj.location}}</td>
                                    <td align="center"><input type="button" value="Delete" class="btn btn-danger" ng-click="dodel(obj.rid,$index);"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal  rate worker -->
        <div class="modal fade" id="modal-rateme" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="staticBackdropLabel">Rate the Worker</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="uid">UserID</label>
                            <input type="txt" class="form-control" disabled ng-model="uid" ng-init="uid='<?php echo $_SESSION["activeuser"]?>'">
                        </div>
                        <div id="status-login"></div>
                        <center><button type="button" class="btn btn-success" ng-click="fetchrating();">Fetch Rating Requests</button><br><br></center>
                        {{rating_msg}}
                        <div class="data1">
                            <table border="1" width="475">
                                <tr bgcolor="gray">
                                    <th>SNo.</th>
                                    <th>Worker ID</th>
                                    <th>Rate ME</th>
                                    <th>Post Rating</th>
                                </tr>
                                <tr ng-repeat="obj in ratingAry">
                                    <td>{{$index+1}}</td>
                                    <td>{{obj.workeruid}}</td>
                                    <td class="stars">
                                    <span id="r1{{$index}}" ng-click="r(1,$index);">&starf;</span>
                                    <span id="r2{{$index}}" ng-click="r(2,$index);">&starf;</span>
                                    <span id="r3{{$index}}" ng-click="r(3,$index);">&starf;</span>
                                    <span id="r4{{$index}}" ng-click="r(4,$index);">&starf;</span>
                                    <span id="r5{{$index}}" ng-click="r(5,$index);">&starf;</span>
                                    </td>
                                    <td align="center"><input type="button" value="Rate" class="btn btn-warning" ng-click="sendrating(obj,$index);"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</body>

</html>
