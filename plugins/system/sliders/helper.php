<?php
/**
 * Plugin Helper File
 *
 * @package         Sliders
 * @version         3.5.6
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2014 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

// Load common functions
require_once JPATH_PLUGINS . '/system/nnframework/helpers/functions.php';
require_once JPATH_PLUGINS . '/system/nnframework/helpers/text.php';
require_once JPATH_PLUGINS . '/system/nnframework/helpers/tags.php';
require_once JPATH_PLUGINS . '/system/nnframework/helpers/protect.php';

NNFrameworkFunctions::loadLanguage('plg_system_sliders');

/**
 * Plugin that replaces stuff
 */
class plgSystemSlidersHelper
{
	public function __construct(&$params)
	{
		$this->params = $params;

		$this->params->comment_start = '<!-- START: Sliders -->';
		$this->params->comment_end = '<!-- END: Sliders -->';

		$bts = '((?:<[a-zA-Z][^>]*>\s*){0,3})'; // break tags start
		$bte = '((?:\s*<(?:/[a-zA-Z]|br|BR)[^>]*>){0,3})'; // break tags end

		$this->params->tag_open = preg_replace('#[^a-z0-9-_]#si', '', $this->params->tag_open);
		$this->params->tag_close = preg_replace('#[^a-z0-9-_]#si', '', $this->params->tag_close);
		$this->params->tag_link = preg_replace('#[^a-z0-9-_]#si', '', $this->params->tag_link);
		$this->params->tag_delimiter = ($this->params->tag_delimiter == 'space') ? '(?: |&nbsp;)' : '=';

		$this->params->regex = '#'
			. $bts
			. '\{(' . $this->params->tag_open . 's?'
			. '((?:-[a-zA-Z0-9-_]+)?)'
			. $this->params->tag_delimiter
			. '((?:[^\}]*?\{[^\}]*?\})*[^\}]*?)|/' . $this->params->tag_close
			. '(?:-[a-z0-9-_]*)?)\}'
			. $bte
			. '#s';
		$this->params->regex_end = '#'
			. $bts
			. '\{/' . $this->params->tag_close
			. '(?:-[a-z0-9-_]+)?\}'
			. $bte
			. '#s';
		$this->params->regex_link = '#'
			. '\{' . $this->params->tag_link
			. '(?:-[a-z0-9-_]+)?' . $this->params->tag_delimiter
			. '([^\}]*)\}'
			. '(.*?)'
			. '\{/' . $this->params->tag_link . '\}'
			. '#s';

		$this->params->protected_tags = array(
			'{' . $this->params->tag_open,
			'{/' . $this->params->tag_close,
			$this->params->tag_link
		);

		$this->ids = array();
		$this->matches = array();
		$this->allitems = array();
		$this->setcount = 0;

		$this->params->disabled_components = array('com_acymailing');

		
	}

	public function onContentPrepare(&$article, &$context)
	{
		NNFrameworkHelper::processArticle($article, $context, $this, 'replaceTags');
	}

