<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: install.docman.helper.php 1379 2010-06-11 16:07:41Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

if( !defined('DS') ) define('DS', DIRECTORY_SEPARATOR);


require_once( dirname(__FILE__).DS.'docman.class.php');
global $_DOCMAN, $_DMUSER;
$_DOCMAN = new dmMainFrame();
$_DMUSER = $_DOCMAN->getUser();
require_once($_DOCMAN->getPath('classes', 'compat'));

if(defined('_DM_J15')) {
    define( '_DM_INSTALLER_ICONPATH', 'components/com_docman/images/');
} else {
    define( '_DM_INSTALLER_ICONPATH', '../administrator/components/com_docman/images/');
}

class DMStatus
{
	var $_success = true;
	var $_msgs = array();

	function & getInstance()
	{
		static $instance;
		if(!isset($instance)) {
			$instance = new DMStatus;
		}
		return $instance;
	}
	function addMsg($msg)
	{
		$this->_msgs[] = $msg;
	}
	function getMsgs()
	{
		return $this->_msgs;
	}
	function set($success)
	{
		$this->_success = $success;
	}
	function get()
	{
		return $this->_success;
	}
}

/**
 * Helper functions for the installer
 * @static
 */
class DMInstallHelper
{
    function logo()
    {
    	?><br />
        <table>
            <tr>
                <th>
                <img border="0" src="http://ping.joomlatools.eu/?<?php echo DMInstallHelper::getInfo()?>" />
                <a href='index2.php?option=com_docman'><img border="0" alt="DOCman" src="components/com_docman/images/dm_logo.png" /></a></th>
            </tr>
        </table><?php
    }

    function files()
    {
    	clearstatcache();

    	$status = & DMStatus::getInstance();
        $root   = $GLOBALS['mosConfig_absolute_path'];
        $site   = $root.DS.'components'.DS.'com_docman';
        $admin  = $root.DS.'administrator'.DS.'components'.DS.'com_docman';

        // dmdocuments
        $dmdoc  = $root.DS._DM_DEFAULT_DATA_FOLDER;
        @mkdir ($dmdoc, 0755, true);
        @copy  ($admin.DS.'htaccess.txt', $dmdoc.DS.'.htaccess' );
        @copy  ($site.DS.'index.html', $dmdoc.DS.'index.html');
        if(!file_exists($dmdoc.DS.'.htaccess')) {
        	$status->addMsg("Couldn't secure <strong>$dmdoc</strong>. Please create the folder yourself. Next copy $admin".DS."htaccess.txt to $dmdoc".DS.".htaccess");
        }

        // modules
        $srcdir 	= $root.DS.'administrator'.DS.'components'.DS.'com_docman'.DS.'modules'.DS.'admin';
        $destdir	= $root.DS.'administrator'.DS.'modules';
        if(defined('_DM_J15'))
        {
        	$files = array(
                    'mod_docman_approval.php'		=>'mod_docman_approval'.DS.'mod_docman_approval.php',
                    'mod_docman_approval.xml.php'	=>'mod_docman_approval'.DS.'mod_docman_approval.xml',
                    'mod_docman_latest.php'     	=>'mod_docman_latest'.DS.'mod_docman_latest.php',
                    'mod_docman_latest.xml.php'     =>'mod_docman_latest'.DS.'mod_docman_latest.xml',
                    'mod_docman_logs.php'       	=>'mod_docman_logs'.DS.'mod_docman_logs.php',
                    'mod_docman_logs.xml.php'       =>'mod_docman_logs'.DS.'mod_docman_logs.xml',
                    'mod_docman_news.php'      	 	=>'mod_docman_news'.DS.'mod_docman_news.php',
                    'mod_docman_news.xml.php'       =>'mod_docman_news'.DS.'mod_docman_news.xml',
                    'mod_docman_top.php'       	 	=>'mod_docman_top'.DS.'mod_docman_top.php',
                    'mod_docman_top.xml.php'        =>'mod_docman_top'.DS.'mod_docman_top.xml' );
        }
        else
        {
        	$files = array(
                    'mod_docman_approval.php'		=>'mod_docman_approval.php',
                    'mod_docman_approval.xml.php'	=>'mod_docman_approval.xml',
                    'mod_docman_latest.php'     	=>'mod_docman_latest.php',
                    'mod_docman_latest.xml.php'     =>'mod_docman_latest.xml',
                    'mod_docman_logs.php'       	=>'mod_docman_logs.php',
                    'mod_docman_logs.xml.php'       =>'mod_docman_logs.xml',
                    'mod_docman_news.php'      	 	=>'mod_docman_news.php',
                    'mod_docman_news.xml.php'       =>'mod_docman_news.xml',
                    'mod_docman_top.php'       	 	=>'mod_docman_top.php',
                    'mod_docman_top.xml.php'        =>'mod_docman_top.xml' );
        }
		foreach( $files as $src=>$dest )
		{
			@mkdir(dirname($destdir.DS.$dest), 0755);
			@copy($srcdir.DS.$src, $destdir.DS.$dest);
			if(!file_exists($destdir.DS.$dest)){
				$status->addMsg("Couldn't copy <strong>$srcdir".DS."$src</strong> to <strong>$destdir".DS."$dest</strong><br /> Please copy the file yourself. Rename all .xml.php files to .xml");
			}
		}

		// plugins
       	$plugins = defined('_DM_J15') ? 'plugins' : 'mambots';
        $srcdir	 = $admin.DS.'plugins';
        $destdir = $root.DS.$plugins.DS.'docman';

        $files = array(
                    'standardbuttons.php'     => 'standardbuttons.php',
                    'standardbuttons.xml.php' => 'standardbuttons.xml');

    	foreach( $files as $src=>$dest )
    	{
    		@mkdir(dirname($destdir.DS.$dest), 0755);
			@copy($srcdir.DS.$src, $destdir.DS.$dest);
			if(!file_exists($destdir.DS.$dest))
			{
				$status->addMsg("Couldn't copy <strong>$srcdir".DS."$src</strong> to <strong>$destdir".DS."$dest</strong><br /> Please copy the file yourself. Rename all .xml.php files to .xml");
			}
		}

        //@chmod ($site, 0755);
        //@chmod ($admin.DS.'classes'.DS.'DOCMAN_download.class.php', 0755);
        //@chmod ($admin.DS.'classes'.DS.'DOCMAN_utils.php', 0755);

    }


