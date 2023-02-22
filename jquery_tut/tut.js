$(document).ready(function() {

    $( "#btn-submit" ).click(function ( e ) { 
        e.preventDefault();
        
        var valid = true;

        var first_name = $( "#firstname" ).val();
        var last_name  = $( "#lastname" ).val();
        if ( !first_name ) {
            $( "#firstname" ).css( "box-shadow", "0px 0px 3px 1px red" );
            valid = false;
        } else {
            $( "#firstname" ).css( "box-shadow", "none" );
        }
        if ( !last_name ) {
            $( "#lastname" ).css( "box-shadow", "0px 0px 3px 1px red" );
            valid = false;
        } else {
            $( "#lastname" ).css( "box-shadow", "none" );
        }

        if ( valid ) {
            var full_name = first_name + " " + last_name;
            var choice    = $( "input[name='radiobutton']:checked" ).val();
            var output    = "Hello " + full_name + ". You chose: " + choice;
            $( "#response" ).html( "<strong>" + output + "</strong>");
        }
    });

});

