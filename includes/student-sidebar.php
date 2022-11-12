<!-- Sidebar navigation-->
<nav class="sidebar-nav">

    <ul id="sidebarnav">
    
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard.php"
        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
         class="hide-menu">Dashboard</span></a></li>

        <li class="list-divider"></li>

        <?php
                    $uid=$_SESSION['login'];
                    $stmt=$mysqli->prepare("SELECT unit_no FROM userregistration WHERE email=? ");
                    $stmt->bind_param('s',$uid);
                    $stmt->execute();
                    $stmt -> bind_result($u);
                    $rs=$stmt->fetch();
                    $stmt->close();

                    if($u==0){ ?>



        <li class="nav-small-cap"><span class="hide-menu">Book Indiviually</span></li>
                            
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="book-hostel.php"
        aria-expanded="false"><i class="fas fa-h-square"></i><span
        class="hide-menu">Book Room</span></a></li>

        <li class="nav-small-cap"><span class="hide-menu">Book With Group</span></li>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="group.php"
        aria-expanded="false"><i class="fas fa-users"></i><span
        class="hide-menu">Group</span></a></li>

        <?php
        $aid=$_SESSION['id'];
        $result ="SELECT * FROM group_invite WHERE user_to=?";
        $stmt = $mysqli->prepare($result);
        $stmt->bind_param('i',$aid);
        $stmt->execute();
        $reso=$stmt->get_result();
        $stmt->close();
        $cnt=0;
        while($row=$reso->fetch_object()){
            $cnt=$cnt+1;
            }
        ?>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="invite.php"
        aria-expanded="false"><i class="fas fa-comment-alt"></i><span
        class="hide-menu" >Invites<sup style="color: red;"><?php echo $cnt;?></sup></span></a></li>
        
        <li class="nav-small-cap"><span class="hide-menu">Features</span></li>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="room-details.php"
        aria-expanded="false"><i class="fas fa-bed"></i><span
        class="hide-menu">My Room Details</span></a></li>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="complaint.php"
        aria-expanded="false"><i class="fas fa-exclamation"></i><span
        class="hide-menu">Query/Complaint</span></a></li>

        <?php }
                    else{?>
                        <li class="nav-small-cap"><span class="hide-menu">Features</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="room-details.php"
                        aria-expanded="false"><i class="fas fa-bed"></i><span
                        class="hide-menu">My Room Details</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="roommates.php"
                        aria-expanded="false"><i class="fas fa-users"></i><span
                        class="hide-menu">My Room-Mates</span></a></li>
                
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="complaint.php"
                        aria-expanded="false"><i class="fas fa-exclamation"></i><span
                        class="hide-menu">Query/Complaint</span></a></li>
			<?php		}			
				?>	
                           
    </ul>
</nav>