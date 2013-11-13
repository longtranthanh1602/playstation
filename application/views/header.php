<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hệ thống quản lý phòng máy PS3 </title>
	
    <!-- Bootstrap core CSS -->
    <?php echo link_tag('public/css/bootstrap.css'); ?>
    <?php echo link_tag('public/css/style.css'); ?>
    <!-- Custom CSS for the 'Thumbnail Gallery' Template -->
    <?php echo link_tag('public/css/thumbnail-gallery.css'); ?>
    <?php echo link_tag('public/css/bootstrap-select.min.css'); ?>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-select.min.js"></script>
	

	<script type="text/javascript">
		$(document).ready(function() {
		// Create two variable with the names of the months and days in an array
		var monthNames = [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ]; 
		var dayNames= ["CN","T2","T3","T4","T5","T6","T7"]

		// Create a newDate() object
		var newDate = new Date();
		// Extract the current date from Date object
		newDate.setDate(newDate.getDate());
		// Output the day, date, month and year   
		$('#Date').html(dayNames[newDate.getDay()] + "-" + newDate.getDate() + '/' + monthNames[newDate.getMonth()] + '/' + newDate.getFullYear());

		setInterval( function() {
			// Create a newDate() object and extract the seconds of the current time on the visitor's
			var seconds = new Date().getSeconds();
			// Add a leading zero to seconds value
			$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
			},1000);
			
		setInterval( function() {
			// Create a newDate() object and extract the minutes of the current time on the visitor's
			var minutes = new Date().getMinutes();
			// Add a leading zero to the minutes value
			$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
			},1000);
			
		setInterval( function() {
			// Create a newDate() object and extract the hours of the current time on the visitor's
			var hours = new Date().getHours();
			// Add a leading zero to the hours value
			$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
			}, 1000);	
		});
	</script>

  </head>

  <body>
  
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a class="navbar-brand" href="<?php echo base_url();?>">Trang chủ</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
			
			<ul class="nav navbar-nav-clock">
				<li id="hours"></li>
				<li id="point">:</li>
				<li id="min"></li>
				<li id="Date"></li>
          </ul>
		  
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url();?>machine">Máy game</a></li>
				<li><a href="<?php echo base_url();?>service">Dịch vụ</a></li>
				<li><a href="<?php echo base_url();?>report">In - Tổng kêt</a></li>
				<li><a href="<?php echo base_url();?>setting">Cài đặt</a></li>
			</ul>

		  </ul>
		  
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
	
	</div>
     <div class="container">
