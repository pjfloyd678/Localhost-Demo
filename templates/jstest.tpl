{include file="header.tpl" title="JS Testing" loggedin=false}

<div class="container">
    <hr style="padding: 4px;"/>
    <div class="row border rounded" id="all-data">
        <div class="row col-sm-12 main" id="page-header">
            <div class="col-sm-12"><h3>JS Test</h3></div>
            <div class="col-sm-12">
                <form onsubmit="submitName(event)">
                    <h3>Reverse my Name!</h3>
                    <div class="input-group">
                        <input id="name_input" name="name_input" autocomplete="off" type="text" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <button type="submit" id="reverseButton" class="btn btn-info">Submit</button>
                </form>
                <!-- output p tag -->
                <p id="reversed_name"></p>
                <!-- Adding Script -->
            </div>
        </div>
    </div>
    <hr style="padding: 4px;"/>
    <div class="row border rounded" id="all-data">
        <div class="row col-sm-12 main" id="page-header">
            <div class="col-sm-12"><h3>Read Dataset Value</h3></div>
            <div class="col-sm-12">
                <p id="hiddenvalue" data-hidden="1001" style="cursor: pointer;">There is a hidden value here!</p>
                <button class="btn btn-success" id="clearvalue" style="border: 1px solid darkgrey;">Clear Value</button>
            </div>
            <div class="col-sm-12">
                <p id="showvalue"></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("reverseButton").addEventListener("click", function( evt ){
        evt.preventDefault();
        loadjs('app.js');
        submitName();
    });
    document.getElementById("hiddenvalue").addEventListener("click", function( evt ){
        var value=this.dataset.hidden;
        document.getElementById("showvalue").innerHTML = "<strong>" + value + "</strong>";
    });
    document.getElementById("clearvalue").addEventListener("click", function( evt ) {
        document.getElementById("showvalue").innerHTML = "";
    });
</script>
<script src="jstest.js"></script>
{include file="footer.tpl"}
