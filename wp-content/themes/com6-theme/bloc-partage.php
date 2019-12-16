<?php
	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
	$url = urlencode( trailingslashit($current_url) );
	$titre = urlencode( get_the_title() );
?>

<div class="share-buttons">
	<span>Partager :</span>
	<a href="mailto:?body=<?= esc_attr($url); ?>" target="_blank" rel="noreferrer" role="button"><i class="icon-paper-plane-empty" aria-hidden="true"></i><span class="sr-only">Envoyer par e-mail</span></a>
	<a href="http://twitter.com/share?url=<?= $url; ?>" target="_blank"><i class="icon-twitter" aria-hidden="true"></i><span class="sr-only">Partager sur Twitter</span></button>
	<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $url ?>&title=<?= $titre ?>" target="_blank"><i class="icon-linkedin" aria-hidden="true"></i><span class="sr-only">Partager sur LinkedIn</span></a>
	<a href="#" onClick="window.print();" role="button"><i class="icon-print" aria-hidden="true"></i><span class="sr-only">Imprimer</span></a>
</div>
