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
    <div class='container'>
    <h2>Bill Splitter</h2>
    <form method='GET' action='index.php'>

<?php
if ((isset($_GET['reset'])) || (!isset($_GET['totalBill'])) ) {
  $_GET['totalBill'] = 0;
} else {
  $_GET['totalBill'] = $form->sanitize($_GET['totalBill']);
}
?>
      <div>
        <label>How much was the tab:
          <input type='text' name='totalBill' value='<?=$_GET['totalBill']?>'>
        </label>
      </div>

<?php
if ((isset($_GET['reset']))  || (!isset($_GET['numPeople'])) ) {
   $_GET['numPeople'] = 1;
} else {
   $_GET['numPeople'] = $form->sanitize($_GET['numPeople']);
}
?>
      <label>Split how many ways:
        <input type='text' name='numPeople' value='<?=$_GET['numPeople']?>'>
      </label>

<?php
if ((isset($_GET['reset']))  || (!isset($_GET['tip'])) ) {
   $_GET['tip'] = "choose";
}
?>
      <div> 
        <label for='tip'>How was the service:
          <select name='tip'>
            <option value='choose'>Choose one...</option>
            <option value='poor'  <?php if ($_GET['tip'] == 'poor')  echo 'SELECTED';?> >Poor</option>
            <option value='good'  <?php if ($_GET['tip'] == 'good')  echo 'SELECTED';?> >Good</option>
            <option value='great' <?php if ($_GET['tip'] == 'great') echo 'SELECTED';?> >Great</option>

          </select>
        </label>
      </div>

<?php
if ((isset($_GET['calc'])) && (isset($_GET['roundUp']))) {
  $roundUp = "CHECKED";
} else {
  $roundUp = "";
}
?>
      <div>
        <label> Round Up:
          <input type='checkbox' name='roundUp' value='yes' <?php echo $roundUp;?> >
        </label>
      </div>
      
      <div id=row>
        <input type='submit' value='Calculate' name='calc'>
        <input type='submit' value='Reset' name='reset'>
      </div>

<?php
if (isset($_GET['calc'])) {
   if ( isset($ppBill) ){
     echo "<br/><h4>Bill per person: $".$ppBill."</h4>" ;
   } else if (isset($errors)) {
     echo "<ul>";
     foreach($errors as $errmsg):
       echo "<li>".$errmsg."</li>";
     endforeach;
     echo "</ul>";
   }
}

if (isset($_GET['reset'])) {
   unset($_SERVER['QUERY_STRING']);
}
?>
    </form>
    </div>
</body>

</html>
