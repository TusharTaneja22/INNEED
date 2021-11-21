<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Worker</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var mmodule = angular.module("mymodule", []);
        mmodule.controller("workerController", function($scope, $http) {
            $scope.categoryAry;
            $scope.catselected;
            $scope.cityAry;

            $scope.fetchCategory = function() {
                $http.get("JSON-fetch-category.php").then(ok, notok);

                function ok(resp) {
                    //                    alert(JSON.stringify(resp.data));
                    $scope.categoryAry = resp.data;
                    $scope.selObj = $scope.categoryAry[0];
                }

                function notok(resp) {
                    alert(resp.data);
                }
                $http.get("JSON-fetch-city.php").then(ok1, notok1);

                function ok1(resp) {
                    //                    alert(JSON.stringify(resp.data));
                    $scope.cityAry = resp.data;
                    $scope.selCity = $scope.cityAry[0];
                }

                function notok1(resp) {
                    alert(resp.data);
                }

            }
            $scope.fetchSelected = function() {
                $http.get("Json-fetch -selected.php?category=" + $scope.selObj.category + "&city=" + $scope.selCity.city).then(ok, notok);

                function ok(resp) {
                    //                    alert(JSON.stringify(resp.data));
                    $scope.catselected = resp.data;
                    if ($scope.catselected.length == 0) {
                        $scope.answer = "Not Found";
                    }
                }

                function notok(resp) {
                    alert(resp.data);
                }
            }
            $scope.showDetails = function(obj) {
                //                alert(JSON.stringify(obj));
                $scope.seldata = obj;
                $("#modal").modal("show");
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

        .pic img {
            border-radius: 75px;
        }
        .stars-outer{
            display: inline-block;
            position: relative;
            font-family: FontAwesome;
        }
        .stars-outer:before{
            content: "\f006 \f006 \f006 \f006 \f006";
            size:1rem;
        }
        .stars-inner{
            position: absolute;
            top: 0;
            left: 0;
            white-space: nowrap;
            overflow: hidden;
            width: 50%;
        }
        .stars-inner::before{
            content: "\f005 \f005 \f005 \f005 \f005";
            color: #f8ce0b;
            size:1rem;
        }
    </style>
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
            <select ng-model="selCity" ng-options="obj.city for obj in cityAry"></select>
            <br><br>
            <div class="btn btn-dark" ng-click="fetchSelected();">Search Worker</div>
        </center>
    </div>
    <br><br>
    {{answer}}
    <div class="container">
        <div class="row">
            <div class="col-md-4" ng-repeat="obj in catselected">
                <div class="card">
                    <img src="uploads/{{obj.ppic}}" height="150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Name : {{obj.wname}}</h5>
                        <p class="card-text">Experience : {{obj.exp}}</p>
                        <p class="card-text">Specialized in : {{obj.spl}}</p>
                        Ratings : <div class="stars-outer" ng-show="{{obj.count}}">
                            <div class="stars-inner" style="width:{{obj.total/obj.count*20}}%"></div>
                        </div><br>
                        <div ng-click="showDetails(obj);" class="btn btn-primary">More Details</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----------------modal---------->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-model="seldata">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Worker Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="pic">
                            <img src="uploads/{{seldata.ppic}}" alt="" height='125' width="125">
                        </div>
                        <hr>
                        Name: {{seldata.wname}}
                        <hr>
                        Contact: {{seldata.cnumber}}
                        <hr>
                        Firm Name: {{seldata.firmshop}}
                        <hr>
                        Specialization: {{seldata.spl}}
                        <hr>
                        Experience: {{seldata.exp}}
                    </center>
                </div>
            </div>
        </div>
    </div>

</body></html>