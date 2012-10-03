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
		<caption><?=$item['name']?></caption>
		<form method="POST" action="ajax/vote.php">
			<input type="hidden" name="vote_for" value="<?=$i?>"/>
			<input type="submit" name="vote" value="Vote"/>
		</form>
	</div> 
	<?php $i++; } ?>


</section>


<aside></aside> 

<footer><a href="#">Northern BC</a></footer> 
<?php
} else {
	echo "There are currently no vote campaigns running.";
}
?>
