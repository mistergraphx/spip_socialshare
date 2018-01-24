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

include_spip('inc/config');
/* balise_SOCIAL_ICON_dist()

Retourne le markup necesssaire a l'affichage de l'icone
de partage svg#symbol ou span.icon

on passe en parametre la clé du tableau issu de la pipeline

*/
function balise_SOCIAL_ICON_dist($p){
	$social_network = interprete_argument_balise(1, $p);
	$p->interdire_scripts = false;
	$p->code = "calculer_balise_SOCIAL_ICON($social_network)";
	return $p;
}
/* calculer_balise_SOCIAL_ICON()

@param $network - clé dans la liste des reseaux sociaux
@return $icon_markup
*/
function calculer_balise_SOCIAL_ICON($social_network){
	$sharers = lister_partages();
	$network = $sharers[$social_network];
	$class = $network['icon_class'];

	if(lire_config('socialshare/method_insert')=='svg_symbols'){
		$markup = "<svg class=\"$class\"><use xlink:href=\"#$social_network\"></use></svg>";
	}else{
		$markup = "<span class=\"$class\" aria-hidden=\"true\"></span>";
	}

	return $markup;
}



/*
 * function lister_partages
 *
 */

function lister_partages() {


	$default = array(
		'facebook' => array(
			'label'=> 'FaceBook',
			'sharing_url'=> 'https://www.facebook.com/sharer.php?u=@url@',
			'icon_class'=> 's-icon s-icon-facebook'
		),
		'twitter' => array(
			'label'=> 'Twitter',
			'sharing_url'=> 'https://twitter.com/home?status=@title@+@url@',
			'icon_class'=> 's-icon s-icon-twitter'
		),
		'googleplus' => array(
			'label'=> 'Google+',
			'sharing_url'=> 'https://plus.google.com/share?url=@url@',
			'icon_class'=> 's-icon s-icon-googleplus'
		),
		'pinterest' => array(
			'label'=> 'Pinterest',
			'sharing_url'=> 'https://www.pinterest.com/pin/create/button/?url=@url@&media=@media@',
			'icon_class'=> 's-icon s-icon-pinterest'
		),
	);

	if(is_array(pipeline('social_networks'))) {
		$user_sharers= pipeline('social_networks');


		$sharers = array_replace_recursive($default,$user_sharers['social_networks']);

		return $sharers;
	}

	return $default;

}
