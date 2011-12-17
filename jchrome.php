<?php

/**
 * @package		JChrome
 * @author		Emerson Rocha Luiz (emerson at webdesign.eng.br)
 * @copyright           Copyright (C) 2005 - 2010 Webdesign Assessoria em Tecnologia da Informacao LTDA.
 * @license		GNU General Public License version 2 or later;
 */
// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * JChrome Plugin
 *
 * @package		Joomla
 * @subpackage          JFox
 */
class plgSystemJchrome extends JPlugin {

    /**
     * Do something onAfterInitialize
     */
    function onAfterInitialise() {
        $db = & JFactory::getDBO();
        //$db->debug(1);
    }

    /**
     * Do something onAfterRender
     */
    function onAfterRender() {


        //load user info
        $user = & JFactory::getUser();
        $app = & JFactory::getApplication();


        //Block non superadmins
        if (!JFactory::getUser()->authorise('core.admin', 'plg_jchrome')) {
            return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
        }

        $document = JFactory::getDocument();
        $doctype = $document->getType();

        // Only render for HTML output
        if ($doctype !== 'html') {
            return;
        }


        // take body


        if ($this->params->get('enable_jchrome_frontend', 1) != 1 AND $app->isSite()) {
            return;
        }

        if ($this->params->get('enable_jchrome_backend', 1) != 1 AND $app->isAdmin()) {
            return;
        }


        //load files
        //$jchromecontent = NULL;
        $jchromecontent = '<div id="jchrome">';
        
        //jfox_general
        if ($this->params->get('show_jchrome_tab_general', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/general.php' );
            $jchromecontent .= $generalfox;
        }
        //jfox_system
        if ($this->params->get('show_jchrome_tab_system', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/system.php' );
            $jchromecontent .= $chromesystem;
        }
        //jfox_page
        if ($this->params->get('show_jchrome_tab_page', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/page.php' );
            $jchromecontent .= $jchromePage;
        }
        //jfox_queries
        if ($this->params->get('show_jchrome_tab_queries', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/queries.php' );
            $jchromecontent .= $queriesfox;
        }
        //jfox_form
        if ($this->params->get('show_jchrome_tab_request', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/request.php' );
            $jchromecontent .= $requestfox;
        }
        //jfox_permissions
        if ($this->params->get('show_jchrome_tab_permissions', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/permissions.php' );
            $jchromecontent .= $permissionsfox;
        }
        //jfox_php
        if ($this->params->get('show_jchrome_tab_jfoxconsole', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jchrome/php.php' );
            $jchromecontent .= $phpfox;
        }
        
        ///POG! Depois mover pra outro lugar
        
        
        
        $jchromecontent .= "</div>";
        $body1 = JResponse::getBody();
        
        //replace on on the html for output the tag </body> for ' + </body>'
        $body = str_replace('</body>', $jchromecontent . '</body>', $body1);

        JResponse::setBody($body);

        return true;
    }

}