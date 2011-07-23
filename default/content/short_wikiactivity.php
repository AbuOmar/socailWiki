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

$wikiID = $doc->get('wikiId');
$wiki = $POD->getContent(array('type'=>'wiki', 'id'=>$wikiID));

?>	<li class="content_short wikiactivity content_<? $doc->write('type'); ?> <? if ($doc->get('isOddItem')) {?>odd<? } ?> <? if ($doc->get('isEvenItem')) {?>even<? } ?> <? if ($doc->get('isLastItem')) {?>last<? } ?> <? if ($doc->get('isFirstItem')) {?>first<? } ?>" id="content<? $doc->write('id'); ?>">	
		<? $doc->author()->output('avatar'); ?>
		<article class="attributed_content content_body">
				<header>
					<span class="content_meta">
						<span class="content_author"><? $doc->author()->permalink();?></span> edited (<span class="content_time"><? echo $doc->write('timesince'); ?></span>)
						<a href="<? echo  str_replace('api', 'index', $wiki->get('api')); ?>?title=<?$doc->write('headline');?>" title="<? $doc->write('headline'); ?>"><? $doc->write('headline'); ?></a> on <a href="<? $wiki->write('link'); ?>"><?$wiki->write('headline');?></a><br>
						<? if ($doc->get('body')) { 
							echo "Summary: ";
							$doc->write('body');
						} ?>
					</span>
				</header>
				
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
					<? if ($doc->isEditable()) { ?>
						<li class="delete_option">
							<a href="#deleteContent" data-content="<?= $doc->id; ?>">Delete</a>
						</li>
					<? } ?>
				</ul>
		</article>

		<div class="clearer"></div>
	</li>
