<?php
/**
* Podcast Manager for Joomla!
*
* @package     PodcastManager
* @subpackage  com_podcastmedia
*
* @copyright   Copyright (C) 2011-2012 Michael Babker. All rights reserved.
* @license     GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*
* Podcast Manager is based upon the ideas found in Podcast Suite created by Joe LeBlanc
* Original copyright (c) 2005 - 2008 Joseph L. LeBlanc and released under the GPLv2 license
*/

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @package     PodcastManager
 * @subpackage  com_podcastmedia
 * @since       1.6
 */
class Com_PodcastMediaInstallerScript
{
	/**
	 * Function to perform changes when component is initially installed
	 *
	 * @param   string               $type    The action being performed
	 * @param   JInstallerComponent  $parent  The class calling this method
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	function postflight($type, $parent)
	{
		$this->removeMenu();
	}

	/**
	 * Function to remove the menu item
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	function removeMenu()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->delete($db->quoteName('#__menu'));
		$query->where($db->quoteName('title') . ' = '.$db->quote('com_podcastmedia'));
		$db->setQuery($query);
		if (!$db->query())
		{
			JError::raiseWarning(1, JText::sprintf('JLIB_INSTALLER_ERROR_SQL_ERROR', $db->stderr(true)));
		}
	}
}
