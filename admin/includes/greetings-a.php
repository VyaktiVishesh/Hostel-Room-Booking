<?php 
 
    date_default_timezone_set('America/Chicago');
    $welcome_string="Welcome"; 
    $numeric_date=date("G"); 


        $aid=$_SESSION['id'];
        $ret="select * from admin where id=?";
         $stmt= $mysqli->prepare($ret) ;
         $stmt->bind_param('i',$aid);
         $stmt->execute();
         $res=$stmt->get_result();
                                        
         while($row=$res->fetch_object())
         {
    
    echo "<h3 class='page-title text-truncate text-dark font-weight-medium mb-1'>$welcome_string $row->username! </h3>"; }
 
?>