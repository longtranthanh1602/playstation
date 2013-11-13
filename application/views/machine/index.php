<?php $this->load->view('header'); ?>

<ul class="breadcrumb" style="margin:20px 0px">
    <li><a href="<?php echo base_url();?>">Trang chủ</a> </li>
    <li class="active">Máy game PS3</li>
</ul>

	<p class="text-right">
		<button id="btn_insert" class="btn btn-success" type="button" >Thêm máy</button>
	</p>

<table class="table table-bordered table-hover">
	<tr class="success">
      <th>#</th>
      <th>Tên máy</th>
      <th>Tình trạng</th>
      <th>Mở lần cuối </th>
      <th>Ngày khởi tạo</th>
    </tr>
	<?php
		$iTotalMachine = 1;
		foreach ($arrMachines->result() as $row)
		{
			echo '<tr' . ($row->status_id==1 ? ' class="warning"': '' ).' >'.
					'<td>'. $iTotalMachine++  .'</td>'.
					'<td>'. $row->name  .'</td>'.
					'<td>'. $row->status_msg  .'</td>'.
					'<td>'. date('d-m-Y H:i:s', strtotime($row->updated_at))  .'</td>'.
					'<td>'. date('d-m-Y ', strtotime($row->created_at))  .'</td>'.
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
        <h4 class="modal-title" id="myModalLabel">Nhập thêm máy</h4>
      </div>
      <div class="modal-body" id="frm_insert">
      		<span class="success"></span>
      		<span class="error"></span>
        	<div id="pmsg" class="alert alert-warning" style="display: none"></div  >
			<div class="form-group">
			<form id="frmInsertMachine" >

		    	<label for="txtName">Tên máy PS3</label>

		    	<textarea name="txtName" id="txtName" class="form-control" rows="5"> </textarea>
		    	<span class="help-block">Cho phép nhập nhiều dữ liệu bằng cách ấn Enter</span>
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


<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_insert").click(function(){
			$("#frmInsertMachines").modal('toggle');
		});

		$("#btn_sign").click(function(){
			var sName = $.trim($("#txtName").val());

			if(sName=='')
			{
				alert('Nhập tên máy, ');
				return false;
			}

			$.post(

				"<?php echo site_url('machine/insert'); ?>",

				{'txtName':sName},

				function(response)
				{
					if(response.error_code != 'OK')
					{
						$("#pmsg").show();
						$("pmsg").text('Không có dữ liệu ');
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