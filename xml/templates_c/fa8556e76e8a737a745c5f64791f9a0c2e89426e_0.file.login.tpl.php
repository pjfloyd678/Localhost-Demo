<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-18 15:39:22
  from 'C:\Projects\Localhost-Demo\templates\auth\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a3c38abda965_78942590',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa8556e76e8a737a745c5f64791f9a0c2e89426e' => 
    array (
      0 => 'C:\\Projects\\Localhost-Demo\\templates\\auth\\login.tpl',
      1 => 1616433904,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_60a3c38abda965_78942590 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'foo'), 0, false);
?>

<div class="container">
    <hr style="padding: 4px;" />
    <!-- Login Form -->
    <?php if (!empty($_smarty_tpl->tpl_vars['message']->value)) {?>
        <div class="row"><strong><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</strong></div>
    <?php }?>
    <form action="/auth/authorize.php" method="post">
        <label for="username">
            Email Address:
            <input type="text" id="login" class="fadeIn second" name="emailaddress" placeholder="email address">
        </label>
        <label for="password">
            Password:
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
        </label>
        <input type="submit" class="fadeIn fourth" value="Log In">
        <?php if (!empty($_smarty_tpl->tpl_vars['loginmessage']->value)) {?>
            <span id="login-error"><?php echo $_smarty_tpl->tpl_vars['loginmessage']->value;?>
</span>
        <?php }?>
    </form>
    <div class="row">
        <p><a href="/auth/register.php">Register</a></p>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
