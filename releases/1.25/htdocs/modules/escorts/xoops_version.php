<?php
/**
 * Private message module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code 
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         pm
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id$
 */
 
/**
 * This is a temporary solution for merging XOOPS 2.0 and 2.2 series
 * A thorough solution will be available in XOOPS 3.0
 *
 */

$modversion = array();
$modversion['name'] = _EST_MI_NAME;
$modversion['version'] = 1.25;
$modversion['description'] = _EST_MI_DESC;
$modversion['author'] = "Simon Roberts (simon@chronolabs.org.au)";
$modversion['credits'] = "Horney People";
$modversion['license'] = "GPL";
$modversion['image'] = "images/escorts_slogo.png";
$modversion['dirname'] = "escorts";
$modversion['status'] = "stable";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/admin.php";
$modversion['adminmenu'] = "admin/menu.php";

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "escorts_search";

// Mysql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Table
$modversion['tables'][1] = "escorts_profile";
$modversion['tables'][2] = "escorts_pictures";
$modversion['tables'][3] = "escorts_urls";
$modversion['tables'][4] = "escorts_votes";
$modversion['tables'][5] = "escorts_prices";
$modversion['tables'][6] = "escorts_options";
$modversion['tables'][7] = "escorts_physique";

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['itemName'] = 'pid';
$modversion['comments']['pageName'] = 'index.php';

$modversion['hasMain'] = 1;

$module_handler =& xoops_gethandler('module');
$i=1;
if ($module_handler->getCount(new Criteria('dirname', 'escorts'))>0)
if (is_object($GLOBALS["xoopsUser"])) {

	$profile_handler =& xoops_getmodulehandler('profile', 'escorts');	
	if ($profile_handler->getCount(new Criteria('uid', $GLOBALS["xoopsUser"]->getVar('uid')))>0)			 	{
		$profiles = $profile_handler->getObjects(new Criteria('uid', $GLOBALS["xoopsUser"]->getVar('uid')), false);
		$modversion['sub'][$i]['name'] = _ESC_MD_MYPROFILE;
		$modversion['sub'][$i]['url'] = "index.php?op=profile&fct=escort&pid=".$profiles[0]->getVar('pid');
		$i++;
		$modversion['sub'][$i]['name'] = _ESC_MD_EDITPROFILE;
		$modversion['sub'][$i]['url'] = "edit.php?op=profile&pid=".$profiles[0]->getVar('pid');
		$i++;
		
		$modversion['sub'][$i]['name'] = _ESC_MD_EDITPHYSIQUE;
		$modversion['sub'][$i]['url'] = "edit.php?op=physique&pid=".$profiles[0]->getVar('pid');
		$i++;
				
		$modversion['sub'][$i]['name'] = _ESC_MD_EDITPICTURES;
		$modversion['sub'][$i]['url'] = "edit.php?op=pictures&pid=".$profiles[0]->getVar('pid');
		$i++;
		$modversion['sub'][$i]['name'] = _ESC_MD_EDITURLS;
		$modversion['sub'][$i]['url'] = "edit.php?op=urls&pid=".$profiles[0]->getVar('pid');
		$i++;
		$modversion['sub'][$i]['name'] = _ESC_MD_EDITPRICES;
		$modversion['sub'][$i]['url'] = "edit.php?op=prices&pid=".$profiles[0]->getVar('pid');
		$i++;
	} else {
		$modversion['sub'][$i]['name'] = _ESC_MD_CREATEPROFILE;
		$modversion['sub'][$i]['url'] = "create.php?op=profile";
		$i++;	
	}
}

