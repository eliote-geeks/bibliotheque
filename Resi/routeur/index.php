RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
Rewrite ^(.*)$ index.php?url=$1 [NC,L]

<?php 

$url = '';
if (isset($_GET['url'])) {
	$url = $_GET['url'];
}
if ($url == '') {
	require 'home.php';
}
elseif (preg_match($article-([0-9]+),$url,$params)) {
	$idArticle = $url[1];
	require 'article.php';;
	
}
else{
	echo "404";
}

// if (isset($_GET['url'])) {
// 	$url = explode('/', $url);
// }
// if ($url = '') {
// 	require 'home.php';
// }
// elseif ($url[0] == 'article' AND !empty($url[1])) {
// 	$idArticle = $url[1];
// 	require 'article.php';;
// }
// else{
// 	echo "Erreur 404";
// }

 ?>