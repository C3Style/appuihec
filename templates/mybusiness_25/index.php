<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$siteName = $this->params->get('siteName');
$logo	 = $this->params->get('logo',$this->baseurl .'/templates/'.$this->template.'/images/logo.png');
$spotlight_image  = $this->params->get('spotlight_image',$this->baseurl .'/templates/'.$this->template.'/images/spotlight.jpg');
class tjC {
function isFrontPage(){
		return (JRequest::getCmd('option')=='com_content' && !JRequest::getInt('id'));
	}
}
$TJ = new tjC($this);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by ThemesJoomla.com
http://www.themesjoomla.com
Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_css.css" type="text/css" />
</head>
<body>
<div id="top">
  <div id="top-cover">
    <div id="logo"><a href="<?php echo $this->baseurl ?>" title="<?php echo $siteName; ?>"><img src="<?php echo $logo ?>" border="0" alt="<?php echo $siteName; ?>" /></a></div>
    <div id="topmenu">
      <jdoc:include type="modules" name="mymainmenu"  style="xhtmlxtd" />
    </div>
  </div>
</div>
<div class="container">
  <div id="contentarea">
    <?php if(!$TJ->isFrontPage()) { ?>
    <div id="content">
      <jdoc:include type="message" />
      <jdoc:include type="component" style="xhtml"/>
    </div>
    <div id="right">
      <jdoc:include type="modules" name="myright"  style="xhtml" />
    </div>
    <?php } else { ?>
      <div class="spotlight">
        <?php if($this->params->get('show_spotlight') == 1) { ?>
            <?php if($this->params->get('spotlight_image_link')) { ?>
                <a href="<?php echo $this->params->get('spotlight_image_link'); ?>">
            <?php }?>
                <img src="<?php echo $spotlight_image; ?>" border="0" alt=" " />
            <?php if($this->params->get('spotlight_image_link')) { ?>
                </a>
            <?php }?>
        <?php } ?>
        <jdoc:include type="modules" name="myspotlight"  style="xhtml" />
    </div>
    <?php } ?>
  </div>
  <div id="bottom">
    <div id="user1">
      <jdoc:include type="modules" name="myuser1"  style="xhtml" />
    </div>
    <div id="user2">
      <jdoc:include type="modules" name="myuser2"  style="xhtml" />
    </div>
    <div id="user3">
      <jdoc:include type="modules" name="myuser3"  style="xhtml" />
    </div>
  </div>
  <div id="footer">
    <jdoc:include type="modules" name="mybusiness-footer"  style="xhtml" />
    <p>Copyright &copy; <?php echo $siteName; ?>. All Rights Reserved. <?php echo JText::_('Powered by') ?> <a href="http://www.joomla.org">Joomla!</a>. <?php echo JText::_('Valid') ?> <a href="http://validator.w3.org/check/referer">XHTML</a> <?php echo JText::_('and') ?> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>.
      <!-- You CAN NOT remove (or unreadable) those links without permission. Removing the link and template sponsor Please visit themesjoomla.com or contact with e-mail (webmaster@themesjoomla.com) If you don't want to link back to themesjoomla.com, you can always pay a link removal donation. This will allow you to use the template link free on one domain name. Also, kindly send me the site's url so I can include it on my list of verified users . Please read license.txt -->
      <br />
      <a href="http://www.themesjoomla.com" rel="follow">Joomla Themes</a> by <a  rel="follow" href="http://www.themesjoomla.com"><strong>themesjoomla.com</strong></a></p>
  </div>
</div>

<jdoc:include type="modules" name="debug" />
</body>
</html>