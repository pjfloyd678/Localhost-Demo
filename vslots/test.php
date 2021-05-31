<?PHP
error_reporting(E_ALL ^ E_NOTICE);

session_start();

include('class.vslot.php');
$vslot = new vslot();

$playSlot = ( !empty($_REQUEST['slot']) ) ? $_REQUEST['slot'] : 0;
include('otherslots.php');

?>
<html>
	<head>
		<title>Virtual Slots</title>
	</head>
	<body>
		<div>[<a href="play.php<?PHP echo ( !empty($playSlot) ) ? '?slot='.$playSlot : '';?>">Play this slot</a>]</div>
		<?PHP echo $vslot->checkSettings();?>
		<div>[<a href="play.php<?PHP echo ( !empty($playSlot) ) ? '?slot='.$playSlot : '';?>">Play this slot</a>]</div>
	</body>
</html>
