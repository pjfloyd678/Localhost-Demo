{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=foo}

<style type="text/css">
#example2 {
    display: block;
    clear: both;
    width: 64px;
    height: 97px;
    border: 2px solid black;
    padding: 25px;
    background: url(/jquery_recaptcha/numbers.gif);
    background-repeat: no-repeat;
    background-position: -24px -15px;
}</style>
<div class="container">
    <hr style="padding: 4px;"/>
    <div class="row border rounded">
        <h3>Recaptcha Script</h3>
        <div class="col-12">
            <select id="choose-number">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
        </div>
        <div id="all-data">
            <div id="example2"></div>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {
    var orderType = "numbers";
    var numberOfItems = 5;
    var all = new Array();
    var sorted = new Array();
    var maxNumber = 0;
    switch( orderType ) {
        case "numbers":
            maxNumber = 9;
            break;
        case "letters":
            maxNumber = 27;
            break;
    }
    if ( numberOfItems >= maxNumber ) {
        numberOfItems = maxNumber - 1;
    }
    for( var x=0; x < numberOfItems; x++ ) {
        var exists = 1;
        var val = Math.floor( Math.random() * maxNumber );
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
    console.log( all );
    sorted = all.sort(function(a, b){return a - b});
    console.log( sorted );
    
    $( '#choose-number' ).change( function( evt ) {
        evt.preventDefault();
        var number = parseInt( $(this).val() );
        pos_x = -24;
        pos_y = -15;
        x = ( ( pos_x * number ) - ( 64 * ( number - 1 ) ) );
        new_x = x - ( pos_x * ( number -1 ) );
        $( '#example2' ).css( 'background-position-x', ( new_x ) );
    });
});
</script>
{/literal}
{include file="footer.tpl"}
