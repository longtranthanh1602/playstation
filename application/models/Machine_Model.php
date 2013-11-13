<?php 

class Machine_Model extends CI_Model 
{
	protected $arrRule = array(
		'insert' => array(
					'field'=>'txtName',
					'label'=>'Tên máy ',
					'rules'=>'required'
					)
	);

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
        
    }


    /**
     * [getRuleMachine description]
     * @return [type] [description]
     */
    public function getRuleMachine($key='')	
    {
    	if($key!='' && isset(self::$this->arrRule[$key]))
    	{
    		return self::$this->arrRule[$key];
    	}

    	return self::$this->arrRule;
    }
}

?>