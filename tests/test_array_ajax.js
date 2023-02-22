$(document).ready(function () {

    current = 0;

    var all_processes = [
        {
            "type" : "registration",
            "callback" : function ( jsonData ) {
                console.log( jsonData );
            },
        },
        {
            "type" : "payee",
            "callback" : function ( jsonData ) {
                console.log( jsonData );
            },
        },
        {
            "type" : "first-injection",
            "callback" : function ( jsonData ) {
                console.log( jsonData );
            },
        },
        {
            "type" : "voucher",
            "callback" : function ( jsonData ) {
                console.log( jsonData );
            },
        },
        {
            "type" : "survey",
            "callback" : function ( jsonData ) {
                console.log( jsonData );
            },
        },
        {
            "type" : "insurance",
            "callback" : function ( jsonData ) {
                console.log( jsonData );
            },
        },
    ];

    // //declare your function to run AJAX requests
    function do_ajax() {

        //check to make sure there are more requests to make
        if (current < all_processes.length) {

            var form_data = new FormData();
            form_data.append('pharma', 1 );
            form_data.append('pharma_type', all_processes[ current ][ "type" ] );
            form_data.append('reg_id', _G.reg_id);

            $.ajax({
                url: './ajax_do_something.php',
                data: form_data,       
                processData: false,
                contentType: false,
                type: 'POST',
                'beforeSend': function () {
    
                }, 
                success: function (response) { 
                    //note that the "success" callback will fire
                    //before the "complete" callback
                    response = $.trim(response);
                    var jsonData = JSON.parse( response );

                    // Process the response
                    all_processes[current].callback( jsonData );

                    var percentComplete = current * 100 / all_processes.length;
                    $("#processing").find('.progress-bar').width(percentComplete+'%').prop('aria-valuenow',percentComplete).html(Math.round(percentComplete)+'%');
    
                    if ( !jsonData[ 'result' ] ) {
                        current = all_processes.length;
                    }
                },
                complete: function () {
                    current++;
                    if ( current == all_processes.length ) {
                        percentComplete = 100;
                        $("#processing").find('.progress-bar').width(percentComplete+'%').prop('aria-valuenow',percentComplete).html(Math.round(percentComplete)+'%');
                        $("#processing").find('.progress-bar').addClass('bg-success').removeClass('progress-bar-animated').html(_G.success_msg);

                        // use setTimeout() to execute
                        setTimeout( function() {
                            showHideModal( true );
                        }, 2000);

                    } else {
                        do_ajax();
                    }
                }
            });
        }
    }

    function showHideModal( hide = false) {
        if ( hide ) {
            $('#processing').modal('hide');
        } else {
            $('#processing').modal('show');
        }
    }

    //run the AJAX function for the first time once `document.ready` fires
    $("#test_array_ajax").click(function (e) { 
        e.preventDefault();

        $("#processing").find('.progress-bar').removeClass('bg-success').removeClass('bg-danger').addClass('progress-bar-animated');
        $("#processing").find('.progress-bar').width('0%').prop('aria-valuenow',0).html('0%');
		showHideModal();

        do_ajax();
    });
});
