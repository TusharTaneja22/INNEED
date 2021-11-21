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
        #btns{
            margin-bottom: 50px;
        }
    </style>
     <script>
        $(document).ready(function() {

            $("#profile").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#prevprofile').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $("#apic").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#prevapic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            //        =======JSON=======
        $("#btnFetchProfile").click(function(){
            var uid=$("#uid").val();
            var url="json-fetch-worker-profile.php?userid="+uid;
            $.getJSON(url,function(resp){
//                alert(JSON.stringify(resp));
                if(resp.length==0)
                    alert("Invalid ID");
                else
                    {
                        $("#cname").val(resp[0].wname);
                        $("#mob").val(resp[0].cnumber);
                        $("#mail").val(resp[0].email);
                        $("#fname").val(resp[0].firmshop);
                        $("#city").val(resp[0].city);
                        $("#address").val(resp[0].address);            
                        $("#state").val(resp[0].state);
                        $("#category").val(resp[0].category);
                        $("#spc").val(resp[0].spl);
                        $("#exp").val(resp[0].exp);
                        $("#pwork").val(resp[0].otherinfo);
                        $("#prevprofile").attr("src","uploads/"+resp[0].ppic);
                        $("#prevapic").attr("src","uploads/"+resp[0].apic);
						$("#hdnp").val(resp[0].ppic);
						$("#hdna").val(resp[0].apic);
                    }
            });
        });
        });
    </script>
</head>
<body>
   <div class="container">
       <div class="heading bg-info">
            <h1>My Profile</h1>
        </div>
        <form action="worker-profile-submit.php" method="post" enctype="multipart/form-data">
           <input type="hidden" id="hdnp" name="hdnp">
           <input type="hidden" id="hdna" name="hdna">
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="uid">User ID</label>
                    <input type="text" class="form-control" readonly name="uid" id="uid" value="<?php session_start();echo $_SESSION["activeuser"]?>">
                    <span id="erruid"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="">&nbsp;</label>
                    <input type="button" id="btnFetchProfile" class="form-control btn btn-secondary" value="Fetch Profile">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cname">Name</label>
                    <input type="text" class="form-control" id="cname" name="cname">
                    <span></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="mob">Contact Number</label>
                    <input type="text" maxlength="10" class="form-control" id="mob" name="mob">
                    <span></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="mail">Email ID</label>
                    <input type="text" class="form-control" id="mail" name="mail">
                    <span></span>
                </div>
            </div>            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">Firm/Shop Name</label>
                    <input type="text" name="fname" class="form-control" id="fname">
                    <span></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                    <span></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
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
                <div class="form-group col-md-6">
                    <label for="spc">Specialization</label>
                    <input type="text" class="form-control" id="spc" name="spc">
                    <span></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exp">Experience</label>
                    <select id="exp" name="exp" class="form-control">
                        <option>---select---</option>
                        <option>Less than 1 year</option>
                        <option>1-2 year</option>
                        <option>2-4 year</option>
                        <option>4 and above</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="pwork">Previous Works</label>
                    <textarea name="pwork" class="form-control" id="pwork" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pic">Upload Pic</label>
                    <input type="file" name="profile" accept="image/*" class="form-control" id="profile">
                    <span></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="apic">Aadhar Card Pic</label>
                    <input type="file" name="apic" accept="image/*" class="form-control" id="apic">
                    <span></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <img src="" alt="" id="prevprofile" style="width: 100px;height: 100px; display: block;">
                </div>
                <div class="form-group col-md-6">
                    <img src="" alt="" id="prevapic" style="width: 100px;height: 100px; display: block;">
                </div>
            </div>
            <div id="btns">
                <center>
                    <input type="submit" value="Submit" name="btn" class="btn btn-success" style="width:150px">
                    <input type="submit" value="Update" name="btn" class="btn btn-success" style="width:150px">
                </center>
            </div>
        </form>
   </div>
    
</body>
</html>