<?php $this->load->view('header'); ?>

<ul class="breadcrumb" style="margin:20px 0px">
    <li><a href="<?php echo base_url();?>">Trang chủ</a> </li>
    <li class="active">Dịch vụ thêm</li>   
</ul>

	<p class="text-right">
		<button id="btn_insert" class="btn btn-success" type="button" >Thêm dịch vụ</button>	
	</p>

<table class="table table-bordered table-hover">
	<tr class="success">
      <th>#</th>
      <th>Dịch vụ</th>
      <th>Đơn giá</th>      
      <th>Ngày cập nhật</th>
    </tr>
	<?php
		$iTotalService = 1;
		foreach ($arrServices->result() as $row)
		{
			echo '<tr>'.
					'<td>'. $iTotalService++  .'</td>'.
					'<td>'. $row->name  .'</td>'.
					'<td class="text-right">'. number_format($row->unit_price) .'</td>'.
					'<td class="text-right">'. date('d-m-Y ', strtotime($row->updated_at))  .'</td>'.					
				'</tr>';
		}
	?>
</table>

<!-- Modal -->
<div class="modal fade" id="frmInsertMachines" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nhập thêm dịch vụ</h4>
      </div>
      <div class="modal-body" id="frm_insert">
      		<span class="success"></span>
      		<span class="error"></span>
        	<div id="pmsg" class="alert alert-warning" style="display: none"></div  >
			<div class="form-group">	
		    	<label for="txtName">Tên dịch vụ</label>
			   	<input name="txtName" id="txtName"  type="text" class="form-control" >		    	
			</form>
			<div class="form-group">	
		    	<label for="txtUnitPrice">Giá tiền</label>
			   	<input name="txtUnitPrice" id="txtUnitPrice"  type="text" class="form-control" >		    	
			</form>
        	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
        <button type="button" id="btn_sign" class="btn btn-success">Lưu dữ liệu</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_insert").click(function(){
			$("#frmInsertMachines").modal('toggle');
		});	

		$("#btn_sign").click(function(){
			var sName = $.trim($("#txtName").val());		
			var fUnitPrice = $.trim($("#txtUnitPrice").val());		

			if(sName=='')
			{
				alert('Tên dịch vụ, ');
				$("#txtName").css('border-color',"#FF0000");
				return false;
			}				

			if(fUnitPrice=='')
			{
				alert('Nhập giá tiên dịch vụ, ');
				$("#txtUnitPrice").css('border-color',"#FF0000");
				return false;
			}				


			$.post(

				"<?php echo site_url('service/insert'); ?>",
				
				{'txtName':sName,'txtUnitPrice':fUnitPrice},

				function(response)
				{					
					if(response.error_code != 'OK')
					{
						$("#pmsg").show();
						$("pmsg").text('Không nhập được dữ liệu! ');
					}
					else
					{
						location.reload();
					}
				},'json'
			);
		});

	});
</script>


<?php $this->load->view('footer'); ?>