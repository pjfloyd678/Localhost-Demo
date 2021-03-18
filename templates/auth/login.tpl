{include file="header.tpl" title=foo}

<div class="container">
    <hr style="padding: 4px;"/>
    <!-- Login Form -->
    <form action="/auth/authorize.php" method="post">
        <label for="username">
            Username: 
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
        </label>
        <label for="password">
            Password: 
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
        </label>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
</div>
{include file="footer.tpl"}

