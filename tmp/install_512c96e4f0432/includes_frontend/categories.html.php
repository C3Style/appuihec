<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: categories.html.php 765 2009-01-05 20:55:57Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

if (defined('_DOCMAN_HTML_CATEGORIES')) {
    return;
} else {
    define('_DOCMAN_HTML_CATEGORIES', 1);
}

class HTML_DMCategories
{
    function displayCategory(&$links, &$paths, &$data)
    {
        $tpl = &new DOCMAN_Theme();

        // Assign values to the Savant instance.
        $tpl->assignRef('links', $links);
        $tpl->assignRef('paths', $paths);
        $tpl->assignRef('data', $data);

        // Display a template using the assigned values.
        return $tpl->fetch('categories/category.tpl.php');
    }

    function displayCategoryList(&$items)
    {
        $tpl = &new DOCMAN_Theme();

        // Assign values to the Savant instance.
        $tpl->assignRef('items', $items);

        // Display a template using the assigned values.
        return $tpl->fetch('categories/list.tpl.php');
    }
}