    /**
     * Upgrade tables from 1.3rc2/1.4beta2 style to 1.4rc1 style
     */
    function upgradeTables()
    {
    	global $database;
    	$status = & DMStatus::getInstance();

        $queries = array();

        $database->setQuery("SHOW INDEX FROM #__docman");
        $database->query();
        $num_keys = $database->getNumRows();
        switch($num_keys){
            case 1: // there's only a primary index, add some more
                $queries[] = "ALTER TABLE `#__docman` ADD INDEX `pub_appr_own_cat_name`  (`published`, `approved`, `dmowner`, `catid`, `dmname`(64))";
                $queries[] = "ALTER TABLE `#__docman` ADD INDEX `appr_pub_own_cat_date`  (`approved`, `published`, `dmowner`, `catid`, `dmdate_published`)";
                $queries[] = "ALTER TABLE `#__docman` ADD INDEX `own_pub_appr_cat_count` (`dmowner`, `published`, `approved`, `catid`, `dmcounter`)";
                // pass through (more can be added later on)
            default:
                break;
        }

        foreach($queries as $query) {
            $database->setQuery($query);
            if(! $database->query()) {
            	$status->addMsg('Error upgrading tables');
            }
        }
    }

    function moduleDB(){
    	global $database;

        // #__template_positions is removed in j15
        if(defined('_DM_J15')) {
        	return;
        }

        // add dmcpanel to the template positions
        $query = "SELECT COUNT(*) FROM #__template_positions WHERE position = 'dmcpanel'";
        $database->setQuery($query);
        if(!$database->loadResult()) {
        	$query = "INSERT INTO #__template_positions SET position = 'dmcpanel', description='DOCman'";
            $database->setQuery($query);
            $database->query();
        }

    }

    function pluginDB($action = 'insert')
     {
        global $database, $_DOCMAN;

        if(defined('_DM_J15')) {
            $table = '#__plugins';
        } else {
        	$table = '#__mambots';
        }

        switch($action) {
            case 'insert':
                $query = "INSERT INTO `$table` (`name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`)"
                    ."\n VALUES ('DOCman Standard Buttons', 'standardbuttons', 'docman', '0', '1', '1', '1', '0', '0', '0000-00-00 00:00:00', "
                    ." 'download=1\nview=1\ndetails=1\nedit=1\nmove=1\ndelete=1\nupdate=1\nreset=1\ncheckout=1\napprove=1\npublish=1')";
                break;
            case 'delete':
                $query = "DELETE FROM `$table` WHERE `element`='standardbuttons' AND `folder`='docman'";
                break;
        }

        $database->setQuery($query);
        $database->query();
    }

