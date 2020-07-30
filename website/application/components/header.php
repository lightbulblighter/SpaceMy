<?php
	$title = "";
	
	if (!empty($page_name))
	{
		$title = $page_name ." - ". PROJECT["NAME"];
	}
	else
	{
		$title = PROJECT["NAME"];
	}
?>

<meta charset="utf-8">
<meta name="csrf-token" content="<?= $_SESSION["csrf"] ?>">
<title><?= $title ?></title>
<link rel="shortcut icon" type="image/png" href="<?= get_server_host() ?>/html/img/logos/icon.png">
<link rel="stylesheet" href="<?= get_server_host() ?>/html/css/site.min.css">