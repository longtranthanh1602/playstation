<?php $this->load->view('header'); ?>

<ul class="breadcrumb" style="margin:20px 0px">
    <li><a href="<?php echo base_url();?>">Trang chủ</a> </li>
    <li class="active">Tổng kết</li>
</ul>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<tr class="danger">
				<th>Tổng số tiền trong dữ liệu</th>
				<th><?php echo number_format($arrAll['total_amount']); ?></th>
			</tr>
		</table>

	</div>	
</div>

<div class="row">
      <div class="col-md-4">
      	
			<table class="table table-striped">
			<tr class="active">
				<th>STT</th>
				<th>Thời gian</th>			
				<th>Tổng số tiền</th>
			</tr>
				<?php 
					$iTotalRecords = 1;
					$iTotalAmountMoney = 0;
					$iTotalRecordDisplay = 1;
					foreach($arrReportOrders->result() as $row)
					{
						$iTotalAmountMoney +=  $row->fTotalAmount;								
					?>	
						<tr >
							<td><?php echo $iTotalRecords++; ?></td>
							<td><?php echo date('d-m-Y',strtotime($row->fDate)); ?></td>			
							<td align="right"><?php echo number_format($row->fTotalAmount); ?></td>
						</tr>
					<?php					
					}				
				?>
				<tr class="danger">
					<th colspan="2">Tổng kết</th>
					<th align="right"><?php echo number_format($iTotalAmountMoney); ?></th>
				</tr>
			
			</table>
	  </div>
	  
	  <div class="col-md-8" >
		
		<table class="table table-hover">
			<tr class="active">
				<th>STT</th>
				<th>Máy</th>
				<th>Thời gian</th>				
				<th>Kết thúc</th>
				<th>Tổng số tiền</th>
			</tr>
			<?php 
			$iTotalRecords = 1;
			$iTotalAmountInDay = 0;
			foreach ($arrOrders->result() as $row)
			{
				$timeBegin = date('d-m-Y H:i:s', strtotime($row->begin));
				$timeEnd = date('d-m-Y H:i:s', strtotime($row->end));

				$fTotalAmount  = $row->total_amount;	
				$iTotalAmountInDay += $fTotalAmount;				

			?>					
				<tr >
					<td><?php echo $iTotalRecords++; ?></td>
					<td>
						<?php echo ($row->status_id==0 ? '<a href="'.base_url() .'order/edit/'. $row->order_id.'" >' :''); ?>
							<?php echo $row->name; ?> 
						<?php echo ($row->status_id==0 ? '</a>' :''); ?>
					</td>
					<td><?php echo $timeBegin;?> </td>
					<td><?php echo ($timeEnd=='01-01-1970 07:00:00' ? '' :$timeEnd)  ;?> </td>
					<td><?php echo ($fTotalAmount!=0 ? number_format($fTotalAmount) : ''); ?></td>	
				</tr>
				
			<?php
			}
			?>
			<tr class="success" >
				<th colspan="4" >Tổng kết</th>
				<th ><?php echo ($iTotalAmountInDay!=0 ? number_format($iTotalAmountInDay) : ''); ?></th>	
			</tr>
		</table>
	  </div>
</div>



<?php $this->load->view('footer'); ?>	