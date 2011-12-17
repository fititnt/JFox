<?php

/**
 * @package     JFox
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die;

//$app = JFactory::GetApplication();
//$live_site = $app->isAdmin() ? $app->getSiteURL() : JURI::base();
$live_site = JURI::base();

$phpfox = '
<div id="jfox_php" style="display:none;" >
<fieldset><legend>JFoxConsole</legend>
<iframe width=100% frameborder=0 height=100% style="margin-bottom:-3px;" src="' . $live_site . 'index.php?option=com_jfoxconsole&format=raw"></iframe>
</fieldset>
</div>
';