	function removeAdminMenuImages()
	{
        global $database;

        $id = DMInstallHelper::getComponentId();

        $database->setQuery("UPDATE #__components SET admin_menu_img = '"._DM_INSTALLER_ICONPATH."dm_spacer_16.png' WHERE parent = $id");
        $database->query();
    }

    function setAdminMenuImages()
    {
      global $database;

        $id = DMInstallHelper::getComponentId();

        // Main mennu
        $database->setQuery("UPDATE #__components SET admin_menu_img = '"._DM_INSTALLER_ICONPATH."dm_documents_16.png' WHERE id=$id");
        $database->query();

        // Submenus
        $submenus = array();
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_cpanel_16.png', 'name'=>'Home' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_files_16.png', 'name'=>'Files' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_documents_16.png', 'name'=>'Documents' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_categories_16.png', 'name'=>'Categories' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_groups_16.png', 'name'=>'Groups' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_licenses_16.png', 'name'=>'Licenses' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_stats_16.png', 'name'=>'Statistics' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_logs_16.png', 'name'=>'Download Logs' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_config_16.png', 'name'=>'Configuration' );
        $submenus[] = array( 'image' => _DM_INSTALLER_ICONPATH.'dm_templates_16.png', 'name'=>'Themes' );

        foreach( $submenus as $submenu ){
          $database->setQuery("UPDATE #__components SET admin_menu_img = '".$submenu['image']."'"
                                . "\n WHERE parent=$id AND name = '".$submenu['name']."';");
            $database->query();
        }
    }

	function cpanel()
    {
        global $mosConfig_live_site;

        ?><br /><br />
        <div class="cpanel">
            <div class="icon">
                <a href="index2.php?option=com_docman" style="text-decoration:none;">
                    <img border="0" align="top" alt="Home" src="<?php echo $mosConfig_live_site?>/administrator/components/com_docman/images/dm_cpanel_48.png"/>
                    <br />
                    <span>Home</span>
                </a>
            </div><br />
            <div class="icon">
                <a href="index2.php?option=com_docman&amp;task=sampledata" style="text-decoration:none;">
                    <img border="0" align="top" alt="Add Sample Data" src="<?php echo $mosConfig_live_site?>/administrator/components/com_docman/images/dm_newdocument_48.png"/>
                    <br />
                    <span>Add Sample Data</span>
                </a>
            </div>
        </div>
        <?php

    }


    function moduleFiles( $action = 'move' ){
        global $mosConfig_absolute_path;

        $src = $mosConfig_absolute_path.DS.'administrator'.DS.'components'.DS.'com_docman'.DS.'modules'.DS.'admin';
        $dest = $mosConfig_absolute_path.DS.'administrator'.DS.'modules';

        $files = array(
                    'mod_docman_approval.php'   =>'mod_docman_approval.php',
                    'mod_docman_approval.xml.php'=>'mod_docman_approval.xml',
                    'mod_docman_latest.php'     =>'mod_docman_latest.php',
                    'mod_docman_latest.xml.php'     =>'mod_docman_latest.xml',
                    'mod_docman_logs.php'       =>'mod_docman_logs.php',
                    'mod_docman_logs.xml.php'       =>'mod_docman_logs.xml',
                    'mod_docman_news.php'       =>'mod_docman_news.php',
                    'mod_docman_news.xml.php'       =>'mod_docman_news.xml',
                    'mod_docman_top.php'        =>'mod_docman_top.php',
                    'mod_docman_top.xml.php'        =>'mod_docman_top.xml' );

        switch ($action) {
            case 'delete':
                foreach( $files as $file ){
                    @unlink( $dest.DS.$file );
                }

                break;
        	default:

                break;
        }
    }

