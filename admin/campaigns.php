<?php

require_once('../config.php');

$campaigns = $db->select('campaign');

/***********************/
// ADD CAMPAIGN
/***********************/

if(isset($_POST['intent']) && $_POST['intent'] == 'Add') {

	// SETUP INSERT VALUES
	$insert = array(
		'name'		=> $_POST['add-name'],
		'start'		=> new MongoDate(strtotime($_POST['add-start'])),
		'end'		=> new MongoDate(strtotime($_POST['add-end'])));

	// INSERT CAMPAIGN AND GET NEW ID
	$newCamp = $db->insert('campaign', $insert);

	$name = array();
	for($i=0;$i <= count($_FILES)+1;$i++) {

		$newFile = $newCamp['_id'] . '-' . $_FILES['add-item-file']['name'][$i];
		$move = move_uploaded_file($_FILES['add-item-file']['tmp_name'][$i], UPLOAD_PATH . $newFile); 
		if(!$move) echo "Couldn't move file $i";

		// SETUP FILE INFO TO UPDATE CAMPAIGN
		$name[$i] = array(
			'name'=>$_POST['add-item-name'][$i],
			'votes'=>0,
			'url'=>$newFile);

	}

	// UPDATE CAMPAIGN WITH FILE INFORMATION
	$update = $db->update('campaign',array('_id'=>$newCamp['_id']),array('$set'=>array('items'=>$name)));
}

if(isset($_GET['intent']) && $_GET['intent'] == 'add') {
?>
<div id="add-campaign" class="modal">
	<form method="POST" action="<?=$_SERVER['PHP_SELF'];?>?p=campaigns" enctype="multipart/form-data">
		<label for="add-name">Name</label>
		<input type="text" name="add-name"/>
		<label for="add-start">Start</label> 
		<input type="text" name="add-start"/>
		<label for="add-end">End</label> 
		<input type="text" name="add-end"/>
		<label for="add-item1-name">Item 1</label> 
		<input type="text" name="add-item-name[]"/>
		<input type="file" name="add-item-file[]"/>
		<label for="add-item2-name">Item 2</label> 
		<input type="text" name="add-item-name[]"/>
		<input type="file" name="add-item-file[]"/>
		<label for="add-item3-name">Item 3</label> 
		<input type="text" name="add-item-name[]"/>
		<input type="file" name="add-item-file[]"/>
		<input type="submit" value="Add" name="intent">
	</form> 
</div> 
<?php
}
/***********************/
// END ADD CAMPAIGN
/***********************/


/***********************/
// EDIT CAMPAIGN
/***********************/

if(isset($_POST['intent']) && $_POST['intent'] == 'Edit') {

	$id = new MongoId($_POST['id']); // SETUP MONGO ID
	$crit = array('_id' => $id); // CRITERIA FOR UPDATES
	$files = array(); // PREPARE FILES ARRAY

	// SETUP FILE UPDATE VALUES
	if($_FILES['edit-item-file1']['name'] != '') {
		$i = 0;
		$newFile = $_POST['id'] . '-' . $_FILES['edit-item-file1']['name'];
		$files[] = array('items.0.name' => $_FILES['edit-item-file1']['name'],'items.0.url'=> $newFile);
		$move = move_uploaded_file($_FILES['edit-item-file1']['tmp_name'], UPLOAD_PATH . $_POST['id'] . '-' . $_FILES['edit-item-file1']['name']);
		if(!$move) echo "Failed Upload 1";
	}

	if($_FILES['edit-item-file2']['name'] != '') {
		$i = 1;
		$newFile = $_POST['id'] . '-' . $_FILES['edit-item-file2']['name'];
		$files[] = array('items.1.name' => $_FILES['edit-item-file2']['name'],'items.1.url'=> $newFile);
		$move = move_uploaded_file($_FILES['edit-item-file2']['tmp_name'], UPLOAD_PATH . $_POST['id'] . '-' . $_FILES['edit-item-file2']['name']);
		if(!$move) echo "Failed Upload 2";
	}

	if($_FILES['edit-item-file3']['name'] != '') {
		$i = 2;
		$newFile = $_POST['id'] . '-' . $_FILES['edit-item-file3']['name'];
		$files[] = array('items.2.name' => $_FILES['edit-item-file3']['name'],'items.2.url'=> $newFile);
		$move = move_uploaded_file($_FILES['edit-item-file3']['tmp_name'], UPLOAD_PATH . $_POST['id'] . '-' . $_FILES['edit-item-file3']['name']);
		if(!$move) echo "Failed Upload 3";
	}

	// MONGO INSTRUCTIONS FOR FILE UPDATE
	$fileUpdate = array('$set'=>$files);

	// MONGO INSTRUCTIONS FOR INFO UPDATE
	$data = array('$set' => array(
		'name' => $_POST['edit-name'],
		'start' => new MongoDate(strtotime($_POST['edit-start'])),
		'end' => new MongoDate(strtotime($_POST['edit-end'])),
		'items.0.name' => $_POST['edit-item-name1'],
		'items.1.name' => $_POST['edit-item-name2'],
		'items.2.name' => $_POST['edit-item-name3']));

	// UPDATE INFO
	try {
		$update = $db->update('campaign',$crit,$data);
	} catch (MongoException $e) {
		echo $e->getMessage();
	}

	// UPDATE FILES
	try {
		$update = $db->update('campaign',$crit,$fileUpdate);
	} catch (MongoException $e) {
		echo $e->getMessage();
	}

}

