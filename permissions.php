<?php

/**
 * @package     JFox
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die;


jimport('joomla.filesystem.folder');
$cparams = JComponentHelper::getParams('com_media');
$config = & JFactory::getConfig();

//to write the permissions of folders
$writeable = '<b><font color="green">' . JText::_('Writable') . '</font></b>';
$unwriteable = '<b><font color="red">' . JText::_('Unwritable') . '</font></b>';

$permissionsfox = '
<div id="jfox_permissions" style="display:none;">
<fieldset><legend> File and Folder permissions </legend>' .
        JText::_('Joomla FTP Layer') . ': ' . $ftp_enable . '<br /> <br />' .
//table
        '<table width="100%">
<thead>
	<tr>
		<th width="70%" style="text-align:left">' .
        JText::_('Directory') .
        '</th>
		<th style="text-align:left">' .
        JText::_('Status') .
        '</th>
	</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
</tfoot>
<tbody>' .
        '<tr> <td class="item"> <strong>' . JText::_('Admin Components') . '</strong> ' . JPATH_ADMINISTRATOR . DS . 'components' . '</td><td >' . (is_writable(JPATH_ADMINISTRATOR . DS . 'components') ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Admin Cache Directory') . '</strong> ' . JPATH_ADMINISTRATOR . DS . 'cache' . '</td><td >' . (is_writable(JPATH_ADMINISTRATOR . DS . 'cache') ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Site Components') . '</strong> ' . JPATH_SITE . DS . 'components' . '</td><td >' . (is_writable(JPATH_SITE . DS . 'components') ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Modules') . '</strong> ' . JPATH_SITE . DS . 'modules' . '</td><td >' . (is_writable(JPATH_SITE . DS . 'modules') ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Plugins') . '</strong> ' . JPATH_SITE . DS . 'plugins' . '</td><td >' . (is_writable(JPATH_SITE . DS . 'plugins') ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Site Cache Directory') . '</strong> ' . JPATH_SITE . DS . 'cache' . '</td><td >' . (is_writable(JPATH_SITE . DS . 'cache') ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Log Directory') . '($log_path) </strong> ' . $config->getValue('config.log_path', JPATH_ROOT . DS . 'log') . '</td><td >' . (is_writable($config->getValue('config.log_path', JPATH_ROOT . DS . 'log')) ? $writeable : $unwriteable ) . '</td></tr>' .
        '<tr> <td class="item"> <strong>' . JText::_('Temp Directory') . '($tmp_path)</strong> ' . $config->getValue('config.tmp_path', JPATH_ROOT . DS . 'tmp') . '</td><td >' . (is_writable($config->getValue('config.tmp_path', JPATH_ROOT . DS . 'tmp')) ? $writeable : $unwriteable ) . '</td></tr>' .
        '</tbody>
</table>
</fieldset>
</div>';