    // Modules each have their own dir in J1.5
    function moduleFilesJ15( $action = 'move' ){
        global $mosConfig_absolute_path;
        jimport('joomla.filesystem.file');

        $src = $mosConfig_absolute_path.DS.'administrator'.DS.'components'.DS.'com_docman'.DS.'modules'.DS.'admin';
        $dest = $mosConfig_absolute_path.DS.'administrator'.DS.'modules';

        $files = array(
                    'mod_docman_approval.php'   =>'mod_docman_approval.php',
                    'mod_docman_approval.xml.php'=>'mod_docman_approval.xml',
                    'mod_docman_latest.php'     =>'mod_docman_latest.php',
                    'mod_docman_latest.xml.php' =>'mod_docman_latest.xml',
                    'mod_docman_logs.php'       =>'mod_docman_logs.php',
                    'mod_docman_logs.xml.php'   =>'mod_docman_logs.xml',
                    'mod_docman_news.php'       =>'mod_docman_news.php',
                    'mod_docman_news.xml.php'   =>'mod_docman_news.xml',
                    'mod_docman_top.php'        =>'mod_docman_top.php',
                    'mod_docman_top.xml.php'    =>'mod_docman_top.xml' );

        switch ($action) {
            case 'delete':
                foreach( $files as $file ){
                    $moduledir = str_replace( array('.xml', '.php'), '', $file );
                    JFile::delete($dest.DS.$moduledir.DS.$file);
                }
                break;
            default:
                break;
        }
    }

    function pluginFiles( $action = 'move' ){
        global $mosConfig_absolute_path;

        if(defined('_DM_J15')) {
        	$plugins = 'plugins';
        } else {
        	$plugins = 'mambots';
        }


        $src = $mosConfig_absolute_path.DS.'administrator'.DS.'components'.DS.'com_docman'.DS.'plugins';
        $dest = $mosConfig_absolute_path.DS.$plugins.DS.'docman';


        $files = array(
                    'standardbuttons.php'     => 'standardbuttons.php',
                    'standardbuttons.xml.php' => 'standardbuttons.xml');

        switch ($action) {
            case 'delete':
                foreach( $files as $file ){
                    @unlink( $dest.DS.$file );
                }

                break;
        }
    }



    function getDefaultFiles(){
        return array( '.htaccess', 'index.html' );
    }

    function getComponentId(){
        static $id;

        if( !$id ) {
            global $database;
            $database->setQuery("SELECT id FROM #__components WHERE name= 'DOCman'");
            $id =$database->loadResult();
        }
        return $id;
    }






    /**
     * Count items in tables
     */
    function cntDbRecords() {
        global $database;
    	$cnt = array();
        $tables = DMInstallHelper::getTablesList();

        foreach( $tables as $table ){
            $database->setQuery("SELECT COUNT(*) FROM `$table`");
            $cnt[] = (int) $database->loadResult();
        }

        // count categories
        $database->setQuery("SELECT COUNT(*) FROM `#__categories` WHERE `section` = 'com_docman'");
        $cnt[] = (int) $database->loadResult();

        return array_sum($cnt);
    }

    function removeTables() {
        global $database;
        $tables = DMInstallHelper::getTablesList();

    	foreach( $tables as $table ){
            $database->setQuery("DROP TABLE `$table`");
            $database->query();
        }
    }

    function getTablesList(){
    	return array( '#__docman', '#__docman_groups', '#__docman_history', '#__docman_licenses', '#__docman_log');
    }

    /**
     * Count the number of files in the data folder
     */
    function cntFiles(){
    	global $_DOCMAN;

        $files = DMInstallHelper::getDefaultFiles();
        $dir = DOCMAN_Compat::mosReadDirectory( $_DOCMAN->getCfg( 'dmpath' ) );
        return count( array_diff( $dir, $files ));
    }

    function removeDmdocuments(){
        global $_DOCMAN;

        $dmpath = $_DOCMAN->getCfg( 'dmpath' );

        $files = DMInstallHelper::getDefaultFiles();

    	foreach( $files as $file ) {
            @unlink ( $dmpath.DS.$file );
        }
        @rmdir( $dmpath );
    }



    function getInfo()
    {
    	$db = & JFactory::getDBO();
    	$version = & $GLOBALS['_VERSION'];

    	$info = array(
    		'ext'	=> 'DOCman',
    		'v'		=> '1.4.1',
    		'up'	=> 'new',
    		'cms'	=> $version->PRODUCT.' '.$version->RELEASE .'.'. $version->DEV_LEVEL,
    	    'k'		=> class_exists('Koowa') &&  method_exists('Koowa', 'getVersion') ? Koowa::getVersion() : 0,
    		'p' 	=> phpversion(),
    		'db'	=> $db->getVersion(),
    	);
    	return http_build_query($info);

    }



}
