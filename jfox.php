<?php

/**
 * @package     JFox
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * JChrome Plugin
 *
 * @package		Joomla
 * @subpackage          JFox
 */
class plgSystemJfox extends JPlugin {

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
        if (!JFactory::getUser()->authorise('core.admin', 'plg_jfox')) {
            return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
        }

        $document = JFactory::getDocument();
        $doctype = $document->getType();

        // Only render for HTML output
        if ($doctype !== 'html') {
            return;
        }

        // take body

        if ($this->params->get('enable_jfox_frontend', 1) != 1 AND $app->isSite()) {
            return;
        }

        if ($this->params->get('enable_jfox_backend', 1) != 1 AND $app->isAdmin()) {
            return;
        }

        //load files
        //$jfoxcontent = NULL;
        $jfoxcontent = '<div id="jfox">';

        //jfox_general
        if ($this->params->get('show_jfox_tab_general', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/general.php' );
            $jfoxcontent .= $generalfox;
        }
        //jfox_system
        if ($this->params->get('show_jfox_tab_system', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/system.php' );
            $jfoxcontent .= $chromesystem;
        }
        //jfox_page
        if ($this->params->get('show_jfox_tab_page', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/page.php' );
            $jfoxcontent .= $jfoxPage;
        }
        //jfox_queries
        if ($this->params->get('show_jfox_tab_queries', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/queries.php' );
            $jfoxcontent .= $queriesfox;
        }
        //jfox_form
        if ($this->params->get('show_jfox_tab_request', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/request.php' );
            $jfoxcontent .= $requestfox;
        }
        //jfox_permissions
        if ($this->params->get('show_jfox_tab_permissions', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/permissions.php' );
            $jfoxcontent .= $permissionsfox;
        }
        //jfox_php
        if ($this->params->get('show_jfox_tab_jfoxconsole', 1) == 1) {
            include_once( JPATH_PLUGINS . '/system/jfox/php.php' );
            $jfoxcontent .= $phpfox;
        }

        $jfoxcontent .= "</div>";
        $body1 = JResponse::getBody();

        //replace on on the html for output the tag </body> for ' + </body>'
        $body = str_replace('</body>', $jfoxcontent . '</body>', $body1);

        JResponse::setBody($body);

        return true;
    }

}