<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

      <div class="starter-template">
        <h1>List pages</h1>
        <hr />
        
        <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Welcome/editpage">
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default" name="add" value='1'>add page</button>
			</div>
		  </div>
		</form>
      <table class="table table-bordered">
	  <thead>
		<tr>
          <th>#</th>
          <th>page name</th>
          <th>active</th>
		  <th>edit</th>
		  <th>del</th>
        </tr>
	  </thead>
	  <tbody>
	  
	  <?php foreach($pages as  $value ): ?>
		<tr>
			<form method="POST" action="<?php echo base_url();?>index.php/Welcome/editpage" >
			<input type="hidden" name="id" value="<?php echo $value->id ?>">
			<td><?php echo $value->id ?></td>
			<td><?php echo $value->name ?></td>
			<td><?php echo $value->active ?></td>
			<td><button type="submit" class="btn btn-primary" name="edit" value ="1">Edit</button></td>
			<td><button type="submit" class="btn btn-danger" name="del" value ="1">Del</button></td>
			</form>
		</tr>
		<?php endforeach; ?>
	  
	  
	  </tbody>
	  </table>
        
        
      </div>

    </div><!-- /.container -->