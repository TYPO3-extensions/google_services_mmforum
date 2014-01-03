<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Bastian Bringenberg <bastian.bringenberg@typo3.org>, BBNetz.eu
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * class Tx_GoogleServicesMmforum_Service_GoogleSitemapService
 *
 * @package google_services_mmforum
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_GoogleServicesMmforum_Service_GoogleSitemapService implements Tx_GoogleServices_Interface_SitemapProviderInterface {

	/**
	 * function getRecords
	 *
	 * @param int $startPage
	 * @param array $basePages
	 * @param Tx_GoogleServices_Controller_SitemapController $obj
	 * @return array
	 */
	public function getRecords($startPage, $basePages, Tx_GoogleServices_Controller_SitemapController $obj) {
		$nodes = array();

		if (!t3lib_extMgm::isLoaded('mm_forum')) {
			return $nodes;
		}
		$storagePid = $GLOBALS['TSFE']->tmpl->setup['config.']['google_services_mmforum.']['storage_pid'];
		$frontendPid = $GLOBALS['TSFE']->tmpl->setup['config.']['google_services_mmforum.']['frontend_pid'];
		$query = 'SELECT p.post_time, t.uid, t.forum_id, t.topic_title FROM tx_mmforum_topics as t JOIN tx_mmforum_posts as p ON t.topic_last_post_id = p.uid JOIN tx_mmforum_forums as f ON f.uid = t.forum_id WHERE t.pid = ' . $storagePid  . ' AND f.grouprights_read = "";';
		$result = $GLOBALS['TYPO3_DB']->sql_query($query);
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result )) {
			$uriBuilder = $obj->getUriBuilder();
			$uriBuilder->setTargetPageUid($frontendPid);
			$uriBuilder->setArguments(array(
				'tx_mmforum_pi1' => array(
					'action' => 'list_post',
					'fid' => $row['forum_id'],
					'tid' => $row['uid']
				)
			));
			$url = $uriBuilder->buildFrontendUri();
			if ($url === '') {
				continue;
			}
			$node = new Tx_GoogleServices_Domain_Model_Node();
			$node->setLoc($baseUri . $url);
			$node->setPriority(0.9);
			$node->setChangefreq('weekly');
			$node->setLastmod($row['post_time']);
			$nodes[] = $node;
		}
		return $nodes;
	}
}
