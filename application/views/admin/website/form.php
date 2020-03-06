<script language="javascript">
$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	$("#rating").val(ratingValue);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });
  
  <?php
if (isset($website['id'])) {
    ?>
    var onStar = parseInt(<?=$website['rating']?>); // The star currently selected
    var stars = $("#stars").children('li.star');
    
    for (i = 0; i < stars; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	$("#rating").val(ratingValue);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
  <?php
} else {
    ?>
    var onStar = 3; // The star currently selected
    var stars = $("#stars").children('li.star');
    
    for (i = 0; i < stars; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	$("#rating").val(ratingValue);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
  <?php
}
?>
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>
<style>
.new-react-version {
	padding: 20px 20px;
	border: 1px solid #eee;
	border-radius: 20px;
	box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
	text-align: center;
	font-size: 14px;
	line-height: 1.7;
}

.new-react-version .react-svg-logo {
	text-align: center;
	max-width: 60px;
	margin: 20px auto;
	margin-top: 0;
}

.success-box {
	margin: 50px 0;
	padding: 10px 10px;
	border: 1px solid #eee;
	background: #f9f9f9;
}

.success-box img {
	margin-right: 10px;
	display: inline-block;
	vertical-align: top;
}

.success-box>div {
	vertical-align: top;
	display: inline-block;
	color: #888;
}

/* Rating Star Widgets Style */
.rating-stars ul {
	list-style-type: none;
	padding: 0;
	-moz-user-select: none;
	-webkit-user-select: none;
}

.rating-stars ul>li.star {
	display: inline-block;
}

/* Idle State of the stars */
.rating-stars ul>li.star>i.fa {
	font-size: 2.5em; /* Change the size of the stars */
	color: #ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul>li.star.hover>i.fa {
	color: #FFCC36;
}

/* Selected state of the stars */
.rating-stars ul>li.star.selected>i.fa {
	color: #FF912C;
}
</style>
<?php
if (isset($msg)) {    
   echo $msg."<br>";
}
?>
<a href="<?php echo site_url('admin/website/index'); ?>"
	class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Website'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/website/save/'.$website['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label for="Url" class="col-md-4 control-label">Url</label>
			<div class="col-md-8">
				<input type="text" name="url"
					value="<?php echo ($this->input->post('url') ? $this->input->post('url') : $website['url']); ?>"
					class="form-control" id="url" />
			</div>
		</div>
		<div class="form-group">
			<label for="Basic Desc" class="col-md-4 control-label">Basic Desc</label>
			<div class="col-md-8">
				<textarea name="basic_desc" id="basic_desc" class="form-control"
					rows="4" /><?php echo ($this->input->post('basic_desc') ? $this->input->post('basic_desc') : $website['basic_desc']); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="Category" class="col-md-4 control-label">Category</label>
			<div class="col-md-8"> 
          <?php
        $this->CI = & get_instance();
        $this->CI->load->database();
        $this->CI->load->model('Category_model');
        $dataArr = $this->CI->Category_model->get_all_category();
        ?> 
          <select name="category_id" id="category_id"
					class="form-control" />
				<option value="">--Select--</option> 
            <?php
            for ($i = 0; $i < count($dataArr); $i ++) {
                ?> 
            <option value="<?=$dataArr[$i]['id']?>"
					<?php if($website['category_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['name']?></option> 
            <?php
            }
            ?> 
          </select>
			</div>
		</div>
		<div class="form-group">
			<label for="Contact Person" class="col-md-4 control-label">Contact
				Person</label>
			<div class="col-md-8">
				<input type="text" name="contact_person"
					value="<?php echo ($this->input->post('contact_person') ? $this->input->post('contact_person') : $website['contact_person']); ?>"
					class="form-control" id="contact_person" />
			</div>
		</div>
		<div class="form-group">
			<label for="Mobile" class="col-md-4 control-label">Mobile</label>
			<div class="col-md-8">
				<input type="text" name="Mobile"
					value="<?php echo ($this->input->post('Mobile') ? $this->input->post('Mobile') : $website['Mobile']); ?>"
					class="form-control" id="Mobile" />
			</div>
		</div>
		<div class="form-group">
			<label for="Mobile 2" class="col-md-4 control-label">Mobile 2</label>
			<div class="col-md-8">
				<input type="text" name="Mobile_2"
					value="<?php echo ($this->input->post('Mobile_2') ? $this->input->post('Mobile_2') : $website['Mobile_2']); ?>"
					class="form-control" id="Mobile_2" />
			</div>
		</div>
		<div class="form-group">
			<label for="Email" class="col-md-4 control-label">Email</label>
			<div class="col-md-8">
				<input type="text" name="email"
					value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $website['email']); ?>"
					class="form-control" id="email" />
			</div>
		</div>
		<div class="form-group">
			<label for="Facebook" class="col-md-4 control-label">Facebook</label>
			<div class="col-md-8">
				<input type="text" name="facebook"
					value="<?php echo ($this->input->post('facebook') ? $this->input->post('facebook') : $website['facebook']); ?>"
					class="form-control" id="facebook" />
			</div>
		</div>
		<div class="form-group">
			<label for="Rating" class="col-md-4 control-label">Rating</label>
			<div class="col-md-8">
				<input type="text" name="rating"
					value="<?php echo ($this->input->post('rating') ? $this->input->post('rating') : $website['rating']); ?>"
					class="form-control" id="rating" />
				<section class='rating-widget'>
					<!-- Rating Stars Box -->
					<div class='rating-stars text-center'>
						<ul id='stars'>
							<li class='star' title='Poor' data-value='1'><i
								class='fa fa-star fa-fw'></i></li>
							<li class='star' title='Fair' data-value='2'><i
								class='fa fa-star fa-fw'></i></li>
							<li class='star' title='Good' data-value='3'><i
								class='fa fa-star fa-fw'></i></li>
							<li class='star' title='Excellent' data-value='4'><i
								class='fa fa-star fa-fw'></i></li>
							<li class='star' title='WOW!!!' data-value='5'><i
								class='fa fa-star fa-fw'></i></li>
						</ul>
					</div>

					<div class='success-box'>
						<div class='clearfix'></div>
						<img alt='tick image' width='32'
							src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
						<div class='text-message'></div>
						<div class='clearfix'></div>
					</div>
				</section>


			</div>
		</div>
		<div class="form-group">
			<label for="Auto Featch" class="col-md-4 control-label">Auto Featch</label>
			<div class="col-md-8">
				<input type="text" name="auto_featch"
					value="<?php echo ($this->input->post('auto_featch') ? $this->input->post('auto_featch') : $website['auto_featch']); ?>"
					class="form-control" id="auto_featch" />
			</div>
		</div>
		<div class="form-group">
			<label for="File Image" class="col-md-4 control-label">File Image</label>
			<div class="col-md-8">
				<input type="file" name="file_image" id="file_image"
					value="<?php echo ($this->input->post('file_image') ? $this->input->post('file_image') : $website['file_image']); ?>"
					class="form-control-file" />
			</div>
		</div>
		<div class="form-group">
			<label for="Active" class="col-md-4 control-label">Active</label>
			<div class="col-md-8"> 
           <?php
        $enumArr = $this->customlib->getEnumFieldValues('website', 'active');
        ?> 
           <select name="active" id="active" class="form-control" />
				<option value="">--Select--</option> 
             <?php
            for ($i = 0; $i < count($enumArr); $i ++) {
                ?> 
             <option value="<?=$enumArr[$i]?>"
					<?php if($website['active']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php
            }
            ?> 
           </select>
			</div>
		</div>
		<div class="form-group">
			<label for="Admin Notes" class="col-md-4 control-label">Admin Notes</label>
			<div class="col-md-8">
				<textarea name="admin_notes" id="admin_notes" class="form-control"
					rows="4" /><?php echo ($this->input->post('admin_notes') ? $this->input->post('admin_notes') : $website['admin_notes']); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="Order" class="col-md-4 control-label">Order</label>
			<div class="col-md-8">
				<input type="text" name="order"
					value="<?php echo ($this->input->post('order') ? $this->input->post('order') : $website['order']); ?>"
					class="form-control" id="order" />
			</div>
		</div>

	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-4 col-sm-8">
		<button type="submit" class="btn btn-success"><?php if(empty($website['id'])){?>Save<?php }else{?>Update<?php } ?></button>
	</div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>
