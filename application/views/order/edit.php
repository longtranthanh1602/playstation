<?php $this->load->view('header'); ?>
<?php echo link_tag('public/css/bootstrap-datetimepicker.min.css'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.min.js"></script>


<ul class="breadcrumb" style="margin:20px 0px">
    <li><a href="<?php echo base_url();?>">Trang chủ</a> </li>
    <li class="active">Chỉnh sửa hóa đơn <?php echo $arrOrders["name"]; ?> </li>
</ul>

<div class="row">	
	<form class="form-horizontal" role="form"  action="<?php echo base_url();?>order/edit/<?php echo $arrOrders["order_id"]; ?>" method="POST">

		<div id="pmsg" class="alert alert-danger" <?php echo (count($arrErrorMsg)> 0 ? '':'style="display: none"') ?>>
			<?php 
				if(isset($arrErrorMsg))
				{
					foreach ($arrErrorMsg as $value) 
					{
						echo  (($value!='') ? '<p>'. $value .'</p>':'') ;	
					}
	
				}
			?>
		</div>
		<input type="hidden" value="<?php echo $arrOrders['order_id'];  ?>" name="txtOrderId">
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">TG Bắt đầu</label>
			<div class="col-sm-7">
				<div  class="input-group input-append date" id="dtpTimeBegin"  >
					<input name="txtBegin" id="txtBegin" value="<?php echo (($arrOrders['begin']=='') ? '' : $arrOrders['begin']); ?>"  data-format="YYYY-MM-DD HH:mm:ss" type="text" class="form-control"  placeholder="Thời gian bắt đầu"></input>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">TG Kết thúc</label>
			<div class="col-xs-7">
				<div  class="input-group input-append date" id="dtpTimeEnd" >
					<input value="<?php echo (($arrOrders['end']=='0000-00-00 00:00:00' || $arrOrders['end']=='')  ? '' : date('Y-m-d H:i:s', strtotime($arrOrders['end']))); ?>" name="txtEnd" id="txtEnd" data-format="YYYY-MM-DD HH:mm:ss" type="text" class="form-control"  placeholder="Thời gian kết thúc"></input>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Cộng thêm</label>
			<div class="col-xs-4">
				<input  value="<?php echo $arrOrders['plus']; ?>" type="text" class="form-control text-right" id="txtPlus" name="txtPlus" placeholder="Cộng thêm">
			</div>
		</div>

		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Giảm giá</label>
			<div class="col-xs-4">
				<input value="<?php echo $arrOrders['discount']; ?>"  type="text" class="form-control text-right" id="txtDiscount" name="txtDiscount" placeholder="Giảm giá">
			</div>
		</div>

		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tổng số tiền</label>
			<div class="col-xs-4">
				<input value="<?php echo $arrOrders['total_amount']; ?>"  type="text" class="form-control text-right" id="txtTotalAmount" name="txtTotalAmount" placeholder="Tổng số tiền">
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="col-md-offset-6">
				<button id="btnFinish" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-ok-circle" ></span> Cập nhật </button>
			</div>
		</div> 	
	</form>
</div>
<script type="text/javascript">
    $(function () {
    	$('.selectpicker').selectpicker();
    });
</script>