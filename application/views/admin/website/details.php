<a href="<?php echo site_url('admin/website/index'); ?>"
	class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Website'); ?></h5>
<!--Data display of website with id-->
<?php
$c = $website;
?>
<table class="table table-striped table-bordered">
	<tr>
		<td>Url</td>
		<td><?php echo $c['url']; ?></td>
	</tr>

	<tr>
		<td>Basic Desc</td>
		<td><?php echo $c['basic_desc']; ?></td>
	</tr>

	<tr>
		<td>Category</td>
		<td><?php
$this->CI = & get_instance();
$this->CI->load->database();
$this->CI->load->model('Category_model');
$dataArr = $this->CI->Category_model->get_category($c['category_id']);
echo $dataArr['name'];
?>
									</td>
	</tr>

	<tr>
		<td>Contact Person</td>
		<td><?php echo $c['contact_person']; ?></td>
	</tr>

	<tr>
		<td>Mobile</td>
		<td><?php echo $c['Mobile']; ?></td>
	</tr>

	<tr>
		<td>Mobile 2</td>
		<td><?php echo $c['Mobile_2']; ?></td>
	</tr>

	<tr>
		<td>Email</td>
		<td><?php echo $c['email']; ?></td>
	</tr>

	<tr>
		<td>Facebook</td>
		<td><?php echo $c['facebook']; ?></td>
	</tr>

	<tr>
		<td>Rating</td>
		<td><?php echo $c['rating']; ?></td>
	</tr>

	<tr>
		<td>Auto Featch</td>
		<td><?php echo $c['auto_featch']; ?></td>
	</tr>

	<tr>
		<td>File Image</td>
		<td><?php
if (is_file(APPPATH . '../public/' . $c['file_image']) && file_exists(APPPATH . '../public/' . $c['file_image'])) {
    ?>
										  <img
			src="<?php echo base_url().'public/'.$c['file_image']?>"
			class="picture_50x50">
										  <?php
} else {
    ?>
										<img src="<?php echo base_url()?>public/uploads/no_image.jpg"
			class="picture_50x50">
										<?php
}
?>	
										</td>
	</tr>

	<tr>
		<td>Active</td>
		<td><?php echo $c['active']; ?></td>
	</tr>

	<tr>
		<td>Admin Notes</td>
		<td><?php echo $c['admin_notes']; ?></td>
	</tr>

	<tr>
		<td>Order</td>
		<td><?php echo $c['order']; ?></td>
	</tr>

	<tr>
		<td>Created At</td>
		<td><?php echo $c['created_at']; ?></td>
	</tr>

	<tr>
		<td>Updated At</td>
		<td><?php echo $c['updated_at']; ?></td>
	</tr>


</table>
<!--End of Data display of website with id//-->
