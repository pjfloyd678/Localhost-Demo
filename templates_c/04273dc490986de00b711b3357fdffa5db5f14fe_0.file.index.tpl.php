<?php
/* Smarty version 3.1.34-dev-7, created on 2021-01-07 16:18:12
  from 'C:\Projects\localhost\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ff72634cdc497_39999377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04273dc490986de00b711b3357fdffa5db5f14fe' => 
    array (
      0 => 'C:\\Projects\\localhost\\templates\\index.tpl',
      1 => 1610029986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ff72634cdc497_39999377 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "setup", 0);
?>

<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'foo'), 0, false);
?>

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
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['links']->value, 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
                <div class="sortable ui-state-default" data-indx="<?php echo $_smarty_tpl->tpl_vars['link']->value['websiteID'];?>
">
                    <div class="inside-box">
                        <button data-id="<?php echo $_smarty_tpl->tpl_vars['link']->value['websiteID'];?>
" onclick="deleteEntry(this)" class="slideRight"><i class="fa fa-trash"></i></button>
                        <button data-id="<?php echo $_smarty_tpl->tpl_vars['link']->value['websiteID'];?>
" onclick="edit_entry(this)" class="slideRight"><i class="fa fa-edit"></i></button>
                    </div>
                    <span class="ui-icon ui-icon-arrowthick-2-n-s span-middle"></span>
                    <a href="<?php echo rawurldecode($_smarty_tpl->tpl_vars['link']->value['websiteURL']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['link']->value['websiteText'];?>
</a>
                </div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
