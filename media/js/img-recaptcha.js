$(document).ready(function() {
// Set these values
    var captchaSize = 0;
    var numberOfItems = 5;
    
// Do not change anything below    
    var element = document.getElementById( "img-recaptcha-images" );
    if (typeof(element) !== 'undefined' && element !== null)
{
        var imgSize = 0;
        switch( captchaSize ) {
            case 1:
                imgSize = 60;
                break;
            default:
                imgSize = 30;
                break;
        }
        var all = new Array();
        var maxNumber = 9;
        if ( numberOfItems >= maxNumber ) {
            numberOfItems = maxNumber - 1;
        }
        for( var x=0; x < numberOfItems; x++ ) {
            var exists = 1;
            var val = Math.floor( ( Math.random() * maxNumber ) + 1 );
            if ( all.length > 0 ) {
                while( exists ) {
                    if ( all.includes( val ) ) {
                        val = Math.floor( ( Math.random() * maxNumber ) + 1 );
                    } else {
                        exists = 0;
                    }
                }
            }
            all.push( val );
        }
        for ( var i=0; i < all.length; i++ ) {
            var div = document.createElement("DIV");
            div.classList.add( 'img-recatcha-image' );
            switch( captchaSize ) {
                case 1:
                    imgSize = 60;
                    div.style.background = 'url(/media/images/numbers-0-9-540.png)'; 
                    break;
                case 2:
                    imgSize = 120;
                    div.style.background = 'url(/media/images/numbers-0-9-1080.png)'; 
                    break;
                default:
                    imgSize = 30;
                    div.style.background = 'url(/media/images/numbers-0-9-270.png)';
                    break;
            }
            div.style.backgroundRepeat = 'no-repeat';
            div.style.backgroundPositionY = '-2px';
            div.style.width = imgSize + "px";
            var imgHeight = imgSize + ( captchaSize * 11 ) + 2;
            div.style.height = imgHeight + "px";
            div.setAttribute( 'id', 'img-recaptcha-image-' + ( i + 1) );
            var number = all[ i ];
            div.dataset.value = number;
            var pos_x = -2;
            var new_x =  ( ( imgSize * ( number - 1 ) ) * -1 ) + pos_x;
            div.style.backgroundPositionX = new_x + 'px';
            document.getElementById( "img-recaptcha-images" ).appendChild( div );
        }
    }
    function calculateFinalValue() {
        var finalValue = '';
        for ( var x=0; x < numberOfItems; x++ ) {
            var imgID = '#img-recaptcha-image-' + ( x + 1);
            var elmt  = $( imgID );
            var value = elmt.data( 'value' );
            finalValue += value.toString();
        }
        return finalValue;
    }
    
    $( '#img-recaptcha-form-submit' ).click( function( evt ) {
        evt.preventDefault();
        $( "#img-recaptcha-form-success" ).html( "" );
        $( "#img-recaptcha-form-error" ).html( "" );
        var value = $( '#img-recaptcha-form-input' ).val();
        var finalValue = calculateFinalValue();
        if ( value === finalValue ) {
            $( "#img-recaptcha-form-success" ).html( "<strong>That is correct!</strong>" );
            //$( "#img-recaptcha-form" ).submit();
        } else {
            $( "#img-recaptcha-form-error" ).html( "<strong>That is incorrect!</strong>" )
        }
    } );
});
