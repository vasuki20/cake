<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
    // File: /app/controllers/orders_controller.php 
    
    class OrdersController extends AppController 
    { 
        var $name = 'Orders'; 
        var $uses = array('Order'); 
        
        // Include the RequestHandler, it makes sure the proper layout and views files are used 
        var $components = array('RequestHandler'); 
        
        function export() 
        { 
            // Stop Cake from displaying action's execution time 
            Configure::write('debug',0); 
            // Find fields needed without recursing through associated models 
            $data = $this->Order->find( 
                'all', 
                array( 
                    'fields' => array('id','created','name','paid','total'), 
                    'order' => "Order.id ASC", 
                    'contain' => false 
                    
            );
            // Define column headers for CSV file, in same array format as the data itself 
            $headers = array( 
                'Order'=>array( 
                    'id' => 'ID', 
                    'created' => 'Date', 
                    'name' => 'Name', 
                    'paid' => 'Paid?', 
                    'total' => 'Total' 
                ) 
            ); 
            // Add headers to start of data array 
            array_unshift($data,$headers); 
            // Make the data available to the view (and the resulting CSV file) 
            $this->set(compact('data')); 
        } 
