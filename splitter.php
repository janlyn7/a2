<?php
namespace DWA;
require('tools.php');
require('Form.php');

// storage array for how much to tip depending on the quality of service
$serviceType = [                             
    "poor" => 0.10,
    "good" => 0.15,
    "great"=> 0.20,
];

$form = new Form($_GET);

if($form->isSubmitted()) {

    // ensure input is sanitized
    if ( isset($_GET['totalBill']) ) 
        $_GET['totalBill'] = $form->sanitize($_GET['totalBill']);
    if ( isset($_GET['numPeople']) )
        $_GET['numPeople'] = $form->sanitize($_GET['numPeople']);

    // check if any errors from required fields 
    $form->hasErrors = false;
    $errors = $form->validate(
        [ 
            'numPeople' => 'required|digit|min:1|max:20',
            'totalBill' => 'required|numeric|min:0|max:10000',
        ]
    );

    // if no errors, get values for calculating bill per person
    // otherwise return the error messages
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

    // calculate bill per person with tip
    if ($service)
        $ppBill = ($totalBill+ ($totalBill * $service)) / $numPeople;

    // calculate bill per person without tip
    else
        $ppBill = $totalBill / $numPeople; 

    // round up to whole dollar amount, if requested
    if ($round)
        $ppBill = ceil($ppBill);

    // format bill per person in USD notation
    $ppBill = number_format($ppBill, 2, ".", "");
}
