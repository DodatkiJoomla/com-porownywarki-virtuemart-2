<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class Porownywarki_VM2ModelPorownywarki_vm2 extends JModel
{
    public function getAvailablePlugins()
    {
        $db = JFactory::getDBO();
        $q = "SELECT * FROM #__extensions WHERE element LIKE '%porownywarki_vm2%' AND type='plugin' AND enabled=1 ";
        $db->setQuery($q);
        $results = $db->loadObjectList();
        if (empty($results)) {
            return false;
        } else {
            return $results;
        }
    }
}

