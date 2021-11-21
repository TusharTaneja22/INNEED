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
        $(document).ready(function() {
            $(".users").click(function() {
                $("#modal-users").modal("show");
            });
            
            $(".logout").click(function(){
                location.href="logout.php";
            });
        });

    </script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http) {
            $scope.fetchusers=function(){
                $http.get("JSON-fetch user.php?cat="+$scope.cat).then(ok,notok);
                function ok(resp){
//                    alert(JSON.stringify(resp.data));
                    $scope.userary=resp.data;
                    $(".data").css("display","block");
                }
                function notok(resp){
                    alert(resp.data);
                }
                
            }
            
            $scope.doblock=function(uid){
                $http.get("block-user.php?uid="+uid).then(ok,notok);
                function ok(resp){
                    alert(resp.data);
                }
                function notok(resp){
                    alert(resp.data);
                }
            }
            
            $scope.doresume=function(uid){
                $http.get("unblock-user.php?uid="+uid).then(ok,notok);
                function ok(resp){
                    alert(resp.data);
                }
                function notok(resp){
                    alert(resp.data);
                }
            }
            
            $scope.dodel=function(uid){
                $http.get("delete-user.php?uid="+uid).then(ok,notok);
                function ok(resp){
                    alert(resp.data);
                }
                function notok(resp){
                    alert(resp.data);
                }
            }
        });

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
        .data{
            display: none;
        }
        td{
            text-align: center;
        }
    </style>

</head>

<body ng-app="mymodule" ng-controller="mycontroller">
    <div class="container-fluid">
        <div class="h1 heading bg-info">inneed.com <span>Welcome: ADMIN</span><button type="button" class="btn btn-danger logout" style="float:right; margin-top:5px;">Logout</button></div>
        <div class="container cards">
            <div class="card-deck ">
                <div class="card col-md-3 users">
                    <center><img src="pics/work.png" class="card-img-top" alt="..."></center>
                    <div class="card-body">
                        <h5 class="card-title">User Manager</h5>
                        <p class="card-text">Manage status of all your users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  requirement -->
    <div class="modal fade" id="modal-users" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Manage All Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="category">Category</label>
                            <select id="category" ng-model="cat" class="form-control">
                                <option>Citizen</option>
                                <option>Worker</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">&nbsp;</label>
                            <input type="button" ng-click="fetchusers();" class="form-control btn btn-secondary" value="Fetch Data">
                        </div>
                    </div>
                        
                    <div class="data">
                        <table border="1" class="table table-striped">
                           <thead>
                            <tr bgcolor="gray">
                                <th>SNo.</th>
                                <th>UID</th>
                                <th>Mobile</th>
                                <th>Joined</th>
                                <th>Status</th>
                                <th>Block</th>
                                <th>Unblock</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <br>
                            <tbody>
                            <tr ng-repeat="obj in userary">
                                <td>{{$index+1}}</td>
                                <td>{{obj.uid}}</td>
                                <td>{{obj.mobile}}</td>
                                <td>{{obj.dos}}</td>
                                <td>{{obj.status}}</td>
                                <td><input type="button" value="Block" class="btn btn-dark" ng-click="doblock(obj.uid);"></td>
                                <td><input type="button" value="Unblock" class="btn btn-success" ng-click="doresume(obj.uid);"></td>
                                <td><input type="button" value="Delete" class="btn btn-danger" ng-click="dodel(obj.uid);"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
