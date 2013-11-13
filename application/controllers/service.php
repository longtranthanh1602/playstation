<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

 */
class Service extends CI_Controller
{

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		/* Load machine */
		$arrService = $this->db->get('services');

		self::$this->_data['iTotalMachines'] = $arrService->num_rows;
		self::$this->_data['arrServices'] = $arrService;

		$this->load->view('service/index',self::$this->_data);
	}

	/**
	 * [insert description]
	 * @return [type] [description]
	 */
	public function insert()
	{
		$arrReponse = array('error_code'=>'OK');

		if ($this->input->is_ajax_request()) 
		{
			$this->load->model('Service_Model','Service');
		
	    	$this->load->helper(array('form'));

	    	$this->load->library('form_validation');

	    	$arrRule = $this->Service->getRuleMachine();

			$this->form_validation->set_rules($arrRule); 

	    	if($this->form_validation->run()==FALSE)
    		{	   
    			$this->return_json(array('error_code'=>'BLANK'));
    		}	

    		/* Insert into database */

    		$arrData = array(
				'name'=> $this->input->post('txtName'), 
				'unit_price'=> $this->input->post('txtUnitPrice'),				
				'created_at'=>date('Y-m-d H:i:s'), 
				'updated_at'=>date('Y-m-d H:i:s')
			);

    		$this->db->insert('services', $arrData); 
		}

		$this->return_json($arrReponse);
	}

	/**
	 * [return_json description]
	 * @param  [type] $arrData [description]
	 * @return [type]          [description]
	 */
	public function return_json($arrData)
	{
		if(!is_array($arrData))
		{
			$arrData= array();
		}

		die(json_encode($arrData));
	}
}