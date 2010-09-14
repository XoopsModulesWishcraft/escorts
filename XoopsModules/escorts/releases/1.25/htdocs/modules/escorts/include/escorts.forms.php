<?php

	function escortsPhysiqueForm($id)
	{
		
		$physique_handler =& xoops_getmodulehandler('physique', 'escorts');
		$profile_handler =& xoops_getmodulehandler('profile', 'escorts');
		$profileprofile_handler =& xoops_getmodulehandler('profile', 'profile');

		if ($id>0)	{
			$physique = $physique_handler->get($id);
			$profile = $profile_handler->get($physique->getVar('pid'));
			$pprofile = $profileprofile_handler->get($profile->getVar('uid'));
			if (@$pprofile->getVar('Sex')=='Male')
				$male=true;
			else
				$male=false;
			
		} else {
			$physique = $physique_handler->create();
			$pprofile = $profileprofile_handler->get(@$GLOBALS['xoopsUser']->getVar('uid'));
			if (@$pprofile->getVar('Sex')=='Male')
				$male=true;
			else
				$male=false;
				
			$physique->setVar('pid', $_GET['pid']);
		}

		if ($id>0)
			$sform = new XoopsThemeForm(_ESC_FRM_EDITPHYSIQUE, 'profile', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_ESC_FRM_NEWPHYSIQUE, 'profile', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
	
		$formobj['race'] = new XoopsFormSelectPhysiqueRace(_ESC_MF_PHYSIQUE_RACE, 'race', ($physique->getVar('race')));
		$formobj['race']->setDescription(_ESC_MF_PHYSIQUE_RACE_DESC);

		$formobj['height'] = new XoopsFormSelectPhysiqueHeight(_ESC_MF_PHYSIQUE_HEIGHT, 'height', ($physique->getVar('height')));
		$formobj['height']->setDescription(_ESC_MF_PHYSIQUE_HEIGHT_DESC);
		
		$formobj['sex'] = new XoopsFormSelectPhysiqueSex(_ESC_MF_PHYSIQUE_SEX, 'sex', ($physique->getVar('sex')));
		$formobj['sex']->setDescription(_ESC_MF_PHYSIQUE_SEX_DESC);

		$formobj['weight'] = new XoopsFormSelectPhysiqueWeight(_ESC_MF_PHYSIQUE_WEIGHT, 'weight', ($physique->getVar('weight')));
		$formobj['weight']->setDescription(_ESC_MF_PHYSIQUE_WEIGHT_DESC);

		if ($male==false) {
			$formobj['dresssize'] = new XoopsFormSelectPhysiqueDressSize(_ESC_MF_PHYSIQUE_DRESSSIZE, 'dresssize', ($physique->getVar('dresssize')));
			$formobj['dresssize']->setDescription(_ESC_MF_PHYSIQUE_DRESSSIZE_DESC);

			$formobj['bust'] = new XoopsFormSelectPhysiqueBust(_ESC_MF_PHYSIQUE_BUST, 'bust', ($physique->getVar('bust')));
			$formobj['bust']->setDescription(_ESC_MF_PHYSIQUE_BUST_DESC);

		} else {
			$formobj['shirtsize'] = new XoopsFormSelectPhysiqueShirtSize(_ESC_MF_PHYSIQUE_SHIRTSIZE, 'shirtsize', ($physique->getVar('shirtsize')));
			$formobj['shirtsize']->setDescription(_ESC_MF_PHYSIQUE_SHIRTSIZE_DESC);
	
			$formobj['pantssize'] = new XoopsFormSelectPhysiquePantsSize(_ESC_MF_PHYSIQUE_PANTSSIZE, 'pantssize', ($physique->getVar('pantssize')));
			$formobj['pantssize']->setDescription(_ESC_MF_PHYSIQUE_PANTSSIZE_DESC);
			
			$formobj['penissize'] = new XoopsFormSelectPhysiquePenisSize(_ESC_MF_PHYSIQUE_PENISSIZE, 'penissize', ($physique->getVar('penissize')));
			$formobj['penissize']->setDescription(_ESC_MF_PHYSIQUE_PENISSIZE_DESC);
	
			$formobj['foreskin'] = new XoopsFormSelectPhysiqueForeskin(_ESC_MF_PHYSIQUE_FORESKIN, 'foreskin', ($physique->getVar('foreskin')));
			$formobj['foreskin']->setDescription(_ESC_MF_PHYSIQUE_FORESKIN_DESC);
		}
				
		$formobj['hair'] = new XoopsFormSelectPhysiqueHair(_ESC_MF_PHYSIQUE_HAIR, 'hair', ($physique->getVar('hair')));
		$formobj['hair']->setDescription(_ESC_MF_PHYSIQUE_HAIR_DESC);

		$formobj['eyes'] = new XoopsFormSelectPhysiqueEyes(_ESC_MF_PHYSIQUE_EYES, 'eyes', ($physique->getVar('eyes')));
		$formobj['eyes']->setDescription(_ESC_MF_PHYSIQUE_EYES_DESC);

		$formobj['bodyhair'] = new XoopsFormSelectPhysiqueBodyHair(_ESC_MF_PHYSIQUE_BODYHAIR, 'bodyhair', ($physique->getVar('bodyhair')));
		$formobj['bodyhair']->setDescription(_ESC_MF_PHYSIQUE_BODYHAIR_DESC);

		$formobj['position'] = new XoopsFormSelectPhysiquePosition(_ESC_MF_PHYSIQUE_POSITION, 'position', ($physique->getVar('position')));
		$formobj['position']->setDescription(_ESC_MF_PHYSIQUE_POSITION_DESC);

		$formobj['build'] = new XoopsFormSelectPhysiquePhysique(_ESC_MF_PHYSIQUE_PHYSIQUE, 'build', ($physique->getVar('physique')));
		$formobj['build']->setDescription(_ESC_MF_PHYSIQUE_PHYSIQUE_DESC);

		$formobj['piercings'] = new XoopsFormSelectYN(_ESC_MF_PHYSIQUE_PIERCINGS, 'piercings', $physique->getVar('piercings'));
		$formobj['piercings']->setDescription(_ESC_MF_PHYSIQUE_PIERCINGS_DESC);
		
		$formobj['tattoos'] = new XoopsFormSelectYN(_ESC_MF_PHYSIQUE_TATTOOS, 'tattoos', $physique->getVar('tattoos'));
		$formobj['tattoos']->setDescription(_ESC_MF_PHYSIQUE_TATTOOS_DESC);
				
		$formobj['drugs'] = new XoopsFormSelectYN(_ESC_MF_PHYSIQUE_DRUGS, 'drugs', $physique->getVar('drugs'));
		$formobj['drugs']->setDescription(_ESC_MF_PHYSIQUE_DRUGS_DESC);
						
		$formobj['smoking'] = new XoopsFormSelectYN(_ESC_MF_PHYSIQUE_SMOKING, 'smoking', $physique->getVar('smoking'));
		$formobj['smoking']->setDescription(_ESC_MF_PHYSIQUE_SMOKING_DESC);

		$formobj['alcohol'] = new XoopsFormSelectYN(_ESC_MF_PHYSIQUE_ALCOHOL, 'alcohol', $physique->getVar('alcohol'));
		$formobj['alcohol']->setDescription(_ESC_MF_PHYSIQUE_ALCOHOL_DESC);
						
		$formobj['actions'] = new XoopsFormCheckboxPhysiqueActions(_ESC_MF_PHYSIQUE_ACTIONS, 'actions', $physique->getVar('actions'));
		$formobj['actions']->setDescription(_ESC_MF_PHYSIQUE_ACTIONS_DESC);

		$formobj['services'] = new XoopsFormCheckboxPhysiqueServices(_ESC_MF_PHYSIQUE_SERVICES, 'services', $physique->getVar('services'));
		$formobj['services']->setDescription(_ESC_MF_PHYSIQUE_SERVICES_DESC);
												
		$formobj['pid'] = new XoopsFormHidden('pid', $physique->getVar('pid'));
		$formobj['phyid'] = new XoopsFormHidden('phyid', $physique->getVar('id'));		
		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'physique');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}


	function escortsProfileForm($pid)
	{
		
		$profile_handler =& xoops_getmodulehandler('profile', 'escorts');
		if ($pid>0)	
			$profile = $profile_handler->get($pid);
		else 
			$profile = $profile_handler->create();

		if ($pid>0)
			$sform = new XoopsThemeForm(_ESC_FRM_EDITPROFILE, 'profile', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_ESC_FRM_NEWPROFILE, 'profile', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		$formobj['alias'] = new XoopsFormText(_ESC_MF_ALIAS, 'alias', 30, 128, $profile->getVar('alias'));
		$formobj['alias']->setDescription(_ESC_MF_ALIAS_DESC);
		
		$formobj['name'] = new XoopsFormText(_ESC_MF_NAME, 'name', 30, 128, $profile->getVar('name'));
		$formobj['name']->setDescription(_ESC_MF_NAME_DESC);

		$formobj['slogon'] = new XoopsFormText(_ESC_MF_SLOGON, 'slogon', 48, 48, $profile->getVar('slogon'));
		$formobj['slogon']->setDescription(_ESC_MF_SLOGON_DESC);

		$formobj['tags'] = new XoopsFormTag("tags", 60, 255, $pid);

		$editor_configs[3] = array();
		$editor_configs[3]['name'] = 'bio';
		$editor_configs[3]['value'] = $profile->getVar('bio');
		$editor_configs[3]['rows'] = $rows ? $rows : 35;
		$editor_configs[3]['cols'] = $cols ? $cols : 60;
		$editor_configs[3]['width'] = "190px";
		$editor_configs[3]['height'] = "400px";
		
		$formobj['bio'] = new XoopsFormEditor(_ESC_MF_BIO, "ckeditor", $editor_configs[3]);
		$formobj['bio']->setDescription(_ESC_MF_BIO_DESC);
								
		$formobj['incall'] = new XoopsFormSelectYN(_ESC_MF_INCALL, 'incall', $profile->getVar('incall'));
		$formobj['incall']->setDescription(_ESC_MF_INCALL_DESC);
		
		$formobj['outcall'] = new XoopsFormSelectYN(_ESC_MF_OUTCALL, 'outcall', array($profile->getVar('outcall')));
		$formobj['outcall']->setDescription(_ESC_MF_OUTCALL_DESC);

		$formobj['sms'] = new XoopsFormText(_ESC_MF_SMS, 'sms', 22, 64, $profile->getVar('sms'));	
		$formobj['sms']->setDescription(_ESC_MF_SMS_DESC);
		
		$formobj['mobile'] = new XoopsFormText(_ESC_MF_MOBILE, 'mobile', 22, 64, $profile->getVar('mobile'));
		$formobj['mobile']->setDescription(_ESC_MF_MOBILE_DESC);
		
		
		$formobj['landline'] = new XoopsFormText(_ESC_MF_LANDLINE, 'landline', 22, 64, $profile->getVar('landline'));		
		$formobj['landline']->setDescription(_ESC_MF_LANDLINE_DESC);
		
		$formobj['age'] = new XoopsFormText(_ESC_MF_AGE, 'age', 4, 64, $profile->getVar('age'));		
		$formobj['age']->setDescription(_ESC_MF_AGE_DESC);

		
		$formobj['agency'] = new XoopsFormSelectYN(_ESC_MF_AGENCY, 'agency', $profile->getVar('agency'));
		$formobj['agency']->setDescription(_ESC_MF_AGENCY_DESC);
		
		$formobj['sexuality'] = new XoopsFormSelectSexuality(_ESC_MF_SEXUALITY, 'sexuality', $profile->getVar('sexuality'));
		$formobj['sexuality']->setDescription(_ESC_MF_SEXUALITY_DESC);

		$editor_configs[0] = array();
		$editor_configs[0]['name'] = 'columnone';
		$editor_configs[0]['value'] = $profile->getVar('columnone');
		$editor_configs[0]['rows'] = $rows ? $rows : 35;
		$editor_configs[0]['cols'] = $cols ? $cols : 60;
		$editor_configs[0]['width'] = "190px";
		$editor_configs[0]['height'] = "400px";
		
		$formobj['columnone'] = new XoopsFormEditor(_ESC_MF_LEFTCOLUMN, "ckeditor", $editor_configs[0]);
		$formobj['columnone']->setDescription(_ESC_MF_LEFTCOLUMN_DESC);

		$editor_configs[1] = array();
		$editor_configs[1]['name'] = 'columntwo';
		$editor_configs[1]['value'] = $profile->getVar('columntwo');
		$editor_configs[1]['rows'] = $rows ? $rows : 35;
		$editor_configs[1]['cols'] = $cols ? $cols : 60;
		$editor_configs[1]['width'] = "190px";
		$editor_configs[1]['height'] = "400px";
		
		$formobj['columntwo'] = new XoopsFormEditor(_ESC_MF_RIGHTCOLUMN, "ckeditor", $editor_configs[1]);
		$formobj['columntwo']->setDescription(_ESC_MF_RIGHTCOLUMN_DESC);

		$editor_configs[2] = array();
		$editor_configs[2]['name'] = 'footer';
		$editor_configs[2]['value'] = $profile->getVar('footer');
		$editor_configs[2]['rows'] = $rows ? $rows : 35;
		$editor_configs[2]['cols'] = $cols ? $cols : 60;
		$editor_configs[2]['width'] = "190px";
		$editor_configs[2]['height'] = "400px";
		
		$formobj['footer'] = new XoopsFormEditor(_ESC_MF_FOOTER, "ckeditor", $editor_configs[2]);
		$formobj['footer']->setDescription(_ESC_MF_FOOTER_DESC);

		
		$formobj['locations'] = new XoopsFormSelectLocation(_ESC_MF_LOCATIONS, 'locations', $profile->getVar('locations'), 15, true);
		$formobj['locations']->setDescription(_ESC_MF_LOCATIONS_DESC);
		
		$formobj['domains'] = new XoopsFormCheckBoxDomains(_ESC_MF_PROFILEDON, 'domains', $profile->getVar('domains'), '<br/>', false);
		$formobj['domains']->setDescription(_ESC_MF_PROFILEDON_DESC);
		
		
		$formobj['pid'] = new XoopsFormHidden('pid', $profile->getVar('pid'));
		$formobj['uid'] = new XoopsFormHidden('uid', $profile->getVar('uid'));
		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'escort');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}

	function escortsUrlForm($id)
	{
		
		$urls_handler =& xoops_getmodulehandler('urls', 'escorts');
		if ($id>0)	
			$url = $urls_handler->get($id);
		else 
			$url = $urls_handler->create();

		if ($id>0)
			$sform = new XoopsThemeForm(_ESC_FRM_EDITURL, 'url', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_ESC_FRM_NEWURL, 'url', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		$formobj['type'] = new XoopsFormSelectUrlType(_ESC_MF_TYPE, 'type', $url->getVar('type'));
		$formobj['type']->setDescription(_ESC_MF_TYPE_DESC);
		
		$formobj['other'] = new XoopsFormText(_ESC_MF_OTHER, 'other', 30, 255, $url->getVar('other'));
		$formobj['other']->setDescription(_ESC_MF_OTHER_DESC);
		
		$formobj['url'] = new XoopsFormText(_ESC_MF_URL, 'url', 60, 5000, $url->getVar('url'));
		$formobj['url']->setDescription(_ESC_MF_URL_DESC);
		
		$formobj['pid'] = new XoopsFormHidden('pid', ($url->getVar('pid')==0)?$_GET['pid']:$url->getVar('pid'));
		$formobj['urlid'] = new XoopsFormHidden('urlid', $id);

		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'url');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}

	function escortsPriceForm($id)
	{
		
		$prices_handler =& xoops_getmodulehandler('prices', 'escorts');
		if ($id>0)	
			$price = $prices_handler->get($id);
		else 
			$price = $prices_handler->create();

		if ($id>0)
			$sform = new XoopsThemeForm(_ESC_FRM_EDITPRICE, 'price', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_ESC_FRM_NEWPRICE, 'price', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		$formobj['type'] = new XoopsFormSelectPriceType(_ESC_MF_PRICETYPE, 'type', $price->getVar('type'));
		$formobj['type']->setDescription(_ESC_MF_PRICETYPE_DESC);

		$formobj['day'] = new XoopsFormSelectPriceDay(_ESC_MF_DAY, 'day', $price->getVar('day'));
		$formobj['day']->setDescription(_ESC_MF_DAY_DESC);

		$formobj['time-start'] = new XoopsFormSelectPriceTime(_ESC_MF_TIMESTART, 'timestart', $price->getVar('time-start'));
		$formobj['time-start']->setDescription(_ESC_MF_TIMESTART_DESC);

		$formobj['time-end'] = new XoopsFormSelectPriceTime(_ESC_MF_TIMEEND, 'timeend', $price->getVar('time-end'));
		$formobj['time-end']->setDescription(_ESC_MF_TIMEEND_DESC);

		$formobj['event'] = new XoopsFormSelectPriceEvent(_ESC_MF_EVENT, 'event', $price->getVar('event'));
		$formobj['event']->setDescription(_ESC_MF_EVENT_DESC);

		$formobj['price'] = new XoopsFormText(_ESC_MF_PRICE, 'price', 10, 10, $price->getVar('price'));
		$formobj['price']->setDescription(_ESC_MF_PRICE_DESC);

		$formobj['currency'] = new XoopsFormSelectPriceCurrency(_ESC_MF_CURENCY, 'currency', $price->getVar('currency'));
		$formobj['currency']->setDescription(_ESC_MF_CURENCY_DESC);

		$editor_configs = array();
		$editor_configs['name'] = 'description';
		$editor_configs['value'] = $price->getVar('description');
		$editor_configs['rows'] = $rows ? $rows : 35;
		$editor_configs['cols'] = $cols ? $cols : 60;
		$editor_configs['width'] = "190px";
		$editor_configs['height'] = "400px";
		
		$formobj['description'] = new XoopsFormEditor(_ESC_DESCRIPTION, "ckeditor", $editor_configs);
		
		$formobj['pid'] = new XoopsFormHidden('pid', ($price->getVar('pid')==0)?$_GET['pid']:$price->getVar('pid'));
		$formobj['priceid'] = new XoopsFormHidden('priceid', $id);

		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'price');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}


	function escortsPricesUser($pid) {

		$prices_handler =& xoops_getmodulehandler('prices', 'escorts');
		$criteria = new Criteria('pid', $pid);
		$criteria->setSort('type');
		$criteria->setOrder('ASC');
		
		$form = new XoopsThemeForm( _ESC_EDITABLEPRICES , "urls" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');
		
		if ($ttl = $prices_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):24;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			
			if ($prices = $prices_handler->getObjects($criteria, true)) {
				foreach($prices as $id => $url) {
					$ele_tray[$id] = new XoopsFormElementTray('Edit Item: '. $id, '&nbsp;');
					$ele_tray[$id]->addElement(new XoopsFormLabel( '' , '<a href="'.XOOPS_URL.'/modules/escorts/edit.php?op=prices&fct=edit&priceid='.$id.'&pid='.$url->getVar('pid').'">'._EDIT.'</a>&nbsp;|&nbsp;<a href="'.XOOPS_URL.'/modules/escorts/edit.php?op=prices&fct=delete&priceid='.$id.'&pid='.$url->getVar('pid').'">'._DELETE.'</a>') );
					$ele_tray[$id]->setDescription('Type :'.$url->getVar('type'));
					$form->addElement($ele_tray[$id]);
				}
			}
		}
		$ret['form'] = $form->render();
		return $ret;
	}
	
	function escortsEditUploadPicture($pid=0, $id=0)
	{
	
		$pictures_handler =& xoops_getmodulehandler('pictures', 'escorts');
		if ($id>0)
			$picture = $pictures_handler->get($id);
		 else
			$picture = $pictures_handler->create();
			
		$form = new XoopsThemeForm( _ESC_PHOTOUPLOAD , "uploadphoto" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');	
				
		$title_text = new XoopsFormText( _ESC_PHOTOTITLE , "title" , 50 , 255 , $picture->getVar('title') ) ;
			
		$editor_configs = array();
		$editor_configs['name'] = 'description';
		$editor_configs['value'] = $picture->getVar('description');
		$editor_configs['rows'] = $rows ? $rows : 35;
		$editor_configs['cols'] = $cols ? $cols : 60;
		$editor_configs['width'] = "190px";
		$editor_configs['height'] = "400px";
		
		$desc_tarea = new XoopsFormEditor(_ESC_PHOTODESC, "ckeditor", $editor_configs);
		
		$file_form = new XoopsFormFile( _ESC_SELECTFILE , "photofile" , $myalbum_fsize ) ;
		$file_form->setExtra( "size='70'" ) ;
		

		$rotate_radio = new XoopsFormRadio( _ESC_RADIO_ROTATETITLE , 'rotate' , 'rot0' ) ;
		$rotate_radio->addOption( 'rot0' , _ESC_RADIO_ROTATE0." &nbsp; " ) ;
		$rotate_radio->addOption( 'rot90' , "<img src='images/icon_rotate90.gif' alt='"._ESC_RADIO_ROTATE90."' title='"._ESC_RADIO_ROTATE90."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot180' , "<img src='images/icon_rotate180.gif' alt='"._ESC_RADIO_ROTATE180."' title='"._ESC_RADIO_ROTATE180."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot270' , "<img src='images/icon_rotate270.gif' alt='"._ESC_RADIO_ROTATE270."' title='"._ESC_RADIO_ROTATE270."' /> &nbsp; " ) ;

		
		$op_hidden = new XoopsFormHidden( "op" , "save" ) ;
		$fct_hidden = new XoopsFormHidden( "fct" , "picture" ) ;
		$pid_hidden = new XoopsFormHidden( "pid" , $pid ) ;
		$id_hidden = new XoopsFormHidden( "id" , $id ) ;		
		
		$submit_button = new XoopsFormButton( "" , "submit" , _SUBMIT , "submit" ) ;
		$reset_button = new XoopsFormButton( "" , "reset" , _CANCEL , "reset" ) ;
		$submit_tray = new XoopsFormElementTray( '' ) ;
		$submit_tray->addElement( $submit_button ) ;
		$submit_tray->addElement( $reset_button ) ;
		
		$form->addElement( $title_text ) ;
		$form->addElement( $desc_tarea ) ;
		$form->addElement( $file_form ) ;
		$form->addElement( $rotate_radio ) ;
		$form->addElement( $op_hidden ) ;
		$form->addElement( $fct_hidden ) ;
		$form->addElement( $pid_hidden ) ;		
		$form->addElement( $id_hidden ) ;				
		$form->addElement( $submit_tray ) ;
	// $form->setRequired( $file_form ) ;

		return $form->render() ;
	}
	
	function escortsUploadPicture($pid=0)
	{
		$form = new XoopsThemeForm( _ESC_PHOTOUPLOAD , "uploadphoto" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');	
				
		$title_text = new XoopsFormText( _ESC_PHOTOTITLE , "title" , 50 , 255 , $_POST['title'] ) ;
			
		$editor_configs = array();
		$editor_configs['name'] = 'description';
		$editor_configs['value'] = $_POST['description'];
		$editor_configs['rows'] = $rows ? $rows : 35;
		$editor_configs['cols'] = $cols ? $cols : 60;
		$editor_configs['width'] = "190px";
		$editor_configs['height'] = "400px";
		
		$desc_tarea = new XoopsFormEditor(_ESC_PHOTODESC, "ckeditor", $editor_configs);
		
		$file_form = new XoopsFormFile( _ESC_SELECTFILE , "photofile" , $myalbum_fsize ) ;
		$file_form->setExtra( "size='70'" ) ;
		

		$rotate_radio = new XoopsFormRadio( _ESC_RADIO_ROTATETITLE , 'rotate' , 'rot0' ) ;
		$rotate_radio->addOption( 'rot0' , _ESC_RADIO_ROTATE0." &nbsp; " ) ;
		$rotate_radio->addOption( 'rot90' , "<img src='images/icon_rotate90.gif' alt='"._ESC_RADIO_ROTATE90."' title='"._ESC_RADIO_ROTATE90."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot180' , "<img src='images/icon_rotate180.gif' alt='"._ESC_RADIO_ROTATE180."' title='"._ESC_RADIO_ROTATE180."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot270' , "<img src='images/icon_rotate270.gif' alt='"._ESC_RADIO_ROTATE270."' title='"._ESC_RADIO_ROTATE270."' /> &nbsp; " ) ;

		
		$op_hidden = new XoopsFormHidden( "op" , "upload" ) ;
		$fct_hidden = new XoopsFormHidden( "fct" , "picture" ) ;
		$pid_hidden = new XoopsFormHidden( "pid" , $pid ) ;
		
		$submit_button = new XoopsFormButton( "" , "submit" , _SUBMIT , "submit" ) ;
		$reset_button = new XoopsFormButton( "" , "reset" , _CANCEL , "reset" ) ;
		$submit_tray = new XoopsFormElementTray( '' ) ;
		$submit_tray->addElement( $submit_button ) ;
		$submit_tray->addElement( $reset_button ) ;
		
		$form->addElement( $title_text ) ;
		$form->addElement( $desc_tarea ) ;
		$form->addElement( $file_form ) ;
		$form->addElement( $rotate_radio ) ;
		$form->addElement( $op_hidden ) ;
		$form->addElement( $fct_hidden ) ;
		$form->addElement( $pid_hidden ) ;		
		$form->addElement( $submit_tray ) ;
	// $form->setRequired( $file_form ) ;

		return $form->render() ;
	}
	

	function escortsURLSUser($pid) {

		$urls_handler =& xoops_getmodulehandler('urls', 'escorts');
		$criteria = new Criteria('pid', $pid);
		$criteria->setSort('type');
		$criteria->setOrder('ASC');
		
		$form = new XoopsThemeForm( _ESC_EDITABLEURLS , "urls" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');
		
		if ($ttl = $urls_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):24;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			
			if ($urls = $urls_handler->getObjects($criteria, true)) {
				foreach($urls as $id => $url) {
					$ele_tray[$id] = new XoopsFormElementTray('Edit Item: '. $id, '&nbsp;');
					$ele_tray[$id]->addElement(new XoopsFormText( _ESC_URL , "url" , 50 , 255 , $url->getVar('url') ) );
					$ele_tray[$id]->addElement(new XoopsFormLabel( '' , '<a href="'.XOOPS_URL.'/modules/escorts/edit.php?op=urls&fct=edit&urlid='.$id.'&pid='.$url->getVar('pid').'">'._EDIT.'</a>&nbsp;|&nbsp;<a href="'.XOOPS_URL.'/modules/escorts/edit.php?op=urls&fct=delete&urlid='.$id.'&pid='.$url->getVar('pid').'">'._DELETE.'</a>') );
					$ele_tray[$id]->setDescription('Type :'.$url->getVar('type'));
					$form->addElement($ele_tray[$id]);
				}
			}
		}
		$ret['form'] = $form->render();
		return $ret;
	}
	
	function escortsPicturesUser($pid) {

		$pictures_handler =& xoops_getmodulehandler('pictures', 'escorts');
		$criteria = new Criteria('pid', $pid);

		if ($ttl = $pictures_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):24;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			$pictures = $pictures_handler->getObjects($criteria, true);
			if ($GLOBALS['xoopsModuleConfig']['thumbnail_rule']=='h')
				$ret['height']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
			else
				$ret['width=']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
				
			$ii=0;
			foreach($pictures as $id => $picture) {
				$ii++;
				$jj++;
				$ret['images'][$ii]['url'] = XOOPS_URL.'/modules/escorts/image.php?op=thumbnail&passkey='.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).'&id='.$id;
				$ret['images'][$ii]['delete'] = XOOPS_URL .'/modules/escorts/edit.php?op=pictures&fct=delete&id='.$id.'&pid='.$pid;
				$ret['images'][$ii]['edit'] = XOOPS_URL.'/modules/escorts/edit.php?op=pictures&fct=edit&id='.$id.'&pid='.$pid;
				if ($jj==4) {
					$jj =0;
					$ret['images'][$ii]['newline'] = true;
				} else {
					$ret['images'][$ii]['newline'] = false;
				}
			}
			
			$ret['colspan']=4-$jj;
						
		}

		return $ret;
	}
	
	function escortsPicturesProfile($pid) {

		$pictures_handler =& xoops_getmodulehandler('pictures', 'escorts');
		$criteria = new Criteria('pid', $pid);
		if ($ttl = $pictures_handler->getCount($criteria)) {
			$pictures = $pictures_handler->getObjects($criteria, true);
			foreach($pictures as $id => $picture) {
				$ii++;
				$ret['images'][$ii]['id'] = md5($id);
				$ret['images'][$ii]['thumbnail'] = XOOPS_URL.'/modules/escorts/image.php?op=resample&key=gallery_thumb&size=70&passkey='.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).'&id='.$id;
				$ret['images'][$ii]['orginal'] = XOOPS_URL.'/modules/escorts/image.php?op=resample&key=gallery_large&size=500&passkey='.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).'&id='.$id;
				$ret['images'][$ii]['download'] = XOOPS_URL.'/modules/escorts/image.php?op=orginal&passkey='.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).'&id='.$id;
				$ret['images'][$ii]['title'] = $picture->getVar('title');
				$ret['images'][$ii]['description'] = htmlspecialchars_decode($picture->getVar('description'));
			}
		}
		return $ret;
	}
	
	function escortsPicturesIndex($pid) {

		$profile_handler =& xoops_getmodulehandler('profile', 'escorts');
		$criteria = new CriteriaCompo(new Criteria('domains', '%'.urlencode(XOOPS_URL).'%', 'LIKE'));
		if (isset($GLOBALS['locationalcode']))
			$criteria->add(new Criteria('locations', '%'.$GLOBALS['locationalcode'].'%', 'LIKE'));
		$criteria->setOrder('DESC');
		$criteria->setSort('pid');
		
		if ($ttl = $profile_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):36;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			$profiles = $profile_handler->getObjects($criteria, true);
			if ($GLOBALS['xoopsModuleConfig']['thumbnail_rule']=='h')
				$ret['height']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
			else
				$ret['width=']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
				
			$ii=0;
			foreach($profiles as $id => $profile) {
				$ii++;
				$jj++;
				$ret['images'][$ii]['url'] = XOOPS_URL.'/modules/escorts/image.php?op=thumbnail&passkey='.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).'&pid='.$profile->getVar('pid');
				$ret['images'][$ii]['profile'] = XOOPS_URL .'/modules/escorts/index.php?op=profile&fct=escort&pid='.$profile->getVar('pid');
				$ret['images'][$ii]['alt'] = $profile->getVar('title');
				if ($jj==4) {
					$jj =0;
					$ret['images'][$ii]['newline'] = true;
				} else {
					$ret['images'][$ii]['newline'] = false;
				}
			}
			
			$ret['colspan']=4-$jj;
						
		}
		return $ret;
	}
?>
