<?php
$files = array(
    'TesseractOCR.php',
    'Command.php',
    'FriendlyErrors.php',
    'TesseractOcrException.php',
    'FeatureNotAvailableException.php',
    'ImageNotFoundException.php',
    'NoWritePermissionsForOutputFile.php',
    'Option.php',
    'Process.php',
    'TesseractNotFoundException.php',
    'UnsuccessfulCommandException.php',
);
foreach( $files as $file ) {
    require_once __DIR__ . '/' . $file;
}

$ret = '';
$ret.='<form enctype="multipart/form-data" action="index.php" method="post">';
$ret.="<table><tr><td>";
$ret.='<input type="hidden" name="filename" value="upload">';
$ret.='Send this file: <input name="userfile" type="file">';
$ret.='</td></tr><tr><td>';
$ret.='<input type="submit" value="Parse">';
$ret.='</td></tr></table>';
$ret.='</form>';
echo $ret;
if ( !$_POST ) {
    exit();
}

$tempfile = $_POST['filename'];
if ($tempfile == 'upload') {
	$tempname = $_FILES['userfile']['tmp_name'];
    $filename = $_FILES['userfile']['name'];
    copy( $tempname, __DIR__ . '/../uploads/' . $filename );
    echo ( '<p><img src="/uploads/' . $filename . '"></p>' );
}
use thiagoalessio\TesseractOCR\TesseractOCR;
$tesseract = new TesseractOCR( $tempname );
$string    = $tesseract->run();
?>
<div id='seconds-counter' style="font-size: 200%;"></div>
<p><textarea style="width: 90%; height: 500px; font-size: 200%"><?=$string; ?></textarea></p>

<script>
var seconds = 0;
var el = document.getElementById('seconds-counter');

function incrementSeconds() {
    seconds += 1;
    el.innerText = seconds + " seconds.";
}

var cancel = setInterval(incrementSeconds, 1000);
</script>
