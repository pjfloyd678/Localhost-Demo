{include file="header.tpl"}
<div class="container">
    <hr style="padding: 4px;"/>
    <div class="row border rounded" id="all-data">
        <div class="row col-sm-12 main" id="page-header">
            <div class="col-sm-8"><h2>Install Localhost Links</h2></div>
            <div class="col-sm-12">
                <form action="/setup.php" method="post" id="save-data">
                    <div>
                        <h3>Database Information</h3>
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label for="dbname">Database Name:
                        <input type="text" class="form-control" name="dbname" id="dbname" placeholder="" required></label>
                    </div>
                    <div class="form-group">
                        <label for="username">Database Username:
                        <input type="text" class="form-control" name="username" id="username" placeholder="Your DB Username" required></label>
                    </div>
                    <div class="form-group">
                        <label for="password">Database Password:
                        <input type="password" class="form-control" name="password" id="password" placeholder="Your DB Password" required></label>
                    </div>
                    <div class="form-group">
                        <label for="hostname">Hostname: 
                        <input type="text" class="form-control" name="hostname" id="hostname" value="localhost" required></label>
                    </div>
                    <div class="form-group">
                        <label for="port">Port:
                        <input type="text" class="form-control" name="port" id="port" value="3306" required></label>
                    </div>
                    <div class="form-group">
                        <label for="tablename">Table Name:
                        <input type="text" class="form-control" name="tablename" id="tablename" value="sites" required></label>
                    </div>
                    <div><h3>Site Information</h3></div>
                    <div class="form-group">
                        <label for="httphost">Site URL:
                        <input type="text" class="form-control" name="httphost" id="httphost" value="http://localhost" required></label>
                    </div>
                    <div class="form-group">
                        <label for="username">Site User/Email Address:
                        <input type="text" class="form-control" name="email" id="email" placeholder="Your Email" required></label>
                    </div>
                    <div class="form-group">
                        <label for="password">Site Password:
                        <input type="password" class="form-control" name="sitepass" id="sitepass" placeholder="Your Site Password" required></label>
                    </div>
                    <button type="submit" id="install-submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="success" id="success"></div>
        <div class="error" id="errorMessage"></div>
    </div>
</div>
{include file="footer.tpl"}
