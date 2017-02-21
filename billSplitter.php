<?php
namespace DWA;
require('tools.php');
require('Form.php');


class Bill {

      public $form;
      private $errors;
      private $serviceType = [      	      		     
      	      	              "poor" => 0.10,
			      "good" => 0.15,
			      "great"=> 0.20,
      	      	       	     ];

      public function __construct()  {

          $this->form = new Form($_GET);
	  $this->form->hasErrors = false;
	  /*
	  if($this->form->isSubmitted()) {
 	     Tools::dump($_GET); # Output from logic, only for debugging purposes to see the contents of POST
	     echo $_SERVER['QUERY_STRING'];
	  }
	  */

      }

      public function isSubmitted() {
      	  if($this->form && $this->form->isSubmitted())
	      return true;
	  return false;

      }

      public function isError() {
      	  return $this->form->hasErrors;
      }


      public function calculate() {

      // check if any errors from required fields
      $this->errors = $this->form->validate(
    	    [ 
	      'numPeople' => 'required|numeric|min:1|max:20',
	      'totalBill' => 'required|numeric|min:0|max:10000',
	    ]
	  );

      // if no errors, get values
      if (!$this->form->hasErrors) {
      	 $numPeople = (float)$this->form->get("numPeople");
	 $totalBill = (float)$this->form->get("totalBill");
	 $round     = $this->form->isChosen("roundUp");

	 $tip = $this->form->get("tip");
	 $service=0;
	 if ($tip != "choose")	 
	     $service   = $this->serviceType[$tip];	 
      } else {
        Tools::dump($this->errors);
      	return;
      }

      // calculate bill
      if ($service)
      	  $ppBill = ($totalBill+ ($totalBill * $service))/ $numPeople;
      else
	  $ppBill = $totalBill / $numPeople; 

      if ($round)
          $ppBill = ceil($ppBill);

      return number_format($ppBill, 2, ".", "");
      }


}


