<?php
/**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Exception extends Exception
{
    public function __construct($message)
    {
        $container = RokCommon_Service::getContainer();
        $container->roksprocket_logger->warning($message);
        parent::__construct($message);
    }
}