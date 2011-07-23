<?

	// include the peoplepods library and instantiate a pod object
	require_once("../../PeoplePods.php");
	$POD = new PeoplePod(array('authSecret'=>@$_COOKIE['pp_auth'],'debug'=>2));
	
	// create an empty piece of content
	$doc = $POD->getContent();
	
	if (isset($_POST['selected_wiki']))
	{
		$selWiki=$POD->getContent(array('stub'=>$_POST['selected_wiki']));	
		$selWiki->addFlag('username',$POD->currentUser(),$_POST['user_name']);
	}
	$doc->headline = 'My Wikis';
	
	// print the header 
	$POD->header($doc->headline);
	
	// output the sample content using a custom template that is included with the pod.

	$doc->output('custom.template',dirname(__FILE__));

	// print the footer.
	$POD->footer();
