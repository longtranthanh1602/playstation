<?php $this->load->view('header'); ?>


<div class="row">

        <div class="col-lg-12">
          <h1 class="page-header">Hệ thống quản lý phòng máy PS3</h1>
        </div>
		<div class="col-lg-12">
          
        </div>
        <?php 
          foreach ($arrMachines->result() as $row) 
          {
        ?>
          <div class="col-lg-2 col-md-2 col-xs-6 thumb">
            <a class="thumbnail" href="<?php echo site_url();?>order/<?php echo $row->id; ?>">              
              <?php if($row->status_id==1) { ?>
                <img class="img-responsive" src="public/img/monitor-on.jpg">
              <?php }else{ ?>

                <img class="img-responsive" src="public/img/monitor-off.jpg">
              <?php } ?>
              <p class="text-center"><?php echo $row->name; ?></p>
            </a>
          </div>
        <?php
          }
        ?>
 </div>
      <hr>
<?php $this->load->view('footer'); ?>