$( "#tabs" ).tabs();

$(document).ready(function () {
    doInitialAjax( function( d ){
        display( d );
    });

    $("form[name='form_test'] input").on('focusout', function( e ) {
        e.preventDefault();
        doPostAjax( function( d ) {
            display( d );
        });
    });

    $( "#check-btn" ).click(function ( e ) { 
        e.preventDefault();
        $( "input[name='checks']" ).prop( 'checked', false );
        $( "#checks-none" ).prop( 'checked', true );
    });

    $( "#disable-btn" ).click(function ( e ) { 
        e.preventDefault();
        //reset the form
        $( "input[name='checks']" ).prop( 'checked', false );
        // check if enabled
        var enabled_check = $( "#checks2" ).is( ':enabled' );
        if ( enabled_check ) {
            // disable
            $( "#checks2" ).prop( 'disabled', true );
            $(this).html("Enable");
        } else {
            // Enable
            $( "#checks2" ).prop( 'disabled', false );
            $(this).html("Disable");
        }
        // set button to none!
        $( "#checks-none" ).prop( 'checked', true );
    });

    $( "#submit-btn" ).click(function ( e ) { 
        e.preventDefault();
        var form_check = true;
        var value = $("#choose option:selected").val();
        if ( !value ) {
            console.log( "No select value!" );
            form_check = false;
        }
        var check = $( "input[name='checks']:checked").val();
        if ( !check ) {
            console.log( "No check value!" );
            form_check = false;
        }
        if ( form_check ) {
            console.log( "Select: " + value );
            console.log( "Check:  " + check );
        }
        return false;
    });

});

function doInitialAjax( callback ) {
    var showMessage = 0;

    var data = {
        action: 'init'
    };
    var request = $.ajax({
        type: "POST",
        url: "ajax_test.php",
        data: data,
    });
    request.done( function( response ) {
        showMessage = response;
    });

    if ( typeof callback == 'function' ) {
        callback( showMessage );
    }
}

function doPostAjax( callback ) {
    var showMessage = 0;

    var data = {
        action: 'post'
    };
    var request = $.ajax({
        type: "POST",
        url: "ajax_test.php",
        data: data
    });
    request.done( function( response ) {
        showMessage = response;
    });

    if ( typeof callback == 'function' ) {
        callback( showMessage );
    }
}

function display( visible ) {
    var d = ( visible ? "block" : "none" );
    $( '#show-message' ).css( 'display', d );
}

