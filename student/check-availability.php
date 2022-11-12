<?php
    require_once("../includes/dbconn.php");
    if(!empty($_POST["emailid"])) {
        $email= $_POST["emailid"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

            echo "error : You did not enter a valid email.";
        } else {
            $result ="SELECT count(*) FROM userRegistration WHERE email=?";
            $stmt = $mysqli->prepare($result);
            $stmt->bind_param('s',$email);
            $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if($count>0){
    echo "<span style='color:red'> Email already exist! Try using new one.</span>";
        } else {
            echo "<span style='color:green'> Email available for registration!!</span>";
        }
     }
    }

    if(!empty($_POST["oldpassword"])) {
    $pass=$_POST["oldpassword"];
    $pass=md5($pass);
    $result ="SELECT password FROM userregistration WHERE password=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('s',$pass);
    $stmt->execute();
    $stmt -> bind_result($result);
    $stmt -> fetch();
    $opass=$result;
    if($opass==$pass) 
    echo "<span style='color:green'> Password  matched.</span>";
    else echo "<span style='color:red'>Password doesnot match!</span>";
    }


    if(!empty($_POST["unitno"])) {
    $unitno=$_POST["unitno"];

    $x=0;
    $result ="SELECT * FROM rooms WHERE unit_no=? and status=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('ii',$unitno,$x);
    $stmt->execute();
    $reso=$stmt->get_result();
    $stmt->close();
    $cnt=0;
    while($row=$reso->fetch_object()){
        $cnt=$cnt+1;
        }

    $x=0;
    $result ="SELECT * FROM rooms WHERE unit_no=? and status=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('ii',$unitno,$x);
    $stmt->execute();
    $res=$stmt->get_result();
    $stmt->close();

    if($cnt>0){
            while($row=$res->fetch_object()){
            echo "<span style='color:red'>$row->room, </span>";
            }
            echo "<span style='color:red'> rooms are available.";
    }else{
        echo "<span style='color:red'> No rooms are available.";
    }
}
?>