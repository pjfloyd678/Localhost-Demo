{include file="header.tpl" title=foo}

<div class="container">
    <hr style="padding: 4px;"/>
    <div class="row border rounded" id="all-data">
        <div class="row col-sm-12 main" id="page-header">
            <div class="col-sm-8"><h3>Website URL</h3></div>
        </div>
        <div class="success" id="success"></div>
        <div class="error" id="errorMessage"></div>
        <div class="row col-sm-12 main">
            <form method="POST" action="/setup.php" id="setup-form">
                <label for="hostname">
                    <span class="required">Hostname:</span>
                    <input type="text" name="hostname" id="hostname" value="localhost" required maxlength="256" autocomplete="off">
                </label>

                <label for="dbname">
                    <span class="required">Database Name:</span>
                    <input type="text" name="dbname" id="dbname" value="localhost-demo" required maxlength="256" autocomplete="off">
                </label>

                <label for="username">
                    <span class="required">User Name:</span>
                    <input type="text" name="username" id="username" value="" required maxlength="256" autocomplete="off">
                </label>

                <label for="password">
                    <span class="required">Password:</span>
                    <input type="password" name="password" id="password" value="" required maxlength="256" autocomplete="off">
                </label>

                <label for="tablename">
                    <span class="required">Table Name:</span>
                    <input type="text" name="tablename" id="tablename" value="websites" required maxlength="256" autocomplete="off">
                </label>
                
                <label for="port">
                    <span class="required">Port:</span>
                    <input type="number" name="port" id="port" value="3306" required maxlength="16" autocomplete="off">
                </label>
                
                <div class="form-button">
                    <button name="submit_form" id="update_form" type="submit" class="btn btn-success">
                        <span>Save Data</span>
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
{include file="footer.tpl"}
