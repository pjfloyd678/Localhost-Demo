{include file="../header.tpl" title=foo}

<div class="container">
    <hr style="padding: 4px;"/>
    <div class="row border rounded" id="all-data">
        <div class="row col-sm-12 main" id="page-header">
            <div class="col-sm-8"><h3>XML File Storage Demo</h3></div>
            <p>Please fill out the following form.</p>
        </div>
        <div class="success" id="success"></div>
        <div class="error" id="errorMessage"></div>
        <div class="row col-sm-12 main">
            <form method="POST" action="/xml/process.php" id="xml-form">
                <label for="linkname">
                    <span class="required">Link Name:</span>
                    <input type="text" name="linkname" id="linkname" value="Some Link" required maxlength="256">
                </label>

                <label for="url">
                    <span class="required">Website URL:</span>
                    <input type="text" name="url" id="url" value="http://localhost" required maxlength="256">
                </label>
                <div class="form-button">
                    <button name="submit_form" id="update_form" type="submit" class="btn btn-success">
                        <span>Save Data and Continue</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
{literal}
<script src="/media/js/formvalidate.js" type="text/javascript"></script>
<script type="text/javascript">
    $( "#update_form" ).click( function( evt ) {
        evt.preventDefault();
        var theForm = $( "#setup-form" );
        var formID = theForm.attr( 'id' );
        var check = validateForm( formID );
        if ( ! check ) {
            return false;
        }
        theForm.submit();
        return true;
    });
</script>
{/literal}
{include file="../footer.tpl"}
