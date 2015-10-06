<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//var_dump($images);
?>
<div class="container">
	<hr />
	
	
    <table class="table table-bordered">
	
	
	  <thead>
		<tr>
          <th>title</th>
          <th>info</th>
		  <th>#</th>
		  <th>#</th>
		  <th>#</th>
        </tr>
	  </thead>
	  <tbody>
		
		<?php /* foreach($info as  $value ): ?>
		<tr>
			<form method="POST" >
			<input type="hidden" name="oldVar" value="<?php echo $value->var ?>">
			<td><input type="text" class="form-control"  name="var" value="<?php echo $value->var ?>"></td>
			<td><input type="text" class="form-control"  name="info" value="<?php echo $value->info ?>"></td>
			<td><button type="submit" class="btn btn-primary" name="edit" value ="1">Edit</button></td>
			<td><button type="submit" class="btn btn-danger" name="del" value ="1" 
			onclick="return confirm('Are you really need delete it is?')"  >Del</button></td>
			</form>
		</tr>
		<?php endforeach; */ ?>
		
		<!--ADD -->
		<tr>
		<form method="POST"  enctype="multipart/form-data" >
			<td>
				<input type="text" class="form-control"  name="title" placeholder="title">
			</td>
			<td>
				<input type="text" class="form-control"  name="info" placeholder="Info">
			</td>
			<td><!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			<!-- Название элемента input определяет имя в массиве $_FILES -->
			 <input name="userfile" type="file" />
			</td>
			
			<td>
				<button type="submit" class="btn btn-primary" name="add" value="Send File" >Add</button>
			</td>
			
		</form>
		</tr>
		
		  <?php foreach($images as  $value ): ?>
		<tr>
			<form method="POST"  >
			<input type="hidden" name="id" value="<?php echo $value->id ?>">
			<td><?php echo $value->title ?></td>
			<td><?php echo $value->info ?></td>
			<td>
				<a href="<?php echo base_url();?>index.php/Rest/images/<?php echo $value->id ?>">
					<img width="90px" src="<?php echo base_url();?>index.php/Rest/images/<?php echo $value->id ?>/20">
				</a>
			</td>
			<td>edit</td>
			<td><button type="submit" class="btn btn-danger" name="del" value ="1"
			onclick="return confirm('Are you really need delete it is?')" >Del</button></td>
			</form>
		</tr>
		<?php endforeach; ?>
		
		
	  </tbody>
	</table>
	
	
</div><!-- /.container -->