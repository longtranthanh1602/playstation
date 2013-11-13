<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Order
 */
class Order extends CI_Controller
{

	/**
	 * [$_data description]
	 * @var [type]
	 */
	protected $_data;

	/**
	 * [__construct description]
	 */
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();   

        self::$this->_data['arrErrorMsg'] = array();     
    }

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	function index($iMachineId=0)
	{
		if($iMachineId==0)
		{
			redirect('home');
		}

		self::$this->_data['arrOrderPlus'] =  array();

		self::$this->_data['iTotalAmountService'] = 0;

		/* Retrive machine */
		self::$this->_data['arrMachines'] = $this->db->get_where('machines', array('id' => $iMachineId));
		/* Retrive other machine */
		self::$this->_data['arrOtherMachines'] = $this->db->query('SELECT *FROM tbl_machines');
		
		/* Get all Services */
		self::$this->_data['arrServices'] =  $this->db->get('services');

		/* Get in Order */
		self::$this->_data['arrOrders'] =  $this->db->get_where('orders', array('machine_id'=>$iMachineId, 'status_id'=>'1'));

		$arrOrder  = self::$this->_data['arrOrders']->row_array();

		$iOrderId = 0;

		if(count($arrOrder ) > 0 )
		{
			$iOrderId = $arrOrder['order_id'];

			/* Order plus **/
			self::$this->_data['arrOrderPlus'] = $this->db->get_where('order_plus', array('order_id'=>$iOrderId));

			/** Total Amount  **/
			foreach (self::$this->_data['arrOrderPlus']->result() as $row) 
			{
				self::$this->_data['iTotalAmountService'] += $row->total_amount;
			}
		}

		self::$this->_data['iFlagTurnOn'] = count(self::$this->_data['arrOrders']->result());

		/* Get price in game hour  */
		self::$this->_data['arrOptions']= $this->db->get_where('mst_options', array('id'=>1 ))->row_array();

		$this->load->view('order/index', self::$this->_data);

	}

	/**
	 * [edit description]
	 * @param  integer $iOrderId [description]
	 * @return [type]            [description]
	 */
	function edit($iOrderId=0)
	{
		/* Get order */	

		self::$this->_data['arrOrders'] = $this->db->get_where('orders',array('order_id'=>$iOrderId))->row_array();

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$iError = true;	
			$iOrderId = (int) $this->input->post('txtOrderId');
			$fPlus = (float) $this->input->post('txtPlus');
			$fDiscount = (float) $this->input->post('txtDiscount');
			$fTotalAmount = (float) $this->input->post('txtTotalAmount');

			$timeBegin = $this->input->post('txtBegin');
			$timeEnd = $this->input->post('txtEnd');
			
			if($iOrderId==0)
			{
				self::$this->_data['arrErrorMsg'][] = 'Không tìm được số Order';
				$iError = false;
			}


			if(($this->isValidDateTime($timeBegin))==false)
			{					
				self::$this->_data['arrErrorMsg'][]	= 'Thời gian bắt đầu không đúng định dạng';				
				$iError = false;
			}

			if(($this->isValidDateTime($timeEnd))==false)
			{
				self::$this->_data['arrErrorMsg'][]	= 'Thời gian kết thúc không đúng định dạng';				
				$iError = false;
			}				
				
			
			if($iError==true)
			{
				$fTotalAmount = $fTotalAmount + $fPlus - $fDiscount;
				/* Update */
				$arrData  = array(
					'begin'			=>$timeBegin,
					'end' 			=>$timeEnd,
					'plus'			=>$fPlus,
					'discount'  	=>$fDiscount,
					'total_amount'	=>$fTotalAmount,
					'updated_at'	=>date('Y-m-d H:i:s')
				);

			 	$this->db->where('order_id', $iOrderId);
		 	 	$this->db->update('orders', $arrData); 

		 	 	redirect('report');
			}
		}

		$this->load->view('order/edit', self::$this->_data);
	}

	
	/**
	 * [save description]
	 * @return [type] [description]
	 */
	function save()
	{
		$arrReponse = array('error_code'=>'');

		if($this->input->post('txtBegin')!='')
		{
			$timeBegin = $this->input->post('txtBegin');	
		}
		else
		{
			$timeBegin = date('Y-m-d H:i:s');
		}
		
		
		$iMachineId = $this->input->post('txtMachineId');
		$sMachineName  = $this->input->post('txtMachineName');
		
		if(($this->isValidDateTime($timeBegin))==false)
		{
			die(json_encode(array('error_code'=>'ERROR_NOT_FORMAT_DATETIME')));
		}

		if((int) $iMachineId==0)
		{
			die(json_encode(array('error_code'=>'ERROR_NOT_MACHINE_ID')));
		}

		/* Save */
		$arrData = array(
				'machine_id'=> $iMachineId,
				'name'=>$sMachineName , 
				'begin'=>date('Y-m-d H:i:s',strtotime($timeBegin)),
				'status_id'=>ID_ORDER_ON,
				'status_msg'=>MSG_ORDER_ON,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s')
			);

		$this->db->insert('orders', $arrData);

		/* Update status of Monitor */
		$arrData = array(
			'status_id'=>ID_STATUS_MACHINE_ON,
			'status_msg'=>MSG_STATUS_MACHINE_ON
		);

		$this->db->where('id', $iMachineId);
		$this->db->update('machines', $arrData);

		die(json_encode($arrReponse));
	}

	/**
	 * [isValidDateTime description]
	 * @param  [type]  $dateTime [description]
	 * @return boolean           [description]
	 */
	function isValidDateTime($dateTime)
	{
    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
        if (checkdate($matches[2], $matches[3], $matches[1])) {
            return true;
        }
    }

    return false;
	}

	/*

	 */
	function addToOrder()
	{
		$arrReponse = array('error_code'=>'');

		$iMachineId = (int) $this->input->post('txtMachineId');
		$iOrderId = (int) $this->input->post('txtOrderId');
		$iServiceId = (int) $this->input->post('txtServiceId');
		$iQuantity = (int) $this->input->post('txtQuantity');

		if($iMachineId==0 || $iOrderId==0 || $iServiceId==0 || $iQuantity==0 )
		{
			die(json_encode(array('error_code'=>'NOT_DATA')));
		}

		/* Get price */

		$arrServices = $this->db->get_where('services', array('id'=>$iServiceId ))->row_array();

		$fUnitPrice = 0;
		if(! isset($arrServices['unit_price']) || $arrServices['unit_price']==0)
		{
			die(json_encode(array('error_code'=>'NOT_UNIT_PRICE')));
		}

		$fUnitPrice =  $arrServices['unit_price'];

		/* Add into database */
		$arrData = array(
			'order_id'=>$iOrderId,
			'service_id'=>$iServiceId,
			'quantity'=>$iQuantity,
			'price'=>$fUnitPrice,
			'total_amount'=>($iQuantity * $fUnitPrice) ,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s')
		);

		$this->db->insert('order_plus', $arrData);

		die(json_encode($arrReponse));

	}

	function finish()
	{
		$iMachineId = (int) $this->input->post('txtMachineId');
		$iOrderId = (int) $this->input->post('txtOrderId');
		$fDiscount = (float)  $this->input->post('txtDiscount');
		$fPlus = (float)  $this->input->post('txtPlus');
		$timeBegin = $this->input->post('txtBegin');
		$timeEnd = $this->input->post('txtEnd');
		
		$fTotalAmount = (float)  $this->input->post('txtTotalAmount');
			

		/* Update status of Monitor */
		$arrData = array(
			'plus'=>$fPlus,
			'discount'=>$fDiscount,
			'total_amount'=>$fTotalAmount,
			'end'=>$timeEnd,
			'begin'=>$timeBegin,
			'status_id'=>ID_ORDER_OFF,
			'status_msg'=>MSG_ORDER_OFF,
			'updated_at'=>date('Y-m-d H:i:s')
		);

		$this->db->where('order_id', $iOrderId);
		$this->db->update('orders', $arrData);

		/* Update status of Monitor */
		$arrData = array(
			'status_id'=>ID_STATUS_MACHINE_OFF,
			'status_msg'=>MSG_STATUS_MACHINE_OFF
		);

		$this->db->where('id', $iMachineId);
		$this->db->update('machines', $arrData);

		die(json_encode(array()));
	}


	/**
	 * [checkOrder description]
	 * @return [type] [description]
	 */
	function checkOrder()
	{
		$fTotalAmountOrder = 0; 

		$iMachineId = (int) $this->input->post('txtMachineId');
		$iOrderId = (int) $this->input->post('txtOrderId');
		$fDiscount = (float)  $this->input->post('txtDiscount');
		$fPlus = (float)  $this->input->post('txtPlus');
		$timeBegin = $this->input->post('txtBegin');

		if($this->input->post('txtEnd')!='')
		{
			$timeEnd = $this->input->post('txtEnd');	
		}
		else
		{
			$timeEnd = date('Y-m-d H:i:s');
		}

		$timeEnd = $this->input->post('txtEnd');	

		$arrOrders =  $this->db->get_where('orders', array('machine_id'=>$iMachineId, 'order_id'=>$iOrderId))->row_array();		
		
		if($arrOrders['begin'] !=$timeBegin)
		{			
			$arrData['begin'] = date('Y-m-d H:i:s', strtotime($timeBegin));
		}

		$timeBegin = date('Y-m-d H:i:s', strtotime($timeBegin));			
		
		if(date('Y-m-d', strtotime($timeBegin)) != date('Y-m-d', strtotime($timeEnd))  )
		{
			die(json_encode(array('error_code'=>'ERROR_TIME_NOT_MATCH')));
		}


		$arrTotaltime = $this->dateDiff($timeBegin,$timeEnd );		
	
		if(empty($arrTotaltime) )
		{
			die(json_encode(array('error_code'=>'ERROR_TIME_NOT_MATCH')));
		}
		
		$fTotalMins = 0;

		if(!isset($arrTotaltime[2]) && !isset($arrTotaltime[1]))
		{
			$fTotalMins = 0;
		}
		else
		{
			if(count($arrTotaltime)==3) //over one hour
			{
				$fTotalMins = $arrTotaltime[0]*60 + (isset($arrTotaltime[1]) ? $arrTotaltime[1] : 0 );				
			}
			else
			{
				$fTotalMins = (isset($arrTotaltime[0]) ? $arrTotaltime[0] : 0 );
				
			}
		}

		/* Calculator Total Amount */ 
		

		/* Order plus **/
		$fTotalAmountService = 0;

		$arrOrderPlus = $this->db->get_where('order_plus', array('order_id'=>$iOrderId));

		$arrOptions =   $this->db->get_where('mst_options', array('id'=>1 ))->row_array();

		$fChargeGame = $arrOptions['unit_price'] ;

		/** Total Amount  **/
		foreach ($arrOrderPlus->result() as $row) 
		{
			$fTotalAmountService += $row->total_amount;
		}	

		$fTotalAmountOrder  = ceil(($fTotalMins*($fChargeGame/60)) + $fTotalAmountService + $fPlus - $fDiscount);

		die(json_encode(array(
			'dsp_total_amount'=>number_format($fTotalAmountOrder) ,
			'total_amount'=>$fTotalAmountOrder
		)));

	}
	
	function delete_order_plus()
	{	
		$iOrder_plus_id = $this->input->post("txtOrderPlusId");
		$iOrder_id = $this->input->post("txtOrderId");
		
		$this->db->delete('tbl_order_plus', array('id' => $iOrder_plus_id,'order_id'=>$iOrder_id)); 
		
		die(json_encode(array()));		
	}
	
	
	// Time format is UNIX timestamp or
	// PHP strtotime compatible strings
	function dateDiff($time1, $time2, $precision = 6) 
	{
		// If not numeric then convert texts to unix timestamps
		if (!is_int($time1)) 
		{
			$time1 = strtotime($time1);
		}
		if (!is_int($time2)) {
			$time2 = strtotime($time2);
		}

		// If time1 is bigger than time2
		// Then swap time1 and time2
		/*
		if ($time1 > $time2) {
			$ttime = $time1;
			$time1 = $time2;
			$time2 = $ttime;
		}
		*/
		// Set up intervals and diffs arrays
		$intervals = array('year','month','day','hour','minute','second');
		$diffs = array();

		// Loop thru all intervals
		foreach ($intervals as $interval) 
		{
			// Create temp time from time1 and interval
			$ttime = strtotime('+1 ' . $interval, $time1);
			// Set initial values
			$add = 1;
			$looped = 0;
			// Loop until temp time is smaller than time2
			while ($time2 >= $ttime) 
			{
				// Create new temp time from time1 and interval
				$add++;
				$ttime = strtotime("+" . $add . " " . $interval, $time1);
				$looped++;
			}

			$time1 = strtotime("+" . $looped . " " . $interval, $time1);
			$diffs[$interval] = $looped;
		}

		$count = 0;
		$times = array();
		// Loop thru all diffs
		foreach ($diffs as $interval => $value) 
		{
			// Break if we have needed precission
			if ($count >= $precision) 
			{
				break;
			}
			// Add value and interval 
			// if value is bigger than 0
			if ($value > 0) 
			{
				// Add s if value is not 1
				if ($value != 1) 
				{
					$interval .= "s";
				}
				// Add value and interval to times array
				$times[] = $value . " ";
				$count++;
			}
		}

		// Return string with times
		return $times;
		}
	}
?>