	public function onAfterDispatch()
	{
		/*
		 * Place back if I get complaint about it not working in PDFs
		// PDF
		if (JFactory::getDocument()->getType() == 'pdf')
		{
			$buffer = JFactory::getDocument()->getBuffer('component');
			NNFrameworkHelper::processBufferComponent($buffer, $this, 'replaceTags', array('component'));

			JFactory::getDocument()->setBuffer($buffer, 'component');

			return;
		}
		*/

		// only in html
		if (JFactory::getDocument()->getType() !== 'html' && JFactory::getDocument()->getType() !== 'feed')
		{
			return;
		}

		$buffer = JFactory::getDocument()->getBuffer('component');

		if (empty($buffer) || is_array($buffer))
		{
			return;
		}

		// do not load scripts/styles on print page
		if (JFactory::getDocument()->getType() !== 'feed' && !JFactory::getApplication()->input->getInt('print', 0))
		{
			if ($this->params->load_mootools)
			{
				JHtml::_('behavior.mootools');
			}

			$script = '
				var nn_sliders_speed = 500;
				var nn_sliders_fade_in_speed = 1000;
				var nn_sliders_fade_out_speed = 400;
				var nn_sliders_linkscroll = 0;
				var nn_sliders_url = \'\';
				var nn_sliders_urlscroll = \'\';
				var nn_sliders_use_hash = ' . (int) $this->params->use_hash . ';
			';
			JFactory::getDocument()->addScriptDeclaration('/* START: Sliders scripts */ ' . preg_replace('#\n\s*#s', ' ', trim($script)) . ' /* END: Sliders scripts */');
			JHtml::script('sliders/script.min.js', false, true);

			if ($this->params->load_stylesheet == 2)
			{
				JHtml::stylesheet('sliders/style.min.css', false, true);
			}
			else if ($this->params->load_stylesheet)
			{
				JHtml::stylesheet('sliders/old.min.css', false, true);
				$style = '';
				$css_i = 'div.nn_sliders_slider';
				$this->params->line_color = ($this->params->outline ? '#' . $this->params->line_color : 'transparent');
				if ($this->params->line_color != '#B4B4B4')
				{
					$style .= '
					' . $css_i . ' a,
					' . $css_i . ' a:hover,
					div.nn_sliders_content_wrapper div.nn_sliders_content {
						border-color: ' . $this->params->line_color . ';
					}
				';
				}
				if ($style)
				{
					JFactory::getDocument()->addStyleDeclaration('/* START: Sliders styles */ ' . preg_replace('#\n\s*#s', ' ', trim($style)) . ' /* END: Sliders styles */');
				}
			}
		}

		$this->replaceTags($buffer, 'component');

		JFactory::getDocument()->setBuffer($buffer, 'component');
	}

	public function onAfterRender()
	{
		// only in html and feeds
		if (JFactory::getDocument()->getType() !== 'html' && JFactory::getDocument()->getType() !== 'feed')
		{
			return;
		}

		$html = JResponse::getBody();

		if ($html == '')
		{
			return;
		}

		if (strpos($html, '{' . $this->params->tag_open) === false)
		{
			if (strpos($html, 'id="nn_sliders_slider') === false)
			{
				// remove style and script if no items are found
				$html = preg_replace('#\s*<' . 'link [^>]*href="[^"]*/(sliders/css|css/sliders)/[^"]*\.css[^"]*"[^>]* />#s', '', $html);
				$html = preg_replace('#\s*<' . 'script [^>]*src="[^"]*/(sliders/js|js/sliders)/[^"]*\.js[^"]*"[^>]*></script>#s', '', $html);
				$html = preg_replace('#/\* START: sliders .*?/\* END: sliders [a-z]* \*/\s*#s', '', $html);
			}
		}
		else
		{
			// only do stuff in body
			list($pre, $body, $post) = nnText::getBody($html);
			$this->replaceTags($body, 'body');
			$html = $pre . $body . $post;
		}
		$this->cleanLeftoverJunk($html);

		JResponse::setBody($html);
	}

