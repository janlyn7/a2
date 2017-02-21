<?php
namespace DWA;
require('bill.php');
?>

<!DOCTYPE html>
<html>

  <head>

    <title>Bill Splitter</title>
    <meta charset='utf-8'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css' rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css' rel='stylesheet' type='text/css'>


  </head>

  <body>
    <div class="container">
    <h2>Bill Splitter</h2>
    <form method="GET" action='index.php'>

      <div>
        <label>How much was the tab:
          <input type='text' name='totalBill' required autofocus value='<?=$form->prefill('totalBill', '0')?>'>
        </label>
      </div>

      <label>Split how many ways:
        <input type='text' name='numPeople' required value='<?=$form->prefill('numPeople', 1)?>'>
      </label>

      <div>
        <label for='tip'>How was the service:
          <select name='tip' id='tip'>
            <option value='choose'>Choose one...</option>
            <option value='poor'>Poor</option>
            <option value='good'>Good</option>
            <option value='great'>Great</option>
          </select>
        </label>
      </div>

      <div>
        <label> Round Up:
          <input type='checkbox' name='roundUp' value='yes'>
        </label>
      </div>

      
      <div id=row>
        <input type='submit' value='Calculate'>

        <input type='reset' value='Reset' >
      </div>


      <?php
	if (isset($ppBill) )
	     echo "\nBill per person: $".$ppBill ;
	else if (isset($errors)) {
	     echo "ERRORS!";

        }	

	unset($_SERVER['QUERY_STRING']);
      ?>



    </form>
    </div>
  </body>

</html>
