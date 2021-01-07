{config_load file="test.conf" section="setup"}
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
            <div id="all-items" class="ui-sortable">
{foreach from=$links item=link}
                <div class="sortable ui-state-default" data-indx="{$link[ 'websiteID' ]}">
                    <div class="inside-box">
                        <button data-id="{$link[ 'websiteID' ]}" onclick="deleteEntry(this)" class="slideRight"><i class="fa fa-trash"></i></button>
                        <button data-id="{$link[ 'websiteID' ]}" onclick="edit_entry(this)" class="slideRight"><i class="fa fa-edit"></i></button>
                    </div>
                    <span class="ui-icon ui-icon-arrowthick-2-n-s span-middle"></span>
                    <a href="{$link[ 'websiteURL' ]|unescape:'url'}" target="_blank">{$link[ 'websiteText']}</a>
                </div>
{/foreach}
            </div>
        </div>
    </div>
    <div id="add-row-plus"><i class="fa fa-plus fa-2x"></i></div>
    <div class="row border rounded" id="add-row" style="padding: 8px;">
        <div class="col-sm-12"><h3>Add new row</h3></div>
        <div class="col-sm-12">
            <form action="" method="post" id="save-data">
                <div class="form-group">
                    <label for="input-text">Form text</label>
                    <input type="text" class="form-control" name="input-text" id="input-text" placeholder="Your Site Text" required>
                </div>
                <div class="form-group">
                    <label for="input-url">Form URL</label>
                    <input type="text" class="form-control" name="input-url" id="input-url" placeholder="http://www.example.com" required>
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div id="edit-form" title="Edit Values">
        <form>
            <fieldset>
                <label for="linkname">Link Text</label>
                <input type="text" name="linkname" id="linkname" value="" class="text ui-widget-content ui-corner-all">
                <label for="linkurl">Link URL</label>
                <input type="text" name="linkurl" id="linkurl" value="" class="text ui-widget-content ui-corner-all">

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="hidden" name="linkID" id="linkid">
            </fieldset>
        </form>
    </div>
    <div id="dialog-confirm" title="Empty the recycle bin?">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
            Are you sure you would like to delete this item?</p>
    </div>
 
</div>
{include file="footer.tpl"}
