<?php
require('../includes/html_table.class.php');

$PRODUCTS = array(
    'choc_chip' => array(' Chocolate Chip Cookies', 1.25, 10.00),
    'oatmeal' => array('Oatmeal Cookies', .99, 8.25),
    'brwwnies' => array('Fudge Brownies', 1.35, 12.00)
);

$tbl = new HTML_Table(null, 'display', 1, 0, 4);

$tbl->addRow();
    $tbl->addCell('Product', 'first', 'header');
    $tbl->addCell('Single Item Price', null, 'header');
    $tbl->addCell('Price per Dozen', null, 'header');
    
    foreach($PRODUCTS as $product) {
        list($name, $unit_price, $doz_price ) = $product;
        $tbl->addRow();
            $tbl->addCell($name);
            $tbl->addCell('$' . number_format($unit_price, 2), 'num' );
            $tbl->addCell('$' . number_format($doz_price, 2), 'num' );
    }
echo $tbl->display();
?> 