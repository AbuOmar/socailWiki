<?

	
	// return an array of variables that should be captured in the settings screen
	function sampleSetup() {
		return array(
			'sampleSetting1'=>'Setting 1',
			'sampleSetting2'=>'Setting 2',
		);
	}

	function wikiManagerContentMethod($content) { 
		echo 'This is output from $sampleContentMethod() called on a piece of content with the title "' . $content->headline . '"';
	}

	function wikiManagerPersonMethod($person) { 
		echo "samplePersonMethod() called on " . $person->nick;	
	}
	
		
	Content::registerMethod('wikiManagerContentMethod');
	Person::registerMethod('wikiManagerPersonMethod');
	
	Content::addDatabaseFields(array('sampleField'=>array()));
	
	function wikiManagerInstall($POD) {
		$POD->executeSQL('alter table content add sampleField varchar(10)');
	}
	
	function wikiManagerUninstall($POD) {
		$POD->executeSQL('Alter table content drop sampleField');
	}
