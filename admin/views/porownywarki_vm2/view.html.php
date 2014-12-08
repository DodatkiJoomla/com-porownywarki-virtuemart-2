<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class Porownywarki_VM2ViewPorownywarki_VM2 extends JView
{
    function display($tpl = null)
    {
        JToolBarHelper::title(JText::_('Integracja z porównywarkami cen dla Virtuemart 2'), 'generic.png');

        // model
        $model = $this->getModel();
        $plugins = $model->getAvailablePlugins();
        $this->assignRef('plugins', $plugins);

        parent::display($tpl);
    }
}

