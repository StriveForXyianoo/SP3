<?php
include ('db_connect.php');
session_start();

if(isset($_POST['login'])){
    $departmentid = $_POST['departmentid'];
    $password = $_POST['studentid'];
    $srvy_id = $_POST['srvyid'];
    $sql = "SELECT * FROM student_list where STUDENTID = '$password' and Dept_ID = '$departmentid'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['studentid'] = $row['ID'];
        $_SESSION['studentname'] = $row['NAME'];
        
        $_SESSION['srvy_id'] = $srvy_id;
        header('location:student.php');
    }else{
       $_SESSION['logstat']='invalid';
       $_SESSION['logmsg']='Invalid Student ID or Department';
        header('location:answer.php?survey_id='.$srvy_id);
    }


}
?>