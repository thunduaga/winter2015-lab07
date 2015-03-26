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
      
        $this->load->model('Order');
        $this->load->model('Menu');
        $this->load->library('parser');

        $order = $this->Order->getOrder($filename);

        $this->data['pagebody'] = 'justone';
        
        $this->data['filename'] = $filename;
        $this->data['customer'] = $order['customer'];
        $this->data['ordertype'] = $order['ordertype'];
        $this->data['special'] = $order['special'];
        $this->data['burgers'] = $order['burgerArray'];
       
        // Present the list to choose from
	$this->data['pagebody'] = 'justone';
	$this->render();
    }
    

}
