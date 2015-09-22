<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Autoload file for PHPUnit
 */

spl_autoload_register('HackFastAlgosAutoload');

function HackFastAlgosAutoload($class)
{
	$class = strtolower($class);
	if (false === ($position = strpos($class, 'hackfastalgos\\'))) {
		return;
	}

	$proposed = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, './lib/'.substr($class, $position+14).'.php');
	if (false !== file_exists($proposed)) {
		require_once($proposed);
	}
}
