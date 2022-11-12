
<nav class="sidebar-nav">

    <ul id="sidebarnav">
    
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard.php"
        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
         class="hide-menu">Dashboard</span></a></li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Features</span></li>
                            
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="register-student.php"
        aria-expanded="false"><i class="fas fa-user-plus"></i><span
        class="hide-menu">Register Student</span></a></li>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="view-students-acc.php"
        aria-expanded="false"><i class="fas fa-user-circle"></i><span
        class="hide-menu">View Student Acc.</span></a></li>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="manage-students.php"
        aria-expanded="false"><i class="fas fa-users"></i><span
        class="hide-menu">Hostel Record</span></a></li>

        <?php
        $result ="SELECT * FROM complaint";
        $stmt = $mysqli->prepare($result);
        $stmt->execute();
        $reso=$stmt->get_result();
        $stmt->close();
        $cnt=0;
        while($row=$reso->fetch_object()){
            $cnt=$cnt+1;
            }
        ?>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="Queryw.php"
        aria-expanded="false"><i class="fas fa-exclamation"></i><span
        class="hide-menu">Query box<sup style="color: red;font-weight: 900;"><?php echo $cnt?></sup></span></a></li>
<!-- 
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="manage-courses.php"
        aria-expanded="false"><i class="fas fa-book"></i><span
        class="hide-menu">Manage Courses</span></a></li>
                            -->
    </ul>
</nav>