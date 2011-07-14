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
defined('_JEXEC') or die();

jimport('joomla.application.component.modeladmin');

class PodcastManagerModelPodcast extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 */
	protected $text_prefix = 'COM_PODCASTMANAGER';

	/**
	 * Model context string.
	 *
	 * @var		string	The context of the model
	 */
	protected $_context		= 'com_podcastmanager.podcast';

	/**
	 * Custom clean cache method
	 *
	 * @param	string	$group		The component name
	 * @param	int		$client_id	The client ID
	 *
	 * @return	void
	 * @since	1.7
	 */
	function cleanCache($group = 'com_podcastmanager', $client_id = 1)
	{
		parent::cleanCache($group, $client_id);
	}

	/**
	 * Method to process the file through the getID3 library to extract key data
	 *
	 * @param	mixed	$data	The data object for the form
	 *
	 * @return	mixed	$data	The processed data for the form.
	 * @since	1.6
	 */
	protected function fillMetaData($data)
	{
		jimport('getid3.getid3');
		define('GETID3_HELPERAPPSDIR', JPATH_LIBRARIES.DS.'getid3');

		$filename	= $_COOKIE['podManFile'];
		if (!preg_match('/^http/', $filename)) {
			$filename	= JPATH_ROOT.'/'.$filename;
		}
		$getID3		= new getID3($filename);
		$fileInfo	= $getID3->analyze($filename);

		// Set the filename field (fallback for if session data doesn't retain)
		$data->filename	= $filename;

		if (isset($fileInfo['tags_html'])) {
			$t = $fileInfo['tags_html'];
			$tags = isset($t['id3v2']) ? $t['id3v2'] : (isset($t['id3v1']) ? $t['id3v1'] : (isset($t['quicktime']) ? $t['quicktime'] : null));
			if ($tags) {
				// Set the title field
				if (isset($tags['title'])) {
					$data->title = $tags['title'][0];
				}
				// Set the album field
				if (isset($tags['album'])) {
					$data->itSubtitle = $tags['album'][0];
				}
				// Set the artist field
				if (isset($tags['artist'])) {
					$data->itAuthor = $tags['artist'][0];
				}
			}
		}

		// Set the duration field
		if (isset($fileInfo['playtime_string'])) {
			$data->itDuration = $fileInfo['playtime_string'];
		}
		return $data;
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 *
	 * @return	mixed	$form		A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_podcastmanager.podcast', 'podcast', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data)) {
			// Disable fields for display.
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('published', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('published', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Returns a JTable object, always creating it.
	 *
	 * @param	string	$type	The table type to instantiate
	 * @param	string	$prefix	A prefix for the table class name. Optional.
	 * @param	array	$config	Configuration array for model. Optional.
	 *
	 * @return	JTable	A database object
	*/
	public function getTable($type = 'Podcast', $prefix = 'PodcastManagerTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	$data	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_podcastmanager.edit.podcast.data', array());

		if (empty($data)) {
			$data = $this->getItem();
			// If changing the selected file, process the new data through getID3
			if (isset($_COOKIE['podManFile'])) {
				$data = $this->fillMetaData($data);
			}
		}
		return $data;
	}

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param	JTable	$table	A JTable object.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function prepareTable(&$table)
	{
		// Set the publish date to now
		if($table->published == 1 && intval($table->publish_up) == 0) {
			$table->publish_up = JFactory::getDate()->toMySQL();
		}
	}
}
