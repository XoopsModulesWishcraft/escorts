<?php
/*
Module: Objects

Version: 1.88

Description: Object manager for WHMCS Billing

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Frilogg

License: See docs - End User Licence.pdf
*/
include 'header.php';

xoops_cp_header();
xoops_loadlanguage('main', 'objects');

	if (empty($op)) $op = 'default';
	if (empty($fct)) $fct = 'default';
	error_reporting(E_ALL);


	switch($op){
	case "save":
		switch($fct){
		case "price":
		
			$prices_handler =& xoops_getmodulehandler('prices', 'escorts');
			if (intval($priceid)>0)
				$cost = $prices_handler->get($priceid);
			else
				$cost = $prices_handler->create();

			$cost->setVar('type', $type );
			$cost->setVar('day', $day );
			$cost->setVar('time-start', $timestart );
			$cost->setVar('time-end', $timeend );
			$cost->setVar('event', $event );
			$cost->setVar('currency', $currency );
			$cost->setVar('price', $price );
			$cost->setVar('description', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $description))) );
			$cost->setVar('pid', $pid );
			
			if ($prices_handler->insert($cost, true))
				redirect_header('admin.php?op=prices&pid='.$pid, 7, _ESC_DATASAVEDSUCCESSFULLY);
			else
				redirect_header('index.php', 7, _ESC_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
		case "url":
		
			$urls_handler =& xoops_getmodulehandler('urls', 'escorts');
			if (intval($urlid)>0)
				$ourl = $urls_handler->get($urlid);
			else
				$ourl = $urls_handler->create();

			$ourl->setVar('type', $type );
			$ourl->setVar('other', $other );
			$ourl->setVar('title', $title );
			$ourl->setVar('url', $url );
			$ourl->setVar('pid', $pid );
			
			if ($urls_handler->insert($ourl, true))
				redirect_header('admin.php?op=urls&pid='.$pid, 7, _ESC_DATASAVEDSUCCESSFULLY);
			else
				redirect_header('index.php', 7, _ESC_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
						
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
			$profile->setVar('tags', $tags );
			$profile->setVar('age', $age );
			$profile->setVar('sexuality', $sexuality );
			$profile->setVar('domains', $domains );
			$profile->setVar('locations', $locations );
			$profile->setVar('slogon', $slogon );
			$profile->setVar('bio', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $bio))) );
			$profile->setVar('columnone', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $columnone))) );
			$profile->setVar('columntwo', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $columntwo))) );
			$profile->setVar('footer', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $footer))) );		

			if ($profile_handler->insert($profile, true)){
				$tag_handler = xoops_getmodulehandler('tag', 'tag');
				$tag_handler->updateByItem($tags, $profile->getVar('pid'), $xoopsModule->getVar("dirname"), $cid = 0);
				redirect_header('index.php', 7, _ESC_DATASAVEDSUCCESSFULLY);
			} else
				redirect_header('index.php', 7, _ESC_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
		case "physique":
			$physique_handler =& xoops_getmodulehandler('physique', 'escorts');

			if ($phyid)
				$physique = $physique_handler->get($phyid);
			else
				$physique = $physique_handler->create();
				
			$physique->setVar('pid', $pid );
			$physique->setVar('race', $race );
			$physique->setVar('height', $height );
			$physique->setVar('sex', $sex );
			$physique->setVar('weight', $weight );
			$physique->setVar('dresssize', $dresssize );
			$physique->setVar('shirtsize', $shirtsize );
			$physique->setVar('pantssize', $pantssize );
			$physique->setVar('bust', $bust );
			$physique->setVar('hair', $hair );
			$physique->setVar('eyes', $eyes );
			$physique->setVar('bodyhair', $bodyhair );
			$physique->setVar('penissize', $penissize );
			$physique->setVar('foreskin', $foreskin );
			$physique->setVar('position', $position );
			$physique->setVar('physique', $build );
			$physique->setVar('piercings', $piercings );
			$physique->setVar('tattoos', $tattoos );		
			$physique->setVar('drugs', $drugs );
			$physique->setVar('smoking', $smoking );		
			$physique->setVar('alcohol', $alcohol );
			$physique->setVar('actions', $actions );		
			$physique->setVar('services', $services );

			if ($physique_handler->insert($physique, true)){
				redirect_header('index.php', 7, _ESC_DATASAVEDSUCCESSFULLY);
			} else
				redirect_header('index.php', 7, _ESC_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;

		case "picture":

			$picture_handler =& xoops_getmodulehandler('pictures', 'escorts');
			$picture = $picture_handler->get($id);			

			include_once( $GLOBALS['xoops']->path('/modules/escorts/class/myuploader.php') );
			
			$photo_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
			$thumb_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
			$path='';
			if (!is_dir($photo_dir))
				foreach(explode('/', $photo_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}

			$path='';
			if (!is_dir($thumb_dir))
				foreach(explode('/', $thumb_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}				
				
			// Check if upload file name specified
			$field = @$_POST["xoops_upload_file"][0] ;
			if( empty( $field ) || $field == "" ) {

			}
			$field = @$_POST['xoops_upload_file'][0] ;

			if( $_FILES[$field]['name'] == '' ) {
				// No photo uploaded
		
				if( trim( $title ) === "" ) {
					$title = 'no title' ;
				}
		
				$tmp_name = md5(time().rand(0,10000));
				
			} else if( $_FILES[$field]['tmp_name'] == "" ) {
				// Fail to upload (wrong file name etc.)
				redirect_header( 'admin.php?op=pictures&pid='.$pid , 2 , _ESC_FILEERROR ) ;
				exit ;
		
			} else {
				$uploader = new MyXoopsMediaUploader( $photo_dir , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetype']) , $GLOBALS['xoopsModuleConfig']['filesize_upload'] , null , null , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_extensions']) ) ;
				
				$uploader->setPrefix( 'tmp_' . time() . '_' . $pid . '_' ) ;
				if( $uploader->fetchMedia( $field ) && $uploader->upload() ) {
					// Succeed to upload
		
					// The original file name will be the title if title is empty
					if( trim( $title ) === "" ) {
						$title = $uploader->getMediaName() ;
					}
		
					$tmp_name = $uploader->getSavedFileName() ;
					$date = time() ;
					$ext = substr( strrchr( $tmp_name , '.' ) , 1 ) ;
					$picture->setVar('extension', $ext);

					$picture->setVar('filename', md5($tmp_name).'.'.$ext);
					escorts_modify_photo_by_gd( "$photo_dir/$tmp_name" , "$photo_dir/".md5($tmp_name).".$ext" ) ;
					list( $width , $height , $type ) = getimagesize( "$photo_dir/".md5($tmp_name).".$ext" ) ;
					$picture->setVar('folder', $GLOBALS['xoopsModuleConfig']['upload_areas']);			
					$picture->setVar('width', $width);
					$picture->setVar('height', $height);
					@$picture_handler->insert($picture, true);			
		
					if( ! escorts_create_thumb_by_gd( "$photo_dir/".md5($tmp_name).".$ext" , $thumb_dir, md5($tmp_name) , $ext ) ) {
						redirect_header( 'admin.php?op=pictures&pid='.$pid , 2 , _ESC_ERRORCREATINGTHUMB) ;
						exit ;
					}

				} else {
					// Fail to upload (sizeover etc.)
					include(XOOPS_ROOT_PATH."/header.php");
		
					echo $uploader->getErrors();
					@unlink( $uploader->getSavedDestination() ) ;
		
					include( XOOPS_ROOT_PATH . "/footer.php" ) ;
					exit ;
				}
			}


			$picture->setVar('title', $title);
			$picture->setVar('description', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $description))) );
			@$picture_handler->insert($picture, true);			
			redirect_header( 'admin.php?op=pictures&pid='.$pid , 6 , _ESC_DATASAVEDSUCCESSFULLY) ;
			exit ;
		
			break;
		}
	case "upload":
		switch($fct){
		case "picture":
	
			include_once( $GLOBALS['xoops']->path('/modules/escorts/class/myuploader.php') );
			
			$photo_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
			$thumb_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
			$path='';
			if (!is_dir($photo_dir))
				foreach(explode('/', $photo_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}

			$path='';
			if (!is_dir($thumb_dir))
				foreach(explode('/', $thumb_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}				
				
			// Check if upload file name specified
			$field = @$_POST["xoops_upload_file"][0] ;
			if( empty( $field ) || $field == "" ) {
				die( "UPLOAD error: file name not specified" ) ;
			}
			$field = @$_POST['xoops_upload_file'][0] ;

			if( $_FILES[$field]['name'] == '' ) {
				// No photo uploaded
		
				if( trim( $title ) === "" ) {
					$title = 'no title' ;
				}
		
				$tmp_name = md5(time().rand(0,10000));
				
			} else if( $_FILES[$field]['tmp_name'] == "" ) {
				// Fail to upload (wrong file name etc.)
				redirect_header( 'admin.php?op=pictures&pid='.$pid , 2 , _ESC_FILEERROR ) ;
				exit ;
		
			} else {
				$uploader = new MyXoopsMediaUploader( $photo_dir , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetype']) , $GLOBALS['xoopsModuleConfig']['filesize_upload'] , null , null , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_extensions']) ) ;
				
				$uploader->setPrefix( 'tmp_' . time() . '_' . $pid . '_' ) ;
				if( $uploader->fetchMedia( $field ) && $uploader->upload() ) {
					// Succeed to upload
		
					// The original file name will be the title if title is empty
					if( trim( $title ) === "" ) {
						$title = $uploader->getMediaName() ;
					}
		
					$tmp_name = $uploader->getSavedFileName() ;
		
				} else {
					// Fail to upload (sizeover etc.)
					include(XOOPS_ROOT_PATH."/header.php");
		
					echo $uploader->getErrors();
					@unlink( $uploader->getSavedDestination() ) ;
		
					include( XOOPS_ROOT_PATH . "/footer.php" ) ;
					exit ;
				}
			}

			if( ! is_readable( "$photo_dir/$tmp_name" ) ) {
				redirect_header( 'admin.php?op=pictures&pid='.$pid , 2 , _ESC_FILEREADERROR ) ;
				exit ;
			}

			$date = time() ;
			$ext = substr( strrchr( $tmp_name , '.' ) , 1 ) ;

			$picture_handler =& xoops_getmodulehandler('pictures', 'escorts');
			$picture = $picture_handler->create();			
			$picture->setVar('title', $title);
			$picture->setVar('pid', $pid);			
			$picture->setVar('description', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $description))) );
			$picture->setVar('extension', $ext);
			$picture->setVar('filename', md5($tmp_name).'.'.$ext);
			$picture->setVar('folder', $GLOBALS['xoopsModuleConfig']['upload_areas']);			
			escorts_modify_photo_by_gd( "$photo_dir/$tmp_name" , "$photo_dir/".md5($tmp_name).".$ext" ) ;
			list( $width , $height , $type ) = getimagesize( "$photo_dir/".md5($tmp_name).".$ext" ) ;
			$picture->setVar('width', $width);
			$picture->setVar('height', $height);
			@$picture_handler->insert($picture, true);			

			if( ! escorts_create_thumb_by_gd( "$photo_dir/".md5($tmp_name).".$ext" , $thumb_dir, md5($tmp_name) , $ext ) ) {
				redirect_header( 'admin.php?op=pictures&pid='.$pid , 2 , _ESC_ERRORCREATINGTHUMB) ;
				exit ;
			}

			redirect_header( 'admin.php?op=pictures&pid='.$pid , 2 , _ESC_UPLOADALLOK) ;
			exit ;

			break;
		}
		break;
	case "urls":
		switch($fct){
		case "delete":
			if (empty($_POST['confirmed'])) {
				xoops_confirm(array('confirmed' => true, 'urlid' => $urlid, 'pid' => $pid, 'op' => $op, 'fct' => $fct), $_SERVER['REQUEST_URI'], _ESC_CONFIRM_DELETEURL);
				xoops_cp_footer();
				exit(0);
			}
			$sql = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('escorts_urls').' WHERE `id` = "'.$urlid.'"';
			if ($GLOBALS['xoopsDB']->queryF($sql)) {
				redirect_header( 'admin.php?op=urls&pid='.$pid , 6 , _ESC_DATADELETEDSUCCESSFULLY) ;				
			} else {
				redirect_header( 'admin.php?op=urls&pid='.$pid , 6 , _ESC_DATADELETEDUNSUCCESSFULLY) ;				
			}
			break;
		case "edit":
			$template_main = 'escorts_admin_edit_url.html';
			$GLOBALS['xoopsTpl']->assign('form_url_edit', escortsUrlForm($urlid));
		default:
			$template_main = 'escorts_admin_edit_urls.html';			
			$GLOBALS['xoopsTpl']->assign('form_url_new', escortsUrlForm($id));	
			$GLOBALS['xoopsTpl']->assign('form_url_list', escortsURLSUser($pid));
		}
		break;
	case "prices":
		switch($fct){
		case "delete":
			if (empty($_POST['confirmed'])) {
				
				xoops_confirm(array('confirmed' => true, 'priceid' => $priceid, 'pid' => $pid, 'op' => $op, 'fct' => $fct), $_SERVER['REQUEST_URI'], _ESC_CONFIRM_DELETEPRICE);
				xoops_cp_footer();
				exit(0);
			}
			$sql = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('escorts_prices').' WHERE `id` = "'.$priceid.'"';
			if ($GLOBALS['xoopsDB']->queryF($sql)) {
				redirect_header( 'admin.php?op=urls&pid='.$pid , 6 , _ESC_DATADELETEDSUCCESSFULLY) ;				
			} else {
				redirect_header( 'admin.php?op=urls&pid='.$pid , 6 , _ESC_DATADELETEDUNSUCCESSFULLY) ;				
			}
			break;
		case "edit":
			$template_main = 'escorts_admin_edit_price.html';
			$GLOBALS['xoopsTpl']->assign('form_price_edit', escortsPriceForm($priceid));
		default:
			$template_main = 'escorts_admin_edit_prices.html';
			$GLOBALS['xoopsTpl']->assign('form_price_new', escortsPriceForm($priceid));	
			$GLOBALS['xoopsTpl']->assign('form_price_list', escortsPricesUser($pid));
		}
		break;
	case "profile":	
		switch($fct){
		default:
			$template_main = 'escorts_admin_edit_escort.html';
			$GLOBALS['xoopsTpl']->assign('escort_form', escortsProfileForm($pid));
		}
		break;
	case "pictures":
		switch($fct){
		case "edit":
			$template_main = 'escorts_admin_edit_picture.html';

			$GLOBALS['xoopsTpl']->assign('image_upload_form', escortsEditUploadPicture($pid, $_GET['id']));	
			$GLOBALS['xoopsTpl']->assign('passkey', md5(XOOPS_LICENSE_KEY.date('Ymdhi')));
			$GLOBALS['xoopsTpl']->assign('id', $_GET['id']);	
		
		case "delete":
			if (empty($_POST['confirmed'])) {
				xoops_confirm(array('confirmed' => true, 'picid' => $_GET['id'], 'pid' => $pid, 'op' => $op, 'fct' => $fct), $_SERVER['REQUEST_URI'], _ESC_CONFIRM_DELETEPICTURE);
			}
			
			$pictures_handler =& xoops_getmodulehandler('pictures', 'escorts');
			$picture = $pictures_handler->get($picid);

			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'thumbnails/'.$picture->getVar('filename'));
			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'orginal/'.$picture->getVar('filename'));
			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'resample/gallery_large%%'.$picture->getVar('filename'));
			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'resample/gallery_thumb%%'.$picture->getVar('filename'));
			
			$sql = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('escorts_pictures').' WHERE `id` = "'.$picid.'"';
		
			if ($GLOBALS['xoopsDB']->queryF($sql)) {
				redirect_header( 'admin.php?op=pictures&pid='.$pid , 6 , _ESC_DATADELETEDSUCCESSFULLY) ;				
			} else {
				redirect_header( 'admin.php?op=pictures&pid='.$pid , 6 , _ESC_DATADELETEDUNSUCCESSFULLY) ;				
			}
			break;		
		default:
			$template_main = 'escorts_admin_edit_pictures.html';
			$GLOBALS['xoopsTpl']->assign('image_upload_form', escortsUploadPicture($pid));	

			$return = escortsPicturesUser($pid);
			$GLOBALS['xoopsTpl']->assign('images', $return['images']);
			$GLOBALS['xoopsTpl']->assign('pagenav', $return['pagenav']);			
			if (isset($return['width'])) 
				$GLOBALS['xoopsTpl']->assign('pictures_extra', "width=\"".$return['width'].'"');
			else
				$GLOBALS['xoopsTpl']->assign('pictures_extra', "height=\"".$return['height'].'"');
			$GLOBALS['xoopsTpl']->assign('colspan', $return['colspan']);
		}
		break;
		
	default:
	
		$template_main = 'escorts_admin_escorts.html';
		
		$proile_handler =& xoops_getmodulehandler('profile', 'escorts');
		$start = (isset($_GET['start'])?intval($_GET['start']):0);
		$limit = (isset($_GET['limit'])?intval($_GET['limit']):30);
		$total = $proile_handler->getCount(NULL);

		xoops_load('pagenav');

		$pgnav = new XoopsPageNav($total, $limit, $start, "limit=".$limit.'&op='.$op.'&fct='.$fct);		

		$GLOBALS['xoopsTpl']->assign('pagenave', $pgnav->RenderNav());						
		
		$criteria = new Criteria(1,1);
		$criteria->setStart($start);
		$criteria->setLimit($limit);

		$profiles = $proile_handler->getObjects($criteria, true, false);
		foreach($profiles as $pid => $profile) {
			$GLOBALS['xoopsTpl']->append('escorts', $profile);						
		}
	}


if ( isset($template_main)  ) {
	$GLOBALS['xoopsTpl']->display("db:{$template_main}");
}

xoops_cp_footer();
?>