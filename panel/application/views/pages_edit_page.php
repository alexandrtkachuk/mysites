<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	$id = 'new';
	$body = '';
	$name = '';
	$active = 0;

if(isset($page))
{
	//var_dump($page);
	$id = $page->id;
	$name = $page->name;
	$body = $page->body;
	$active = $page->active;
	
}
?>

<script type="text/javascript" src="<?php echo base_url();?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<hr />
<div class="container">
	<form method="post" action="<?php echo base_url();?>index.php/Welcome/pages" >
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<div class="form-group">
			<label for="exampleInputEmail1">Name Page:</label>
			<input type="namePage" class="form-control" name="name" placeholder="name page" value="<?php echo $name ?>">
		  </div>
		  <div class="form-group">
			<label for="body">Body page:</label>
			<textarea name="body" style="width:100%"><?php echo $body;?></textarea>
		  </div>
		  <div class="checkbox">
			<label>
			  <input type="checkbox"  name="active"  <?php if($active == 1) echo 'checked';  ?>> active
			</label>
		  </div>
		  <button type="submit" name="editend" value="1" class="btn btn-default">Save</button>
	</form>
</div>

