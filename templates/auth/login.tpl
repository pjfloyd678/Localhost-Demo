{include file="header.tpl" title="Localhost"}

<div class="container">
    <hr style="padding: 4px;" />
    <!-- Login Form -->
    {if !empty( $message ) }
        <div class="row"><strong>{$message}</strong></div>
    {/if}
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
        {if !empty( $loginmessage ) }
            <span id="login-error">{$loginmessage}</span>
        {/if}
    </form>
    <div class="row">
        <p><a href="/auth/register.php">Register</a></p>
    </div>
</div>
{include file="footer.tpl"}