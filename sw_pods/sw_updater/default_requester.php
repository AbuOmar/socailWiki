<?php

include_once("../../lib/Core.php");

// only allow logged in people
$POD = new PeoplePod(array(
 'authSecret'=>$_COOKIE['pp_auth'],
  'lockdown'=>'login'
));

	if (isset($_GET['id'])) {
		include('/wikimate/globals.php');
		
						$new_activity = $POD->getContent();
						$new_activity->headline = 'I have made it!';
						$new_activity->save();
		
		$wiki = $POD->getContent(array(
			'type'=>'wiki', 'id'=> $_GET['id']
		));		
			define('WIKI_USERNAME','');
			define('WIKI_PASSWORD','');
			define('WIKI_API',$wiki->get('api'));
			
		$requester = new Wikimate;
			
		$data = array(
			'list' => 'recentchanges',
			'rcprop' => 'user|comment|timestamp|title|ids|sizes|redirect|loginfo|flags',
			'rcend' => $wiki->get('rcstart')
		);			
		$results = $requester->query( $data );
		$wiki->set('rcstart', $results['query']['recentchanges'][0]['timestamp']);
		
		if($results) {foreach ($results['query']['recentchanges'] as $recentchange) {	
			print_r($recentchange);

			echo "<br>";
		
			//first we check if the user is registered in our website
			$username = $recentchange['user'];				
			$sql = "SELECT value, userId from flags WHERE itemId=".$wiki->get('id')." AND name='mywiki' AND value='".mysql_real_escape_string($username)."';";	
			$res = mysql_query($sql,$POD->DATABASE);			

			if($res) {
				$num = mysql_num_rows($res);
				if ($num > 0){
				//if the user is registered in our website, we are going to publish his activity
					$n = $POD->getContents(
						array('type'=>'wikiactivity',
							  'wikiId'=>$wiki->get('id'),
							  'rcid' => $recentchange['rcid']
					))->count();
					
					if($n == 0){				
						//user info
						$user = mysql_fetch_assoc($res);
						$userId = $user['userId'];
						
						//publishing..
						$new_activity = $POD->getContent();
						$new_activity->headline = $recentchange['title'];
						$new_activity->type = 'wikiactivity';
						$new_activity->userId = $userId;
						$new_activity->body = $recentchange['comment'];
						$new_activity->addMeta('rcid',$recentchange['rcid']);
						$new_activity->addMeta('edit_type',$recentchange['type']);
						$new_activity->addMeta('wikiId',$wiki->get('id'));
						
						//creating date..
						
						$recentchange['timestamp']= str_replace('T',' ',$recentchange['timestamp']);
						$recentchange['timestamp'] = str_replace('Z','',$recentchange['timestamp']);	
						echo "<br>hey: ".$recentchange['timestamp']."<br>";
						
						//$new_activity->changeDate = $new_activity->editDate = $recentchange['timestamp'];
						$new_activity->save();					
					}

				}
			}
		}		
		$wiki->set('last_rcid', $results['query']['recentchanges'][0]['rcid']);	 	 
		}		
	}	
?>