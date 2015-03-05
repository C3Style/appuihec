<?php

/**
* Outputs a tooltip.
*
* $Id: Savant2_Plugin_calendar.php 798 2009-02-12 14:42:04Z mathias $
* @author Johan Janssens <johan.janssens@users.sourceforge.net>
* @package Savant2
* @license http://www.gnu.org/copyleft/lesser.html LGPL
*
*/

require_once dirname(__FILE__) . '/Plugin.php';

class Savant2_Plugin_calendar extends Savant2_Plugin
{
    function plugin()
    {
        DOCMAN_Compat::calendarJS();
    }
}

