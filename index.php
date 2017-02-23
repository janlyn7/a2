<?php
namespace DWA;
require('splitter.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Assignment 2 - Split the Check
        </title>
        <meta charset='utf-8'>
        <link href='splitter.css' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css' rel='stylesheet' type='text/css' />
        <link href='https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <form method='GET' action='index.php'>
            <div class='container'>

                <div class='row'>
	            <div class='three columns'>
                        <p></p>
                    </div>
	            <div class='six columns' id='page_title'>
             	        <h2> Split the Check</h2>
                    </div>
                </div>


                <?php
                    if ((isset($_GET['reset'])) || (!isset($_GET['totalBill'])) ) {
                        $_GET['totalBill'] = 0;
                    } else {
                        $_GET['totalBill'] = $form->sanitize($_GET['totalBill']);
                    }
                ?>

                <div class='row'>
                    <div class='six columns' id='amount_label'>
                        <label>Bill Amount: </label>
                        <p>Required*</p>
                    </div>
                    <div class='six columns'>
                        <input type='text' name='totalBill' value='<?=$_GET["totalBill"]?>'>
                    </div>
                </div>


                <?php
                    if ((isset($_GET['reset']))  || (!isset($_GET['numPeople'])) ) {
                        $_GET['numPeople'] = 1;
                    } else {
                        $_GET['numPeople'] = $form->sanitize($_GET['numPeople']);
                    }
                ?>

                <div class='row'>
                    <div class='six columns' id='npeople_label'>
                        <label>Number of People:</label>
                        <p>Required*</p>
                    </div>
                    <div class='six columns'>
                        <input type='text' name='numPeople' value='<?=$_GET["numPeople"]?>'>
                    </div>
                </div>

                
                <?php
                    if ((isset($_GET['reset']))  || (!isset($_GET['tip'])) ) {
                        $_GET['tip'] = "good";
		    }
                ?>

                <div class='row'> 
                    <div class='six columns'>
                        <label for='tip'>Quality of Service:</label>
                    </div>
                    <div class='six columns' id='service_menu'>
                        <select name='tip' id='tip'>
                            <option value='poor'  <?php if ($_GET['tip'] == 'poor')  echo 'SELECTED';?>>Poor</option>
                            <option value='good'  <?php if ($_GET['tip'] == 'good')  echo 'SELECTED';?>>Good</option>
                            <option value='great' <?php if ($_GET['tip'] == 'great') echo 'SELECTED';?>>Great</option>
                        </select>
                    </div>
                </div>

                <?php
                    if ((isset($_GET['calc'])) && (isset($_GET['roundUp']))) {
                        $roundUp = "CHECKED";
                    } else {
                        $roundUp = "";
                    }
                ?>

                <div class='row'>
                    <div class='six columns'>
                        <label> Round Up:</label>
                    </div>
                    <div class='six columns' id='round_check'>
                        <input type='checkbox' name='roundUp' value='yes' <?php echo $roundUp;?> > &nbsp;Yes
                    </div>
                </div>

                <div id='row'>
                    <div class='six columns' id='calc_button'>
                        <input type='submit' value='Calculate' name='calc'>
                    </div>
                    <div class='six columns' id='reset_button'>
                        <input type='submit' value='Reset' name='reset'>
                    </div>
                </div>


                <?php if (isset($_GET['calc']) && isset($ppBill)): ?>
                    <div id='row'>
                        <div class='three columns'>
                            <p></p>
                        </div>
                        <div class='six columns' id='results'>
                            <h4>Each person pays $<?=$ppBill?> </h4>
                        </div>
                    </div>

                <?php elseif (isset($_GET['calc']) && isset($errors)): ?>
                    <div id='row'>
                        <div class='three columns'>
                            <p></p>
                        </div>
                        <div class='six columns' id='errors'>
                            <h5>Errors:</h5>
                            <ul>
                                <?php foreach($errors as $errmsg): ?>
                                    <li><?=$errmsg?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </form>
    </body>
</html>