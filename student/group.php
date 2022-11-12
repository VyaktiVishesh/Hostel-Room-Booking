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

        $ret="SELECT group_id from userregistration where id=$id";
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute() ;
        $stmt->bind_result($gid);
        $rs=$stmt->fetch();
        $stmt->close();

        $d=0;
        $query="SELECT * FROM rooms WHERE unit_no=? and status=?";
        $stmt= $mysqli->prepare($query);  
        $stmt->bind_param('ii',$unitno,$d);
        $stmt->execute();
        $res=$stmt->get_result();
        $stmt->close();

        $query="SELECT * FROM userregistration WHERE group_id=?";
        $stmt= $mysqli->prepare($query);   
        $stmt->bind_param('i',$gid);
        $stmt->execute();
        $res2=$stmt->get_result();
        $stmt->close();

        while(($row2=$res2->fetch_object())&&($row=$res->fetch_object())) 
            {
             
                $query="UPDATE userregistration SET unit_no=?, room_no=? WHERE id=?";
                $stmt= $mysqli->prepare($query);  
                $stmt->bind_param('isi',$row->unit_no,$row->room,$row2->id); 
                $stmt->execute();
                $stmt->close();

                $query="UPDATE rooms SET status=? WHERE unit_no=? and room=?";
                $stmt= $mysqli->prepare($query);  
                $stmt->bind_param('iis',$row2->regNo,$row->unit_no,$row->room); 
                $stmt->execute();
                $stmt->close();
                

            }
            echo "<script>alert('Room has been alloted to the group!');</script>";
       }

       if(isset($_POST['creategroup'])){
        $aid=$_SESSION['id'];
        $id=$_SESSION['roll'];
        $uid=$_SESSION['login'];


        $query="SELECT group_id FROM userregistration WHERE id=?";
        $stmt100=$mysqli->prepare($query);
        $stmt100->bind_param('i',$aid);
        $stmt100->execute();
        $stmt100->bind_result($g);
        $rs100=$stmt100->fetch();
        $stmt100->close();


        if($g==0){
            $query200="SELECT unit_no FROM userregistration WHERE id=?";
            $stmt200=$mysqli->prepare($query200);
            $stmt200->bind_param('i',$aid);
            $stmt200->execute();
            $stmt200->bind_result($u);
            $rs200=$stmt200->fetch();
            $stmt200->close();
            $k=0;

            if($u==0){
            $k=1;
            $query="INSERT INTO groups(group_id,roll) VALUES (?,?)";
            $stmt=$mysqli->prepare($query);
            $stmt->bind_param('ii',$aid,$id);
            $stmt->execute();

            $query101="UPDATE userregistration SET group_id=$aid WHERE id=$aid";
            $stmt101=$mysqli->prepare($query101);
            $stmt101->execute();


                echo "<script>alert('New Group has been created!');</script>";
            }else{
                echo "<script>alert('You have already booked a room! So you can't create a group!');</script>";
            }
        }else{
            echo "<script>alert('You are already in a group!');</script>";
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
                
                    <?php 
                    $uid=$_SESSION['id'];
                    $query="SELECT group_id FROM userregistration WHERE id=?";
                    $stmt50=$mysqli->prepare($query);
                    $stmt50->bind_param('i',$uid);
                    $stmt50->execute();
                    $stmt50->bind_result($g);
                    $res=$stmt50->fetch();
                    $stmt50->close();

    if($g>0){?>
                        <div class="col-7 align-self-center">
                                <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Group Details</h2>
                            </div>
                            <br>

                    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                            <thead class="thead-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Roll No.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php	
                                                    $aid=$_SESSION['id'];
                                                    $ret="SELECT group_id from userregistration where id=$aid";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    //$stmt->bind_param('i',$aid);
                                                    $stmt->execute() ;//ok
                                                    $stmt->bind_result($gid);
                                                    $rs=$stmt->fetch();
                                                    $stmt->close();
                                            
                                                    $query="SELECT roll FROM groups WHERE group_id=?";
                                                    $stmt= $mysqli->prepare($query);
                                                    $stmt->bind_param('i',$gid);    
                                                    $stmt->execute();
                                                    $res=$stmt->get_result();
                                                    $stmt->close();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                        {
                                                            ?>
                                                <tr><td><?php echo $cnt;;?></td>
                                                    <td><?php echo $row->roll;?></td>
                                                    <?php
                                                        $cnt=$cnt+1;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <?php 
                                                    $id=$_SESSION['id'];
                                                    $query201="SELECT group_id FROM userregistration WHERE id=?";
                                                    $stmt201=$mysqli->prepare($query201);
                                                    $stmt201->bind_param('i',$id);
                                                    $stmt201->execute();
                                                    $stmt201->bind_result($gid);
                                                    $stmt201->close();

                                                    $query="SELECT * FROM groups WHERE group_id=$gid";
                                                    $stmt11=$mysqli->prepare($query);
                                                    $stmt11->execute();
                                                    $stmt11->store_result();
                                                    $gcnt=$stmt11->num_rows;
                                                    $stmt11->close();
                                        ?>
                                        <?php if($gcnt>4){?>
                                            <a href="#"><button type="button" class="btn btn-block btn-md">Group is Full</button></a><?php
                                        }else{?><a href="addg.php"><button type="button" class="btn btn-block btn-md btn-success">Add Member</button></a><?php }?>
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="col-7 align-self-center">
                                <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Book Room for the Group</h2>
                            
                            </div>
<br>

                    <form method="POST">


                        
                        <div class="row">


                            <div class="col-sm-12 col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Unit Number</h4>
                                            <div class="form-group mb-4">
                                                <select class="custom-select mr-sm-2" name="unit" id="room" onChange="getSeater(this.value);" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                                    <option selected>Select...</option>
                                                    <?php 
                                                    $id=$_SESSION['id'];
                                                    $query201="SELECT group_id FROM userregistration WHERE id=?";
                                                    $stmt201=$mysqli->prepare($query201);
                                                    $stmt201->bind_param('i',$id);
                                                    $stmt201->execute();
                                                    $stmt201->bind_result($gid);
                                                    $stmt201->close();

                                                    $query="SELECT * FROM groups WHERE group_id=$gid";
                                                    $stmt11=$mysqli->prepare($query);
                                                    $stmt11->execute();
                                                    $stmt11->store_result();
                                                    $gcnt=$stmt11->num_rows;
                                                    $stmt11->close();
                                                    
                                                    $query ="SELECT unit_no FROM rooms WHERE status=0 GROUP BY unit_no";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res=$stmt2->get_result();
                                                    while($row=$res->fetch_object())
                                                    {
                                                    ?>
                                                    <?php 
                                                        $query="SELECT * FROM rooms WHERE unit_no=$row->unit_no and status=0";
                                                        $stmt11=$mysqli->prepare($query);
                                                        $stmt11->execute();
                                                        $stmt11->store_result();
                                                        $rcnt=$stmt11->num_rows;
                                                        $stmt11->close();

                                                        if($rcnt>=$gcnt){
                                                    ?>
                                                    <option value="<?php echo $row->unit_no;?>"> <?php echo $row->unit_no;?></option>
                                    
                                                    <?php }} ?>
                                                </select>
                                                <span style="font-size:12px;">Only units which has more than <span style="color: red;"><?php echo $gcnt ?> rooms</span> available are displayed!</span>
                                            </div>
                                    
                                    </div>
                                </div>
                            </div>
                    

                        </div>

                                    <h5 class="card-title mt-5" style="text-align: center;"><code>Important: </code>Once room alloted, You will not be able to change it later!</h5>

                            <div class="form-actions">
                                <div class="text-center">
                             <button type="submit" name="submit" class="btn btn-success">Book</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                                                                
                                </div>
                            </div>

                        
                </form>




<?php }else{?>






                    <form method="POST">
                    
                                <div class="col-7 align-self-center">
                                    <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Groups</h2>
                                </div>
                                <h5 class="card-title mt-5"><h3 style="display: inline;"><b>IITI</b></h3> is known for its unique hostel facilites. Here we flat type system is followed. Each flat has 5 rooms included with common kitchen and living room. We also allow students to choose their flat-mates so that they can cherish their college life. </h5>
                                <h5 class="card-title mt-5">So we allow students to form groups with their preffered-ones. Groups can be created from below, after which you can send invites to your friends. Groups can also be joined by accepting invites in invite section. </h5>
                                <br>
                            <div class="col-7 align-self-center">
                                    <!-- <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Create Group</h4> -->
                                </div>



                                <h5 class="card-title">Gerneral Instructions: <br><ol><li>New Group can be created here</li><li>Only students who are not involved in any group can create new group</li><li>Later Preffered students can be invited</li><li>The Group can book room such that they get same unit</li></ol></h5>


                        


                                <div class="form-actions">
                                    <div class="text-center">
                                        <button type="submit" name="creategroup" class="btn btn-success" onclick="return confirm('Do you want to create group?');" >Create Group</button>
                                    </div>
                                </div>



                            </form>

<?php }?>
            

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