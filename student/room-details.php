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
    <link href="../dist/css/style.min.css" rel="stylesheet">
    
</head>

<body>
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        
        
        <header class="topbar" data-navbarbg="skin6">
             <?php include '../includes/student-navigation.php'?>
        </header>
        
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php'?>
            </div>
        </aside>
        
        <div class="page-wrapper">
            
            <div class="container-fluid">
                
                <div class="col-7 align-self-center">
                        <h2 class="page-title text-truncate text-medium font-weight-medium mb-1">Details About My Booked Room</h2>
                </div>
                
                 <div class="card">
                 
                   <div class="card-body">
                   
                      <div class="row">
                      
                      <div class="table-responsive">
                                    <table id="zctb" class="table table-striped table-bordered no-wrap">
                                        <tbody>
                                        <?php	
                                        $aid=$_SESSION['login'];
                                        $ret="SELECT * from userregistration where email=?";
                                        $stmt= $mysqli->prepare($ret) ;
                                        $stmt->bind_param('s',$aid);
                                        $stmt->execute() ;
                                        $res=$stmt->get_result();
                                        $cnt=1;
                                        while($row=$res->fetch_object())
                                            {
                                                ?>

                                            <tr>
                                                <td colspan="4"><b>Date & Time of Registration: <?php echo $row->regDate;?></b></td>
                                                
                                            </tr>

                                            <tr>
                                            <td><b>Full Name :</b></td>
                                            <td><?php echo $row->firstName;echo "  "; echo $row->lastName;?></td>

                                            <td><b>Room no :</b></td>
                                            <td><?php if($row->unit_no==0){echo "Not booked yet";} else{echo "$row->unit_no-$row->room_no";}?></td>

                                            </tr>

                                            <tr>
                                            <td><b>Registration Number :</b></td>
                                            <td><?php echo $row->regNo;?></td>

                                            <td><b>Enrolled Course :</b></td>
                                            <td><?php echo $row->course;?></td>
                                            
                                            </tr>


                                            <tr>
                                            <td><b>Contact Number :</b></td>
                                            <td><?php echo $row->contactNo;?></td>

                                            <td><b>Email Address:</b></td>
                                            <td><?php echo $row->email;?></td>

                                            </tr>


                                            <tr>

                                            <td><b>Gender :</b></td>
                                            <td><?php echo $row->gender;?></td>

                                            <td><b>Current Address:</b></td>
                                            <td colspan="2">
                                            <?php echo $row->city;?>,
                                            <?php echo $row->state;?><br />
                                        </td>
                                            </tr>


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
</body>

</html>