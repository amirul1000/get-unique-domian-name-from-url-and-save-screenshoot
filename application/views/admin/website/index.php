<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Website'); ?></h5>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/website/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type"
			class="select"
			onChange="window.location='<?php echo site_url('admin/website/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/website/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//-->

<!--Data display of website-->
<table class="table table-striped table-bordered">
	<tr>
		<th>Url</th>
		<th>Basic Desc</th>
		<th>Category</th>
		<th>Contact Person</th>
		<th>Mobile</th>
		<!--<th>Mobile 2</th>
<th>Email</th>
<th>Facebook</th>
<th>Rating</th>
<th>Auto Featch</th>-->
		<th>File Image</th>
		<th>Active</th>
		<th>Admin Notes</th>
		<th>Order</th>

		<th>Actions</th>
	</tr>
	<?php foreach($website as $c){ ?>
    <tr>
		<td><?php echo $c['url']; ?></td>
		<td><?php echo $c['basic_desc']; ?></td>
		<td><?php
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->model('Category_model');
    $dataArr = $this->CI->Category_model->get_category($c['category_id']);
    echo $dataArr['name'];
    ?>
									</td>
		<td><?php echo $c['contact_person']; ?></td>
		<td><?php echo $c['Mobile']; ?></td>
		<!--<td><?php echo $c['Mobile_2']; ?></td>
<td><?php echo $c['email']; ?></td>
<td><?php echo $c['facebook']; ?></td>
<td><?php echo $c['rating']; ?></td>
<td><?php echo $c['auto_featch']; ?></td>-->
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
		<td><?php echo $c['active']; ?></td>
		<td><?php echo $c['admin_notes']; ?></td>
		<td><?php echo $c['order']; ?></td>

		<td><a
			href="<?php echo site_url('admin/website/details/'.$c['id']); ?>"
			class="action-icon"> <i class="zmdi zmdi-eye"></i></a> <a
			href="<?php echo site_url('admin/website/save/'.$c['id']); ?>"
			class="action-icon"> <i class="zmdi zmdi-edit"></i></a> <a
			href="<?php echo site_url('admin/website/remove/'.$c['id']); ?>"
			onClick="return confirm('Are you sure to delete this item?');"
			class="action-icon"> <i class="zmdi zmdi-delete"></i></a></td>
	</tr>
	<?php } ?>
</table>
<!--End of Data display of website//-->

<!--No data-->
<?php
if (count($website) == 0) {
    ?>
<div align="center">
	<h3>Data is not exists</h3>
</div>
<?php
}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
echo $link;
?>
<!--End of Pagination//-->
