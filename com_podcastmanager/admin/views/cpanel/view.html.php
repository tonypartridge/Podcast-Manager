<?php
/**
* Podcast Manager for Joomla!
*
* @copyright	Copyright (C) 2011 Michael Babker. All rights reserved.
* @license		GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*
* Podcast Manager is based upon the ideas found in Podcast Suite created by Joe LeBlanc
* Original copyright (c) 2005 - 2008 Joseph L. LeBlanc and released under the GPLv2 license
*/

// Restricted access
defined('_JEXEC') or die;

// Load framework base classes
jimport('joomla.application.component.view');

class PodcastManagerViewCpanel extends JView
{
	public function display($tpl = null)
	{
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$document = JFactory::getDocument();
		$document->setBuffer($this->loadTemplate('navigation'), 'modules', 'submenu');

		// Add the component media
		JHtml::stylesheet('administrator/components/com_podcastmanager/media/css/template.css', false, false, false);

		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return	void
	 * @since	1.8
	 */
	protected function addToolbar()
	{
		$canDo	= PodcastManagerHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PODCASTMANAGER'), 'podcastmanager.png');

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_podcastmanager');
		}
	}
}