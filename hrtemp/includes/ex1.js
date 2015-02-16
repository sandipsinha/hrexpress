/* order form code from dyn-web.com */

// onchange of qty field entry
function getProductTotal(field) {
    clearErrorInfo();
    var form = field.form;
	if (field.value == "") field.value = 0;
	if ( !isPosInt(field.value) ) {
        var msg = 'Please enter a positive integer for quantity.';
        addValidationMessage(msg);
        addValidationField(field)
        displayErrorInfo( form );
        return;
	} else {
		var product = field.name.slice(0, field.name.lastIndexOf("_") ); 
        var price = form.elements[product + "_price"].value;
		var amt = field.value * price;
		form.elements[product + "_tot"].value = formatDecimal(amt);
		doTotals(form);
	}
}

function doTotals(form) {
    var total = 0;
    for (var i=0; PRODUCT_ABBRS[i]; i++) {
        var cur_field = form.elements[ PRODUCT_ABBRS[i] + "_qty" ]; 
        if ( !isPosInt(cur_field.value) ) {
            var msg = 'Please enter a positive integer for quantity.';
            addValidationMessage(msg);
            addValidationField(cur_field)
            displayErrorInfo( form );
            return;
        }
        total += parseFloat(cur_field.value) * parseFloat( form.elements[ PRODUCT_ABBRS[i] + "_price" ].value );
    }
    form.elements['total'].value = formatDecimal(total);
}

function finalCheck(form) {
    clearErrorInfo();
    var msg = '';
    // final check of quantity entries' validity
    for (var i=0; PRODUCT_ABBRS[i]; i++) {
        var cur_field = form.elements[ PRODUCT_ABBRS[i] + "_qty" ]; 
        if ( !isPosInt(cur_field.value) ) {
            msg = 'Please enter a positive integer for quantity.';
            addValidationField(cur_field)
        }
    }
    if (msg) {
        addValidationMessage(msg);
        displayErrorInfo( form );
        return false;
    }
    // check if a quantity entered
    if (form.elements['total'].value == 0) {
        msg = "You haven't ordered anything.";
        addValidationMessage(msg);
        displayErrorInfo( form );
        return false;
    }
    return true;
}

// onclick
function checkValue(field) {
    if (field.value == 0) field.value = "";
}

// onblur
function reCheckValue(field) {
    if (field.value == "") field.value = 0;
}

function isPosInt(val) {
	var re = /^\d+$/
	if ( !re.test(val) ) {
		return false;
	}
    return true;
}

// format val to n number of decimal places
// modified version of Danny Goodman's (JS Bible)
function formatDecimal(val, n) {
    n = n || 2;
    var str = "" + Math.round ( parseFloat(val) * Math.pow(10, n) );
    while (str.length <= n) str = "0" + str;
    var pt = str.length - n;
    return str.slice(0,pt) + "." + str.slice(pt);
}