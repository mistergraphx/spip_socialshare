<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function socialshare_upgrade($nom_meta_base_version, $version_cible) {

	// Création du tableau des mises à jour.
	$maj = array();

	$config = array(
		'method_insert' => 'none'
	);

	// Tableau de la configuration par défaut
	$maj['0.0.1'] = array(
		array('ecrire_config', 'socialshare', $config)
	);

	// Maj du plugin.
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

/*
 *   Désintaller
 */
function socialshare_vider_tables($nom_meta_base_version) {
	// Supprimer les méta, ou oublie pas celle de la base.
	effacer_meta('socialshare');
	effacer_meta($nom_meta_base_version);
}
