<?php
	require_once("/var/www/lib/generator.php");
	require_once("/var/www/lib/model_generator.php");
	require_once("/var/www/lib/migration_generator.php");

	function get_attributes($args){
		$attributes = array();
		for($i = 3 ; $i < count($args) ; $i++){
			$tokens = explode(":",$args[$i]);
			$attributes[$tokens[0]] = $tokens[1];
		}
		return $attributes;
	}
	switch($argv[1]){
		case "model":
			$params = array();
			$params['model'] = $argv[2];
			$attributes = get_attributes($argv);
			$params['columns'] = $attributes;
			$generator = new ModelGenerator($params);
			echo $generator->generate();
			$generator = new MigrationGenerator($params);
			echo $generator->generate();
		break;

		case "migration":

		break;

		default:

		break;
		
	}

?>
