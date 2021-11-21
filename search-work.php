<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Work</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <style>
        .data{
            display: none;
        }
        .pic img {
            border-radius: 75px;
        }
    </style>
    <script>
        var mmodule = angular.module("mymodule", []);
        mmodule.controller("workerController", function($scope, $http) {
            $scope.categoryAry;
            $scope.selected;
            $scope.fetchCategory = function() {
                $http.get("JSON-fetch-cat-and-city-req.php").then(ok, notok);

                function ok(resp) {
                    $scope.categoryAry = resp.data;
                    $scope.selObj = $scope.categoryAry[0];
                    $scope.selCity = $scope.categoryAry[0];
                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
            $scope.fetchSelected = function() {
                $http.get("JSON-fetch-selected-work.php?cat=" + $scope.selObj.category + "&city=" + $scope.selCity.city).then(ok, notok);

                function ok(resp) {
                    $scope.selected = resp.data;
                    if($scope.selected.length==0){
                        $scope.ans="No data Found";
                        return;
                    }
                    $(".data").css("display","block");
                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
            $scope.showdetails=function(uid){
                $http.get("JSON-fetch-citzendata-for-worker.php?uid="+uid).then(ok,notok);
                function ok(resp){
                    $scope.citizendata=resp.data;
                    $("#citizendetail").modal("show");
                }
                function notok(resp){
                    alert(resp.data);
                }
            }

        });
    </script>
</head>

<body ng-app="mymodule" ng-controller="workerController" ng-init="fetchCategory();">
    <div class="container-fluid">
        <div class="h1 bg-info">inneed.com</div>
        <center>
            <br>
            <span>Select Category</span>
            <select ng-model="selObj" ng-options="obj.category for obj in categoryAry">
            </select><br><br>
            <span>Select City</span>
            <select ng-model="selCity" ng-options="obj.city for obj in categoryAry"></select>
            <br><br>
            <div class="btn btn-dark" ng-click="fetchSelected();">Search Work</div>
        </center>
    </div>
    <br><br>
    <center>
       {{ans}}
        <div class="data">
            <table border="1" width="475">
                <tr bgcolor="gray">
                    <th>SNo.</th>
                    <th>Problem</th>
                    <th>Location</th>
                    <th>Deatils</th>
                </tr>
                <tr ng-repeat="obj in selected">
                    <td>{{$index+1}}</td>
                    <td>{{obj.problem}}</td>
                    <td>{{obj.location}}</td>
                    <td align="center"><input type="button" class="btn btn-success" value="More Details" ng-click="showdetails(obj.cust_uid);"></td>
                </tr>
            </table>
        </div>
    </center>
    
    
<!--------  citizen detail modal----->
    <div class="modal fade" id="citizendetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-model="citizendata">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Citizen Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="pic">
                            <img src="uploads/{{citizendata[0].pic}}" alt="" height='125' width="125">
                        </div>
                        <hr>
                        Name: {{citizendata[0].name}}
                        <hr>
                        Contact: {{citizendata[0].contact}}
                        <hr>
                        Address: {{citizendata[0].address}}
                    </center>
                </div>
            </div>
        </div>
    </div>

</body></html>