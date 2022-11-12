<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
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
     <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
    
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Room Mates</h2>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <a href="#"><button type="button" class="btn btn-block btn-md btn-success">Unit Number:
                                <?php
                                $aid=$_SESSION['id'];
                                $query="SELECT unit_no FROM userregistration WHERE id=$aid";
                                $stmt=$mysqli->prepare($query);
                                $stmt->execute();
                                $stmt->bind_result($unitno);
                                $reso=$stmt->fetch();
                                $stmt->close();
                                echo $unitno;
                            

                                ?>
                            </button></a>
                            <hr>
                                <div class="table-responsive">
                                    <table  class="table table-striped table-hover table-bordered no-wrap">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Room</th>
                                                <th>Name</th>
                                                <th>Roll Number</th>
                                                <th>Course</th>
                                                <th>Full Details</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	
                                            $aid=$_SESSION['id'];
                                            $query="SELECT unit_no FROM userregistration WHERE id=$aid";
                                            $stmt=$mysqli->prepare($query);
                                            $stmt->execute();
                                            $stmt->bind_result($unitno);
                                            $reso=$stmt->fetch();
                                            $stmt->close();

                                            $ret="SELECT * from rooms WHERE unit_no=$unitno";
                                            $stmt= $mysqli->prepare($ret) ;
                                            //$stmt->bind_param('i',$aid);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            $cnt=1;
                                            while($row=$res->fetch_object())
                                                {
                                                    ?>
                                        <tr><td><?php echo $cnt;;?></td>
                                            <td><?php echo $row->room;?></td>
                                            <?php
                                            if($row->status==0){
                                                ?>
                                                 <td><h4><code>-NA-</code></h4></td>
                                                 <td><h3><code>-</code></h3></td>
                                                 <td><h3><code>-</code></h3></td>
                                                 <td><h3><code>-</code></h3></td>
                                                <?php
                                            }else{                                        
                                            ?>
                                            <?php
                                            $aid=$_SESSION['id'];
                                            $query="SELECT unit_no FROM userregistration WHERE id=$aid";
                                            $stmt=$mysqli->prepare($query);
                                            $stmt->execute();
                                            $stmt->bind_result($unitno);
                                            $reso=$stmt->fetch();
                                            $stmt->close();

                                            $ret1="SELECT * from userregistration where unit_no=? and room_no=?";
                                            $stmt1= $mysqli->prepare($ret1) ;
                                            $stmt1->bind_param('is',$unitno,$row->room);
                                            $stmt1->execute() ;//ok
                                            $res1=$stmt1->get_result();
                                            while($row1=$res1->fetch_object()){
                                                ?>
                                            <td><?php echo $row1->firstName;?> <?php echo $row1->lastName;?></td>
                                            <td><?php echo $row1->regNo;?></td>
                                            <td><?php echo $row1->course;?></td>
                            

                                        <td>&nbsp;&nbsp;
           &nbsp;&nbsp;
                                        <a href="profile1.php?id=<?php echo $row1->id;?>" title="View Full Details"><i class="icon-size-fullscreen"></i></a>&nbsp;&nbsp;</td>
                                        </tr>
                                        <?php }?>
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
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

</body>

</html>