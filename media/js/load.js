jQuery(document).ready(function () {
    var maxCount = 100;
    var interval = Math.ceil(maxCount/10);
    for (var c=0; c<maxCount; c=c+interval) {
        var range = c.toString() + "-" + ((c+interval)-1).toString();
        var value = (c+1).toString() + "-" + (c+interval).toString();
        console.log(value + " --> " + range);
    }
});
