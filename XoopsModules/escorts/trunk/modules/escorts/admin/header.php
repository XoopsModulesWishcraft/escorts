<?php
require_once "../../../include/cp_header.php";

include ($GLOBALS['xoops']->path('modules/escorts/include/functions.php'));
include ($GLOBALS['xoops']->path('modules/escorts/include/escorts.formobjects.php'));
include ($GLOBALS['xoops']->path('modules/escorts/include/escorts.forms.php'));

$GLOBALS['passkey'] = md5(XOOPS_LICENSE_KEY.date('Ymdhi'));

foreach($_GET as $id => $val)
	${$id} = $val;
	
foreach($_POST as $id => $val)
	${$id} = $val;		

if (isset($_POST['op'])) { $op = $_POST['op']; }
if (isset($_POST['fct'])) { $fct = $_POST['fct']; }
if (isset($_POST['oid'])) { $oid = $_POST['oid']; }
if (isset($_POST['id'])) { $id = $_POST['id']; }

xoops_loadLanguage('user');
xoops_loadLanguage('main', 'escorts');
if ( !isset($GLOBALS['xoopsTpl']) || !is_object($GLOBALS['xoopsTpl'])  ) {
	include_once $GLOBALS['xoops']->path( "/class/template.php" );
	$GLOBALS['xoopsTpl'] = new xoopsTpl();
}

IF (!@ include_once $GLOBALS['xoops']->path( "/Frameworks/art/functions.admin.php" ) ):
    

function loadModuleAdminMenu($currentoption, $breadcrumb = "")
{
    if ( !$adminmenu = $GLOBALS["xoopsModule"]->getAdminMenu()  ) {
        return false;
    }
        
    $breadcrumb = empty($breadcrumb) ? $adminmenu[$currentoption]["title"] : $breadcrumb;
    $module_link = XOOPS_URL . "/modules/" . $GLOBALS["xoopsModule"]->getVar("dirname") . "/";
    $image_link = XOOPS_URL . "/modules/" . $GLOBALS["xoopsModule"]->getVar("dirname") . "/images";
    
    $adminmenu_text ='
    <style type="text/css">
    <!--
    #buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0;}
    #buttonbar { float:left; width:100%; background: #e7e7e7 url("'.$image_link.'/modadminbg.gif") repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px;}
    #buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
    #buttonbar li { display:inline; margin:0; padding:0; }
    #buttonbar a { float:left; background:url("'.$image_link.'/left_both.gif") no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
    #buttonbar a span { float:left; display:block; background:url("'.$image_link.'/right_both.gif") no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
    /* Commented Backslash Hack hides rule from IE5-Mac \*/
    #buttonbar a span {float:none;}
    /* End IE5-Mac hack */
    #buttonbar a:hover span { color:#333; }
    #buttonbar .current a { background-position:0 -150px; border-width:0; }
    #buttonbar .current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
    #buttonbar a:hover { background-position:0% -150px; }
    #buttonbar a:hover span { background-position:100% -150px; }    
    //-->
    </style>
    <div id="buttontop">
     <table style="width: 100%; padding: 0; " cellspacing="0">
         <tr>
             <td style="width: 70%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;">
                 <a href="../index.php">' . $GLOBALS["xoopsModule"]->getVar("name") . '</a>
             </td>
             <td style="width: 30%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;">
                 <strong>' . $GLOBALS["xoopsModule"]->getVar("name") . '</strong>&nbsp;' . $breadcrumb . '
             </td>
         </tr>
     </table>
    </div>
    <div id="buttonbar">
     <ul>
    ';
    foreach (array_keys($adminmenu) as $key ) {
        $adminmenu_text .= ( ( $currentoption == $key) ? '<li class="current">' : '<li>') . '<a href="' . $module_link . $adminmenu[$key]["link"] . '"><span>' . $adminmenu[$key]["title"] . '</span></a></li>';
    }
    $adminmenu_text .= '<li><a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=showmod&mod=' . $GLOBALS["xoopsModule"]->getVar("mid") . '"><span>' . _PREFERENCES . '</span></a></li>';
    $adminmenu_text .= '
     </ul>
    </div>
    <br style="clear:both;" />';
    
    echo $adminmenu_text;
}
    
ENDIF;
?>