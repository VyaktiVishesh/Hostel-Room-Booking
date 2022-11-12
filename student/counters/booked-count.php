<?php
    include '../includes/dbconn.php';

    $sql = "SELECT id FROM userregistration WHERE unit_no!=0";
                $query = $mysqli->query($sql);
                echo "$query->num_rows";
?>