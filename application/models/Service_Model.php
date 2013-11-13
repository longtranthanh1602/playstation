<?php 

class Service_Model extends CI_Model 
{
	protected $arrRule = array(
		           array(
    					'field'=>'txtName',
    					'label'=>'Tên máy ',
    					'rules'=>'required|trim'
					),

                   array(
                        'field'=>'txtUnitPrice',
                        'label'=>'Giá tiền  ',
                        'rules'=>'required|Trim|numeric'
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