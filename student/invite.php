<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();

        if(isset($_GET['delete'])){
            $id=intval($_GET['delete']);
    
            $query="DELETE FROM group_invite WHERE id=$id";
            $stmt=$mysqli->prepare($query);
            $stmt->execute();
            $stmt->close();

        }

        if(isset($_GET['accept'])){

            $uroll=$_SESSION['roll'];
            $uid=$_SESSION['id'];
            $id=intval($_GET['accept']);
            $gid=intval($_GET['id']);

            $query="SELECT group_id FROM userregistration WHERE id=?";
            $stmt=$mysqli->prepare($query);
            $stmt->bind_param('i',$uid);
            $stmt->execute();
            $stmt->bind_result($gcd);
            $rs200=$stmt->fetch();
            $stmt->close();
            
            if($gcd<1){
    
            $query="DELETE FROM group_invite WHERE id=$id";
            $stmt=$mysqli->prepare($query);
            $stmt->execute();
            $stmt->close();

            $query="UPDATE userregistration SET group_id=$gid WHERE id=$uid";
            $stmt=$mysqli->prepare($query);
            $stmt->execute();
            $stmt->close();

            $query="INSERT INTO groups(group_id,roll) VALUES (?,?)";
            $stmt=$mysqli->prepare($query);
            $stmt->bind_param('ii',$gid,$uroll);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('You have accepted the invite!!')</script>";
            }else{
                echo "<script>alert('You cannot accept invite as your are already in a group!!')</script>";
            }

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
                        <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Invitations</h2>
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
                                                <th>Time</th>
                                                <th>Accept Invite</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	
                                            $aid=$_SESSION['id'];
                                            $ret="SELECT * from group_invite WHERE user_to=$aid";
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
                                        <?php 
                                            $query="SELECT * FROM userregistration WHERE id=$row->user_from";
                                            $stmt=$mysqli->prepare($query);
                                            $stmt->execute();
                                            $res2=$stmt->get_result();
                                            $stmt->close();
                                            while($row2=$res2->fetch_object())
                                                {

                                        ?>
                                            <td><?php echo $row2->firstName;?> <?php echo $row2->lastName;?></td>
                                            <td><?php echo $row2->regNo;;?></td>
                                            <td><?php echo $row2->course;;?></td>
                                            <td><?php echo $row->time_req;;?></td>
                                            <td><a href="invite.php?accept=<?php echo $row->id;?>&id=<?php echo $row2->group_id?>" title="Accept Invite" onclick="return confirm('Do you want to accept?');"><i class="fas fa-user-plus" style="color:red;"></i></a>
                                            <a href="invite.php?delete=<?php echo $row->id;?>" title="Delete Invite" onclick="return confirm('Do you want to delete invite?');"><i class="icon-close" style="color:red;"></i></a></td>
                                          
                                          <?php }?>
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