<?php

require_once('../config.php');

if(isset($_POST['dropdown']) && !empty($_POST['dropdown'])
&& $_FILES['file']['name'] != '') {

	$dropdown = $_POST['dropdown'];

	if($dropdown == 'right') {
		$result = move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_PATH . 'votecallout.png');
		if(!$result) $upFail = true;
	} else if ($dropdown == 'bottom') {
		$result = move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_PATH . 'bottombar.png');
		if(!$result) $upFail = true;
	} else if ($dropdown == 'top' ) {
		$result = move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_PATH . 'copy.png');
		if(!$result) $upFail = true;
	}
		

	if(isset($upFail)) {
		echo "Image Upload Failed.";
	} else {
		echo "Image Upload Successful";
	}

}
?>

<form method="POST" action="<?=$_SERVER['PHP_SELF'];?>?p=images" enctype="multipart/form-data" name="image_uploader" id="image_uploader">

	<label for="dropdown">Which Image Would you like to replace?</label>
	<select name="dropdown">
		<option value="top">Top</option>
		<option value="right">Right Side</option>
		<option value="bottom">Bottom Bar</option>
	</select>
	<input type="file" name="file" id="file"/>
	<input type="submit" value="Upload and Replace" name="submit" id="submit"/>

</form>
