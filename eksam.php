<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>eksam</title>
	<style>
	label {color:blue; font-weight: bold; }
	</style>
</head>
<body>
<?php
	$errors=array();
	require_once ('db.php');
	session_start();
	connect_db();
	$name="";
	$price="";
	
	#display last visit from db
	$sql = "SELECT nimi, pakkumine FROM `12103979_eksam` order by pakkumine desc";
	$result = mysqli_query($connection, $sql);
	$success = mysqli_num_rows($result);
	$r = mysqli_fetch_assoc($result);
	echo '<br/>';
	echo 'Suurim pakkumine hetkel <b>'.$r['pakkumine'].'€</b> ja selle on teinud <b>'.$r['nimi'].'</b>';
	
	if (isset($_POST['name'])&& isset($_POST['price'])) { 
		$dbtext = mysqli_real_escape_string($connection,htmlspecialchars($_POST['name']));
		$dbprice = mysqli_real_escape_string($connection,htmlspecialchars($_POST['price']));
		$sql= "INSERT INTO 12103979_eksam (nimi, pakkumine) VALUES ('$dbtext', '$dbprice')";
		$result=mysqli_query($connection, $sql);
		header("location: eksam.php");
	}
?>
<!-- pilt aadressilt http://www.eastsideelementaryfoundation.org/uploads/1/1/9/7/11970946/4901458_orig.jpg -->
<img src="http://www.eastsideelementaryfoundation.org/uploads/1/1/9/7/11970946/4901458_orig.jpg" alt="pakkumine"/>
<div id="offer">
<form action="" method="POST" >
	<label>Nimi</label>
	<input type="text" name="name" value="<?php echo $name; ?>" ><br/>
	<label>Pakkumine 50€ astmetega</label>
	<input type="number" name="price" min="0" step="50" value="<?php echo $price; ?>"><br/>
	<input type="submit" value="Saada" name="button" />
</form>
</div>
<?php if (isset($errors)):?>
	<?php foreach($errors as $error):?>
		<div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
	<?php endforeach;?>
<?php endif;?>
</body>
</html>