	function replaceTags(&$str, $area = 'article')
	{
		if (!is_string($str) || $str == '')
		{
			return;
		}

		if ($area == 'component')
		{
			// allow in component?
			if (in_array(JFactory::getApplication()->input->get('option'), $this->params->disabled_components))
			{
				$this->protectTags($str);

				return;
			}
		}

		if (
			strpos($str, '{' . $this->params->tag_open) === false
			&& strpos($str, '{' . $this->params->tag_link) === false
		)
		{
			return;
		}

		$this->protect($str);

		if (JFactory::getApplication()->input->getInt('print', 0))
		{
			// Replace syntax with general html on print pages
			if (preg_match_all($this->params->regex, $str, $matches, PREG_SET_ORDER) > 0)
			{
				foreach ($matches as $match)
				{
					$title = NNText::cleanTitle($match['4']);
					if (strpos($title, '|') !== false)
					{
						list($title, $extra) = explode('|', $title, 2);
					}
					$title = trim($title);
					$name = NNText::cleanTitle($title, 1);
					$title = preg_replace('#<\?h[0-9](\s[^>]* )?>#', '', $title);
					$replace = '<a name="' . $name . '"></a><' . $this->params->title_tag . ' class="nn_sliders_title">' . $title . '</' . $this->params->title_tag . '>';
					$str = str_replace($match['0'], $replace, $str);
				}
			}
			if (preg_match_all($this->params->regex_end, $str, $matches, PREG_SET_ORDER) > 0)
			{
				foreach ($matches as $match)
				{
					$str = str_replace($match['0'], '', $str);
				}
			}
			if (preg_match_all($this->params->regex_link, $str, $matches, PREG_SET_ORDER) > 0)
			{
				foreach ($matches as $match)
				{
					$href = NNText::getURI($match['1']);
					$link = '<a href="' . $href . '">' . $match['2'] . '</a>';
					$str = str_replace($match['0'], $link, $str);
				}
			}
			NNProtect::unprotect($str);

			return;
		}

		$sets = array();
		$setids = array();

		if (preg_match_all($this->params->regex, $str, $matches, PREG_SET_ORDER) > 0)
		{
			foreach ($matches as $match)
			{
				if ($match['2']['0'] == '/')
				{
					array_pop($setids);
					continue;
				}
				end($setids);
				$item = new stdClass;
				$item->orig = $match['0'];
				$item->setid = trim(str_replace('-', '_', $match['3']));
				if (empty($setids) || current($setids) != $item->setid)
				{
					$this->setcount++;
					$setids[$this->setcount . '_'] = $item->setid;
				}
				$item->set = str_replace('__', '_', array_search($item->setid, array_reverse($setids)) . $item->setid);
				$item->title = NNText::cleanTitle($match['4']);
				list($item->pre, $item->post) = NNTags::setSurroundingTags($match['1'], $match['5']);
				if (!isset($sets[$item->set]))
				{
					$sets[$item->set] = array();
				}
				$sets[$item->set][] = $item;
			}
		}

		$urlitem = JFactory::getApplication()->input->getString('slider', '', 'default', 1);
		$urlitem = trim($urlitem);
		if (is_numeric($urlitem))
		{
			$urlitem = '1-' . $urlitem;
		}
		$active_url = '';


		foreach ($sets as $set_id => $items)
		{
			$rand = '___' . rand(100, 999) . '___';
			$active_by_url = '';
			$active_by_cookie = '';
			$active = 0;
			foreach ($items as $i => $item)
			{
				$tag = NNTags::getTagValues(str_replace('|alias:', '|alias=', $item->title));
				$item->title = $tag->title;
				$item->alias = isset($tag->alias) ? $tag->alias : '';
				$item->active = 0;

				foreach ($tag->params as $j => $val)
				{
					if (in_array($val, array('active', 'opened', 'open')))
					{
						$item->active = 1;
						$active = $i;
						unset($tag->params[$j]);
					}
					else if (in_array($val, array('inactive', 'closed', 'close')))
					{
						$item->active = 0;
						if ($active == $i)
						{
							$active = '';
						}
						unset($tag->params[$j]);
					}
				}
				$item->class = implode(' ', $tag->params);

				$item->set = $set_id . $rand;
				$item->setname = $set_id;
				$item->count = $i + 1;
				$item->id = $item->set . '-' . $item->count;
				$item->haslink = preg_match('#<a [^>]*>.*?</a>#usi', $item->title);


				$item->title_full = $item->title;
				$item->title = NNText::cleanTitle($item->title, 1);
				if ($item->title == '')
				{
					$item->title = NNText::getAttribute('title', $item->title_full);
					if ($item->title == '')
					{
						$item->title = NNText::getAttribute('alt', $item->title_full);
					}
				}
				$item->title = str_replace(array('&nbsp;', '&#160;'), ' ', $item->title);
				$item->title = preg_replace('#\s+#', ' ', $item->title);

				$item->alias = NNText::createAlias($item->alias ? $item->alias : $item->title);
				$item->alias = $item->alias ?: 'slide';

				$item->id = $this->createId($item->alias);

				$item->matches = NNText::createUrlMatches(array($item->id, $item->title));
				$item->matches[] = ($i + 1) . '';
				$item->matches[] = $item->set . '-' . ($i + 1);

				$item->matches = array_unique($item->matches);
				$item->matches = array_diff($item->matches, $this->matches);
				$this->matches = array_merge($this->matches, $item->matches);

				if ($urlitem != '' && (in_array($urlitem, $item->matches, 1) || in_array(strtolower($urlitem), $item->matches, 1)))
				{
					if (!$item->haslink)
					{
						$active_by_url = $i;
					}
				}
				if ($active == $i && $item->haslink)
				{
					$active++;
				}

				$sets[$set_id][$i] = $item;
				$this->allitems[] = $item;
			}

			if ($active_by_url !== '' && isset($sets[$set_id][$active_by_url]))
			{
				$sets[$set_id][$active_by_url]->active = 1;
				$active_url = $sets[$set_id][$active_by_url]->id;
			}
			else if ($active !== '' && isset($sets[$set_id][(int) $active]))
			{
				$sets[$set_id][(int) $active]->active = 1;
			}
		}

		if (preg_match($this->params->regex_end, $str))
		{
			$script_set = 0;
			foreach ($sets as $items)
			{
				$first = key($items);
				end($items);
				$last = key($items);
				foreach ($items as $i => $item)
				{
					$s = '#' . preg_quote($item->orig, '#') . '#';
					if (@preg_match($s . 'u', $str))
					{
						$s .= 'u';
					}
					if (preg_match($s, $str, $match))
					{
						$html = array();
						$html[] = $item->post;
						$html[] = $item->pre;
						if ($item->active)
						{
							// Shows the active slide asap, before the entire script is loaded
							$id = uniqid('script_nn_sliders');
							$html[] = '<div id="' . $id . '" class="script_nn_sliders" style="display:none;"></div>';
							$html[] = '<script type="text/javascript">document.getElementById(\'' . $id . '\').innerHTML = '
								. 'String.fromCharCode(60)+\'style type="text/css">'
								. 'div#nn_sliders_slider_' . $item->id . ' { display: block !important; }'
								. '\'+String.fromCharCode(60)+\'/style>'
								. '\';</script>';
						}
						if ($i == $first)
						{
							if (!$script_set)
							{
								// Hides the titles and inactive content asap, before the entire script is loaded
								$id = uniqid('script_nn_sliders');
								$html[] = '<div id="' . $id . '" class="script_nn_sliders" style="display:none;"></div>';
								$html[] = '<script type="text/javascript">document.getElementById(\'' . $id . '\').innerHTML = '
									. 'String.fromCharCode(60)+\'style type="text/css">'
									. 'div.nn_sliders_content_inactive { display: none; }'
									. '.nn_sliders_title { display: none !important; }'
									. '\'+String.fromCharCode(60)+\'/style>'
									. '\';</script>';
								$script_set = 1;
							}
							$html[] = '<div'
								. ' class="' . trim('nn_sliders_container nn_sliders_container_' . $item->setname . ' nn_sliders_noscript') . '"'
								. ' id="nn_sliders_container_' . $item->set . '"'
								. '>';
						}
						else
						{
							$html[] = '<div style="clear:both;"></div>';
							$html[] = '</div></div></div>';
						}

						$item->class = ($item->active == 1 ? ' active' : '') . ' ' . $item->class;
						if (strpos($item->class, 'indent') === false)
						{
							$item->class .= ' ' . $this->params->indent;
						}

						if ($item->haslink && preg_match('#(<a [^>]*>)(.*?)(</a>)#usi', $item->title_full, $match))
						{
							$link = str_replace($match['0'], $match['1'] . '<span>' . $match['2'] . '</span>' . $match['3'], $item->title_full);
							$item->class .= ' nn_sliders_noslider';
						}
						else
						{
							if ($this->params->use_hash)
							{
								$href = NNText::getURI($item->id);
							}
							else
							{
								$href = 'javascript: // ' . $item->title;
							}
							$link = '<a href="' . $href . '"><span>' . $item->title_full . '</span></a>';
						}

						$html[] = '<div style="display:none;"'
							. ' class="' . trim('nn_sliders_slider nn_sliders_count_' . $item->count . ' ' . trim($item->class)) . '"'
							. ' id="nn_sliders_slider_' . $item->id . '"'
							. ' data-container="' . $item->set . '"'
							. '><span class="nn_sliders_alias_' . $item->alias . '">' . $link . '</span></div>';
						$html[] = '<div'
							. ' class="' . trim('nn_sliders_content_wrapper nn_sliders_count_' . $item->count . ' ' . trim($item->class)) . ' nn_sliders_content_' . ($item->active ? '' : 'in') . 'active"'
							. ' id="nn_sliders_content_' . $item->id . '"'
							. ' data-container="' . $item->set . '"'
							. '>';
						$html[] = '<div class="' . trim('nn_sliders_content ' . trim($item->class)) . '">';
						$html[] = '<div'
							. ' class="nn_sliders_item"'
							. ' id="nn_sliders_item_' . $item->id . '"'
							. ' data-container="' . $item->set . '"'
							. '>';
						$html[] = '<' . $this->params->title_tag . ' class="nn_sliders_title">' . preg_replace('#<\?h[0-9](\s[^>]* )?>#', '', $item->title_full) . '</' . $this->params->title_tag . '>';

						if ($i == $last)
						{
							$html[] = '<script type="text/javascript">'
								. "document.getElementById('nn_sliders_container_" . $item->set . "').setAttribute( 'class', document.getElementById('nn_sliders_container_" . $item->set . "').className.replace(/\bnn_sliders_noscript\b/,'') );"
								. '</script>';
						}

						$html = implode("\n", $html);
						$pos = strpos($str, $match['0']);
						if ($pos !== false)
						{
							$str = substr_replace($str, $html, $pos, strlen($match['0']));
						}
					}
				}
			}
		}

		// closing tag
		if (preg_match_all($this->params->regex_end, $str, $matches, PREG_SET_ORDER) > 0)
		{
			$html = array();
			$html[] = '<div style="clear:both;"></div>';
			$html[] = '</div></div></div>';
			$html[] = '<div style="height:1px;"></div>';
			$html[] = '</div>';
			if ($active_url)
			{
				$html[] = '<script type="text/javascript">';
				$html[] = 'nn_sliders_url = \'' . $active_url . '\';';
				$html[] = '</script>';
			}
			$html = implode("\n", $html);
			foreach ($matches as $match)
			{
				$m_html = $html;
				list($pre, $post) = NNTags::setSurroundingTags($match['1'], $match['2']);
				$m_html = $pre . $m_html . $post;
				$str = str_replace($match['0'], $m_html, $str);
			}
		}

		// link tag
		if (preg_match_all($this->params->regex_link, $str, $matches, PREG_SET_ORDER) > 0)
		{
			foreach ($matches as $match)
			{
				$linkitem = 0;
				$names = NNText::createUrlMatches(array($match['1']));
				foreach ($names as $name)
				{
					if (is_numeric($name))
					{
						foreach ($this->allitems as $item)
						{
							if (in_array($name, $item->matches, 1) || in_array((int) $name, $item->matches, 1))
							{
								$linkitem = $item;
								break;
							}
						}
					}
					else
					{
						foreach ($this->allitems as $item)
						{
							if (in_array($name, $item->matches, 1) || in_array(strtolower($name), $item->matches, 1))
							{
								$linkitem = $item;
								break;
							}
						}
					}
					if ($linkitem)
					{
						break;
					}
				}
				if ($linkitem)
				{
					$href = NNText::getURI($linkitem->id);
					$link = '<a href="' . $href . '"'
						. ' class="nn_sliders_link nn_sliders_link_' . $linkitem->alias . '"'
						. ' rel="' . $linkitem->id . '">' . $match['2'] . '</a>';
				}
				else
				{
					$href = NNText::getURI($name);
					$link = '<a href="' . $href . '">' . $match['2'] . '</a>';
				}
				$str = str_replace($match['0'], $link, $str);
			}
		}

		NNProtect::unprotect($str);
	}

	function createId($alias)
	{
		$id = $alias;

		$i = 1;
		while (in_array($id, $this->ids))
		{
			$id = $alias . '-' . ++$i;
		}

		$this->ids[] = $id;

		return $id;
	}

	function protect(&$str)
	{
		NNProtect::protectFields($str);
		NNProtect::protectSourcerer($str);
	}

	function protectTags(&$str)
	{
		NNProtect::protectTags($str, $this->params->protected_tags);
	}

	function unprotectTags(&$str)
	{
		NNProtect::unprotectTags($str, $this->params->protected_tags);
	}

	/**
	 * Just in case you can't figure the method name out: this cleans the left-over junk
	 */
	function cleanLeftoverJunk(&$str)
	{
		$this->unprotectTags($str);

		NNProtect::removeFromHtmlTagContent($str, $this->params->protected_tags);
		NNProtect::removeInlineComments($str, 'Sliders');
	}
}
