<?php
/**
* Podcast Manager for Joomla!
*
* @copyright	Copyright (C) 2011 Michael Babker. All rights reserved.
* @license		GNU/GPL - http://www.gnu.org/copyleft/gpl.html
* @package		PodcastManager
* @subpackage	files_podcastmanager_hathor
*
* Podcast Manager is based upon the ideas found in Podcast Suite created by Joe LeBlanc
* Original copyright (c) 2005 - 2008 Joseph L. LeBlanc and released under the GPLv2 license
*/

// Restricted access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>
<div class="podcast-edit">

<form action="<?php echo JRoute::_('index.php?option=com_podcastmanager&view=feed&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
<div class="col main-section">
	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_PODCASTMANAGER_VIEW_FEED_FIELDSET_FEED'); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?></li>

			<li><?php echo $this->form->getLabel('subtitle'); ?>
			<?php echo $this->form->getInput('subtitle'); ?></li>

			<li><?php echo $this->form->getLabel('description'); ?>
			<?php echo $this->form->getInput('description'); ?></li>

			<li><?php echo $this->form->getLabel('published'); ?>
			<?php echo $this->form->getInput('published'); ?></li>

			<li><?php echo $this->form->getLabel('copyright'); ?>
			<?php echo $this->form->getInput('copyright'); ?></li>

			<li><?php echo $this->form->getLabel('author'); ?>
			<?php echo $this->form->getInput('author'); ?></li>

			<li><?php echo $this->form->getLabel('image'); ?>
			<?php echo $this->form->getInput('image'); ?></li>

			<li><?php echo $this->form->getLabel('language'); ?>
			<?php echo $this->form->getInput('language'); ?></li>

			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>
		</ul>
	</fieldset>
</div>

<div class="col options-section">
	<?php echo JHtml::_('sliders.start', 'podcastmanager-feed-sliders-'.$this->item->id); ?>
		<?php echo JHtml::_('sliders.panel',JText::_('JGLOBAL_FIELDSET_PUBLISHING'), 'publishing-details'); ?>
		<fieldset class="panelform">
		<legend class="element-invisible"><?php echo JText::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></legend>
		<ul class="adminformlist">

			<li><?php echo $this->form->getLabel('created'); ?>
			<?php echo $this->form->getInput('created'); ?></li>

			<li><?php echo $this->form->getLabel('publish_up'); ?>
			<?php echo $this->form->getInput('publish_up'); ?></li>

			<?php if ($this->item->modified_by) : ?>
			<li><?php echo $this->form->getLabel('modified_by'); ?>
			<?php echo $this->form->getInput('modified_by'); ?></li>

			<li><?php echo $this->form->getLabel('modified'); ?>
			<?php echo $this->form->getInput('modified'); ?></li>
			<?php endif; ?>

		</ul>

		</fieldset>

		<?php echo JHtml::_('sliders.panel',JText::_('COM_PODCASTMANAGER_FIELDSET_ITUNES_OPTIONS'), 'itunes-options'); ?>
		<fieldset class="panelform">
		<legend class="element-invisible"><?php echo JText::_('COM_PODCASTMANAGER_FIELDSET_ITUNES_OPTIONS'); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('block'); ?>
			<?php echo $this->form->getInput('block'); ?></li>

			<li><?php echo $this->form->getLabel('explicit'); ?>
			<?php echo $this->form->getInput('explicit'); ?></li>

			<li><?php echo $this->form->getLabel('category1'); ?>
			<?php echo $this->form->getInput('category1'); ?></li>

			<li><?php echo $this->form->getLabel('category2'); ?>
			<?php echo $this->form->getInput('category2'); ?></li>

			<li><?php echo $this->form->getLabel('category3'); ?>
			<?php echo $this->form->getInput('category3'); ?></li>

			<li><?php echo $this->form->getLabel('ownername'); ?>
			<?php echo $this->form->getInput('ownername'); ?></li>

			<li><?php echo $this->form->getLabel('owneremail'); ?>
			<?php echo $this->form->getInput('owneremail'); ?></li>

			<li><?php echo $this->form->getLabel('keywords'); ?>
			<?php echo $this->form->getInput('keywords'); ?></li>
		</ul>

		</fieldset>
	<?php echo JHtml::_('sliders.end'); ?>
	</div>
	<div class="clr"></div>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
</div>

