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


function socialshare_affichage_final($page){
	// ne pas insérer le svg sur toute les pages
	// si ce n'est pas nécessaire
	if(strpos($page,'class="socialshare"',0)){
			// Methode insertion svg symbols
			// on place le svg après la balise body
			include_spip('inc/config');
			if (lire_config('socialshare/insert_svg_symbols', 0)) {
				$body = preg_match("/(<body.*?>)/u", $page, $matches);
				if ( $body_pos = strpos($page,$matches[0]) ){
					lire_fichier(find_in_path('images/symbols.svg'),$svg);
					$page = substr_replace($page, $matches[0].$svg , $body_pos, 0);
				}
			}
	}

	return $page;
}


/**
 * Insertion css
 * repris de webfonts, on place les styles en premier
 *
 * @param $flux
 * @return string
 *
 */
function socialshare_insert_head_css($flux) {
	include_spip('inc/config');
	if (lire_config('socialshare/css', 0)) {
			static $done = false;
			$styles = '<link rel="stylesheet" type="text/css" href="' . find_in_path('css/socialshare.css') . '" />' . "\n";
			if (!$done){
						// le placer avant les autres CSS du flux
						if (($p = strpos($flux,"<link"))!==false){
							$flux = substr_replace($flux,$styles,$p,0);
						// sinon a la fin
						}else{
							$flux .= $styles;
						}

				$done = true;
			}
	}
	return $flux;
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
