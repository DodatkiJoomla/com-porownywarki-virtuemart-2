<?php
defined('_JEXEC') or die('Restricted access');

// Pobieramy bazowy kontroler
require_once(JPATH_COMPONENT . DS . 'controller.php');

// Require specific controller if requested
if ($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT . DS . 'controllers' . DS . $controller . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

// Stwórz kontorler        '{Componentname}{Controller}{Controllername}'
$classname = 'Porownywarki_VM2Controller' . $controller;
$controller = new $classname();

// Przygotuj odpowiedź zadania (task)
$controller->execute(JRequest::getWord('task'));

// Przekieruj jeśli ustawione przez kontroler
$controller->redirect();