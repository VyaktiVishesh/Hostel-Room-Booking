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

        if(isset($_GET['invite'])){
            $id_to=intval($_GET['invite']);
            $id=$_SESSION['id'];
    
            $query="SELECT group_id FROM userregistration WHERE id=$id";
            $stmt=$mysqli->prepare($query);
            $stmt->execute();
            $stmt->bind_result($gid);
            $stmt->close();
    
            $query="INSERT INTO group_invite(user_from,user_to) VALUES (?,?)";
            $stmt=$mysqli->prepare($query);
            $stmt->bind_param('ii',$id,$id_to);
            $stmt->execute();
            $stmt->close();
        }

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
            <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Invite Friends</h4>
                    </div>

            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Roll number</th>
                                                <th>Course</th>
                                                <th>Invite</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	
                                            $aid=$_SESSION['id'];
                                            $ret="SELECT * from userregistration WHERE group_id=0 and unit_no=0";
                                            $stmt= $mysqli->prepare($ret) ;
                                            //$stmt->bind_param('i',$aid);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            $stmt->close();
                                            $cnt=1;
                                            while($row=$res->fetch_object())
                                                {
                                                    ?>
                                        <tr><td><?php echo $cnt;;?></td>
                                            <td><?php echo $row->firstName;?> <?php echo $row->lastName;?></td>
                                            <td><?php echo $row->regNo;;?></td>
                                            <td><?php echo $row->course;;?></td>
                                            <td><a href="addg.php?invite=<?php echo $row->id;?>" title="Invite" onclick="return confirm('Do you want to invite?');"><i class="fas fa-user-plus" style="color:red;"></i></a></td>
                                            <?php
                                                $cnt=$cnt+1;
                                            } ?>
									    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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

<!-- Custom Ft. Script Lines -->
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
    </script>
    
    <script>
        function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'roomno='+$("#room").val(),
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