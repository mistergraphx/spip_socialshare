# Social share

* Ajoute au plugin Menu des boutons de partage
* Pipeline pour ajouter ou modifier des reseaux sociaux depuis un plugin ou skel
* Liste utilisable indépendament du menu
* Sprites svg et png
* Détection du support svg

Le plugin ne gère pas les métas necessaires au réseaux sociaux pour correctement remplir les informations de partage.

Elles sont donc à gérer soit par vous même dans vos squelettes, ou en utilisant [le plugin meta-plus](https://contrib.spip.net/Metas-4845)


## Personalisation

### Assets, css, svg, png

le plugin inssère les css nécessaires, l'insertion est désactivable dans la configuration du plugin, dans le cas d'un set d'icone externe.

Ajouter , personaliser les logos/icones des liens de partage

Le sprite svg ainsi que le sprite png (si vous souhaitez gérer les navigateurs ne supportant pas le svg), sont surchargeables depuis le dossier squelette en créant vos propres images social_icons.png.

### Description d'un réseaux

```php

'facebook' => array(
	'label'=> 'FaceBook',
	'sharing_url'=> 'https://www.facebook.com/sharer.php?u=@url@',
	'icon_class'=> 's-icon s-icon-facebook'
),

```

les variables uilisables pour construire les liens de partage :

| Variable | Description |
|--|--|
| `@url@`| Url de l'objet à partager passé en parametre|
| `@title@` | Titre du partage |
| `@media@` | Un media |

On peut donc ajouter ensuite depuis la pipeline ses propres réseaux de partage, ils seront activables depuis la config du plugin.

### Pipeline `social_networks()`


Ajouter au paquet xml de votre plugin/theme

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



## Utilisation dans un squelette

### Liste des boutons de partage

```html
[<div class="sharing">(#INCLURE{fond=listes/social-share,url=#URL_ARTICLE,title=#TITRE,media=#LOGO_ARTICLE,env})</div>]
```

### Appel du menu de partage

Passer en paramètre l'url de l'objet a partager

```html
[(#INCLURE{fond=inclure/menu,identifiant=nav_share, url=#URL_PRODUIT, media=#LOGO_ARTICLE env})]
```

## Plugins complémentaires


https://contrib.spip.net/Liens-sociaux
https://zone.spip.org/trac/spip-zone/browser/_plugins_/rezosocios/trunk

Logo auto trouve une image/document si le logo n'éxiste pas :
https://zone.spip.org/trac/spip-zone/browser/_plugins_/logo_auto/branches/logo_auto_php

## Sources

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
