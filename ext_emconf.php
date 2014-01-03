<?php

########################################################################
# Extension Manager/Repository config file for ext: "google_services_mmforum"
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Google Services for mm_forum',
	'description' => 'Enables Google Services for mm_forum. Lists Public Threads and Boards.',
	'category' => 'plugin',
	'author' => 'Bastian Bringenberg',
	'author_email' => 'bastian.bringenberg@typo3.org',
	'author_company' => 'Bastian Bringenberg | BbNetz.eu',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'google_services' => '0.2.4',
			'typo3' => '4.5.0-4.7.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>
