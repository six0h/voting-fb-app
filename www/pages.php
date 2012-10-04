<?php

$date = new MongoDate();
$active = $db->count('campaign', array('start'=>array('$lt' => $date), 'end'=>array('$gt'=>$date)));
if($active == 1) {
$campaign = $db->select('campaign', array('start'=>array('$lt' => $date), 'end'=>array('$gt'=>$date)));
foreach($campaign as $camp);
?>

<header></header> 


<section id="items">

	<?php $i = 1; foreach($camp['items'] as $item) { ?>

	<div class="entry">
		<img src="<?=BASE_URL . 'uploads/' . $item['url'];?>" alt="<?=$item['name'];?>"/>
		<br />
		<span><?=$item['name']?></span>
		<form method="POST" action="ajax/vote.php">
			<input type="hidden" name="vote_for" value="<?=$i?>"/>
			<input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR'];?>"/>
			<input type="submit" name="vote" value="Vote" class="votebtn"/>
		</form>
	</div> 
	<?php $i++; } ?>

	<aside></aside> 

</section>

<aside id="calendar"></aside>

<footer><a href="#">Northern BC</a></footer> 
<?php
} else {
	echo "There are currently no vote campaigns running.";
}
?>
