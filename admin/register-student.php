<?php
    session_start();
    include('../includes/dbconn.php');
    if(isset($_POST['submit']))
    {
    $regno=$_POST['regno'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $course=$_POST['course'];
    $gender=$_POST['gender'];
    $contactno=$_POST['contact'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $emailid=$_POST['email'];
    $password=$_POST['password'];
    $password = md5($password);
    $query="INSERT into userRegistration(regNo,firstName,lastName,course,gender,contactNo,city,state,email,password) values(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('sssssissss',$regno,$fname,$lname,$course,$gender,$contactno,$city,$state,$emailid,$password);
    $stmt->execute();
        echo"<script>alert('Student has been Registered!');</script>";
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/iitil.png">
    <title>Hostel Management System</title>
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script type="text/javascript">
    function valid(){
        if(document.registration.password.value!= document.registration.cpassword.value)
    {
        alert("Password and Confirm Password does not match");
        document.registration.cpassword.focus();
        return false;
    }
        return true;
    }
    </script>
    
</head>

<body>
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <!-- Main wrappe pages.scss -->
    
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        
        <!-- Topbar heade pages.scss -->
        
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>
        
        <!-- End Topbar header -->
        
        
        <!-- Left Sideba sidebar.scss  -->
        
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
            
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Student Registration Form</h2>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="container-fluid">

                <form method="POST" name="registration" onSubmit="return valid();">

                    <div class="row">


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">First Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" placeholder="Enter First Name" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Last Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="lname" id="lname" placeholder="Enter Last Name" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Roll Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="regno" placeholder="Enter Roll Number" id="regno" onBlur="checkAvailabilityr()" class="form-control" required>
                                            <span id="roll-availability-status" style="font-size:12px;"></span>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>

                        
 


                        <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Course Enrolled</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" name="course" id="unit" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                            <option selected>Select...</option>
                                            <?php $query ="SELECT * FROM courses";
                                            $stmt2 = $mysqli->prepare($query);
                                            $stmt2->execute();
                                            $res=$stmt2->get_result();
                                            while($row=$res->fetch_object())
                                            {
                                            ?>
                                            <option value="<?php echo $row->course_sn;?>"> <?php echo $row->course_sn;?></option>
                                            <?php } ?>
                                            </select>
                                    </div>
                              
                            </div>
                        </div>
                    </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gender</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="gender" name="gender" required="required">
                                                <option selected>Choose...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                        <div class="form-group">
                                            <input type="number" name="contact" id="contact" placeholder="Your Contact" required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">City/Village</h4>
                                        <div class="form-group">
                                            <input type="text" name="city" id="lname" placeholder="Enter City" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">State</h4>
                                        <div class="form-group">
                                            <input type="text" name="state" id="lname" placeholder="Enter State" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email ID</h4>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="Your Email" onBlur="checkAvailability()" required="required" class="form-control">
                                            <span id="user-availability-status" style="font-size:12px;"></span>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Password</h4>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Enter Password" required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Confirm Password</h4>
                                        <div class="form-group">
                                            <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirmation Password" required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>



                    </div>
                

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success">Register</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                
                </form>


            </div>
            <?php include '../includes/footer.php' ?>
            
        </div>

    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>


    <script>
    function checkAvailability() {

        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'emailid='+$("#email").val(),
        type: "POST",
        success:function(data){
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
            },
                error:function ()
            {
                event.preventDefault();
                alert('error');
            }
        });
    }

    function checkAvailability() {

        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'regno='+$("#regno").val(),
        type: "POST",
        success:function(data){
            $("#roll-availability-status").html(data);
            $("#loaderIcon").hide();
            },
                error:function ()
            {
                event.preventDefault();
                alert('error');
            }
        });
}
    </script>
</body>

</html>