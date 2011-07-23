<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/short.php
* Default short template for content.
* Used by core_usercontent/list.php
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>	<li class="content_short content_<? $doc->write('type'); ?> <? if ($doc->get('isOddItem')) {?>odd<? } ?> <? if ($doc->get('isEvenItem')) {?>even<? } ?> <? if ($doc->get('isLastItem')) {?>last<? } ?> <? if ($doc->get('isFirstItem')) {?>first<? } ?>" id="content<? $doc->write('id'); ?>">	
		<article class="attributed_content content_body">
				<h1><a href="<? $doc->write('permalink'); ?>" title="<? $doc->write('headline'); ?>"><? $doc->write('headline'); ?></a></h1>
				<? if ($img = $doc->files()->contains('file_name','img')) { ?>
					<p class="content_image"><a href="<? $doc->write('permalink'); ?>"><img src="<? $img->write('resized') ?>" /></a></p>
				<? } ?>			


				<? if ($doc->get('link')) { ?>
					<p>View Link: <a href="<? $doc->write('link'); ?>"><? $doc->write('link'); ?></a></p>
				<? } ?>		

				<? if ($doc->get('body')) { 
					$doc->writeFormatted('body');
				} ?>
				
				<div class="clearer"></div>

				<ul class="content_options">
					<li class="comments_option">
						<a href="<? $doc->write('permalink'); ?>"><?  if ($doc->comments()->totalCount() > 0) {  echo $doc->comments()->totalCount() . " comments"; } else { echo "No comments"; } ?></a>
					</li>
					<? if ($doc->POD->isAuthenticated()) { ?>
						<li class="watching_option">
							<a href="#toggleFlag" data-flag="watching" data-active="Stop tracking" title="Track new comments on the dashboard" data-inactive="Track" data-content="<?= $doc->id; ?>" class="trackingLink <? if ($doc->hasFlag('watching',$POD->currentUser())) {?>active<? } ?>">Track</a>
						</li>
					<? } ?>				
					<? if ($doc->get('privacy')=="friends_only") { ?>
						<li class="friends_only_option">Friends Only</li>
					<? } else if ($doc->get('privacy')=="group_only") { ?>
						<li class="group_only_option">Group Members Only</li>
					<? } else if ($doc->get('privacy')=="owner_only") { ?>
						<li class="owner_only_option">Only you can see this.</li>
					<? } ?>

				</ul>
		</article>
		<div class="clearer"></div>
	</li>
