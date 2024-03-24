<?php include 'db_connect.php';
$id = $_GET['id'];
$query = $conn->query("SELECT * FROM department_list where ID = $id");
$row = $query->fetch_array();

?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">Department Details</h3>
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<p>Title: <b><?php echo $row['departmentname'] ?></b></p>
					</div>
					<hr class="border-primary">
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Student ID</b></h3>
					<div class="card-tools">
						<button class="btn btn-block btn-sm btn-default btn-flat border-success new_question" type="button" data-toggle="modal" data-target="#AddStudent"><i class="fa fa-plus"></i> Add Student</button>
					</div>
				</div>
                <div class="card-body">
                    <table class="table tabe-hover table-bordered" id="list">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT * FROM student_list WHERE Dept_ID = $id ORDER BY NAME ASC");
                            while($row= $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++ ?></td>
                                <td><?php echo $row['NAME'];?></td>
                                <td><?php echo $row['STUDENTID'];?></td>
                                <td>
                                <button type="button" class="btn btn-danger btn-flat delete_survey" data-id="<?php echo $row['ID'] ?>">
		                              <i class="fas fa-trash"></i>
		                            </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            

                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_survey').click(function(){
	_conf("Are you sure to delete this survey?","delete_survey",[$(this).attr('data-id')])
	})
	})
	function delete_survey($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_student',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
<!-- Modal -->
<div class="modal fade" id="AddStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="addStudent.php" method="post">
            <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Student ID</label>
                <input type="text" name="studentid" class="form-control" required>
            </div>
            <input type="hidden" name="dept_id" value="<?php echo $_GET['id'] ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addStudent" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>
<?php
if(isset($_SESSION['savestatus'])){
    if($_SESSION['savestatus']=='success'){
        ?>
        <script>
            swal.fire('Success', '<?php echo $_SESSION['savemsg']?>', 'success');
        </script>
        <?php
    }else{
       ?>
        <script>
            swal.fire('Error', '<?php echo $_SESSION['savemsg']?>', 'failed');
        </script>
       <?php 
    }
    //unset
    unset($_SESSION['savestatus']);
    unset($_SESSION['savemsg']);
}
?>