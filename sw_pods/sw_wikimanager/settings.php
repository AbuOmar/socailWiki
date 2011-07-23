<?

	$POD->registerPOD(
		'sw_wikimanager',									// this is the name of the pod. it should match the folder name.
		'this pod let manage your wikis ',		// this is the description of the pod. it shows up in the command center.
		array(
			'^wikiman$'=>'sw_wikimanager/handler.php',		// set up the /sample url to handle requets
			//'^wikiMark/(.*)'=>'sw_wikimanager/handler.php?wiki_name=$1',	// set up the /sample/* to handle requets
		),
		array(
			'sample_pod_variable'=>true,				// if this pod is enabled, value can be accessed via $POD->libOptions('sample_pod_variable');
		),
		dirname(__FILE__) . "/methods.php",				// tells PeoplePods to add custom methods included in the methods.php file
		'wikiManagerSetup',									// tells PeoplePods to call sampleSetup as the setup function for this pod.
		'wikiManagerInstall',								// tells PeoplePods to call this function when the pod is turned on
		'wikiManagerUninstall'								// tells PeoplePods to call this function when the pod is turned off.
	);
