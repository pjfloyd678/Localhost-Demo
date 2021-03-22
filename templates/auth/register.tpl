{include file="header.tpl" title=foo}

<div class="container">
    <hr style="padding: 4px;"/>
    <!-- Login Form -->
    <form action="/auth/register.php" method="post">
        <label for="firstname">
            First Name: 
            <input type="text" id="firstname" class="fadeIn second" name="firstname" placeholder="First Name" required="required">
        </label>
        <label for="lastname">
            Last Name: 
            <input type="text" id="lastname" class="fadeIn second" name="lastname" placeholder="Last Name" required="required">
        </label>
        <label for="emailaddress">
            Email Address: 
            <input type="text" id="emailaddress" class="fadeIn second" name="emailaddress" placeholder="Email Address" required="required">
            <span id="error-message" class="error"></span>
        </label>
        <label for="password">
            Password: 
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required="required">
        </label>
      <input type="submit" class="fadeIn fourth" value="Register">
    </form>
</div>
{include file="footer.tpl"}
