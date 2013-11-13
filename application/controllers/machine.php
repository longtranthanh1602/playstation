<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

 */
class Machine extends CI_Controller
{

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		/* Load machine */
		$arrMachine = $this->db->get('machines');

		self::$this->_data['iTotalMachines'] = $arrMachine->num_rows;
		self::$this->_data['arrMachines'] = $arrMachine;

		$this->load->view('machine/index',self::$this->_data);
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
			$this->load->model('Machine_Model','Machine');
		
	    	$this->load->helper(array('form'));

	    	$this->load->library('form_validation');

	    	$arrRule = $this->Machine->getRuleMachine();

			$this->form_validation->set_rules($arrRule); 

	    	if($this->form_validation->run()==FALSE)
    		{	   
    			$this->return_json(array('error_code'=>'BLANK'));
    		}	

    		/* Insert into database */

    		$arrMachineName = explode("\n", $this->input->post('txtName'));

    		foreach ($arrMachineName as $sMachineName)
    		{
    			$arrData[] = array(
    							'name'=> $sMachineName , 
    							'status_id'=> ID_STATUS_MACHINE_OFF,
    							'status_msg'=> MSG_STATUS_MACHINE_OFF,
    							'created_at'=>date('Y-m-d H:i:s'), 
    							'updated_at'=>date('Y-m-d H:i:s'));
    		}

    		$this->db->insert_batch('machines', $arrData); 
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
?>