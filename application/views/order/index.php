<?php $this->load->view('header'); ?>
<?php echo link_tag('public/css/bootstrap-datetimepicker.min.css'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.min.js"></script>
	<div id="pmsg" class="alert alert-danger" style="display: none"></div  >
  	<div class="row">
      <div class="col-md-4">
          <?php
          foreach ($arrMachines->result() as $row)
          {
          	$iMachineId = $row->id;
            $sMachineName = $row->name;
          ?>
            <div class="thumbnail">
              <?php if($row->status_id==1) { ?>
                <img class="img-responsive" src="<?php echo base_url(); ?>public/img/monitor-on.jpg">
              <?php }else { ?>
                <img class="img-responsive" src="<?php echo base_url(); ?>public/img/monitor-off.jpg">
              <?php } ?>
            </div>
        <?php
          }
        ?>
        <p class="text-center"  style="padding-top:5px">
			<button id="btnSave" class="btn btn-large btn-primary" type="button" <?php echo ($iFlagTurnOn==1 ? 'disabled': ''); ?> ><span class="glyphicon glyphicon-off" ></span> Bật máy</button>
			<button id="btnCharge" class="btn btn-large btn-success" type="button"  <?php echo ($iFlagTurnOn==0 ? 'disabled': ''); ?> ><span class="glyphicon glyphicon-chevron-down"> </span> Tính tiền</button>
			<button type="button" class="btn btn-warning" id="btn_add_services" <?php echo ($iFlagTurnOn==0 ? 'disabled': ''); ?>><span class="glyphicon glyphicon-plus" ></span> Thêm dịch vụ</button>
		</p>
		<div class="panel panel-primary" style="display: none; margin-top: 20px;" id="resultOrder" style="margin-top: 20px;">
			<div class="panel-heading">Phiếu thanh toán</div>
  			<div class="panel-body">
  				<div class="form-group">
  					<label for="inputEmail3" class="control-label">Tổng số tiền</label>
  					<input type="text" val="" class="text-right form-control input-lg" id="txtTotalAmountDisplay" placeholder="Thành tiền" style="color:#D43F3A" disabled>  					
  				</div>

  				<div class="form-group">
  					<label for="inputEmail3" class="control-label">Điều chỉnh tiền</label>
  					<input type="text" val="" class="text-right form-control " id="txtTotalAmount" placeholder="Thành tiền" style="color:#D43F3A" >  					
  				</div>

				<div class="form-group">
					<button id="btnFinish" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-ok-circle" ></span> Kết thúc</button>
				</div> 
  			</div>
		</div>
      </div>
      <div class="col-md-8" >
      	<div class="panel panel-success">
      		<div class="panel-heading"><strong> <?php echo $sMachineName; ?> </strong></div>
				<div class="panel-body">
				<?php
					$iOrderId = 0;
					$timeBegin = '';
					$timeEnd = '';
					$fTotalAmount =0;
					$fPlush	= 0;
					$fDiscount = 0;
					$fUnitPrice = $arrOptions['unit_price'];
					$fAmountService = $iTotalAmountService;
					foreach ($arrOrders->result() as $row)
					{
						$iOrderId = $row->order_id;
						$timeBegin = $row->begin;
						$timeEnd = $row->end;
						$fTotalAmount = $row->total_amount;
						$fPlush	= $row->plus;
						$fDiscount = $row->discount;
					}
				?>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">TG Bắt đầu</label>
						<div class="col-sm-7">
							<div  class="input-group input-append date" id="dtpTimeBegin"  >
								<input name="txtBegin" id="txtBegin" value="<?php echo (($timeBegin=='' && $iFlagTurnOn==0) ? '' : $timeBegin); ?>"  data-format="YYYY-MM-DD HH:mm:ss" type="text" class="form-control"  placeholder="Thời gian bắt đầu"></input>
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
								<input value="<?php echo (($timeEnd=='0000-00-00 00:00:00' || $timeEnd=='')  ? '' : date('d-m-Y H:i:s', strtotime($timeEnd))); ?>" name="txtEnd" id="txtEnd" data-format="YYYY-MM-DD HH:mm:ss" type="text" class="form-control"  placeholder="Thời gian kết thúc"></input>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Cộng thêm</label>
							<div class="col-xs-4">
								<input  value="<?php echo $fPlush; ?>" <?php echo ($iFlagTurnOn==0 ? 'disabled': ''); ?> type="text" class="form-control text-right" id="txtPlus" placeholder="Cộng thêm">
							</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Giảm giá</label>
							<div class="col-xs-4">
								<input value="<?php echo $fDiscount; ?>" <?php echo ($iFlagTurnOn==0 ? 'disabled': ''); ?> type="text" class="form-control text-right" id="txtDiscount" placeholder="Giảm giá">
							</div>
					</div>

					<div class="form-group ">
						<label for="inputPassword3" class="col-sm-2 control-label">Tiền dịch vụ</label>
							<div class="col-xs-3 input-append">
								<input type="text" value="<?php echo number_format($fAmountService);?>" disabled class="form-control text-right" id="inputPassword3" placeholder="Tiền dịch vụ">
							</div>
					</div>

					<hr>
					<table class="table table-bordered">
					<tr  class="warning">
						<th>STT</th>
						<th>Loại dịch vụ</th>
						<th align="right">Đơn giá </th>
						<th align="right">Số lượng </th>
						<th align="right">Thành tiền</th>
						<th align="right">#</th>
					</tr>
					<?php
					$iTotalOrderPlush = 1;

					if(!empty($arrServices) && !empty($arrOrderPlus))
					{
						$arrTemp = $arrServices->result();					
						foreach ($arrOrderPlus->result() as $row) 
						{
						?>
							<tr>
								<td><?php echo $iTotalOrderPlush++; ?></td>
								<td><?php echo $arrTemp[$row->service_id]->name; ?></td>
								<td align="right"><?php echo number_format($row->price); ?></td>
								<td align="right"><?php echo number_format($row->quantity); ?></td>
								<td align="right"><?php echo number_format($row->total_amount); ?></td>
								<td align="right" ><a  href="#" data-id="<?php echo  $row->id; ?>" rel="confirm_delete"> Xóa </a></td>
							</tr>
						<?php
						}
					}
					?>

					</table>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="mdService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nhập thêm máy</h4>
      </div>
      <div class="modal-body" id="frm_insert">
      		<span id="spError" class="error" style="display:none"></span>
      		<div id="spError" class="alert alert-warning" style="display: none"></div  >
    		<form class="form-horizontal" role="form">
			<div class="form-group">
				<label for="txtServiceType" class="col-sm-4 control-label">Loại dịch vụ</label>
				<div class="col-xs-4">
					<select id="sleServices" class="selectpicker">
					<option rel="" value="0" selected="selected" >--- Chọn dịch vụ --- </option>
					<?php
					foreach ($arrServices->result() as $row)
					{
						echo '<option rel="'. $row->unit_price .'" value="' . $row->id .'"> '. $row->name ."</option>";
					}
					?>
					</select>
				</div>
		  	</div>
		  	<div class="form-group">
		  		<label for="txtServiceType" class="col-sm-4 control-label">Đơn giá</label>
		  		<div class="col-xs-6">
		  			<input type="text" val="" class="text-right form-control" id="txtUnitPrice" placeholder="" disabled>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label for="txtServiceType" class="col-sm-4 control-label">Số lượng</label>
		  		<div class="col-xs-6">
		  			<input type="text" val="" class="text-right form-control" id="txtQuantity" placeholder="" >
		  		</div>
		  	</div>

	  		<div class="form-group" style="display:none" rel="result">
		  		<label for="txtServiceType" class="col-sm-4 control-label">Thành tiền </label>
		  		<div class="col-xs-6">
		  			<input type="text" val="" class="text-right form-control input-lg" id="txtResult" placeholder="Thành tiền" style="color:#D43F3A" disabled>
		  		</div>
		  	</div>


		  	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
        <button type="button" id="btn_sign" class="btn btn-success">Lưu dữ liệu</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<hr>
<script type="text/javascript">
    $(function () {

    	$('.selectpicker').selectpicker();

    	$('#sleServices').change(function(){

    		var unit_price = $("#sleServices option:selected").attr("rel");

    		$("#txtUnitPrice").val($("#sleServices option:selected").attr("rel"));

    		if(isNaN($("#txtQuantity").val())==false)
    		{
				var quantity = 1;

				$("#txtQuantity").val(1);
    		}
    		else
    		{
    			var quantity = $("#txtQuantity").val();
    		}


    		var result = unit_price*quantity;

    		$("#txtResult").val(result);

    		$("div[rel=result]").show();

    	});


    	$("#btnCharge").click(function()
    	{
    		if($("#txtBegin").val()=='')
    			{
    				alert('Máy không có thời gian bắt đầu');
    				return false;
    			}

    			$.post(

					"<?php echo site_url('order/checkOrder'); ?>",
					{
						'txtMachineId':<?php echo $iMachineId; ?>,
						'txtOrderId':<?php echo $iOrderId; ?>,
						'txtEnd': $("#txtEnd").val(),
						'txtBegin': $("#txtBegin").val(),
						'txtDiscount': $("#txtDiscount").val(),
						'txtPlus' : $("#txtPlus").val()

					},

					function(response)
					{

						if(response.error_code == 'ERROR_TIME_NOT_MATCH')
						{
							$("#pmsg").show();
							$("#pmsg").text('Dữ liệu thời gian không chính xác');
						}
						else
						{
							$("#txtTotalAmountDisplay").val(response.dsp_total_amount)
							$("#txtTotalAmount").val(response.total_amount)
							$("#resultOrder").show();
						}
					},'json'
				);
    	});


    	$("#txtQuantity").change(function(){

    		if(isNaN($("#txtQuantity").val())==false)
    		{
    			var unit_price = $("#sleServices option:selected").attr("rel");

    			var quantity = $("#txtQuantity").val();

    			var result = unit_price*quantity;

    			$("#txtResult").val(result);
    		}
    	});


    	$("#btnSave").click(function()
    	{
    		if(confirm("Ghi giờ chơi cho <?php echo $sMachineName; ?> "))
    		{
    			
    			$.post(

					"<?php echo site_url('order/save'); ?>",
					{
						'txtMachineId':<?php echo $iMachineId; ?>,
						'txtMachineName':"<?php echo $sMachineName; ?>",
						'txtBegin':$("#txtBegin").val()
					},

					function(response)
					{
						if(response.error_code == 'ERROR_NOT_FORMAT_DATETIME')
						{
							$("#pmsg").show();
							$("#pmsg").text('Không xác định được thời gian');
						}
						else
						{
							location.reload();
						}
					},'json'
				);
    		}
    	});


    	$("#btn_add_services").click(function(){
			$("#mdService").modal('toggle');
		});


    	$("#btn_sign").click(function(){

    		var iServiceId = $("#sleServices option:selected").val();

    		if(iServiceId==0)
    		{
    			alert("Nhập thông tin dịch vụ");
    			$("#sleServices").focus();
    			return false;
    		}

    		var iQuantity = $("#txtQuantity").val();

    		if(isNaN(iQuantity)==true)
    		{
    			alert("Nhập số lượng ");
    			$("#txtQuantity").empty();
    			$("#txtQuantity").focus();
    			return false;
    		}

    		if($("#txtResult").val=='')
    		{
    			alert("Không ghi nhận được tổng số tiền");
    			$("#txtResult").focus();
    			return false;
    		}

    		$.post(

					"<?php echo site_url('order/addToOrder'); ?>",
					{
						'txtMachineId':<?php echo $iMachineId; ?>,
						'txtOrderId':<?php echo $iOrderId; ?>,
						'txtServiceId': iServiceId,
						'txtQuantity': iQuantity
					},

					function(response)
					{

						if(response.error_code == 'NOT_UNIT_PRICE')
						{
							$("#spError").show();
							$("#spError").text('Dữ liệu không chính xác');
						}
						else
						{
							location.reload();
						}
					},'json'
				);

    	});
		
		$("#btnFinish").click(function()
		{			
			if(confirm("Thanh toán tiền <?php echo $sMachineName; ?> "))
    		{
    			if(isNaN($("#txtTotalAmount").val())==true)
    			{
    				alert('Miễn phí cho <?php echo $sMachineName; ?> ?');
    				$("#txtTotalAmount").focus();
    				return false;
    			}
    			$.post(

					"<?php echo site_url('order/finish'); ?>",
					{
						'txtMachineId':<?php echo $iMachineId; ?>,
						'txtOrderId':<?php echo $iOrderId; ?>,
						'txtEnd': $("#txtEnd").val(),
						'txtBegin': $("#txtBegin").val(),
						'txtDiscount': $("#txtDiscount").val(),
						'txtPlus' : $("#txtPlus").val(),
						'txtTotalAmount': $("#txtTotalAmount").val()

					},
					function(response)
					{
						location.replace("<?php echo base_url();?>");
					},
					'json'
				);
    		}
		});
		
		$('a[rel=confirm_delete]').click(function()
		{
			if(confirm("Xóa dịch vụ cho <?php echo $sMachineName; ?> "))
    		{
				var data_id = $(this).attr("data-id");
				var data_order_id  = "<?php echo $iOrderId;  ?>";
				
				$.post(

					"<?php echo site_url('order/delete_order_plus'); ?>",
					{						
						'txtOrderId':data_order_id,
						'txtOrderPlusId': data_id
					},
					function(response)
					{
						location.replace("<?php echo current_url();?>");
					},
					'json'
				);		
			}
		});
		
        $('#dtpTimeBegin').datetimepicker();


        $('#dtpTimeEnd').datetimepicker();
    });
</script>

<div class="row1">
        <?php 
          foreach ($arrOtherMachines->result() as $row) 
          {
        ?>
          <div class="col-lg-02 col-md-2 col-xs-6 thumb">
            <a class="thumbnail" href="<?php echo site_url();?>order/<?php echo $row->id; ?>">              
              <?php if($row->status_id==1) { ?>
                <img class="img-responsive" src="../public/img/monitor-on.jpg">
              <?php }else{ ?>

                <img class="img-responsive" src="../public/img/monitor-off.jpg">
              <?php } ?>
              <p class="text-center"><?php echo $row->name; ?></p>
            </a>
          </div>
        <?php
          }
        ?>
 </div>
