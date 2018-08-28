<?php
if (empty($_GET['target'])) {$_GET['target']='user';}
?>
<!doctype html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

</head>
<style>
body{
margin:15px 15px 15px 15px;
background-image:url('images/background.png');
font-family: 'Open Sans', sans-serif;
font-weight: bold;
}
.xdebug-var-dump{width:550px;}
.form-control{
    min-width: 0;
    width: 300px;
    display: inline;
	margin-left:25px;
}
.btn{margin-left:10px;}
</style>
<body>
<?php
function __autoload($class)
  {
      include_once  $class . '_class.php';
  }
  
__autoload($_GET['target']);
$item = new $_GET['target'];
if (isset($_GET['idkey'])){
	$id=$_GET['idkey'];	$show=1;}
else {$id=0;$show=0;}
	
echo '<form class="form-1"><input type="hidden" id="control0" name="idkey" value="'.$id.'"';

$i=0;
foreach($item as $key => $value) {
	$i++;
    echo "<div class='form-control-inline'><label for='.$key.'>".$key.":</label><input type='input' class='form-control' id='control".$i."' name='".$key."' value='".$value."'></div><br>";
}
echo '<input type="button" value="Create" id="button-form-1" name="'.$item->Iam().'" class="btn btn-primary"/>';
echo '<input type="button" value="Update" id="button-form-2" name="'.$item->Iam().'" class="btn btn-primary"/>';
echo str_repeat('<input type="button" value="Read" id="button-form-1" name="'.$item->Iam().'" class="btn btn-primary"/>',$show);
echo str_repeat('<input type="button" value="Update" id="button-form-1" name="'.$item->Iam().'" class="btn btn-primary"/>',$show);
echo str_repeat('<input type="button" value="Delete" id="button-form-1" name="'.$item->Iam().'" class="btn btn-primary"/>',$show);
echo '</form><br><br>Ja sam: '.$item->Iam().'<br>';

?>
<div id="holder">SHOULD BE FILLED WITH NEW DATA</div>
</body>
<script src="main.js"></script>
</html>
