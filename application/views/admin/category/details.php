<a href="<?php echo site_url('admin/category/index'); ?>"
	class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Category'); ?></h5>
<!--Data display of category with id-->
<?php
$c = $category;
?>
<table class="table table-striped table-bordered">
	<tr>
		<td>Name</td>
		<td><?php echo $c['name']; ?></td>
	</tr>

	<tr>
		<td>Status</td>
		<td><?php echo $c['status']; ?></td>
	</tr>


</table>
<!--End of Data display of category with id//-->
