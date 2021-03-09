function isValidNumber(value) {
    var check = /^[0-9]{1,12}$/.test(value);
    return check;
}
function isValidDescription(value) {
    var check = /^[a-zA-Z0-9 -.,:\n]*$/.test(value);
    return check;
}
function isValidEmail(value) {
    var check =/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    return check;
}

function validateForm(inFormID) {
    var count = 0;
    
    var formID = $("#" + inFormID).attr("id");
    $('#'+formID).find(':input').each(function() {
        var valid    = true;
        var itemID   = $(this).attr("id");
        var dataType = $( this ).attr( "type" );
        var value    = $(this).val();
        var required = $(this).attr("required");
        
        if ( value === "" ) {
            if ( required || required === "required" ) {
                valid = false;
            } else {
                valid = true;
            }
        }
        if (valid) {
            if ( value !== "" ) {
                if ( ( dataType === "email" ) || ( dataType === "new-email" ) ) {
                    valid = isValidEmail( value );
                } else if ( dataType === "number" ) {
                    valid = isValidNumber( value );
                } else {
                    valid = isValidDescription(value);
                }
            }
        }
        if (valid) {
            $("#" + itemID).css("border-color", "lightgrey");
            $("#" + itemID).css("border-width", "1px");
            $("#" + itemID).css("border-style", "solid");
        } else {
            $("#" + itemID).css("border-color", "red");
            $("#" + itemID).css("border-width", "2px");
            $("#" + itemID).css("border-style", "solid");
            count++;
        }
    });
    if (count > 0) {
        return false;
    } else {
        return true;
    }
}
