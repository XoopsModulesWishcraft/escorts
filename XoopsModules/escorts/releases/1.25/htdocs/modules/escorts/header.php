<?php

	include ('../../mainfile.php');
	
	include ($GLOBALS['xoops']->path('/modules/escorts/include/functions.php'));
	include ($GLOBALS['xoops']->path('/modules/escorts/include/escorts.formobjects.php'));
	include ($GLOBALS['xoops']->path('/modules/escorts/include/escorts.forms.php'));
	
	$op = strip_tags(trim($_REQUEST['op']));
	$fct = strip_tags(trim($_REQUEST['fct']));
	$pid = intval(strip_tags(trim($_REQUEST['pid'])));
	$id = intval(strip_tags(trim($_REQUEST['id'])));
	
	foreach($_GET as $id => $val)
		${$id} = $val;
		
	foreach($_POST as $id => $val)
		${$id} = $val;		

?>