// DISPLAY EDIT FORM IF INTENT IS EDIT
if(isset($_GET['intent']) && $_GET['intent'] == 'edit') {

	$id = new MongoId($_GET['id']);
	$campaign = $db->select('campaign', array('_id' => $id));
	foreach($campaign as $camp) {
		foreach($camp as $key=>$value) $$key = $value;
	}
?>

<div id="edit-campaign" class="modal">
	<form method="POST" action="<?=$_SERVER['PHP_SELF'];?>?p=campaigns&intent=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
		<label for="edit-name">Name</label>
		<input type="text" name="edit-name" value="<?=$name?>"/>
		<label for="edit-start">Start</label> 
		<input type="text" name="edit-start" value="<?=date('M d Y', $start->sec);?>"/>
		<label for="edit-end">End</label> 
		<input type="text" name="edit-end" value="<?=date('M d Y', $end->sec);?>"/>
		<?php $i = 1; foreach($items as $item) { ?>
			<label for="edit-item-name<?=$i?>">Item <?=$i;?></label> 
			<input type="text" name="edit-item-name<?=$i;?>" value="<?=$item['name'];?>"/>
			<input type="file" name="edit-item-file<?=$i;?>"/>
		<?php $i++; } ?>
		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		<input type="submit" value="Edit" name="intent">
	</form> 
</div> 

<?php
}


/***********************/
// END EDIT CAMPAIGN
/***********************/

/***********************/
// LIST OF CAMPAIGNS
/***********************/
?>
<a href="<?=$_SERVER['PHP_SELF'];?>?p=campaigns&intent=add">Add</a>
<table class="data-table modal">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th> 
			<th>Date Start</th> 
			<th>Date End</th> 
			<th>Item 1</th> 
			<th>Item 2</th> 
			<th>Item 3</th>
			<th>Total Votes</th>
			<th>Edit</th>
		</tr>
	</thead> 
	<tbody>
		<?php 
		foreach($campaigns as $cam) { 
		$total_votes = $cam['items'][0]['votes'] + $cam['items'][1]['votes'] + $cam['items'][2]['votes'];
		?>
		<tr>
			<td><?=$cam['_id'];?></td>
			<td><?=$cam['name'];?></td> 
			<td><?=date('m d Y', $cam['start']->sec);?></td> 
			<td><?=date('m d Y', $cam['end']->sec);?></td> 
			<td><?=$cam['items'][0]['url']?></td> 
			<td><?=$cam['items'][1]['url']?></td> 
			<td><?=$cam['items'][2]['url']?></td> 
			<td><?=$total_votes;?></td> 
			<td><a href="<?=$_SERVER['PHP_SELF'];?>?p=campaigns&intent=edit&id=<?=$cam['_id']?>">Edit</a></td> 
		</tr> 
		<?php } ?>
	</tbody> 
</table>
<?php
/***********************/
// END LIST OF CAMPAIGNS
/***********************/
?>
