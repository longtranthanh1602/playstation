<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

 */
class Report extends CI_Controller
{
	public function index()
	{
		/* Load orders */
		self::$this->_data['arrOrders'] =  $this->db->get_where('orders', array('DATE(begin)'=>date('Y-m-d')));		
			
		/* Load all order in 30 days*/
		self::$this->_data['arrReportOrders'] = 
				$this->db->query('SELECT DATE(begin) as fDate, SUM(total_amount) as fTotalAmount
									FROM tbl_orders 
									WHERE status_id = 0
									GROUP BY DATE(begin)
									ORDER BY DATE(begin) DESC
									LIMIT 0,31');
	
		/* Load all order */
		$this->db->select_sum('total_amount');
		self::$this->_data['arrAll'] =  $this->db->get_where('orders', array('status_id'=>0))->row_array();	
	
		$this->load->view('report/index',self::$this->_data);
	}

}
?>