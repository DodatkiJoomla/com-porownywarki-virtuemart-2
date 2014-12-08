<?php
defined('_JEXEC') or die('Restricted access');
ini_set('max_execution_time ', 0);
ini_set('memory_limit ', '512M');
set_time_limit(240);

if (isset($_GET['typ'])) {
    switch ($_GET['typ']) {
        case 'ceneo':
            $porownywarka = "Ceneo";
            require_once(JPATH_COMPONENT . DS . 'ceneoXML.php');
            break;
    }
}
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;


$meta = "";
$body = "";

if (!isset($_SESSION['last_old_group'])) {
    $_SESSION['last_old_group'] = "";
}

if (TABLE_SIZE < LIMITED) {
    // deleting file
    if (file_exists(JPATH_SITE . DS . FILE_NAME)) {
        unlink(JPATH_SITE . DS . FILE_NAME);
    }

    $body = "<h3>Krok 1 z 1</h3>";
    $body .= "Link do pliku z ofertami dla " . $porownywarka . " w formacie xml: <a target='_blank' href='" . JURI::root() . FILE_NAME . "'>" . JURI::root() . FILE_NAME . "</a><br><br>";
    $body .= "<div style='width: 100%; border: 1px solid #000; height: 24px; padding: 3px;'><div style='width: 100%; height: 24px; background: #06a61c;'></div></div>";
    $products = getProducts($main_query, "");
    createXML($products, true, true);
} else {
    $iteracji = ceil(TABLE_SIZE / LIMITED);

    if (!isset($_GET['i']) || (isset($_GET['i']) && $_GET['i'] == 1)) {
        // deleting file
        if (file_exists(JPATH_SITE . DS . FILE_NAME)) {
            unlink(JPATH_SITE . DS . FILE_NAME);
        }

        $body = "<h3>Krok 1 z " . $iteracji . "</h3>";
        $body .= "<div style='width: 100%; border: 1px solid #000; height: 24px; padding: 3px;'><div style='width: " . (round(1 / $iteracji,
                    2) * 100) . "%; height: 24px; background: #06a61c;'></div></div>";
        $products = getProducts($main_query, "LIMIT 0, " . LIMITED);
        $_SESSION['last_old_group'] = createXML($products, true, false);
        $meta = '<meta http-equiv="refresh" content="5;url=' . JURI::current() . '?option=com_porownywarki_vm2&typ=' . $_GET['typ'] . '&u=' . UNIQID . '&tmpl=component&i=2">';
    } else {
        if (isset($_GET['i']) && $_GET['i'] == $iteracji) {
            $body = "<h3>Krok ostatni " . $iteracji . " z " . $iteracji . "</h3>";
            $body .= "Link do pliku z ofertami dla " . $porownywarka . " w formacie xml: <a target='_blank' href='" . JURI::root() . FILE_NAME . "'>" . JURI::root() . FILE_NAME . "</a><br><br>";
            $body .= "<div style='width: 100%; border: 1px solid #000; height: 24px; padding: 3px;'><div style='width: " . (round($_GET['i'] / $iteracji,
                        2) * 100) . "%; height: 24px; background: #06a61c;'></div></div>";
            $products = getProducts($main_query, "LIMIT " . (LIMITED * $_GET['i'] - LIMITED) . ", " . LIMITED);
            $_SESSION['last_old_group'] = createXML($products, false, true, $_SESSION['last_old_group']);
        } else {
            if (isset($_GET['i']) && $_GET['i'] < $iteracji && $_GET['i'] != 1) {
                $body = "<h3>Krok " . $_GET['i'] . " z " . $iteracji . "</h3>";
                $body .= "<div style='width: 100%; border: 1px solid #000; height: 24px; padding: 3px;'><div style='width: " . (round($_GET['i'] / $iteracji,
                            2) * 100) . "%; height: 24px; background: #06a61c;'></div></div>";
                $limit = (int)$_GET['i'] + 1;
                $products = getProducts($main_query, "LIMIT " . (LIMITED * $_GET['i'] - LIMITED) . ", " . LIMITED);
                $_SESSION['last_old_group'] = createXML($products, false, false, $_SESSION['last_old_group']);
                $meta = '<meta http-equiv="refresh" content="5;url=' . JURI::current() . '?option=com_porownywarki_vm2&typ=' . $_GET['typ'] . '&u=' . UNIQID . '&tmpl=component&i=' . $limit . '">';
            }
        }
    }

}



?>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <?php echo $meta; ?>
    </head>
    <body>
    <?php
    echo $body;

    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    $mtime = $mtime[1] + $mtime[0];
    $endtime = $mtime;
    $totaltime = ($endtime - $starttime);
    echo "<br><br><hr>Strona wygenerowana w " . $totaltime . " sekund";

    ?>
    </body>
    </html>
<?php
exit();
?>