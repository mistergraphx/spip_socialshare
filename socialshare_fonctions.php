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
	$size = 8;
	if(lire_config('socialshare/method_insert')=='svg_symbols'){
		$markup = "<svg class=\"$class\" viewBox=\"0 0 32 32\"><use xlink:href=\"#$social_network\"></use></svg>";
	}else{
		$markup = "<span class=\"$class\" aria-hidden=\"true\"></span>";
	}

	return $markup;
}
/*
 * fontface_declaration
 * extrait de webfonts2
 *
@font-face {
    font-family: 'open_sansitalic';
    src: url('OpenSans-Italic-webfont.eot');
    src: url('OpenSans-Italic-webfont.eot?#iefix') format('embedded-opentype'),
         url('OpenSans-Italic-webfont.woff2') format('woff2'),
         url('OpenSans-Italic-webfont.woff') format('woff'),
         url('OpenSans-Italic-webfont.ttf') format('truetype'),
         url('OpenSans-Italic-webfont.svg#open_sansitalic') format('svg');
    font-weight: normal;
    font-style: normal;

}

@param $font array family|file|weight|style
@param $formats array extension|format default

*/

function socialshare_fontface_declaration($font, $formats = array('.woff2'=>'woff2','.woff'=>'woff','.ttf'=>'truetype')){

	$default = array(
		'family'=>'Dutissimo',
		'file'=>'squelettes-dist/polices/dutissimo',
		'weight'=>'400',
		'style'=>'normal'
	);
	$font = array_merge($default,$font);
	$font_files = '';
	$i = 1;
	foreach($formats as $extension => $format){
		$file_path = find_in_path("polices/socialshare/font/".$font['file'].$extension);
		$font_files .="url('".$file_path."') format('$format')";
		($i < count($formats)) ? $font_files .=", " : $font_files .=";";
		$i++;
	}

	$declaration = <<<EOT
@font-face {
    font-family: '{$font['family']}';
	src: $font_files
    font-weight:{$font['weight']};
    font-style:{$font['style']};
}
EOT;

	return $declaration;
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
			'sharing_url'=> "https://plus.google.com/share?url=@url@",
			'icon_class'=> 's-icon s-icon-googleplus'
		),
		'pinterest' => array(
			'label'=> 'Pinterest',
			'sharing_url'=> 'https://www.pinterest.com/pin/create/button/?url=@url@&media=@media@',
			'icon_class'=> 's-icon s-icon-pinterest'
		),
		'seenthis' => array(
			'label'=> 'SeenThis',
			'sharing_url'=> 'https://www.seenthis.net/#ajouter=@title@&url_site=@url@&logo=@media@',
			'icon_class'=> 's-icon s-icon-seenthis'
		),
		'youtube' => array(
			'label'=> 'Youtube',
			'sharing_url'=> '',
			'icon_class'=> 's-icon s-icon-youtube'
		),
		'github' => array(
			'label'=> 'GitHub',
			'sharing_url'=> '',
			'icon_class'=> 's-icon s-icon-github'
		),
		'instagram' => array(
			'label'=> 'Instagram',
			'sharing_url'=> '',
			'icon_class'=> 's-icon s-icon-instagram'
		)
	);

	if(is_array(pipeline('social_networks'))) {
		$user_sharers= pipeline('social_networks');
		$sharers = array_replace_recursive($default,$user_sharers['social_networks']);
		return $sharers;
	}

	return $default;

}
