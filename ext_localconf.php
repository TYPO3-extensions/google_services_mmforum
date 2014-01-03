<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if(t3lib_extMgm::isLoaded('google_services')) {
	require_once(t3lib_extMgm::extPath('google_services', 'Classes/Service/SitemapProvider.php'));
	Tx_GoogleServices_Service_SitemapProvider::addProvider(t3lib_extMgm::extPath('google_services_mmforum', 'Classes/Service/GoogleSitemapService.php'), 'Tx_GoogleServicesMmforum_Service_GoogleSitemapService');
}
