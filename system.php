<?php

/**
 * @package     JFox
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die;


//URL
$app = JFactory::GetApplication();
//$live_site = $app->isAdmin() ? $app->getSiteURL() : JURI::base();
//$live_site = $app->isAdmin() ? JURI::base() : JURI::base();
//$app->getCfg('ftp_enable') ? $ftp_enable = JTEXT::_('On') : $ftp_enable = JTEXT::_('Off');
//$app->getCfg('gzip') ? $gzip = JTEXT::_('On') : $gzip = JTEXT::_('Off');
//$mailer = $app->getCfg('mailer');
//$app->getCfg('debug') ? $debug = JTEXT::_('On') : $debug = JTEXT::_('Off');
//$app->getCfg('offline') ? $offline = JTEXT::_('On') : $offline = JTEXT::_('Off');
//$lifetime = $app->getCfg('lifetime');


$jsystem = new stdClass();
$jsystem->url = $app->isAdmin() ? JURI::base() : JURI::base();
$jsystem->offline = $app->getCfg('offline') ? $offline = JTEXT::_('On') : $offline = JTEXT::_('Off');
$jsystem->debug = $app->getCfg('debug') ? $debug = JTEXT::_('On') : $debug = JTEXT::_('Off');
$jsystem->sessionLifeTime = $app->getCfg('lifetime');
$jsystem->mailer = $app->getCfg('mailer');
$jsystem->gzip = $app->getCfg('gzip') ? $gzip = JTEXT::_('On') : $gzip = JTEXT::_('Off');
$jsystem->gzip = $app->getCfg('ftp_enable') ? $ftp_enable = JTEXT::_('On') : $ftp_enable = JTEXT::_('Off');


$chromesystem = '<div id="jfox-system">' . json_encode($jsystem) . '</div>';

/*
///           General info about Joomla         
//URL
$app = JFactory::GetApplication();
//$live_site = $app->isAdmin() ? $app->getSiteURL() : JURI::base();
$live_site = $app->isAdmin() ? JURI::base() : JURI::base();

//to take configs
$app = JFactory::getApplication();
$app->getCfg('ftp_enable') ? $ftp_enable = JTEXT::_('On') : $ftp_enable = JTEXT::_('Off');
$app->getCfg('gzip') ? $gzip = JTEXT::_('On') : $gzip = JTEXT::_('Off');
$mailer = $app->getCfg('mailer');
$app->getCfg('debug') ? $debug = JTEXT::_('On') : $debug = JTEXT::_('Off');
$app->getCfg('offline') ? $offline = JTEXT::_('On') : $offline = JTEXT::_('Off');
$lifetime = $app->getCfg('lifetime');


$systemfox = NULL;
$systemfox .= '
<div id="jfox_system" style="display:none;" >
<fieldset><legend> Joomla General </legend>' .
JText::_('Joomla Version') . ': <strong>' . JVERSION . '</strong> | ' .
JText::_('Gzip Compression') . ': <strong>' . $gzip . '</strong> | ' .
JText::_('Mailer') . ': <strong>' . $mailer . '</strong> | ' .
JText::_('Debug') . ': <strong>' . $debug . '</strong> | ' .
JText::_('Offline') . ': <strong>' . $offline . '</strong> | ' .
JText::_('Lifetime') . ': <strong>' . $lifetime . ' ' . JText::_('minutes') . '</strong><br />' .
'</fieldset>';


//                    Security
//Security
$security = NULL;

$config =& JFactory::getConfig();

//Check table prefix
if ($config->get('dbprefix') == 'jos_'){
    $security .= '<span style="color:red;">';
    $security .= '[SQL Injection] Your database prefix prefix is "jos_". Please edit it for increase your security agaisnt SQL Injections. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=5">Read more</a>';
    $security .= '</span><br />';
} else {
    $security .= '<span style="color:green;">';
    $security .= '[SQL Injection] Your database prefix is not "jos_". <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=5">Read more</a>';
    $security .= '</span><br />';
}
//Check admin
$db =& jFactory::getDBO();
$query = 'SELECT COUNT(*) FROM #__users WHERE username = "admin" OR username = "administrator "OR id = "62" OR id = "42"';
$db->setQuery($query);
$warningadminusers = $db->loadResult();
if ($warningadminusers >0){
    $security .= '<span style="color:red;">';
    $security .= '[SQL Injection] You have at least one user with ID equals to 62/42 or username is admin/administrator. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=6">Read more</a>';
    $security .= '</span><br />';
} else {
    $security .= '<span style="color:green;">';
    $security .= '[SQL Injection] You do not have one user with ID equals to 62/42 or username is admin/administrator. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=6">Read more</a>';
    $security .= '</span><br />';
}

//FTP password saved
if ( $config->get('ftp_pass') != ''){
    $security .= '<span style="color:red;">';
    $security .= '[Generic Security] FTP password is saved on FTP Settings and on file /configuration.php. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=7">Read more</a>';
    $security .= '</span><br />';
} else {
    $security .= '<span style="color:green;">';
    $security .= '[Generic Security] FTP password is not saved on FTP Settings and on file /configuration.php. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=7">Read more</a>';
    $security .= '</span><br />';
}

//SEF
if ( $config->get('sef') == 0){
    $security .= '<span style="color:red;">';
    $security .= '[Generic Security] [SEO] SEF is not enabled. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=8">Read more</a>';
    $security .= '</span><br />';
} else {
    $security .= '<span style="color:green;">';
    $security .= '[Generic Security] [SEO] SEF is enabled. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=8">Read more</a>';
    $security .= '</span><br />';
}

$systemfox .= "<fieldset><legend>Security</legend>
{$security}
</fieldset>";





//                SEO and Performance 
$seoandperformance = NULL;
//SEF
if ( $config->get('sef') == 0){
    $seoandperformance .= '<span style="color:red;">';
    $seoandperformance .= '[Generic Security] [SEO] SEF is not enabled. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=8">Read more</a> ';
    $seoandperformance .= '</span><br />';
} else {
    $seoandperformance .= '<span style="color:green;">';
    $seoandperformance .= '[Generic Security] [SEO] SEF is enabled. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=8">Read more</a>';
    $seoandperformance .= '</span><br />';
}

//SEF mod_rewrite
if ( $config->get('sef_rewrite') == 0){
    $seoandperformance .= '<span style="color:red;">';
    $seoandperformance .= '[SEO] Your site have /index.php/ on all URLs. Please rename /htaccess.txt to /.htaccess. and enable "Use Apache mod_rewrite" on Global Configuration. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=9">Read more</a>';
    $seoandperformance .= '</span><br />';
} else {
    $seoandperformance .= '<span style="color:green;">';
    $seoandperformance .= '[SEO] Apache mod_rewrite is enabled. <a target="_blank" href="http://forum.fititnt.org/viewtopic.php?f=16&t=9">Read more</a>';
    $seoandperformance .= '</span><br />';
}


$systemfox .= "<fieldset><legend>SEO and Performance</legend>
{$seoandperformance}
</fieldset>";


$systemfox .='</div>';

 */