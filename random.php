<div>
    <input type="text" value="19" size="4" id="size">
    <button onclick="generate()">Generate</button>
</div>
<div>
    <p style="font-size: 20px;">Number is: <code><span id="generated"></span></code></p>
</div>
<script>
    function generate() {
        var size = document.getElementById("size").value;
        var generated = Math.random().toFixed(size).split('.')[1];
        document.getElementById("generated").innerHTML = generated;
    }
</script>