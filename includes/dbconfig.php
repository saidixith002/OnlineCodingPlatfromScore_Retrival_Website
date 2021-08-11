<?php
	
	require __DIR__.'/vendor/autoload.php';
	
	use Kreait\Firebase\Factory;
	use Kreait\Firebase\ServiceAccount;
	
	$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/online-judges-95576-firebase-adminsdk-6hlrs-56ac12de52.json');
	$factory = (new Factory) 
				-> withServiceAccount($serviceAccount)
				->withDatabaseUri('https://online-judges-95576-default-rtdb.firebaseio.com/')
				->create();

	
	$database = $factory->getDatabase();
?>