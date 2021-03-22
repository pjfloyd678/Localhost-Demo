$(document).ready(function() {

    var dialog;
    
    $('#add-row-plus').on("click", function() {
        openCloseAddRowPlus();
    });

    $('#submit').click(function(evt){
        evt.preventDefault();
        saveData();
    });
    
    $('#updateButton').click(function(evt){
        evt.preventDefault();
        var linkName = $( "#linkname" ).val();
        var linkURL = $( "#linkurl" ).val();
        var linkID = $( "#linkid" ).val();
        
    });

    $("#all-items").sortable({
        placeholder: "ui-state-highlight",
        items: '> .sortable',
        cursor: "move",
        start: function( evt, ui ) {
            $("#success").html( 'Processing ...' );
        },
        stop: function( evt, ui ) {
            var order = [];
            $( ".sortable" ).each( function() {
                var indx = $(this).data( "indx" );
                order.push( indx );
            });
            saveOrder( order );
        }
    });
    
    $( "#view-type" ).click( function( evt ) {
        var type = $(this).data( 'view' );
        if ( type === 'default' ) {
            
        }
    });

    if ( $( "#emailaddress" ).length ) {
        $( "#emailaddress" ).blur( function( ) {
            var emailAddress = $( "#emailaddress" ).val();
            $.get( '/api/checkEmail.php?emailaddress=' + emailAddress, function( data) {
                var result = JSON.parse( data );
                if ( result ) {
                    $( '#error-message' ).html( 'Sorry that email exists!' );
                    $( "#emailaddress" ).focus();
                } else {
                    $( '#error-message' ).html( '' );
                }
            });
        });
    }

});

function saveOrder( newOrder ) {
    var formData = JSON.stringify( newOrder );
    var protocol = document.location.protocol;
    var hostname = document.location.hostname;
    var url = protocol + "//" + hostname + '/api/updateList.php?order=' + formData;
    $.ajax({
        type: "GET",
        url: url,
        success: function (data, textStatus, jqXHR) {
            var response = JSON.parse(data);
            if (parseInt(response.code) === 200) {
                $("#errorMessage").html('');
                $("#success").html( response.message );
            } else {
                $("#success").html('');
                $("#errorMessage").html( response.message );
            }
        },
    });
}

function openCloseAddRowPlus() {
    var addRow = $('#add-row');
    if (addRow.css("display") === "none") {
        openAddRow(addRow);
    } else {
        closeAddRow(addRow);
    }
}

function openAddRow(addRow) {
    var speed = 200;
    var addRowPlus = $("#add-row-plus > i");
    addRow.show(speed);
    addRowPlus.removeClass("fa-plus");
    addRowPlus.addClass("fa-minus");
}

function closeAddRow(addRow) {
    var speed = 200;
    var addRowPlus = $("#add-row-plus > i");
    addRow.hide(speed);
    addRowPlus.removeClass("fa-minus");
    addRowPlus.addClass("fa-plus");
}

function saveData() {
    $("#success").html("");
    var text    = $("#input-text").val();
    var url     = $('#input-url').val();
    var protocol = document.location.protocol;
    var hostname = document.location.hostname;
    var doAPIURL = protocol + "//" + hostname;
    $.post( doAPIURL + '/api/doSave.php', {text: text, url: url}, function(data) {
        var response = JSON.parse(data);
        if (parseInt(response.code) === 200) {
            $("#success").html("Data saved.");
            var hostname = document.location.hostname;
            window.location.replace( doAPIURL );
        } else {
            $("#errorMessage").html(data.response);
        }
        $("#input-text").val('');
        $('#input-url').val('');
    });
}

function deleteEntry(button) {
    $("#success").html("");
    var id = $(button).data("id");
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: true,
      buttons: {
        "Delete Item": function() {
                doDelete( id );
                $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });    
}

function doDelete( id ) {
    var protocol = document.location.protocol;
    var hostname = document.location.hostname;
    var doAPIURL = protocol + "//" + hostname;
    $.post( doAPIURL + '/api/doDelete.php', {id: id}, function(data) {
        var response = JSON.parse(data);
        if (parseInt(response.code) === 200) {
            $("#success").html("Data removed.");
            var hostname = document.location.hostname;
            window.location.replace( doAPIURL );
            return true;
        }
        $("#errorMessage").html(data.response);
        return false;
    });
}

function moveUp(button) {
    var id = $(button).data("id");
    var sort = $(button).data("sort");
    moveEntry(id, sort, "UP");
}

function moveDown(button) {
    var id = $(button).data("id");
    var sort = $(button).data("sort");
    moveEntry(id, sort, "DOWN");
}

function moveEntry(id, sort, direction) {
    $("#success").html("");
    var protocol = document.location.protocol;
    var hostname = document.location.hostname;
    var doAPIURL = protocol + "//" + hostname;
    $.post( doAPIURL + '/api/doMove.php', {id: id, sort: sort, direction: direction}, function(data) {
        var response = JSON.parse(data);
        if (parseInt(response.code) === 200) {
            var hostname = document.location.hostname;
            window.location.replace( doAPIURL );
        }
        $("#errorMessage").html(data.response);
        return false;
    });
}

function edit_entry(button) {
    var id = $(button).data("id");
    var protocol = document.location.protocol;
    var hostname = document.location.hostname;
    var doAPIURL = protocol + "//" + hostname;
    $.post( doAPIURL + '/api/getByID.php', { id: id }, function( data ) {
        var response = JSON.parse(data);
        if (parseInt(response.code) === 200) {
            var result = response.data.response[ 0 ];
            showEditDialog( result );
            return true;
        }
        $("#errorMessage").html("Error getting data");
        return false;
    });
}

function showEditDialog( data ) {
    
    $( "#linkname" ).val( data.websiteText );
    var linkurl = decodeURIComponent( data.websiteURL );
    $( "#linkurl" ).val( linkurl );
    $( "#linkid" ).val( data.websiteID );
    
    dialog = $("#edit-form").dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: [
            {
                text: "Update",
                icon: "ui-icon-heart",
                click: function() {
                    var linkText = $( '#linkname' ).val();
                    var linkURL  = $( '#linkurl' ).val();
                    var linkID   = $( '#linkid').val();
                    var postData = {
                        id : linkID,
                        text: linkText,
                        url: linkURL,
                    };
                    var protocol = document.location.protocol;
                    var hostname = document.location.hostname;
                    var doAPIURL = protocol + "//" + hostname;
                    $.post( doAPIURL + '/api/doUpdate.php', postData, function( resData ) {
                        var response = JSON.parse( resData );
                        if ( parseInt(response.code ) === 200 ) {
                            $( "#success" ).html( "Data updated." );
                            window.location.replace( doAPIURL );
                        } else {
                            $( "#errorMessage" ).html( resData.response );
                        }
                    });

                    $( this ).dialog( "close" );
                }
            }, 
            {
                text: "Cancel",
                click: function() {
                    dialog.dialog( "close" );
                }
            }
        ],
    });

    dialog.dialog( "open" );

}

function edit_user() {
    var link_name = $( '#linkname' );
    var link_url  = $( ' #linkurl' );
    var id = $(button).data("id");
    var protocol = document.location.protocol;
    var hostname = document.location.hostname;
    var doAPIURL = protocol + "//" + hostname;
    $.post( doAPIURL + '/api/do_edit.php', {id: id}, function(data) {
        var response = JSON.parse(data);
        if (parseInt(response.code) === 200) {
            $("#success").html("Data removed.");
            window.location.replace( doAPIURL );
            return true;
        }
        $("#errorMessage").html(data.response);
        return false;
    });
}

