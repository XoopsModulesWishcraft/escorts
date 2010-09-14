<?php
// $Autho: wishcraft $

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
/**
 * Class for compunds
 * @author Simon Roberts <simon@xoops.org>
 * @copyright copyright (c) 2009-2003 XOOPS.org
 * @package kernel
 */
class EscortsProfile extends XoopsObject
{

    function EscortsProfile($id = null)
    {
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('uid', XOBJ_DTYPE_INT, null, true);
		$this->initVar('alias', XOBJ_DTYPE_UNICODE_TXTBOX, null, true, 128);
        $this->initVar('name', XOBJ_DTYPE_UNICODE_TXTBOX, null, true, 128);
		$this->initVar('incall', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
		$this->initVar('outcall', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));		
		$this->initVar('sms', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('mobile', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('landline', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('agency', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
		$this->initVar('age', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('sexuality', XOBJ_DTYPE_ENUM, null, false, false, false, array('Hetrosexual','Bisexual','Homosexual'));		
		$this->initVar('domains', XOBJ_DTYPE_ARRAY, array(0=>XOOPS_URL));
		$this->initVar('locations', XOBJ_DTYPE_ARRAY, array());	
		$this->initVar('tags', XOBJ_DTYPE_TXTBOX, null, false, 255);	
		$this->initVar('slogon', XOBJ_DTYPE_UNICODE_TXTBOX, null, false, 64);
		$this->initVar('bio', XOBJ_DTYPE_UNICODE_TXTAREA, null, false);
		$this->initVar('columnone', XOBJ_DTYPE_UNICODE_TXTAREA, null, false);
		$this->initVar('columntwo', XOBJ_DTYPE_UNICODE_TXTAREA, null, false);
		$this->initVar('footer', XOBJ_DTYPE_UNICODE_TXTAREA, null, false);
    }
	
	function outputCardHTML ()
	{
		$ret .='<h2>'.$this->getVar('alias').' - Escort ('.$this->getVar('sexuality'). ') - '.$this->getVar('age').' years</h2>';
       	$ret .='<h3>Contact Details</h2>';
        $ret .='<ul style="list-style:square;">';
        $ret .='<li><strong>Incall:</strong>&nbsp;'.$this->getVar('incall').'</li>';
        $ret .='<li><strong>Outcall:</strong>&nbsp;'.$this->getVar('outcall').'</li>';
		$ret .='<li><strong>SMS:</strong>&nbsp;'.$this->getVar('sms').'</li>';
        $ret .='<li><strong>Mobile:</strong>&nbsp;'.$this->getVar('mobile').'</li>';
        $ret .='<li><strong>Landline:</strong>&nbsp;'.$this->getVar('landline').'</li>';
        $ret .='</ul>';
		return $ret;
	}

}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.org.au>
* @package kernel
*/
class EscortsProfileHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "escorts_profile", 'EscortsProfile', "pid", "alias");
    }
}

?>