<?php
include 'db_connect.php';

session_start();
if(isset($_POST['addStudent'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $studentid = mysqli_real_escape_string($conn, $_POST['studentid']);
    $dept_ID = mysqli_real_escape_string($conn, $_POST['dept_id']);
    $sql = "INSERT INTO student_list (NAME, STUDENTID, Dept_ID) VALUES ('$name', '$studentid', '$dept_ID')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['savestatus']='success';
        $_SESSION['savemsg']="Student Save Successfully";
        header('Location: index.php?page=view_department&id='.$dept_ID);
    } else {
        $_SESSION['savestatus']='failed';
        $_SESSION['savemsg']="Student failed to save";
        header('Location: index.php?page=view_department&id='.$dept_ID);

    }
}
?>