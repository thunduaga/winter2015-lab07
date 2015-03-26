<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Order extends CI_Model {

    // Constructor
    public function __construct(){
        parent::__construct();
    }
    public function getName($xmlFile)
    {
        $xml = simplexml_load_file(DATAPATH . $xmlFile);  
        $customer = (String)$xml->customer;
        return $customer;
    }
    public function getOrder($xmlFile)
    {
       $xml = simplexml_load_file(DATAPATH . $xmlFile);  
       
       $record = array();
       $record['customer'] = (String)$xml->customer;
       $record['ordertype'] = (String)$xml->attributes()['type'];
       if(isset($xml->special))
       {
           $record['special'] = (String)$xml->special;
       }
       else
       {
           $record['special'] = 'none';
       }
       
       $record["burgerArray"] = array();
       
       

       $total = 0;
       $numOfBurgers = 0;
       
       foreach ($xml->burger as $curBurger)
       {
           //keep track of how many burgers
           $numOfBurgers = $numOfBurgers + 1;
           
           
           //make individual burger array to store the toppings
           $burger = array( 'patty' => 'none',
                            'cheeseTop' => 'none',
                            'cheeseBottom' => 'none',
                            'toppings' => array(),
                            'sauces' => array(),
                            'instructions' => 'none',
                            'name' => 'none');
           //check to see if each topping is set
           //if it is then add all of its values
           
           //set patty type, it is always required
           $burger['patty'] = $curBurger->patty["type"];
           
           //check to see if there is cheese at all
            if(isset($curBurger->cheeses))
            {
                //if theres a top cheese set that 
                if(isset($curBurger->cheeses["top"]))
                {
                    $burger["cheeseTop"] = $curBurger->cheeses["top"];
                }
                //if there is a bottom cheese set that
                if(isset($curBurger->cheeses["bottom"]))
                {
                    $burger["cheeseBotom"] = $curBurger->cheeses["bottom"];
                }
            }
            
            //if there are instructions, set them
            if(isset($curBurger->instructions))
            {
                $burger["instructions"] = $curBurger["instructions"];
            }
            //if this burger has a name, record it
            if(isset($curBurger->name))
            {
                $burger["name"] = $curBurger->name;
            }
       
            //get all toppings 
            if(isset($curBurger->topping))
            {
                //keep track of how many toppings
                $numOfToppings = 0;
                
                foreach ($curBurger->topping as $topping)
                {
                    $numOfToppings = $numOfToppings + 1;
                    $burger["toppings"][$numOfToppings] = $topping["type"];
                }
            }
            
            //get all sauces
            if(isset($curBurger->sauce))
            {
                //keep track of how many toppings
                $numOfSauces = 0;
                
                foreach ($curBurger->sauce as $sauce)
                {
                    $numOfSauces = $numOfSauces + 1;
                    $burger["sauces"][$numOfSauces] = $sauce["type"];
                }
            }

            //add this burger to the array of burgers in record
            $record["burgerArray"][$numOfBurgers] = $burger;
        }
        
        return $record;
    }
     

}