<?php

require('../../config.php');
$date = new MongoDate();
$status = 200;

if($_POST['vote'] && $_POST['ip']) {

	// GET CURRENT CAMPAIGN
	try {
		$campaign = $db->select('campaign', array('start' => array('$lt'=>$date),'end'=>array('$gt'=>$date)));
	} catch (Exception $e) {
		$status = 500;
		$error[] = $e->getMessage();
	}

	// PULL CAMPAIGN FROM MONGOCURSOR
	foreach($campaign as $camp);

	$checkVote = $db->count('votes',array('campaign' => $camp['_id'],'ip'=>(string)$_POST['ip']));

	if($checkVote > 0) {
		$error[] = "It looks as if you've already voted!";
		$status = 502;
	}

	// CRITERIA FOR UPDATE
	$crit = $camp['_id'];

	// CONVERT VOTE TO 0 BASED INT
	$for = $_POST['vote_for']-1;

	// LOG VOTE IN VOTES COLLECTION
	if($status == 200) {
		try {
			$result = $db->insert('votes',array('ip'=>$_POST['ip'],'campaign'=>$camp['_id'],'vote'=>$for));
		} catch (Exception $e) {
			$status = 500;
			$error[] = $e->getMessage();
		}
	}


}

// SETUP AND THROW RESPONSE
$response = array('status' => $status);
if(isset($error)) 
	$response['errors'] = $error;

echo json_encode($response);

?>
