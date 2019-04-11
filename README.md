# Social share

* Menu de partage et follow
* Pipeline pour ajouter ou modifier des reseaux sociaux depuis un plugin ou skel
* Liste utilisable indépendament des menus
* Sprites svg ou icon font
* Détection du support svg

Le plugin ne gère pas les métas necessaires au réseaux sociaux pour correctement remplir les informations de partage.

Elles sont donc à gérer soit par vous même dans vos squelettes, ou en utilisant [le plugin meta-plus](https://contrib.spip.net/Metas-4845)


## Gestion des icones :

Le plugin propose en configuration, trois méthodes de gestion des icones.

### Pas d'insertion :

Tout est géré par le thème, les classes css peuvent êtres adaptés via la pipeline dans le cas d'un set comme font-awesome.

### Sprite svg :

Un sprite svg, est insséré après la balise `<body>` sur les pages ou les boutons de partages sont présents (`class="socialshare`).

Une balise génère le markup `<svg>`, permettant donc l'utilisation de toutes les propriétées css3 svg (fill, stroke) sur chacune des icones.

### icon font :

Une icone font est inséré et utilisé, le fichier de config fontello permet de pouvoir générer sa propre icon font si besoin.

### Modèles


`<suiveznous|afficher_label=non>`

afficher_label (oui !) : affiche le nom du réseau sinon `.visuallyhidden`

## Utilisation dans un squelette

### Listes

Boutons de partage

```html
[<div class="sharing">
(#INCLURE{fond=listes/social-share,
	url=#URL_ARTICLE,
	title=#TITRE,
	media=#LOGO_ARTICLE,env})
</div>]
```

Boutons Suivez-nous

```
<div class="sharing">
<INCLURE{fond=listes/suivez-nous, afficher_label=oui,env}/>
</div>
```

### Menus

Si vous utilisez le plugin menu, un menu est fourni, vous pouvez passer en paramètre l'url de l'objet a partager, son titre, un media (pour les réseaux le supportant - ex: pinterest).

```html
[(#INCLURE{fond=inclure/menu,identifiant=nav_share, url=#URL_PRODUIT, media=#LOGO_ARTICLE env})]
```





### Description d'un réseaux

```php

'facebook' => array(
	'label'=> 'FaceBook',
	'sharing_url'=> 'https://www.facebook.com/sharer.php?u=@url@',
	'icon_class'=> 's-icon s-icon-facebook'
),

```

les variables utilisables pour construire les liens de partage :

| Variable | Description |
|--|--|
| `@url@`| Url de l'objet à partager passé en parametre|
| `@title@` | Titre du partage |
| `@media@` | Un media |

On peut donc injecter dans la pipeline ses propres réseaux de partage, ils seront activables depuis la configuration du plugin, ou mis a jour si seulement certaines informations sont transmise.

### Pipeline `social_networks()`


#### Ajouter au paquet xml de votre plugin/theme

```xml
<pipeline nom="social_networks" inclure="prefix_plugin_pipelines.php"/>

```

puis dans votre fichier pipeline, vous pouvez ainsi ajouter ou surcharger
les liens de partage, on peut ainsi utiliser un système d'icone externe au plugin si besoin.

```php
function prefix_plugin_social_networks($flux){

	$flux['social_networks']  = array(
		'facebook' => array(
			'icon_class'=> 'icon icon-facebook'
		),
		'twitter' => array(
			'icon_class'=> 'icon icon-twitter'
		),
		'googleplus' => array(
			'icon_class'=> 'icon icon-gplus'
		),
		'pinterest' => array(
			'icon_class'=> 'icon icon-pinterest'
		),
	);
```

#### Depuis votre fichier `mes_options`

```php
$GLOBALS['spip_pipeline']['social_networks'] = "|my_social_networks";

function my_social_networks($flux){

	$flux['social_networks']  = array(
		'facebook' => array(
			'icon_class'=> 'icon icon-facebook'
		),
		'twitter' => array(
			'icon_class'=> 'icon icon-twitter'
		),
		'googleplus' => array(
			'icon_class'=> 'icon icon-gplus'
		),
		'pinterest' => array(
			'icon_class'=> 'icon icon-pinterest'
		),
	);

	return $flux;
}
```


## Plugins complémentaires


https://contrib.spip.net/Liens-sociaux
https://zone.spip.org/trac/spip-zone/browser/_plugins_/rezosocios/trunk

Logo auto trouve une image/document si le logo n'éxiste pas :
https://zone.spip.org/trac/spip-zone/browser/_plugins_/logo_auto/branches/logo_auto_php

## Sources

OpenGraph :
* https://snook.ca/archives/html_and_css/open-graph-and-sharing-tags

Sharers :
* https://developers.google.com/+/web/share/#sharelink
* https://simplesharebuttons.com/html-share-buttons/
* https://github.com/bradvin/social-share-urls
* https://toddmotto.com/progressively-enhanced-svg-sprite-icons/
* Pinterst dev :
	* https://developers.pinterest.com/tools/widget-builder/?type=pin&url=https%3A%2F%2Fwww.pinterest.com%2Fpin%2F189010515587413425%2F
	* https://developers.pinterest.com/

## Todo


- [] Revalider le fonctionnement du partage facebook depuis un périphérique mobile
facebook n'accepte plus de changer le user ou la page vers laquelle on veut publier quand
on utilise l'url actuelle pour le sharer.php :

des pistes :
http://stackoverflow.com/questions/17935449/facebook-share-on-mobile-device  
http://stackoverflow.com/questions/7187016/facebook-and-twitter-share-for-mobile-web?rq=1

ou alors :
Forcer l'utilisateur a utiliser la versin desktop du sharer.php :

Une autre piste
http://stackoverflow.com/questions/14377968/cant-use-facebook-sharer-php-custom-parameters-in-mobile-sites
Doc : la boite de dialogue partager Facebook:
https://developers.facebook.com/docs/sharing/reference/share-dialog
https://developers.facebook.com/docs/sharing/reference/share-dialog#advancedtopics
Donc l'url serait :
`https://www.facebook.com/dialog/share?app_id=<app_id>&display=popup&href=<url_encoded>`

- [] Vérifier le patage sur Twitter. Twitter utilise WebIntent depuis quelques temps : https://dev.twitter.com/web/tweet-button/web-intent
- [] Ajouter SeenThis `http://seenthis.net/#ajouter=%t&url_site=%u&extrait=%d`



## Changelogs

1.1.0 :
Changement de stratégie de gestion des icones.

Ajout d'une balise gérant le markup, soit `svg` soit `span`, pour gérer la bascule entre les trois modes.

On propose trois méthodes d'insertion :

- Pas d'insertion : tout est géré par le thème, les classes css peuvent êtres adaptés via la pipeline dans le cas d'un set comme font-awesome.
- Sprite svg : un sprite svg, est insséré après la balise `<body>` sur les pages ou les boutons de partages sont présents. Une balise génère le markup `<svg>`, permettant donc l'utilisation de toutes les propriétées css3 svg (fill, stroke) sur chacune des icones.
- icon font : une icone font est insséré et utilisé, le fichier de config fontello permet de pouvoir générer sa propre icon font si besoin.


1.0.6 :

- Ajout d'un attribut title sur les liens de partage + chaine de langue

0.0.5 :

- [X] - correction sur les urls fournies lors de l'ajout passage au https
- [X] Ajout du reseaux pinterest , ajout d'un parametre media

0.0.3 :

- [X] Reseaux default et pipeline, ajout d'une fonction lister_partages
- [X] Icone pour le plugin
- [x] Sécuriser les target=_blank, comme sur le plugin links (https://contrib.spip.net/Liens-explicites)
		on ajouter rel=noopener noreferrer
		(http://zone.spip.org/trac/spip-zone/browser/_plugins_/links/links.js)
		https://www.mail-archive.com/spip-zone@rezo.net/msg40738.html

- [x] Ajouter le partage sur Pinterest : https://gist.github.com/chrisjlee/5196139
