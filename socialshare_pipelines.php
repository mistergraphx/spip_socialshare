<?php
/**
 * Utilisations de pipelines par Social-Share
 *
 * @plugin     Social Share
 * @copyright  2016
 * @author     Mist. GraphX
 * @licence    GNU/GPL
 * @package    SPIP\social-share\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Inserer les styles
 *
 * @param $head
 *
 * @return string
 */
function socialshare_insert_head_css($head) {
	include_spip('inc/config');
	if (lire_config('socialshare/css', 0)) {
		$head .= '<link rel="stylesheet" type="text/css" href="' . find_in_path('css/socialshare.css') . '" />' . "\n";
	}

	return $head;
}

function socialshare_ieconfig_metas($table){
	$table['socialshare']['titre'] = _T('socialshare:socialshare_titre');
	$table['socialshare']['icone'] = 'prive/themes/spip/images/socialshare-16.png';
	$table['socialshare']['metas_serialize'] = 'socialshare';
	return $table;
}
/**
 * pipeline social_networks
 *
 * 
*/
function socialshare_social_networks($flux){
	
	return $flux;
}