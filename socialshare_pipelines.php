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


function socialshare_social_networks($flux){


	$flux['social_networks'] = array(
		'facebook' => array(
			'label'=> 'FaceBook',
			'sharing_url'=> 'http://www.facebook.com/sharer.php?u=@url@',
			'icon_name'=> 'icon-facebook'
		),
		'twitter' => array(
			'label'=> 'Twitter',
			'sharing_url'=> 'http://twitter.com/home?status=@title@+@url@',
			'icon_name'=> 'icon-twitter'
		),
		'googleplus' => array(
			'label'=> 'Google+',
			'sharing_url'=> 'https://plus.google.com/share?url=@url@',
			'icon_name'=> 'icon-gplus'
		),
		'pinterest' => array(
			'label'=> 'Pinterest',
			'sharing_url'=> 'https://www.pinterest.com/pin/create/button/?url=@url@&description=@title@',
			'icon_name'=> 'icon-pinterest'
		),
	);
	
	
	
	return $flux;
}