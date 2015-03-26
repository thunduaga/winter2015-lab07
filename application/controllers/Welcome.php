<?php

/**
 * Our homepage. Show the most recently added quote.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  Homepage: show a list of the orders on file
    //-------------------------------------------------------------

    function index()
    {
	// Build a list of orders
        // 
        //Load directory helper
	$this->load->helper('directory');
        
        $orders = directory_map(DATAPATH);//./data
        $ordersArray = array();

        foreach($orders as $order)
        {
            if(substr_compare($order, "order", 0, 5) == 0)
            {
                $singleOrder["filename"] = $order;
                $ordersArray[] = $singleOrder;
            }
        }

        $this->data['orders'] = $ordersArray;

	// Present the list to choose from
	$this->data['pagebody'] = 'homepage';
	$this->render();
    }
    
    //-------------------------------------------------------------
    //  Show the "receipt" for a specific order
    //-------------------------------------------------------------

    function order($filename)
    {
	// Build a receipt for the chosen order
	
	// Present the list to choose from
        // Build a receipt for
      
        // Present the list to choose from
	$this->data['pagebody'] = 'justone';
	$this->render();
    }
    

}
