<?PHP
error_reporting(E_ALL ^ E_NOTICE);

session_start();

include('class.vslot.php');
$vslot = new vslot();

if( $vslot->credits < 1 ){
	$vslot->addCredits(100);
}

$playSlot = ( !empty($_REQUEST['slot']) ) ? $_REQUEST['slot'] : 0;
include('otherslots.php');

$vslot->pullHandle();

?>
<html>
	<head>
		<title>Virtual Slots</title>
	</head>
	<body>
		<?PHP echo $vslot->showResult();?>
		<h4>Credits: <?PHP echo $vslot->credits;?></h4>
		<h4>Winnings: <?PHP echo $vslot->winnings;?></h4>
		<div>[<a href="play.php<?PHP echo ( !empty($playSlot) ) ? '?slot='.$playSlot : '';?>">Pull the handle</a>]</div>
		<div>[<a href="test.php<?PHP echo ( !empty($playSlot) ) ? '?slot='.$playSlot : '';?>">Examine this slot</a>]</div>
		<div>[<a href="index.php">Select a different slot</a>]</div>
	</body>
</html>