// Templates
$modversion['templates'][1]['file'] = 'escorts_create_profile.html';
$modversion['templates'][1]['description'] = 'Create Profile Template (Form)';
$modversion['templates'][2]['file'] = 'escorts_index.html';
$modversion['templates'][2]['description'] = 'Escorts Index';
$modversion['templates'][3]['file'] = 'escorts_edit_pictures.html';
$modversion['templates'][3]['description'] = 'Escorts Picture Editing Index (Forms)';
$modversion['templates'][4]['file'] = 'escorts_edit_picture.html';
$modversion['templates'][4]['description'] = 'Escorts Picture Editing Index (Form)';
$modversion['templates'][5]['file'] = 'escorts_manage_form.html';
$modversion['templates'][5]['description'] = 'Escorts Picture Editing Table (Form)';
$modversion['templates'][6]['file'] = 'escorts_index_profile.html';
$modversion['templates'][6]['description'] = 'Escorts Index Profile';
$modversion['templates'][7]['file'] = 'escorts_edit_urls.html';
$modversion['templates'][7]['description'] = 'Escorts Edit URLS (Forms)';
$modversion['templates'][8]['file'] = 'escorts_edit_url.html';
$modversion['templates'][8]['description'] = 'Escorts Edit URL (Form)';
$modversion['templates'][9]['file'] = 'escorts_edit_prices.html';
$modversion['templates'][9]['description'] = 'Escorts Edit Prices (Forms)';
$modversion['templates'][10]['file'] = 'escorts_edit_price.html';
$modversion['templates'][10]['description'] = 'Escorts Edit Price (Form)';
$modversion['templates'][11]['file'] = 'escorts_edit_physique.html';
$modversion['templates'][11]['description'] = 'Escorts Edit Physique (Form)';

$i=1;
$modversion['config'][$i]['name'] = 'supported_areas';
$modversion['config'][$i]['title'] = "_ESC_MD_AREAS";
$modversion['config'][$i]['description'] = "_ESC_MD_AREAS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'AU=Australia{SYD=Sydney|NWC=Newcastle|BRI=Brisbane|GLD=Gold Coast|ADL=Adelaide|MLB=Melbourne|PRT=Perth|DRW=Darwin|HBT=Hobart|CAN=Canberra/EU=Europe{AMS=Amsterdam|ALV=Andorra la Vella|ANK=Ankara|ATH=Athens|BEL=Belgrade|BER=Berlin|BEN=Bern|BRA=Bratislava|BRU=Brussels|BUC=Bucharest|BUD=Budapest|CHI=Chisinau|COP=Copenhagen|DUB=Dublin|HEL=Helsinki|KEV=Kiev|LIS=Lisbon|LJU=Ljubljana|LUX=Luxembourg|MAD=Madrid|MIN=Minsk|MON=Monaco|MOS=Moscow|CYP=Nicosia|NUU=Nuuk|OSL=Oslo|PAR=Paris|POD=Podgorica|PRA=Prague|REY=Reykjavik|RIG=Riga|ROM=Rome|SAN=San Marino|SAR=Sarajevo|SKO=Skopje|SOF=Sofia|STK=Stockholm|TAL=Tallinn|TIR=Tirana|VAD=Vaduz|VAL=Valletta|VIE=Vienna|VIL=Vilnius|WARWarsaw/US=USA{SEA=Seattle|POR=Portland|SAN=San Francisco|DEN=Denver|LAS=Las Vegas|SNT=Santa Fe|PHO=Phonenix|SND=San Diego|LOS=Los Angeles|MNP=Minneapolis|CHI=Chicago|KAN=Kansas City|STL=St. Louis|DAL=Dalas|AUS=Austin|HOU=Houston|SAT=San Antonio|NAS=Nashville|CHA=Charleston|ALT=Altanta|NEW=New Orleans|ORL=Orlando|MIA=Miami|DC=D.C.|PHI=Philadelphia|NYC=New York|PRO=Providence|BOS=Boston/CA=Canada{VAN=Vancouver|MON=Montreal|QUE=Quebec City|VIC=Victoria|CAL=Calgary|OTT=Ottawa|EDM=Edmonton|HAL=Halifax/CN=China{SHN=Shanghai|BEI=Beijing|HK=Hong Kong|TIA=Tianjin|WUH=Wuhan|GUA=Guangzhou|SHE=Shenzhen|SHY=Shenyang|CHO=Chongqing|NAN=Nanjing|HAR=Harbin|TAI=Taipei/UK=United Kingdom{BAT=Bath|BIR=Birmingham|BRA=Bradford|BAH=Brighton and Hove|BRI=Bristol|CAM=Cambridge|CAN=Canterbury|CAR=Carlisle|CHE=Chester|CHI=Chichester|COV=Coventry|DER=Derby|DUR=Durham|ELY=Ely|EXE=Exeter|GLO=Gloucester|HER=Hereford|KIN=Kingston upon Hull|LAN=Lancaster|LEE=Leeds|LEI=Leicester|LIC=Lichfield|LIN=Lincoln|LIV=Liverpool|LON=City of London|MAN=Manchester|NWC=Newcastle upon Tyne|NOR=Norwich|NOT=Nottingham|OXF=Oxford|PET=Peterborough|PLY=Plymouth|POR=Portsmouth|PRE=Preston|RIP=Ripon|SAL=Salford|SAL=Salisbury|SHE=Sheffield|SOU=Southampton|SAL=St Albans|SOT=Stoke-on-Trent|SUN=Sunderland|TRU=Truro|WAK=Wakefield|WEL=Wells|WES=Westminster|WIN=Winchester|WOL=Wolverhampton|WOR=Worcester/ASIA=Asia Pacific{AHM=Ahmedabad|DAV=Davao City|HCM=Ho Chi Minh City|JAI=Jaipur|NAG=Nagpur|PEN=Penang|MAL=Malaysia';
$i++;

