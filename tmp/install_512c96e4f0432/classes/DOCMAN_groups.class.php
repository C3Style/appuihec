<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: DOCMAN_groups.class.php 765 2009-01-05 20:55:57Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

if (defined('_DOCMAN_GROUPS')) {
    return true;
} else {
    define('_DOCMAN_GROUPS', 1);
}

class DOCMAN_groups {

    /**
     * Provides a list of all groups
     *
     * @deprecated
     */
    function & getList() {
        static $groups;

        if( !isset( $groups )) {
            global $database;
            $database->setQuery("SELECT groups_id, groups_name "
             . "\n  FROM #__docman_groups "
             . "\n ORDER BY groups_name ASC");
            $groups = $database->loadObjectList();
        }

        return $groups;
    }

    /**
     * Get a group object, caches results
     */
    function & get($id)
    {
        static $groups;

        if( !isset( $groups )) {
            $groups = array();
        }

        if( !isset( $groups[$id] )) {
            global $database;
            $groups[$id] = new mosDMGroups($database);
            $groups[$id]->load($id);
        }

        return $groups[$id];
    }
}