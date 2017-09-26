<?php 
include 'database.php';
$action='unset';
if (isset($_REQUEST['action'])){
$action = $_REQUEST['action'];}

if (isset($_REQUEST['target'])){
$target = $_REQUEST['target'];}

$pdo = Database::connect();
switch ($action){ 
case 'Create':
	$flds=$vls= array();
	$req=$_REQUEST;
	unset($_REQUEST['idkey']);
	unset($_REQUEST['target']);
	unset($_REQUEST['action']);
	foreach ($_REQUEST as $key => $value){
		array_push($flds,$key);
		array_push($vls,$value);
		}
	$tbl_trg=strtolower($req['target']);//table name from request
	
	$text_flds = implode(",", $flds);
	$qst_mrk = substr(str_repeat("?,", count($flds)),0,strlen(str_repeat("?,", count($flds)))-1);
	try {
	$stmt =$pdo->prepare('INSERT INTO '.$tbl_trg.' ('.$text_flds.') VALUES ('.$qst_mrk.')');
	for ($x= 0; $x <= count($vls)-1;$x++) {
		$stmt->bindParam($x+1, $vls[$x]);
	}
	$stmt->execute();
	}
	catch(PDOException $e){
		//echo $e->getMessage();
		echo "There was an error on insert!!";
	}
	break;

case 'Read':
   $tbl_trg=strtolower($_REQUEST['target']);//table name from request
   $query =$pdo->prepare('SELECT * FROM '.$tbl_trg);
   $query->execute();
   $result = $query->fetchall();
   echo "<table class='table table-hover'>";
   foreach ($result as $value) {
   	echo "<tr>";
	   for ($i=1; $i < count($value)/2; $i++) { //3 items target action id 
      	echo "<td>".$value[$i]."</td>";
	   }
   	echo "<td><a name='delete-".$value['id']."-".$_REQUEST['target']."'>Delete</a></td>";
   	echo "<td><a name='get-".$value['id']."-".$_REQUEST['target']."'>Get</a></td></tr>";
   }
   echo "</table>";
   break;
 
 case 'Update':
	$flds=$vls= array();
	$req=$_REQUEST;
	$q_helper='';
	unset($_REQUEST['idkey']);
	unset($_REQUEST['target']);
	unset($_REQUEST['action']);
	foreach ($_REQUEST as $key => $value){
		array_push($flds,$key);
		array_push($vls,$value);
		$q_helper=$q_helper.$key."=?,";
		}
	$q_helper=substr($q_helper, 0,strlen($q_helper)-1);
	$tbl_trg=strtolower($req['target']);//table name from request
	$stmt = $pdo->prepare("UPDATE ".$tbl_trg." SET ".$q_helper." WHERE id=". $req['idkey']);
	for ($x= 0; $x <= count($vls)-1;$x++) {
		$stmt->bindParam($x+1, $vls[$x]);
	}
	try {
	$stmt->execute();		
	}
	catch(PDOException $e){
		//echo $e->getMessage();
		echo "There was an error on update!!";
	}
	break;

case 'Delete':
    $pis = explode("-", $_REQUEST['id']);
	$query =$pdo->prepare('DELETE FROM '.$pis[2].' where id = '.$pis[1]);
	try {
	$query->execute();
	}
	catch(PDOException $e){
		//echo $e->getMessage();
		echo "There was an error on delete!!";
	}
	break;
	
case 'Get':
   $pis = explode("-", $_REQUEST['id']);
   $query =$pdo->prepare('SELECT * FROM '.$pis[2]. ' WHERE id='.$pis[1]);
   $query->execute();
   $result = $query->fetch(PDO::FETCH_NUM); 
   echo json_encode($result);
   break;
default:
	echo "Error handling database!!";
}
Database::disconnect();
