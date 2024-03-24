<?php include'db_connect.php';

?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=add_department"><i class="fa fa-plus"></i> Add New Department</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="25%">
					
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						
						<th>Department Name</th>

						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM department_list ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td class="text-center"><?php echo $row['departmentname'] ?><?php
						
						?></td>
						
						<td class="text-center">
							<!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item" href="./index.php?page=edit_survey&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_survey" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div> -->
		                    <div class="btn-group">
		                        <a href="./index.php?page=edit_department&id=<?php echo $row['ID'] ?>" class="btn btn-primary btn-flat">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <a  href="./index.php?page=view_department&id=<?php echo $row['ID'] ?>" class="btn btn-info btn-flat">
		                          <i class="fas fa-eye"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_survey" data-id="<?php echo $row['ID'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
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
			url:'ajax.php?action=delete_department',
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