$modversion['config'][$i]['name'] = 'physique_actions';
$modversion['config'][$i]['title'] = "_ESC_MD_PHYSIQUEACTIONS";
$modversion['config'][$i]['description'] = "_ESC_MD_PHYSIQUEACTIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'SEX=Sex Interests{BDY=Body Contact|FOOT=Foot Play|KISS=Kissing|ORAL=Oral|ANAL=Anal|FETS=Fetish|ASK=Ask me';
$i++;

$modversion['config'][$i]['name'] = 'physique_services';
$modversion['config'][$i]['title'] = "_ESC_MD_PHYSIQUEACTIONS";
$modversion['config'][$i]['description'] = "_ESC_MD_PHYSIQUEACTIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'ESC=Escort{SRD=Sexual|VIP=VIP|IND=Independent|PMP=Pimp/MAS=Massage{THR=Therapeutic|RLF=Relief/TV=Transsexual{TS=Transsexual/HSU=House{AGN=Agency Work|BRT=Brothel/DNC=Dancing{PRF=Performance|STP=Stripper/FLM=Film{PRN=Porn Star/BDSM=Bondage{FET=Fetishes|DCP=Dicipline';
$i++;

$modversion['config'][$i]['name'] = 'filesize_upload';
$modversion['config'][$i]['title'] = "_ESC_MD_FILESIZEUPLD";
$modversion['config'][$i]['description'] = "_ESC_MD_FILESIZEUPLD_DESC";
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1950351';
$i++;

$modversion['config'][$i]['name'] = 'allowed_mimetype';
$modversion['config'][$i]['title'] = "_ESC_MD_ALLOWEDMIMETYPE";
$modversion['config'][$i]['description'] = "_ESC_MD_ALLOWEDMIMETYPE_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'image/gif|image/pjpeg|image/jpeg|image/x-png|image/png';
$i++;

$modversion['config'][$i]['name'] = 'allowed_extensions';
$modversion['config'][$i]['title'] = "_ESC_MD_ALLOWEDEXTENSIONS";
$modversion['config'][$i]['description'] = "_ESC_MD_ALLOWEDEXTENSIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'gif|pjpeg|jpeg|jpg|png';
$i++;

$modversion['config'][$i]['name'] = 'upload_areas';
$modversion['config'][$i]['title'] = "_ESC_MD_UPLOADAREAS";
$modversion['config'][$i]['description'] = "_ESC_MD_UPLOADAREAS_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = array('/uploads/' => '/uploads/','/uploads/escorts/' => '/uploads/escorts/');
$modversion['config'][$i]['default'] = '/uploads/escorts/';
$i++;

$modversion['config'][$i] = array(
	'name'			=> 'thumbnail_size' ,
	'title'			=> '_ESC_MD_THUMBSIZE' ,
	'description'	=> '_ESC_MD_THUMBSIZE_DESC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> '140' ,
	'options'		=> array()
) ;

$i++;
$modversion['config'][$i] = array(
	'name'			=> 'thumbnail_rule' ,
	'title'			=> '_ESC_MD_THUMBRULE' ,
	'description'	=> '_ESC_MD_THUMBRULE_DESC' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'w' ,
	'options'		=> array(
		'Calculate from Width' => 'w' , 'Calculate from Height' => 'h' , 'Calculate from Inside Box' => 'b' )
	);
	
	$i++;
