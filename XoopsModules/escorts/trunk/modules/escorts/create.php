<?php
	require('header.php');

	if (!is_object($GLOBALS["xoopsUser"])) {
		redirect_header('index.php', 7, _ESC_NEEDTOBELOGGEDIN);
		exit(0);
	}
	
	switch($op) {
	case "save":
		switch($fct){
		case "escort":
			$profile_handler =& xoops_getmodulehandler('profile', 'escorts');

			if ($pid)
				$profile = $profile_handler->get($pid);
			else
				$profile = $profile_handler->create();
				
			$profile->setVar('alias', $alias );
			$profile->setVar('name', $name );
			$profile->setVar('incall', $incall );
			$profile->setVar('outcall', $outcall );
			$profile->setVar('sms', $sms );
			$profile->setVar('mobile', $mobile );
			$profile->setVar('landline', $landline );
			$profile->setVar('agency', $agency );
			$profile->setVar('age', $age );
			$profile->setVar('tags', $tags );
			$profile->setVar('sexuality', $sexuality );
			$profile->setVar('domains', $domains );
			$profile->setVar('locations', $locations );
			$profile->setVar('domains', $domains );
			$profile->setVar('slogon', $slogon );
			$profile->setVar('bio', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $bio))) );
			$profile->setVar('columnone', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $columnone))) );
			$profile->setVar('columntwo', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $columntwo))) );
			$profile->setVar('footer', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $footer))) );
			$profile->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid') );

			if ($profile_handler->insert($profile, true)) {
				$tag_handler = xoops_getmodulehandler('tag', 'tag');
				$tag_handler->updateByItem($tags, $profile->getVar('pid'), $xoopsModule->getVar("dirname"), $cid = 0);
				redirect_header('index.php', 7, _ESC_DATASAVEDSUCCESSFULLY);
			} else
				redirect_header('index.php', 7, _ESC_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
		}
	default:
	case "profile":	
		switch($fct){
		default:
			$xoopsOption['template_main'] = 'escorts_create_profile.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('profile_form', escortsProfileForm($pid));	
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		}
	}
?>