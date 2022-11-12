<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    if(isset($_POST['submit'])){
        $id=$_SESSION['id'];
        $roll=$_SESSION['roll'];
        $uid=$_SESSION['login'];
        $unitno=$_POST['unit'];
        $roomno=$_POST['room'];

        $stmt=$mysqli->prepare("SELECT unit_no FROM userregistration WHERE email=? ");
        $stmt->bind_param('s',$uid);
        $stmt->execute();
        $stmt -> bind_result($u);
        $rs=$stmt->fetch();
        $stmt->close();

        $stmt2=$mysqli->prepare("SELECT status FROM rooms WHERE unit_no=? and room=?");
        $stmt2->bind_param('is',$unitno,$roomno);
        $stmt2->execute();
        $stmt2->bind_result($p);
        $rs2=$stmt2->fetch();
        $stmt2->close();

        if($u==0){
            if($p==0){
                $query="UPDATE userregistration SET unit_no=?,room_no=? WHERE id=?";
                $stmt = $mysqli->prepare($query);
                $rc=$stmt->bind_param('isi',$unitno,$roomno,$id);
                $stmt->execute();
        
                $query="UPDATE rooms SET status=? WHERE unit_no=? AND room=?";
                $stmt = $mysqli->prepare($query);
                $rc=$stmt->bind_param('iis',$roll,$unitno,$roomno);
                $stmt->execute();
                echo"<script>alert('Requested Room has been booked!');</script>";
            }else{
                echo "<script>alert('Requested Room has already been booked! Try with another room');</script>";
            }
         }
        else{
            echo "<script>alert('You have already booked a room!');</script>";
        } }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/iitil.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script>
    function getSeater(val) {
        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'roomid='+val,
        success: function(data){
        //alert(data);
        $('#seater').val(data);
        }
        });

        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'rid='+val,
        success: function(data){
        //alert(data);
        $('#fpm').val(data);
        }
        });
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

    <!-- Main wrapper pages.scss -->

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    
        <!-- Topbar header pages.scss -->
    
        <header class="topbar" data-navbarbg="skin6">
            <?php include '../includes/student-navigation.php'?>
        </header>
        <!-- Left Sidebar sidebar.scss  -->
    
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
            
        
            <!-- Container fluid  -->
        
            <div class="container-fluid">
                
                <form method="POST">
                
                <?php
                    $uid=$_SESSION['login'];
                    $stmt=$mysqli->prepare("SELECT unit_no FROM userregistration WHERE email=? ");
                    $stmt->bind_param('s',$uid);
                    $stmt->execute();
                    $stmt -> bind_result($u);
                    $rs=$stmt->fetch();
                    $stmt->close();

                    if($u!==0){ ?>
                    <div class="alert alert-primary alert-dismissible bg-danger text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                                <strong>Info: </strong> You have already booked a Room!
                    </div>
                    <?php }
                    else{
						echo "";
					}			
				?>	


                <div class="col-7 align-self-center">
                        <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Hostel Bookings</h2>
                    </div>
                    <br>

                
                <div class="row">


                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Unit Number</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" name="unit" id="unit" onChange="getSeater(this.value);" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                            <option selected>Select...</option>
                                            <?php $query ="SELECT * FROM rooms GROUP BY unit_no";
                                            $stmt2 = $mysqli->prepare($query);
                                            $stmt2->execute();
                                            $res=$stmt2->get_result();
                                            while($row=$res->fetch_object())
                                            {
                                            ?>
                                            <option value="<?php echo $row->unit_no;?>"> <?php echo $row->unit_no;?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="room-availability-status" style="font-size:12px;"></span>
                                    </div>
                              
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Room Number</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" name="room" id="room" onChange="getSeater(this.value);" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                            <option selected>Select...</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>

                                       
                                        </select>
                                        <span id="room-availability-status" style="font-size:12px;"></span>
                                    </div>
                              
                            </div>
                        </div>
                    </div>
            

                </div>

                <h4 class="card-title mt-5">Student's Personal Information</h4>
                <h6 class="card-subtitle"><code>If want to make changes, go to My Profile</code> </h6>
                <br>


                <div class="row">

                <?php	
                $aid=$_SESSION['id'];
                    $ret="select * from userregistration where id=?";
                        $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('i',$aid);
                    $stmt->execute();
                    $res=$stmt->get_result();

                    while($row=$res->fetch_object())
                    {
                        ?>
                
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Registration Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="regno" id="regno" value="<?php echo $row->regNo;?>" class="form-control" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">First Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="fname" id="fname" value="<?php echo $row->firstName;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Last Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="lname" id="fname" value="<?php echo $row->lastName;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Email</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" value="<?php echo $row->email;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Gender</h4>
                                    <div class="form-group">
                                        <input type="text" name="gender" id="gender" value="<?php echo $row->gender;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="number" name="contact" id="contact" value="<?php echo $row->contactNo;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Enrolled Course</h4>
                                    <div class="form-group">
                                        <input type="text" name="course" id="contact" value="<?php echo $row->course;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                              
                </div>

                    
                  

                    <h4 class="card-title mt-5">Current Address Information</h4>

                    <div class="row">
                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">City</h4>
                                    <div class="form-group">
                                        <input type="text" name="city" id="fname" value="<?php echo $row->city;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">State</h4>
                                    <div class="form-group">
                                        <input type="text" name="state" id="fname" value="<?php echo $row->state;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                        <?php }?>

                                                </div>

                               <h5 class="card-title mt-5" style="text-align: center;"><code>Important: </code>Once booked, You will not be able to change your room later!!</h5>
                    <br>
                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success" onclick="return confirm('Do you want to book the room? You will not be able to change it later!');">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
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

    
    <script>
        function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'unitno='+$("#unit").val(),
        type: "POST",
        success:function(data){
            $("#room-availability-status").html(data);
            $("#loaderIcon").hide();
        },
            error:function (){}
            });
        }
    </script>


    <script type="text/javascript">

    $(document).ready(function() {
        $('#duration').keyup(function(){
            var fetch_dbid = $(this).val();
            $.ajax({
            type:'POST',
            url :"ins-amt.php?action=userid",
            data :{userinfo:fetch_dbid},
            success:function(data){
            $('.result').val(data);
            }
            });
            

    })});
    </script>

</html>