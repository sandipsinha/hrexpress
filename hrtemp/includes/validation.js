/*************************************************************************
    This code is from Dynamic Web Coding at dyn-web.com
    Copyright 2007-10 by Sharon Paine 
    See Terms of Use at www.dyn-web.com/business/terms.php
    regarding conditions under which you may use this code.
    This notice must be retained in the code as is!
*************************************************************************/

var Validation = {
    msg_header: 'Problem with Form Data',
    error_messages: [],
    error_fields: []
}

function addValidationMessage(msg) {
    Validation.error_messages.push(msg);
}

function addValidationField(fld) {
    Validation.error_fields.push(fld);
}

function displayErrorInfo(form) {
    var len = Validation.error_messages.length;
    if ( len ) {
        var el, fld, msg;
        var errorEl = document.createElement("div");
        errorEl.id = 'errorDiv';
        form.parentNode.insertBefore(errorEl, form);
        el = document.createElement('h3');
        el.appendChild( document.createTextNode( Validation.msg_header ) );
        errorEl.appendChild(el);
        for (var i=0; i<len; i++) {
            msg = Validation.error_messages[i];
            el = document.createElement('p');
            el.appendChild( document.createTextNode(msg) );
            errorEl.appendChild(el);
        }
        len = Validation.error_fields.length;
        for (i=0; i<len; i++) {
            fld = Validation.error_fields[i];
            if ( !dw_Util.hasClass(fld, 'error') ) {
                dw_Util.addClass(fld, 'error');
            }
        }
    }
}

// remove all error fields/messages
function clearErrorInfo() {
    var fld, len = Validation.error_fields.length;
    for (var i=0; i<len; i++) {
        fld = Validation.error_fields[i];
        dw_Util.removeClass(fld, 'error');
    }
    Validation.error_fields = [];
    Validation.error_messages = [];
    clearErrorDisplay();
}

function clearErrorDisplay() {
    var errorEl = document.getElementById('errorDiv');
    if ( errorEl ) {
        errorEl.parentNode.removeChild(errorEl);
    }
    //window.location.hash = ''; // causes jump up
}


var dw_Util; 
if (!dw_Util) dw_Util = {};

dw_Util.trimString = function (str) {
    var re = /^\s+|\s+$/g;
    return str.replace(re, "");
}

dw_Util.normalizeString = function (str) {
    var re = /\s\s+/g;
    return dw_Util.trimString(str).replace(re, " ");
}

dw_Util.addClass = function (el, cl) {
    el.className = dw_Util.trimString( el.className + ' ' + cl );
}

dw_Util.removeClass = function (el, cl) {
    el.className = dw_Util.normalizeString( el.className.replace(cl, " ") );
}

dw_Util.hasClass = function (el, cl) {
    var re = new RegExp("\\b" + cl + "\\b", "i");
    if ( re.test( el.className ) ) {
        return true;
    }
    return false;
}