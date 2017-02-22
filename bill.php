<?php
namespace DWA;
require('tools.php');
require('Form.php');


$serviceType = [      	      		     
              "poor" => 0.10,
	      "good" => 0.15,
	      "great"=> 0.20,
       	       ];

$form = new Form($_GET);

if($form->isSubmitted()) {
    $form->hasErrors = false;
	  /*

 	     Tools::dump($_GET); # Output from logic, only for debugging purposes to see the contents of POST
	     echo $_SERVER['QUERY_STRING'];
	  }
	  */

    // check if any errors from required fields
    $errors = $form->validate(
    	    [ 
	      'numPeople' => 'required|digit|min:1|max:20',
	      'totalBill' => 'required|numeric|min:0|max:10000',
	    ]
	  );

    // if no errors, get values
    if (!$form->hasErrors) {
     	 $numPeople = (float)$form->get("numPeople");
	 $totalBill = (float)$form->get("totalBill");
	 $round     = $form->isChosen("roundUp");

	 $tip = $form->get("tip");
	 $service=0;
	 if ($tip != "choose")	 
	     $service   = $serviceType[$tip];	 
     } else {
      	return $errors;
     }

      // calculate bill
     if ($service)
      	  $ppBill = ($totalBill+ ($totalBill * $service))/ $numPeople;
     else
	  $ppBill = $totalBill / $numPeople; 

     if ($round)
          $ppBill = ceil($ppBill);

     $ppBill = number_format($ppBill, 2, ".", "");

}


