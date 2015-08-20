<?php
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
	
	$proposed = '.'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.substr($class, $position+14).'.php';
	if (false !== @filemtime($proposed)) {
		require_once($proposed);
	}
}
