<h1><?= $doc->headline; ?></h1>
<?
	if (isset($_POST['selected_wiki']))
	{
		$selWiki=$POD->getContent(array('type'=>'wiki','id'=>$_POST['selected_wiki']));	
		$selWiki->addFlag('mywiki',$POD->currentUser(),$_POST['user_name']);		
		header("Location: wikiman");
	}
	
	else if (isset($_GET['remove'])){
		$wiki = $POD->getContent(array('type'=>'wiki','id'=>$_GET['remove']));
		$wiki->removeFlag('mywiki',$POD->currentUser());
		header("Location: wikiman");

	}
	
	
	
	$wikis = $POD->getContents(array('type'=>'wiki'));
	?><ul><?
	foreach ($wikis as $wiki)
		if($username = $wiki->hasFlag('mywiki', $POD->currentUser())) {
			?><li><b><?
			$wiki->write('headline');
			?></b>, <? echo $username; ?>, <a href="wikiman?remove=<? $wiki->write('id'); ?>">remove</a><br> <?
		}
	?></ul><?

	
	
	?>
	
	<form method="POST">		
	<fieldset>
		<legend>Add a wiki to track</legend>
		Wiki Name: 	<select name='selected_wiki'>
			<?php foreach ($wikis as $wiki) { ?>
			<option value=<?php $wiki->write('id'); ?> > <?php $wiki->write('headline'); ?> </option>
			<?php } ?>
		</select><br />
		User Name: <input name="user_name" type="text"/><br/>
		<input value="Add Wiki" type="submit" />
	</fieldset>
	</form>
	<?

?>
