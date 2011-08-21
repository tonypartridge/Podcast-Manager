<?php
/**
* Podcast Manager for Joomla!
*
* @package     PodcastManager
* @subpackage  files_podcastmanager_minima
*
* @copyright   Copyright (C) 2011 Michael Babker. All rights reserved.
* @license     GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*
* Podcast Manager is based upon the ideas found in Podcast Suite created by Joe LeBlanc
* Original copyright (c) 2005 - 2008 Joseph L. LeBlanc and released under the GPLv2 license
*/

defined('_JEXEC') or die;

$app	= JFactory::getApplication();
$style	= $app->getUserStateFromRequest('podcastmedia.list.layout', 'layout', 'thumbs', 'word');
?>
<div id="submenu-box">
	<div class="submenu-box">
		<div class="submenu-pad">
			<ul id="submenu" class="media">
				<li><a href="index.php?option=com_podcastmanager&amp;view=feeds"><?php echo JText::_('COM_PODCASTMEDIA_SUBMENU_FEEDS'); ?></a></li>
				<li><a href="index.php?option=com_podcastmanager&amp;view=podcasts"><?php echo JText::_('COM_PODCASTMEDIA_SUBMENU_PODCASTS'); ?></a></li>
				<li><a id="thumbs" onclick="PodcastMediaManager.setViewType('thumbs')" class="<?php echo ($style == "thumbs") ? 'active' : '';?>">
				<?php echo JText::_('COM_PODCASTMEDIA_SUBMENU_FILES'); ?></a></li>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>
</div>
