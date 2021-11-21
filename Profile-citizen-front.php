<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }

        .heading {
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
    <script>
        $(document).ready(function() {

            $("#pic").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#prev').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            //        =======JSON=======
        $("#btnFetchProfile").click(function(){
            var uid=$("#uid").val();
            var url="json-fetch-profile.php?userid="+uid;
            $.getJSON(url,function(resp){
//                alert(JSON.stringify(resp));
                if(resp.length==0)
                    alert("Invalid ID");
                else
                    {
                        $("#cname").val(resp[0].name);
                        $("#mob").val(resp[0].contact);
                        $("#address").val(resp[0].address);
                        $("#city").val(resp[0].city);
                        $("#state").val(resp[0].state);
                        $("#mail").val(resp[0].email);
                        $("#prev").attr("src","uploads/"+resp[0].pic);
						$("#hdn").val(resp[0].pic);
                    }
            });
        });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="heading bg-info">
            <h1>Profile</h1>
        </div>
        <form action="profile-submit.php" method="post" enctype="multipart/form-data">
           <input type="hidden" id="hdn" name="hdn">
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="uid">User ID</label>
                    <input type="text" class="form-control" disabled id="uid" value="<?php session_start();echo $_SESSION["activeuser"]?>">
                    <span id="erruid"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="">&nbsp;</label>
                    <input type="button" id="btnFetchProfile" class="form-control btn btn-secondary" value="Fetch Profile">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cname">Name</label>
                    <input type="text" class="form-control" id="cname" name="cname">
                    <span></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="mob">Contact Number</label>
                    <input type="text" maxlength="10" class="form-control" id="mob" name="mob">
                    <span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address">
                <span></span>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                    <span></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="state">State</label>
                    <select id="state" name="state" class="form-control">
                        <option>---select---</option>
                        <option>Andhra Pradesh</option>
                        <option>Arunachal Pradesh</option>
                        <option>Assam</option>
                        <option>Bihar</option>
                        <option>Chhattisgarh</option>
                        <option>Goa</option>
                        <option>Gujarat</option>
                        <option>Haryana</option>
                        <option>Himachal Pradesh</option>
                        <option>Jammu and Kashmir</option>
                        <option>Jharkhand</option>
                        <option>Karnataka</option>
                        <option>Kerala</option>
                        <option>Madhya Pradesh</option>
                        <option>Maharashtra</option>
                        <option>Manipur</option>
                        <option>Meghalaya</option>
                        <option>Mizoram</option>
                        <option>Nagaland</option>
                        <option>Odisha</option>
                        <option>Punjab</option>
                        <option>Rajasthan</option>
                        <option>Sikkim</option>
                        <option>Tamil Nadu</option>
                        <option>Telangana</option>
                        <option>Tripura</option>
                        <option>Uttarakhand</option>
                        <option>uttar Pradesh</option>
                        <option>West Bengal</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pic">Upload Pic</label>
                    <input type="file" name="profile" accept="image/*" class="form-control" id="pic">
                    <span></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="mail">Email ID</label>
                    <input type="text" class="form-control" id="mail" name="mail">
                    <span></span>
                </div>
            </div>
            <div class="col-md-4">
                <img src="" alt="" id="prev" style="width: 100px;height: 100px; display: block;">
            </div>
            <div>
                <center>
                    <input type="submit" value="Submit" name="btn" class="btn btn-success" style="width:150px">
                    <input type="submit" value="Update" name="btn" class="btn btn-success" style="width:150px">
                </center>
            </div>
        </form>
    </div>
</body></html>
