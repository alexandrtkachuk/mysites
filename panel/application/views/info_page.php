<div class="container">
	<hr />
	<p class="bg-danger"><?php
		if($error === 2)
		{
			echo 'Ошибка при добавлении записи';
		}
	?></p>
	
	<p class="bg-success"><?php
		if($error === 1)
		{
			echo 'Запись успешно добавлена';
		}
	?></p>
	
    <table class="table table-bordered">
	  <thead>
		<tr>
          <th>varible name</th>
          <th>info</th>
		  <th>edit</th>
		   <th>del</th>
        </tr>
	  </thead>
	  <tbody>
		<?php foreach($info as  $value ): ?>
		<tr>
			<td><?php echo  $value->var ?></td>
			<td><?php echo $value->info ?></td>
			<td>#</td>
			<td>#</td>
		</tr>
		<?php endforeach; ?>
		<!--ADD -->
		<tr>
		<form method="POST" >
			<td>
				<input type="text" class="form-control"  name="var" placeholder="Varible">
			</td>
			<td>
				<input type="text" class="form-control"  name="info" placeholder="Info">
			</td>
			<td>
				<button type="submit" class="btn btn-primary" name="add" value ="add">Add</button>
			</td>
			<td>#</td>
		</form>
		</tr>
		
	  </tbody>
	</table>
	
	
</div><!-- /.container -->