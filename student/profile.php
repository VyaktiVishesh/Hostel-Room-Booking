<?php
    session_start();
    include('../includes/dbconn.php');
    date_default_timezone_set('America/Chicago');
    include('../includes/check-login.php');
    check_login();
    $aid=$_SESSION['id'];
    if(isset($_POST['update']))
    {

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $gender=$_POST['gender'];
    $contactno=$_POST['contact'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $udate = date('d-m-Y h:i:s', time());
    $query="UPDATE  userRegistration set firstName=?,lastName=?,city=?,state=?,gender=?,contactNo=?,updationDate=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('sssssisi',$fname,$city,$state,$lname,$gender,$contactno,$udate,$aid);
    $stmt->execute();
    echo"<script>alert('Profile updated Succssfully');</script>";
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
    <!-- CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">

    
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- Main wrapper pages.scss -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header pages.scss -->

        <header class="topbar" data-navbarbg="skin6">
            <?php include '../includes/student-navigation.php'?>
        </header>

        <!-- Left Sidebar - sidebar.scss  -->

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php'?>
            </div>
        </aside>

        <!-- End Left Sidebar sidebar.scss  -->


        <!-- Page wrapper  -->

        <div class="page-wrapper">
        
    
            <!-- Container fluid  -->
    
            <div class="container-fluid">
                
                <div class="col-7 align-self-center">
                        <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">My Profile</h2>
                </div>
                <br>


                <div class="row">

                    <?php	
                    $aid=$_SESSION['id'];
                        $ret="select * from userregistration where id=?";
                            $stmt= $mysqli->prepare($ret) ;
                        $stmt->bind_param('i',$aid);
                        $stmt->execute() ;//ok
                        $res=$stmt->get_result();
                        //$cnt=1;
                        while($row=$res->fetch_object())
                        {
                            ?>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Registration Number</h4>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="<?php echo $row->regNo;?>" required readonly>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email</h4>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="<?php echo $row->email;?>" required readonly>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>



                </div>

                <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Change Account Details</h4>
                </div>

                
                    
                    <form name="registration" onSubmit="return valid();" method="POST">
                        <br>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">First Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $row->firstName;?>"   required="required">
                                        </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Last Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $row->lastName;?>" required="required">
                                        </div>
                                    
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Gender</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="gender" name="gender">
                                            <option value="<?php echo $row->gender;?>"><?php echo $row->gender;?></option>
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
                                            <input type="text" name="contact" id="contact" maxlength="10" class="form-control" value="<?php echo $row->contactNo;?>" required="required">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">City</h4>
                                        <div class="form-group">
                                            <input type="text" name="city" id="contact" maxlength="10" class="form-control" value="<?php echo $row->city;?>" required="required">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">State</h4>
                                        <div class="form-group">
                                            <input type="text" name="state" id="contact" maxlength="10" class="form-control" value="<?php echo $row->state;?>" required="required">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    
                    </div>

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-success" onclick="return confirm('Confirm to make changes!');">Make Changes</button>
                            </div>
                        </div>

                    </form>



            </div>
    
            <!-- End Container fluid  -->
    
    
            <!-- footer -->
    
            <?php include '../includes/footer.php' ?>
    
            <!-- End footer -->
    
        </div>

        <!-- End Page wrapper  -->

    </div>
    <!-- End Wrapper -->
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>