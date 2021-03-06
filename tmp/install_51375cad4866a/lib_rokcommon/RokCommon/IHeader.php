<?php
/**
 * @version   $Id: IHeader.php 57540 2012-10-14 18:27:59Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - ${copyright_year} RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
interface RokCommon_IHeader
{
	const DEFAULT_ORDER = 10;
	const DEFAULT_PRIORITY = 10;

	public function addScriptPath($path, $priority = self::DEFAULT_PRIORITY);

	public function addScript($file, $order = self::DEFAULT_ORDER);

	public function addStylePath($path, $priority = self::DEFAULT_PRIORITY);

	public function addInlineScript($text, $order = self::DEFAULT_ORDER);

	public function addStyle($file, $order = self::DEFAULT_ORDER);

	public function addInlineStyle($text, $order = self::DEFAULT_ORDER);

	public function addDomReadyScript($js, $order = self::DEFAULT_ORDER);

	public function addLoadScript($js, $order = self::DEFAULT_ORDER);

	public function reset();
}