$modversion['config'][$i]['name'] = 'watermark';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;

$i++;
$modversion['config'][$i]['name'] = 'watermark_trans';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_TRANSPARENCY";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_TRANSPARENCYDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '75';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_FONT";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_FONTDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_ROOT_PATH.'/uploads/objects/watermarks/default.ttf';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_size';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_FONTSIZE";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_FONTSIZEDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '12';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_width';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_FONTWIDTH";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_FONTWIDTHDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '200';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_height';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_FONTHEIGHT";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_FONTHEIGHTDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '100';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_colour';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_FONTCOLOUR";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_FONTCOLOURDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '000000';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_angle';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_FONTANGLE";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_FONTANGLEDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '0';
$i++;
$modversion['config'][$i]['name'] = 'watermark_text';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_TEXT";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_TEXTDESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = $GLOBALS['xoopsConfig']['sitename'];

$i++;
$modversion['config'][$i]['name'] = 'watermark_image';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_IMAGE";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_IMAGEDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_ROOT_PATH.'/uploads/objects/watermarks/default.png';

$i++;
$modversion['config'][$i]['name'] = 'watermark_position';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_POSITION";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_POSITIONDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'BR';
$modversion['config'][$i]['options'] = array('Top Left' => 'TL', 'Top Right' => 'TR', 'Bottom Left' => 'BL', 'Bottom Right' => 'BR', 'Middle' => 'MD');

$i++;
$modversion['config'][$i]['name'] = 'watermark_mode';
$modversion['config'][$i]['title'] = "_ESC_WATERMARK_MODE";
$modversion['config'][$i]['description'] = "_ESC_WATERMARK_MODEDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'image';
$modversion['config'][$i]['options'] = array('Image' => 'image', 'Text' => 'text');

$i++;
$modversion['config'][$i]['name'] = 'googlemap_key';
$modversion['config'][$i]['title'] = "_ESC_GOOGLEMAPS_KEY";
$modversion['config'][$i]['description'] = "_ESC_GOOGLEMAPS_KEYDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'ABQIAAAAIUhPYI9N-OPz0lbqEv0ayBRi_j0U6kJrkFvY4-OX2XYmEAa76BQpZsEE4OhC4L1Tz2e6Uua0hxemBA';

$i++;
$modversion['config'][$i]['name'] = 'googlemap_width';
$modversion['config'][$i]['title'] = "_ESC_GOOGLEMAPS_WIDTH";
$modversion['config'][$i]['description'] = "_ESC_GOOGLEMAPS_WIDTHDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '500';

$i++;
$modversion['config'][$i]['name'] = 'googlemap_height';
$modversion['config'][$i]['title'] = "_ESC_GOOGLEMAPS_HEIGHT";
$modversion['config'][$i]['description'] = "_ESC_GOOGLEMAPS_HEIGHTDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '350';

$i++;
$modversion['config'][$i]['name'] = 'googlemap_zoom';
$modversion['config'][$i]['title'] = "_ESC_GOOGLEMAPS_ZOOM";
$modversion['config'][$i]['description'] = "_ESC_GOOGLEMAPS_ZOOMDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '15';

$i++;
$modversion['config'][$i]['name'] = 'googlemap_zoom';
$modversion['config'][$i]['title'] = "_ESC_GOOGLEMAPS_ZOOM";
$modversion['config'][$i]['description'] = "_ESC_GOOGLEMAPS_ZOOMDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '15';

$i++;
$modversion['config'][$i]['name'] = 'passkeyvalidfor';
$modversion['config'][$i]['title'] = "_ESC_PASSKEY_VALIDFOR";
$modversion['config'][$i]['description'] = "_ESC_PASSKEY_VALIDFORDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 10;
$modversion['config'][$i]['options'] = array('2 minutes' => 2, '4 minutes' => 4, '6 minutes' => 6, '8 minutes' => 8, '10 minutes' => 10, '15 minutes' => 15, '20 minutes' => 20, '30 minutes' => 30, '1 Hour' => 60, '2 Hour' => 120, '4 Hour' => 240, '6 Hour' => 360, '8 Hour' => 480, '10 Hour' => 600);

?>