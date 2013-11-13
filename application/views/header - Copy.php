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
     <div class="container">
