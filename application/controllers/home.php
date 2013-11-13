<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Home 
 */
class Home extends CI_Controller 
{

	/**
	 * [$data description]
	 * @var array
	 */
	protected $_data = array();


	/**
	 * [__construct description]
	 */
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		/* Get all Machines in database */
		$arrMachine = $this->db->get('machines');
		$arrOtherMachine = $this->db->get('machines');
		
		
		self::$this->_data['iTotalMachines'] = $arrMachine->num_rows;
		self::$this->_data['arrMachines'] = $arrMachine;
		self::$this->_data['arrOtherMachines'] = $arrOtherMachine;


		$this->load->view('home', self::$this->_data);
	}
	
}