<?php
/**
 *------------------------------------------------------------------------------
 *  iCagenda v3 by Jooml!C - Events Management Extension for Joomla! 2.5 / 3.x
 *------------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @version     3.3.4 2014-04-23
 * @since       1.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$app = JFactory::getApplication();

// Access Administration Events check.
if (JFactory::getUser()->authorise('icagenda.access.events', 'com_icagenda'))
{

	$bootstrapType		= '1';

	$EventTag			= 'event';
	$EventTitle			= JText::_('COM_ICAGENDA_TITLE_EVENT', true);

	$DatesTag			= 'dates';
	$DatesTitle			= JText::_('COM_ICAGENDA_LEGEND_DATES', true);

	$DescTag			= 'desc';
	$DescTitle			= JText::_('COM_ICAGENDA_LEGEND_DESC', true);

	$InfosTag			= 'infos';
	$InfosTitle			= JText::_('COM_ICAGENDA_LEGEND_INFORMATION', true);

	$GooglemapTag		= 'googlemap';
	$GooglemapTitle		= JText::_('COM_ICAGENDA_LEGEND_GOOGLE_MAPS', true);

	$OptionsTag			= 'options';
	$OptionsTitle		= JText::_('JOPTIONS', true);

	$PublishingTag		= 'publishing';
	$PublishingTitle	= JText::_('JGLOBAL_FIELDSET_PUBLISHING', true);

	if(version_compare(JVERSION, '3.0', 'lt')) {

		jimport( 'joomla.html.html.tabs' );

		$iCmapDisplay='3';

		$icPanEvent=JText::_('COM_ICAGENDA_TITLE_EVENT', true);
		$icPanDates=JText::_('COM_ICAGENDA_LEGEND_DATES', true);
		$icPanDesc=JText::_('COM_ICAGENDA_LEGEND_DESC', true);
		$icPanInfos=JText::_('COM_ICAGENDA_LEGEND_INFORMATION', true);
		$icPanGooglemap=JText::_('COM_ICAGENDA_LEGEND_GOOGLE_MAPS', true);
		$icPanOptions=JText::_('JOPTIONS', true);
		$icPanPublishing=JText::_('JGLOBAL_FIELDSET_PUBLISHING', true);
		$startPane='tabs.start';
		$addPanel='tabs.panel';
		$endPanel='tabs.end';
		$endPane='tabs.end';
		$EventTag1=$EventTag;
		$EventTag2=$EventTitle;
		$DatesTag1=$DatesTag;
		$DatesTag2=$DatesTitle;
		$DescTag1=$DescTag;
		$DescTag2=$DescTitle;
		$InfosTag1=$InfosTag;
		$InfosTag2=$InfosTitle;
		$GooglemapTag1=$GooglemapTag;
		$GooglemapTag2=$GooglemapTitle;
		$OptionsTag1=$OptionsTag;
		$OptionsTag2=$OptionsTitle;
		$PublishingTag1=$PublishingTag;
		$PublishingTag2=$PublishingTitle;

	} else {

		JHtml::_('formbehavior.chosen', 'select');
		jimport('joomla.html.html.bootstrap');

		$icPanEvent='icTab';
		$icPanDates='icTab';
		$icPanDesc='icTab';
		$icPanInfos='icTab';
		$icPanGooglemap='icTab';
		$icPanOptions='icTab';
		$icPanPublishing='icTab';

		if ($bootstrapType == '1') {
			$iCmapDisplay='1';
			$startPane='bootstrap.startTabSet';
			$addPanel='bootstrap.addTab';
			$endPanel='bootstrap.endTab';
			$endPane='bootstrap.endTabSet';
			$EventTag1=$EventTag;
			$EventTag2=$EventTitle;
			$DatesTag1=$DatesTag;
			$DatesTag2=$DatesTitle;
			$DescTag1=$DescTag;
			$DescTag2=$DescTitle;
			$InfosTag1=$InfosTag;
			$InfosTag2=$InfosTitle;
			$GooglemapTag1=$GooglemapTag;
			$GooglemapTag2=$GooglemapTitle;
			$OptionsTag1=$OptionsTag;
			$OptionsTag2=$OptionsTitle;
			$PublishingTag1=$PublishingTag;
			$PublishingTag2=$PublishingTitle;
		}
		elseif ($bootstrapType == '2') {
			$iCmapDisplay='2';
			$startPane='bootstrap.startAccordion';
			$addPanel='bootstrap.addSlide';
			$endPanel='bootstrap.endSlide';
			$endPane='bootstrap.endAccordion';
			$EventTag1=$EventTitle;
			$EventTag2=$EventTag;
			$DatesTag1=$DatesTitle;
			$DatesTag2=$DatesTag;
			$DescTag1=$DescTitle;
			$DescTag2=$DescTag;
			$InfosTag1=$InfosTitle;
			$InfosTag2=$InfosTag;
			$GooglemapTag1=$GooglemapTitle;
			$GooglemapTag2=$GooglemapTag;
			$OptionsTag1=$OptionsTitle;
			$OptionsTag2=$OptionsTag;
			$PublishingTag1=$PublishingTitle;
			$PublishingTag2=$PublishingTag;
		}
	}

	$params = $this->form->getFieldsets('params');

	// ZOOM
	$zoom='1';
	// HYBRID, ROADMAP, SATELLITE, TERRAIN
	$mapTypeId='ROADMAP';

	$coords='0, 0';
	$oldcoordinate=$this->item->coordinate;
	$lat=$this->item->lat;
	$lng=$this->item->lng;
	if (($oldcoordinate == NULL) && ($lat == '0') && ($lng == '0')) { $zoom='1'; }
	//if (($lat == 0) && ($lng == 0)) { $zoom='1'; }
	//$coords=''.$lat.', '.$lng.'';

	// Notes: 	zoomControl: false, mapTypeControl: false

	// Control of dates if valid (Alert Messages)
	$messagealert='';
	$alert='';
	$nodate='0000-00-00 00:00:00';
	$nextget = $this->item->next;

	if (($nextget=='-3600') OR ($nextget==$nodate)) {
		$messagealert= '<div><h4><b>'.JText::_('COM_ICAGENDA_FORM_ALERT_UNPUBLISHED').'</b></h4></div>';

		if (($this->item->startdate == $nodate) && ($this->item->enddate != $nodate)) {
			$messagealert.= '<p>'.JText::_('COM_ICAGENDA_FORM_ERROR_NO_STARTDATE').'</p><br>';
		}
		if (($this->item->enddate == $nodate) && ($this->item->startdate != $nodate)) {
			$messagealert.= '<p>'.JText::_('COM_ICAGENDA_FORM_ERROR_NO_ENDDATE').'</p><br>';
		}
		if (($this->item->enddate < $this->item->startdate) && (($this->item->next!='-3600') OR ($this->item->next!=$nodate))) {
			$messagealert.= '<p>'.JText::_('COM_ICAGENDA_FORM_ERROR_INVALID_PERIOD').'</p><br>';
		}
	}

	else {

		if (($this->item->startdate == $nodate) && ($this->item->enddate != $nodate)) {
			$alert.= '<p>'.JText::_('COM_ICAGENDA_FORM_ERROR_NO_STARTDATE').'</p><br>';
		}
		if (($this->item->enddate == $nodate) && ($this->item->startdate != $nodate)) {
			$alert.= '<p>'.JText::_('COM_ICAGENDA_FORM_ERROR_NO_ENDDATE').'</p><br>';
		}
		if (($this->item->enddate < $this->item->startdate) && (($this->item->next!='-3600') OR ($this->item->next!=$nodate))) {
			$alert.= '<p>'.JText::_('COM_ICAGENDA_FORM_ERROR_INVALID_PERIOD').'</p><br>';
		}
	}

	JText::script('COM_ICAGENDA_FORM_NO_DATES_ALERT');

	?>

	<script type="text/javascript">

		Joomla.submitbutton = function(task)
		{
			function strpos (haystack, needle, offset) {
				// http://kevin.vanzonneveld.net
				// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
				// +   improved by: Onno Marsman
				// +   bugfixed by: Daniel Esteban
				// +   improved by: Brett Zamir (http://brett-zamir.me)
				// *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
				// *     returns 1: 14
				var i = (haystack + '').indexOf(needle, (offset || 0));
				return i === -1 ? false : i;
			}
			var nodate = '0';

			var noserialdate = 'a:1:{i:0;s:19:"0000-00-00 00:00:00";}';
			var startDate = document.getElementById('startdate');
			var endDate = document.getElementById('enddate');
			var Dates = document.getElementById('jform_dates_id');
			var strpostest = strpos(Dates.value, nodate, 2);

			if (((!strpostest) || (Dates.value == '')) && (startDate.value =='') && (task != 'event.cancel')) {
				alert(Joomla.JText._('COM_ICAGENDA_FORM_NO_DATES_ALERT'));
				return false;
			}

			if (task == 'event.cancel' || document.formvalidator.isValid(document.id('event-form'))) {

				// do field validation
				Joomla.submitform(task, document.getElementById('event-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
			}
		}
	</script>

	<form action="<?php echo JRoute::_('index.php?option=com_icagenda&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="event-form" class="form-validate" enctype="multipart/form-data">
		<div class="container">

			<!-- iCheader top bar -->
			<!--div class="iCheader-top">
				<a href="#">
					<strong>&laquo; Previous </strong>event
				</a>
				<span class="right">
					<a href="#">
						<strong>Next</strong> event <strong>&raquo;</strong>
					</a>
				</span>
				<div class="clr"></div>
			</div-->
			<!--/ iCheader top bar -->


			<!-- iCagenda Header -->
			<header>
				<h1>
				<?php
				if (empty($this->item->id))
				{
					echo '<input type="hidden" value="1" name="new_event" />';
				}
				else
				{
					echo '<input type="hidden" value="0" name="new_event" />';
				}
				echo empty($this->item->id) ? JText::_('COM_ICAGENDA_LEGEND_NEW_EVENT') : JText::sprintf('COM_ICAGENDA_LEGEND_EDIT_EVENT', $this->item->id);
				?>
				<span>iCagenda</span></h1>
				<h2>
					<?php echo JText::_('COM_ICAGENDA_COMPONENT_DESC'); ?>
					<!--nav class="iCheader-videos">
						<span style="font-variant:small-caps">Tutorial Videos</span>
						<a href="#">Add a event</a>
						<a href="#">Video 2</a>
						<a href="#">Video 3</a>
					</nav-->
				</h2>
			</header>

			<div>&nbsp;</div>


			<!-- Alert Messages -->
			<div>
				<?php if ($messagealert) :?>
				<div style="background: #990000; color: #FFFFFF; border-radius: 10px; border: 1px solid #D4D4D4; padding: 20px; margin-bottom:20px;"><?php echo '<h2>'.JText::_('COM_ICAGENDA_FORM_WARNING').'</h2>'.$messagealert; ?></div>
				<?php endif; ?>
				<?php if (($alert) and (!$messagealert)) :?>
				<div style="background: #FFFFFF; color: red; border-radius: 10px; border: 1px solid #D4D4D4; padding: 10px; margin-bottom:20px;"><b><?php echo $alert; ?></b></div>
				<?php endif; ?>
			</div>


			<!-- Begin Content -->
			<div class="row-fluid">
				<div class="span10 form-horizontal">

					<!-- Open Panel Set -->
					<?php echo JHtml::_($startPane, 'icTab', array('active' => 'event')); ?>

						<!-- Panel Event -->
						<?php echo JHtml::_($addPanel, $icPanEvent, $EventTag1, $EventTag2); ?>

							<div class="icpanel iCleft">
								<h1><?php echo empty($this->item->id) ? JText::_('COM_ICAGENDA_LEGEND_NEW_EVENT') : JText::sprintf('COM_ICAGENDA_LEGEND_EDIT_EVENT', $this->item->id); ?></h1>
								<hr>
								<div class="row-fluid">
									<div class="span6 iCleft">
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('title'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('title'); ?>
											</div>
										</div>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('catid'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('catid'); ?>
											</div>
										</div>
									</div>
									<div class="span6 iCleft">
										<?php //if ($this->item->id) : ?>
										<div class="control-group">
											<div>
												<!--img src="../<?php echo $this->item->image; ?>" style="float:right; max-width:100%; max-height:350px;" /-->
												<img src="" alt="" id="jform_image_preview" class="media-preview" style="float:right; max-width:100%; max-height:350px;">
											</div>
										</div>
										<?php //endif; ?>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('image'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('image'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>


						<?php
						if(version_compare(JVERSION, '3.0', 'ge')) {
							echo JHtml::_($endPanel);
						}
						?>

						<!-- Panel Dates -->
						<?php echo JHtml::_($addPanel, $icPanDates, $DatesTag1, $DatesTag2); ?>

							<div class="icpanel iCleft">
								<h1><?php echo JText::_('COM_ICAGENDA_LEGEND_DATES'); ?></h1>
								<hr>
								<div class="row-fluid">
									<div class="span6 iCleft">
										<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_PERIOD_DATES'); ?></h3>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('startdate'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('startdate'); ?>
											</div>
										</div>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('weekdays'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('weekdays'); ?>
											</div>
										</div>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('next'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('next'); ?>
											</div>
										</div>
										<!--div class="control-group">
										</div-->
									</div>
									<div class="span6 iCleft">
										<h3>&nbsp;</h3>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('enddate'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('enddate'); ?>
											</div>
										</div>
										<!--div class="control-group">
										</div-->
									</div>
								</div>
								<hr>
								<div class="row-fluid">
									<div class="span6 iCleft">
										<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_SINGLE_DATES'); ?></h3>
										<div class="control-group">
											<?php echo $this->form->getInput('dates'); ?>
										</div>
									</div>
								</div>
								<hr>
								<div class="row-fluid">
									<div class="span6 iCleft">
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('displaytime'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('displaytime'); ?>
											</div>
										</div>
									</div>
								</div>
								<hr>

								<?php
								echo '<fieldset style="margin:0">'
									.JHtml::_('sliders.start', 'info-slider', array('useCookie'=>0, 'startOffset'=>-1, 'startTransition'=>1))
									.JHtml::_('sliders.panel', JText::_('COM_ICAGENDA_DATES_HELP'), 'slide1')
									.'<fieldset class="panelform" >'
									.'<ul class="adminformlist" style="color:#555555;">'
									.'<div>'. JText::_('COM_ICAGENDA_DATES_HELP_INTRO').'</div><br>'
									.'<div style="text-transform:uppercase;"><b>'. JText::_('COM_ICAGENDA_LEGEND_SINGLE_DATES').'</b></div>'
									.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE1').'</b></div>'
									.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE1').'</i></div><br>'
									.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE2').'</b></div>'
									.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE2').'</i></div><br>'
									.'<div style="text-transform:uppercase;"><b>'. JText::_('COM_ICAGENDA_LEGEND_PERIOD_DATES').'</b></div>'
									.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE3').'</b></div>'
									.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE3').'</i></div><br>'
									.'<div style="text-transform:uppercase;"><b>'. JText::_('COM_ICAGENDA_LEGEND_PERIOD_DATES').' & '. JText::_('COM_ICAGENDA_LEGEND_SINGLE_DATES').'</b></div>'
									.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE4').'</b></div>'
									.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE4').'</i></div><br>'
									.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE5').'</b></div>'
									.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE5').'</i></div><br>'
									.'</ul>'
									.'</fieldset>'
									.JHtml::_('sliders.end')
									.'<br />';
								?>
							</div>

						<?php
						if(version_compare(JVERSION, '3.0', 'ge')) {
							echo JHtml::_($endPanel);
						}
						?>

						<!-- Panel Description -->
						<?php echo JHtml::_($addPanel, $icPanDesc, $DescTag1, $DescTag2); ?>

							<div class="icpanel iCleft">
								<h1><?php echo JText::_('COM_ICAGENDA_LEGEND_DESC'); ?></h1>
								<hr>
								<div class="row-fluid">
									<h3><?php echo JText::_('COM_ICAGENDA_FORM_DESC_EVENT_DESC'); ?></h3>
									<?php echo $this->form->getInput('desc'); ?>
								</div>
								<hr>
								<div class="row-fluid">
									<h3><?php echo JText::_('COM_ICAGENDA_FORM_EVENT_METADESC_LBL'); ?></h3>
									<div class="alert alert-info"><?php echo JText::_('COM_ICAGENDA_FORM_EVENT_METADESC_DESC'); ?></div><?php echo $this->form->getInput('metadesc'); ?>
								</div>
							</div>

						<?php
						if(version_compare(JVERSION, '3.0', 'ge')) {
							echo JHtml::_($endPanel);
						}
						?>

						<!-- Panel Information -->
						<?php echo JHtml::_($addPanel, $icPanInfos, $InfosTag1, $InfosTag2); ?>

							<div class="icpanel iCleft">
								<h1><?php echo JText::_('COM_ICAGENDA_LEGEND_INFORMATION'); ?></h1>
								<hr>
								<div class="row-fluid">
									<div class="span6 iCleft">
										<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_VENUE'); ?></h3>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('place'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('place'); ?>
											</div>
										</div>
										<hr>
										<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_CONTACT'); ?></h3>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('email'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('email'); ?>
											</div>
										</div>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('phone'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('phone'); ?>
											</div>
										</div>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('website'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('website'); ?>
											</div>
										</div>
										<hr>
									</div>
									<div class="span6 iCleft">
										<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_ALLEG'); ?></h3>
										<div class="control-group">
											<div class="control-label">
												<?php echo $this->form->getLabel('file'); ?>
											</div>
											<div class="controls">
												<?php echo $this->form->getInput('file'); ?>
											</div>
										</div>
										<hr>
									</div>
								</div>
							</div>

						<?php
						if(version_compare(JVERSION, '3.0', 'ge')) {
							echo JHtml::_($endPanel);
						}
						?>

						<!-- Panel Google Maps -->
						<?php echo JHtml::_($addPanel, $icPanGooglemap, $GooglemapTag1, $GooglemapTag2); ?>

					<div class="icpanel iCleft" id="googlemap">
						<h1><?php echo JText::_('COM_ICAGENDA_LEGEND_GOOGLE_MAPS'); ?></h1>
						<hr>
						<div class="row-fluid">
							<div class="span6 iCleft">

							<h3><?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_SUBTITLE_LBL'); ?></h3>
							<div>
								<?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_NOTE1'); ?>
								<br/>
								<?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_NOTE2'); ?><br/>
							</div>
							<!--div class='clearfix'-->
							<div class="icmap-box">

								<div class="control-group">
									<div class="control-label">
										<?php echo $this->form->getLabel('address'); ?>
									</div>
									<div class="controls">
										<?php echo $this->form->getInput('address'); ?>
									</div>
								</div>
								<div class="icmap-input">
									<?php echo $this->form->getInput('city'); ?>
								</div>
								<div class="icmap-input">
									<?php echo $this->form->getInput('country'); ?>
								</div>
								<div class="icmap-input">
									<?php echo $this->form->getInput('lat'); ?>
								</div>
								<div class="icmap-input">
									<?php echo $this->form->getInput('lng'); ?>
								</div>
								<!--label>District: </label> <input id="administrative_area_level_2" disabled=disabled> <br/>
								<label>State/Province: </label> <input id="administrative_area_level_1" disabled=disabled> <br/-->
								<!--label>route: </label> <input id="route"> <br/>
								<label>Postal Code: </label> <input id="postal_code" disabled=disabled> <br/>
								<label>type: </label> <input id="type" disabled=disabled> <br/-->

							</div>
						</div>
						<div class="span6 iCleft">
							<div class='map-wrapper'>
								<h3>Map</h3>
								<label id="geo_label" for="reverseGeocode"><?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_REVERSE'); ?></label>
								<select id="reverseGeocode">
									<option value="false" selected><?php echo JText::_('JNO'); ?></option>
									<option value="true"><?php echo JText::_('JYES'); ?></option>
								</select><br/>

								<div id="map"></div>
								<div id="legend"><?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_LEGEND'); ?></div>
							</div>
						</div>

						<!--div class='input-positioned'>
							<label>Callback: </label>
							<textarea id='callback_result' rows="15"></textarea>
						</div-->
					</div>
				</div>

				<?php
				if(version_compare(JVERSION, '3.0', 'ge')) {
					echo JHtml::_($endPanel);
				}
				?>

				<?php
				echo JHtml::_($addPanel, $icPanOptions, $OptionsTag1, $OptionsTag2);
				?>
				<div class="icpanel iCleft">
					<h1><?php echo JText::_('JOPTIONS'); ?></h1>
					<hr>
					<div class="row-fluid">
					<?php foreach ($params as $name => $fieldSet) : ?>
							<?php if (isset($fieldSet->description) && trim($fieldSet->description)) : ?>
								<p class="tip"><?php echo $this->escape(JText::_($fieldSet->description));?></p>
							<?php endif; ?>
						<div class="span6 iCleft">
						<h3><?php echo $this->escape(JText::_($fieldSet->label)); ?></h3>
						<?php

						foreach ($this->form->getFieldset($name) as $field) : ?>
							<div class="control-group">
								<div class="control-label">
									<?php echo $field->label; ?>
								</div>
								<div class="controls">
									<?php
									$language = JFactory::getLanguage();
									$language->load('com_icagenda', JPATH_SITE, 'en-GB', true);
									$language->load('com_icagenda', JPATH_SITE, null, true);
										if (($field->name == 'jform[params][statutReg]') && ($field->value == '2')) {
											echo '<select name="jform[params][statutReg]">';
											echo '<option value="">' . JText::_('JGLOBAL_USE_GLOBAL') . '</option>';
											echo '<option value="0" selected>' . JText::_('JOFF') . '</option>';
											echo '<option value="1">' . JText::_('JON') . '</option>';
											echo '</select>';
										} elseif ($field->name == 'jform[params][maxRlistGlobal]') {
										 	if ($field->value == '1') {
												echo '<select name="jform[params][maxRlistGlobal]">';
												echo '<option value="" selected>' . JText::_('JGLOBAL_USE_GLOBAL') . '</option>';
												echo '<option value="2">' . JText::_('COM_ICAGENDA_LBL_CUSTOM_VALUE') . '</option>';
												echo '</select>';
											}
										 	elseif ($field->value == '0') {
												echo '<select name="jform[params][maxRlistGlobal]">';
												echo '<option value="">' . JText::_('JGLOBAL_USE_GLOBAL') . '</option>';
												echo '<option value="2" selected>' . JText::_('COM_ICAGENDA_LBL_CUSTOM_VALUE') . '</option>';
												echo '</select>';
											}
											else {
												echo $field->input;
											}
										} else {
											echo $field->input;
										}
									?>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
					</div>
				</div>


				<?php
				if(version_compare(JVERSION, '3.0', 'ge')) {
					echo JHtml::_($endPanel);
				}
				?>

				<?php
				echo JHtml::_($addPanel, $icPanPublishing, $PublishingTag1, $PublishingTag2);
				?>
				<div class="icpanel iCleft">
					<h1><?php echo JText::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></h1>
					<hr>
					<div class="row-fluid">
						<div class="span6 iCleft">
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('alias'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('alias'); ?>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('id'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('id'); ?>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('created_by'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('created_by'); ?>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('created_by_alias'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('created_by_alias'); ?>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('created'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('created'); ?>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('checked_out'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('checked_out'); ?>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getLabel('checked_out_time'); ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getInput('checked_out_time'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>



				<?php echo JHtml::_($endPanel); ?>

				<?php echo JHtml::_($endPane, 'icTab'); ?>
			</div>

		<!-- Begin Sidebar -->
			<div class="span2 iCleft">
			<h4><?php echo JText::_('COM_ICAGENDA_TITLE_SIDEBAR_DETAILS'); ?></h4>
			<hr>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('state'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('state'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('approval'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('approval'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('access'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('access'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('language'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('language'); ?>
					</div>
				</div>


			</div>
		<!-- End Sidebar -->
		</div>

		<div class="clr"></div>
		</div>
		<?php
		if ($messagealert)
		{
			$this->item->state=='0';
		}
		?>
		<div>
			<?php
			//	echo $this->form->getValue('title');
			//	$title_value = $this->form->getValue('title');
			//	if ($title_value == ' ') {
			//					JError::raiseWarning( 100, JText::_( 'missing title' ).'<br>' );
			//		return false;
			//	}
			$tokenHTML = str_replace('type="hidden"','id="formAgree" type="checkbox" checked style="display:none"',JHTML::_( 'form.token' ));
			?>
			<?php echo $tokenHTML; ?>

			<input type="hidden" name="task" value="" />
			<?php if (false) echo JHtml::_( 'form.token' ); ?>
		</div>
	</form>

	<script type="text/javascript">
		//<![CDATA[
		var iCmapDisplay = '<?php echo $iCmapDisplay; ?>';

		jQuery(function($) {
			// Tabs
			if (iCmapDisplay=='1') {
				$iCgvar='a[href="#googlemap"]';
				$iCmapShow='shown';
			}
			if (iCmapDisplay=='3') {
				$iCgvar='.googlemap';
				$iCmapShow='click';
			}
			// Slides
			if (iCmapDisplay=='2') {
				$iCgvar='#googlemap';
				$iCmapShow='shown';
			}

			$(''+$iCgvar+'').on(''+$iCmapShow+'', function() {   // When tab is displayed...
//			$('.googlemap').on('click', function (e) {

				var addresspicker = $( "#addresspicker" ).addresspicker();
				var addresspickerMap = $( '#jform_address' ).addresspicker({
					regionBias: "fr",
					updateCallback: showCallback,
					mapOptions: {
						zoom: <?php echo $zoom; ?>,
						center: new google.maps.LatLng(<?php echo $coords; ?>),
						scrollwheel: false,
						mapTypeId: google.maps.MapTypeId.<?php echo $mapTypeId; ?>,
						streetViewControl: false
					},
					elements: {
						map: "#map",
						lat: "#lat",
						lng: "#lng",
						street_number: '#street_number',
						route: '#route',
						locality: '#locality',
						administrative_area_level_2: '#administrative_area_level_2',
						administrative_area_level_1: '#administrative_area_level_1',
						country: '#country',
						postal_code: '#postal_code',
						type: '#type',
					}
				});

				var gmarker = addresspickerMap.addresspicker( "marker");
				gmarker.setVisible(true);
				addresspickerMap.addresspicker( "updatePosition");

				$('#reverseGeocode').change(function(){
					$("#jform_address").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
				});

				function showCallback(geocodeResult, parsedGeocodeResult){
					$('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
				}
			});
		});
		//]]>
	</script>

	<?php
	jimport( 'joomla.environment.request' );

	$document = JFactory::getDocument();

	$document->addStyleSheet( JURI::base().'components/com_icagenda/add/css/icagenda.css' );
	$document->addStyleSheet( JURI::base().'components/com_icagenda/add/css/jquery-ui-1.8.17.custom.css' );
	$document->addStyleSheet( JURI::base().'components/com_icagenda/add/css/icmap.css' );

	if(version_compare(JVERSION, '3.0', 'lt'))
	{
		JHTML::_('stylesheet', 'template.css', 'administrator/components/com_icagenda/add/css/');
		JHTML::_('stylesheet', 'icagenda.j25.css', 'administrator/components/com_icagenda/add/css/');

		JHTML::_('behavior.framework');

		// load jQuery, if not loaded before (NEW VERSION IN 1.2.6)
		$scripts = array_keys($document->_scripts);
		$scriptFound = false;
		$scriptuiFound = false;
		$mapsgooglescriptFound = false;
		for ($i = 0; $i < count($scripts); $i++)
		{
			if (stripos($scripts[$i], 'jquery.min.js') !== false)
			{
				$scriptFound = true;
			}
			// load jQuery, if not loaded before as jquery - added in 1.2.7
			if (stripos($scripts[$i], 'jquery.js') !== false)
			{
				$scriptFound = true;
			}
			if (stripos($scripts[$i], 'jquery-ui.min.js') !== false)
			{
				$scriptuiFound = true;
			}
			if (stripos($scripts[$i], 'maps.google') !== false)
			{
				$mapsgooglescriptFound = true;
			}
		}

		// jQuery Library Loader
		if (!$scriptFound)
		{
			// load jQuery, if not loaded before
			if (!JFactory::getApplication()->get('jquery'))
			{
				JFactory::getApplication()->set('jquery', true);
				// add jQuery
				$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
				$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/jquery.noconflict.js' );
			}
		}

		if (!$scriptuiFound)
		{
			$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		}

		$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/template.js' );
	}
	else
	{
		JHtml::_('bootstrap.framework');
		if(!JFactory::getApplication()->get('jquery')){
			JFactory::getApplication()->set('jquery',true);
			$document = JFactory::getDocument();
			$document->addScript(JURI::root(true)."/libraries/jquery/jquery-2.1.3.min.js");
		}
	}

	// Google Maps api V3
	$doclang = JFactory::getDocument();
	$curlang = $doclang->language;
	$lang = substr($curlang,0,2);
	$document->addScript('https://maps.googleapis.com/maps/api/js?sensor=false&language='.$lang);

	$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/timepicker.js' );
	$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/icdates.js' );
	$document->addScript( JURI::root( true ).'/media/com_icagenda/js/icmap.js' );
}
else
{
	$app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'warning');
	$app->redirect(htmlspecialchars_decode('index.php?option=com_icagenda&view=icagenda'));
}
