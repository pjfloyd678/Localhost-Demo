<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-18 15:34:01
  from 'C:\Projects\Localhost-Demo\templates\xml\xml.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a3c249d572d0_06965471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '604cef3d6e88605eb604879b7d57ccb9915064fb' => 
    array (
      0 => 'C:\\Projects\\Localhost-Demo\\templates\\xml\\xml.tpl',
      1 => 1621344837,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_60a3c249d572d0_06965471 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'foo'), 0, false);
?>

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
                        <span>Save Data and Continue</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 src="/media/js/formvalidate.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
