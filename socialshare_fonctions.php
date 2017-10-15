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
			'icon_class'=> 's-icon s-icon-google'
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