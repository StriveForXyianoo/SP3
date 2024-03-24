<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('db_connect.php');

//check if the survey is started or ended
$id = $_GET['survey_id'];
$ssql = "SELECT * FROM survey_set where id = $id";
$ress = mysqli_query($conn, $ssql);


?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | CPSU HINIGARAN POLLING SYSTEM</title>
 	
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>


</head>
<style>
	body{
		background-image: url('cpsu_lab.jpg'); 
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
		width: 100%;
	    position: fixed;

	    /*background: yellowgreen;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}

</style>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

<body style="background-image: url('cpsubuilding.jpg');">

<?php
if(mysqli_num_rows($ress)>0){
  $row = $ress->fetch_assoc();
  $datestart = date('Y-m-d-H:i A',strtotime($row['start_date']));
  $dateend = date('Y-m-d-H:i A',strtotime($row['end_date']));
  //today date
  //set the timezone to manila time
  date_default_timezone_set('Asia/Manila');

  $today = date('Y-m-d-H:i A');
  if($today < $datestart){
    ?>
    <script>
      Swal.fire({
        title: 'Ooops!',
        text: 'Survey is not yet started!',
        icon: 'error',
        confirmButtonText: 'Ok'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = 'index.php';
        }
      })
    </script>
    <?php
  }else if($today > $dateend){
    ?>
    <script>
      Swal.fire({
        title: 'Ooops!',
        text: 'Survey is already ended!',
        icon: 'error',
        confirmButtonText: 'Ok'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = 'index.php';
        }
      })
    </script>
    <?php
  }

 
}else{
  ?>
  <script>
    Swal.fire({
      title: 'Ooops!',
      text: 'No survey found!',
      icon: 'error',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = 'index.php';
      }
    })
  </script>
  <?php
}
?>
  <main id="main" >
  	
  		<div class="align-self-center w-100">
		
  		<div id="login-center" class="bg-hsl(120, 60%, 70%); row justify-content-center">
  			<div class="card col-md-4">
  				<div class="card-body">
				  <h4 class="text-dark text-center"><b> CPSU HINIGARAN POLLING SYSTEM</b></h4>
  					<form method="POST" action="answerlogin.php">
  						<div class="form-group">
  							<label for="email" class="control-label text-dark">Department </label>
  							<select name="departmentid" id="" class="form-control">
                                <option value="">Choose Department</option>
                                <?php
                                $sql = "SELECT * FROM department_list";
                                $result = mysqli_query($conn, $sql);
                                foreach($result as $row)
                                {
                                    echo "<option value=".$row['ID'].">".$row['departmentname']."</option>";
                                }


                                ?>

                            </select>
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label text-dark">Student ID</label>
  							<input type="text" id="password" name="studentid" class="form-control">
  						</div>
                        <?php
                        if(isset($_SESSION['logstat'])){

                            if($_SESSION['logstat'] == 'invalid'){
                                ?>
                                <span class="badge bg-danger"><?php echo strtoupper($_SESSION['logmsg'])?></span>
                                <?php
                            }
                            unset($_SESSION['logstat']);
                            unset($_SESSION['logmsg']);
                        }
                        ?>
                        <input type="hidden" name="srvyid" value="<?php echo $_GET['survey_id']?>">
  						<center><button class=" btn-block btn-wave col-md-4 btn-primary" type="submit" name="login">Login</button></center><br>
						 
  					</form>
					  
  				</div>
  			</div>
  		</div>
  		</div>
  </main>



<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>	


</body>

</html>