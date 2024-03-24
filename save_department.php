<?php
session_start();
include 'db_connect.php';
if(isset($_POST['savedepartment'])){
   $departmentname = mysqli_real_escape_string($conn, $_POST['departmentname']);
$sql = "INSERT INTO department_list (departmentname) VALUES ('$departmentname')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['savestatus']='success';
        $_SESSION['savemsg']="Department name Save Successfully";
        header('Location: index.php?page=add_department');
    } else {
        $_SESSION['savestatus']='failed';
        $_SESSION['savemsg']="Department name failed to save";
        header('Location: index.php?page=add_department');

    }
    
}


//update department
if(isset($_POST['Updartedepartment'])){
    $departmentname = mysqli_real_escape_string($conn, $_POST['departmentname']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "UPDATE department_list SET departmentname='$departmentname' WHERE ID='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['savestatus']='success';
        $_SESSION['savemsg']="Department name Updated Successfully";
        header('Location: index.php?page=department_list');
    } else {
        $_SESSION['savestatus']='failed';
        $_SESSION['savemsg']="Department name failed to Update";
        header('Location: index.php?page=department_list');

    }
}
?>