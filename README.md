# Social share

* Ajoute au plugin Menu des boutons de partage
* Pipeline pour ajouter ou modifier des reseaux sociaux depuis un plugin ou skel
* Liste utilisable indépendament du menu
* Sprites svg et png
* Détection du support svg

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

* https://simplesharebuttons.com/html-share-buttons/
* https://github.com/bradvin/social-share-urls
* https://toddmotto.com/progressively-enhanced-svg-sprite-icons/

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