
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="save_department.php" id="manage_user" method="POST">
				
				<div class="row">
					<div class="col-md-12 border-right">
						<b class="text-muted">Personal Information</b>
						<div class="form-group">
							<label for="" class="control-label">Department Name</label>
							<input type="text" name="departmentname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						
					</div>
					
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2" type="submit" name="savedepartment">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=department_list'">Cancel</button>
				</div>
			</form>
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