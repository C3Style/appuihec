<?php
/*------------------------------------------------------------------------
# mod_rizvn_support - Module RizVN Support
# ------------------------------------------------------------------------
# Author: Phuoc Nguyen
# copyright Copyright (C) 2011 RizVN.Net. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.rizvn.net
# Technical Support: Mail - rizvn93@gmail.com
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die;
$style = ($params->get('style'));
$top = ($params->get('top')); 
JHtml::_('behavior.keepalive');
?>
<link rel="stylesheet" href="<?php echo JURI::base().'modules/mod_rizlogin/'; ?>style/<?php echo $style; ?>/css.css" type="text/css" />
<div id="rizsideBar2" style="top:<?php echo $top; ?>px">
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
<a id="sideBarTab2" onclick="rizslide();"><img src="<?php echo JURI::base().'modules/mod_rizlogin/'; ?>style/<?php echo $style; ?>/slide-button-o.gif" alt="RizVN Login" title="RizVN Login" /></a>
	
	<div id="sideBarContents" style="width:0px;">
		<div id="sideBarContentsInner">
	<div style="color:#fff; padding-right: 30px; text-align: center;"><br><br>
		<span style="font-weight: bold;">
		<?php if($params->get('name') == 0) : {
		echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('name'));
	} else : {
		echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('username'));
	} endif; ?></span> <br><br><br>
	
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
	</div>

	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>	
</form>
<?php else : ?>

	
	<a id="sideBarTab2" onclick="rizslide();"><img src="<?php echo JURI::base().'modules/mod_rizlogin/'; ?>style/<?php echo $style; ?>/slide-button.gif" alt="RizVN Login" title="RizVN Login" /></a>
	
	<div id="sideBarContents" style="width:0px;">
		<div id="sideBarContentsInner">
<div style="color:#fff; padding-right: 20px; text-align: left;">	

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
	<?php if ($params->get('pretext')): ?>
		<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<fieldset class="userdata">
	<p id="form-login-username">
		<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label><br />
		<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" />
	</p>
	<p id="form-login-password">
		<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label><br />
		<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"  />
	</p>
	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
	<p id="form-login-remember">
		<label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
		<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
	</p>
	<?php endif; ?>
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	</fieldset>
	<ul>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
		</li>
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
	<?php if ($params->get('posttext')): ?>
		<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
</div>
<?php endif; ?>
</div></div></div>
<script>
$.noConflict();
</script>