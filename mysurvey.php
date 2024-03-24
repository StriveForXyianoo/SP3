<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 

  ob_start();
  $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Dashboard";
  ?>
  <title><?php echo $title ?> | CPSU Hinigaran Polling System</title>
  <?php ob_end_flush() ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
	<script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-green navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li>
        <a class="nav-link text-white"  href="#" role="button"> <large><b>CPSU Hinigaran Polling System</b></large></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <style>
#logo {
  display: inline-block;
  margin: 5px; /* margin: 20px was off */
  float: left;
  height: 30px;
  width: auto; /* correct proportions to specified height */
  border-radius: 50%; /* makes it a circle */
}
</style>
<?php
session_start();

?>
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <a href="" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
   	    <span><img id="logo" src="cpsu.jpeg"></span>&nbsp;&nbsp;&nbsp;
        <!--<span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-white text-danger font-weight-500" style="width: 38px;height:50px"></span>-->
        <span class="brand-text font-weight-light">
           <?php echo $_SESSION['studentname'];?>

        </span>
        

    </a><br><br>
    <div class="dropdown-menu" style="">
        <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-add_department nav-department_list">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Survey
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="mysurvey.php" class="nav-link nav-add_department tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Survey</p>
                </a>
              </li>
              
            </ul>
          </li>
            </ul>
        </nav>
    </div>
</aside>

<?php
include 'db_connect.php';

?>

    <div class="content-wrapper">
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	        <div class="toast-body text-white"></div>
	    </div>
        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
        <div class="content-header">
            <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Survey History</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                        <hr class="border-primary">
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
            <div class="col-lg-12">
	
	<div class=" w-100" id='ns' style="display: none"><center><b>No Result.</b></center></div>
	<div class="row">
		<?php 
		$sql = "SELECT student_answe_status.*,survey_set.* FROM student_answe_status INNER JOIN survey_set ON student_answe_status.surveyid = survey_set.id where student_answe_status.studentid = '{$_SESSION['studentid']}'";
    $survey = $conn->query($sql);
    foreach($survey as $row){
      ?>
      <div class="col-md-3 py-1 px-1 survey-item">
			<div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo ucwords($row['title']) ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
               <?php echo $row['description'] ?>
               <div class="row">
               	<hr class="border-primary">
               	<div class="d-flex justify-content-center w-100 text-center">
                  <?php
                  $myid = $_SESSION['studentid'];
                  $sql = "SELECT * FROM student_answe_status WHERE studentid = '$myid'";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  if($row['STATUS']=='ANSWERED'){
                    ?>
                      <p class="text-primary border-top border-primary">Done</p>
                    <?php
                  }
                  
                  ?>
               	
               	</div>
               </div>
              </div>
            </div>
		</div>
      <?php
    }
		?>
	</div>
</div>
            </div><!--/. container-fluid -->
        </section>

    </div>
</div>
<script>
	function find_survey(){
		start_load()
		var filter = $('#filter').val()
			filter = filter.toLowerCase()
			console.log(filter)
		$('.survey-item').each(function(){
			var txt = $(this).text()
			if((txt.toLowerCase()).includes(filter) == true){
				$(this).toggle(true)
			}else{
				$(this).toggle(false)
			}
			if($('.survey-item:visible').length <= 0){
				$('#ns').show()
			}else{
				$('#ns').hide()
			}
		})
		end_load()
	}
	$('#search').click(function(){
		find_survey()
	})
	$('#filter').keypress(function(e){
		if(e.which == 13){
		find_survey()
		return false;
		}
	})
</script>
<script>
	$('#manage-survey').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_answer',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Thank You.",'success')
					setTimeout(function(){
						location.href = 'student.php'
					},2000)
				}
			}
		})
	})
</script>

<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>
	$(document).ready(function(){
	  // $('.datetimepicker').datetimepicker({
	  //     format:'Y/m/d H:i',
	  //     startDate: '+3d'
	  // })

	  $('.select2').select2({
	    placeholder:"Please select here",
	    width: "100%"
	  });
  })
	 window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
	  }
	  window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	      })
	  }
	 window.viewer_modal = function($src = ''){
	    start_load()
	    var t = $src.split('.')
	    t = t[1]
	    if(t =='mp4'){
	      var view = $("<video src='"+$src+"' controls autoplay></video>")
	    }else{
	      var view = $("<img src='"+$src+"' />")
	    }
	    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
	    $('#viewer_modal .modal-content').append(view)
	    $('#viewer_modal').modal({
	            show:true,
	            backdrop:'static',
	            keyboard:false,
	            focus:true
	          })
	          end_load()  

	}
	  window.uni_modal = function($title = '' , $url='',$size=""){
	      start_load()
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log()
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#uni_modal .modal-title').html($title)
	                  $('#uni_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#uni_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
	                  }
	                  $('#uni_modal').modal({
	                    show:true,
	                    backdrop:'static',
	                    keyboard:false,
	                    focus:true
	                  })
	                  end_load()
	              }
	          }
	      })
	  }
	  window._conf = function($msg='',$func='',$params = []){
	     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
	     $('#confirm_modal .modal-body').html($msg)
	     $('#confirm_modal').modal('show')
	  }
	   var Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
	    //   $('#alert_toast').removeClass('bg-success')
	    //   $('#alert_toast').removeClass('bg-danger')
	    //   $('#alert_toast').removeClass('bg-info')
	    //   $('#alert_toast').removeClass('bg-warning')

	    // if($bg == 'success')
	    //   $('#alert_toast').addClass('bg-success')
	    // if($bg == 'danger')
	    //   $('#alert_toast').addClass('bg-danger')
	    // if($bg == 'info')
	    //   $('#alert_toast').addClass('bg-info')
	    // if($bg == 'warning')
	    //   $('#alert_toast').addClass('bg-warning')
	    // $('#alert_toast .toast-body').html($msg)
	    // $('#alert_toast').toast({delay:3000}).toast('show');
	    console.log('TEST')
	      Toast.fire({
	        icon: $bg,
	        title: $msg
	      })
	  }
$(function () {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })

  })
</script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


</body>
</html>