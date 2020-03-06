<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css">
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Website'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide"> </htmlpageheader>

<htmlpageheader name="otherpages" class="hide"> <span class="float_left"></span>
<span class="padding_5"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
<span class="float_right"></span> </htmlpageheader>
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" />

<htmlpagefooter name="myfooter" class="hide">
<div align="center">
	<br>
	<span class="padding_10">Page {PAGENO} of {nbpg}</span>
</div>
</htmlpagefooter>

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of website-->
<table cellspacing="3" cellpadding="3" class="table" align="center">
	<tr>
		<th>Url</th>
		<th>Basic Desc</th>
		<th>Category</th>
		<th>Contact Person</th>
		<th>Mobile</th>
		<th>Mobile 2</th>
		<th>Email</th>
		<th>Facebook</th>
		<th>Rating</th>
		<th>Auto Featch</th>
		<th>File Image</th>
		<th>Active</th>
		<th>Admin Notes</th>
		<th>Order</th>

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
		<td><?php echo $c['Mobile_2']; ?></td>
		<td><?php echo $c['email']; ?></td>
		<td><?php echo $c['facebook']; ?></td>
		<td><?php echo $c['rating']; ?></td>
		<td><?php echo $c['auto_featch']; ?></td>
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

	</tr>
	<?php } ?>
</table>
<!--End of Data display of website//-->
