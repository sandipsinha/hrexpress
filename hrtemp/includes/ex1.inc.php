<?php
/* order form code from dyn-web.com */

$PRODUCTS = array(
    // product abbreviation, product name, unit price
    // follow valid name/ID rules for product abbreviation 
    array('choc_cake', 'Chocolate Cake', 15),
    array('carrot_cake', 'Carrot Cake', 12),
    array('cheese_cake', 'Cheese Cake', 20),
    array('banana_bread', 'Banana Bread', 14)
);

function getOrderForm() {
    global $PRODUCTS;
    $tbl = new HTML_Table(null, 'display', 0, 0, 0);
    $frm = new HTML_Form();
    
    // header row
    $tbl->addRow();
        $tbl->addCell('Product', 'first', 'header');
        $tbl->addCell('Price', null, 'header');
        $tbl->addCell('Quantity', null, 'header');
        $tbl->addCell('Totals', null, 'header');
    
    // display product info/form elements
    foreach($PRODUCTS as $product) {
        list($abbr, $name, $price) = $product;
        $qty_el = $frm->addInput('text', $abbr . '_qty', 0, 
            array('size'=>4, 'class'=>'cur', 
            'onchange'=>'getProductTotal(this)',
            'onclick'=>'checkValue(this)', 'onblur'=>'reCheckValue(this)' ) 
        );
        $tot_el = $frm->addInput('text', $abbr . '_tot', 0, array('readonly'=>true, 'size'=>8, 'class'=>'cur') );
        $price_el = $frm->addInput('hidden', $abbr . '_price', $price);
        $tbl->addRow();
            $tbl->addCell($name);
            $tbl->addCell('$' . number_format($price, 2) . $price_el, 'cur' );
            $tbl->addCell( $qty_el, 'qty');
            $tbl->addCell( $tot_el );
    }
    // total row
    $tbl->addRow();
        $tbl->addCell();
        $tbl->addCell();
        $tbl->addCell( 'Total: ', 'total');
        $tbl->addCell( $frm->addInput('text', 'total', 0, array('readonly'=>true, 'size'=>8, 'class'=>'cur') ) );
    // submit button
    $tbl->addRow();
        $tbl->addCell();
        $tbl->addCell( $frm->addInput('submit', 'submit', 'Submit') );
        $tbl->addCell();
        $tbl->addCell();
        
    $frmStr = $frm->startForm('ex1_result.php', 'post', null, 
        array('onsubmit'=>'return finalCheck(this)') ) . 
        $tbl->display() . $frm->endForm();
    
    return $frmStr;
}


// for js
function getProductAbbrs() {
    global $PRODUCTS;
    foreach ( $PRODUCTS as $product ) {
        $ar[] = $product[0];
    }
    return $ar;
}
?>