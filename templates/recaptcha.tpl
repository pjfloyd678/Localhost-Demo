{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=foo}

<style type="text/css">
.img-recatcha-image {
    display: inline-block;
}
#img-recaptcha-images:after {
    clear: both;
}
</style>
<div class="container">
    <div class="row">
        <h3>Recaptcha Script</h3>
        <div class="col-12" id="img-recaptcha">
            <div id="img-recaptcha-images"></div>
            <form name="img-recaptcha-form" id="img-recaptcha-form">
                <label for="img-recaptcha-form-input">
                    <span>Enter the numbers above</span><br />
                    <input id="img-recaptcha-form-input" name="img-recaptcha-form-input" size="9" required="required" />
                </label>
                <div id="img-recaptcha-form-success" class="success"></div>
                <div id="img-recaptcha-form-error" class="error"></div>
                <button type="submit" id="img-recaptcha-form-submit" class="btn btn-success btn-lg">Validate ReCaptcha</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/media/js/img-recaptcha.js"></script>
{include file="footer.tpl"}
