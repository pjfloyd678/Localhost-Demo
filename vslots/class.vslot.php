<?PHP
/*
vslot class - virtual slot machine
version 1.0 3/3/2015

Copyright (c) 2015, Wagon Trader
All rights reserved.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT 
OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
class vslot{
	
	//*********************************************************
	// Settings
	//*********************************************************
	
	var $symbolPath = 'symbols/'; //relative path to slot symbols
	
	var $virtualStops = 128; //number of stops on the virtual reel
	
	var $blankSymbol = 0; //symbolID for blank symbol
	
	var $minRandomPulls = 1000; // minimum number of pulls to generate before result
	
	var $maxRandomPulls = 5000; //maximum number of pulls to generate before result
	
	var $symbol; //slot symbol names and images
	var $reel; //symbolID on reel and stop
	var $vmap; //map of virtual stops to reel stops
	var $weight; //weight assigned to reel and stop
	var $payout; //payouts amounts
	var $result; //physical stop result from handle pull
	var $winnings; //calculated winnings from handle pull
	var $credits; //players current credits
	
	/* vslot class initialization
	usage: vslot([bool doDefault=true]);
	params: doDefault = initialize script with default values

	This method is automatically called when the class is initialized. If doDefault param is true, it
	will initialize the script with default values. It also checks the session for player credits and
	assigns them to the credits variable.
	
	retuns:	void
	*/
	function __construct($doDefault=true){
		if ( ! isset( $this->symbol ) ) {
			$this->symbol = array();
		}
		if ( ! isset( $this->reel ) ) {
			$this->reel = array();
		}
		if( $doDefault == true ){
			$this->setDefaultSymbols();
			$this->setDefaultReels();
			$this->setDefaultPayout();
		}
		if( !empty($_SESSION['vslot_credits']) ){
			$this->credits = $_SESSION['vslot_credits'];
		}
	}
	
	/* method:	pullHandle
	usage:	pullHandle([int multiplier=1]);
	params:	multiplier = number of credits to charge against player and multipier for winnings.
	
	This method will simulate the handle pull on a slot machine. It reduces credits from the player
	for the handle pull, runs through a series of pulls to emulate real world slot constant number
	generation, sets the result and pays the player if there are any winnings.
	
	returns: void
	*/
	function pullHandle($multiplier=1){
		$this->credits -= $multiplier;
		$randMax = mt_getrandmax();
		$randomPulls = mt_rand($this->minRandomPulls,$this->maxRandomPulls);
		for($x=0;$x<$randomPulls;$x++){
			$stop[0] = mt_rand()%($this->virtualStops-1);
			$stop[1] = mt_rand()%($this->virtualStops-1);
			$stop[2] = mt_rand()%($this->virtualStops-1);
		}
		$this->result[0] = $this->vmap[0][$stop[0]];
		$this->result[1] = $this->vmap[1][$stop[1]];
		$this->result[2] = $this->vmap[2][$stop[2]];
		
		$this->calculateWinnings($multiplier);
		$this->addCredits($this->winnings);
	}
	
	/* method:	addCredits
	usage:	addCredits(int credits);
	params:	credits = number of credits to add to players session.
	
	This method will add the specified credits to the players session.
	
	returns: void
	*/
	function addCredits($credits){
		$this->credits += $credits;
		$_SESSION['vslot_credits'] = $this->credits;
	}
	
	/* method:	calculateWinnings
	usage:	calculateWinnings([int multiplier=1]);
	params:	multiplier = multiplier for winnings.
	
	This method will calculate the winnings and add it to the players session.
	
	returns: void
	*/
	function calculateWinnings($multiplier=1){
		$this->winnings = 0;
		
		$checkString = $this->reel[0][$this->result[0]].'-'.$this->reel[1][$this->result[1]].'-'.$this->reel[2][$this->result[2]];
		$checkString2 = $this->reel[0][$this->result[0]].'-'.$this->reel[1][$this->result[1]].'-a';
		$checkString3 = $this->reel[0][$this->result[0]].'-a-a';
		$checkString4 = 'a-'.$this->reel[1][$this->result[1]].'-'.$this->reel[2][$this->result[2]];
		$checkString5 = 'a-a-'.$this->reel[2][$this->result[2]];
		
		if( array_key_exists($checkString,$this->payout) ){
			$this->winnings += $multiplier*$this->payout[$checkString];
		}else{
			if( array_key_exists($checkString2,$this->payout) ){
				$this->winnings += $multiplier*$this->payout[$checkString2];
			}elseif( array_key_exists($checkString3,$this->payout) ){
				$this->winnings += $multiplier*$this->payout[$checkString3];
			}
			if( array_key_exists($checkString4,$this->payout) ){
				$this->winnings += $multiplier*$this->payout[$checkString4];
			}elseif( array_key_exists($checkString5,$this->payout) ){
				$this->winnings += $multiplier*$this->payout[$checkString5];
			}
		}
	}
	
	/* method:	showResult
	usage:	showResult();
	params:	void
	
	This method will display the slot symbols for the current result.
	
	returns: html markup
	*/
	function showResult(){
		$maxStops = count($this->reel[0])-1;
		
		$stop[0][0] = ( $this->result[0] > 0 ) ? $this->result[0] - 1 : $maxStops;
		$stop[0][1] = $this->result[0];
		$stop[0][2] = ( $this->result[0] == $maxStops ) ? 0 : $this->result[0]+1;
		$stop[1][0] = ( $this->result[1] > 0 ) ? $this->result[1] - 1 : $maxStops;
		$stop[1][1] = $this->result[1];
		$stop[1][2] = ( $this->result[1] == $maxStops ) ? 0 : $this->result[1]+1;
		$stop[2][0] = ( $this->result[2] > 0 ) ? $this->result[2] - 1 : $maxStops;
		$stop[2][1] = $this->result[2];
		$stop[2][2] = ( $this->result[2] == $maxStops ) ? 0 : $this->result[2]+1;
		$html = '';
		$html .= '<img src="'.$this->symbolPath.$this->symbol[$this->reel[0][$stop[0][0]]]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$this->reel[1][$stop[1][0]]]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$this->reel[2][$stop[2][0]]]['image'].'"><br>';
		$html .= '<img src="'.$this->symbolPath.$this->symbol[$this->reel[0][$stop[0][1]]]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$this->reel[1][$stop[1][1]]]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$this->reel[2][$stop[2][1]]]['image'].'"><br>';
		$html .= '<img src="'.$this->symbolPath.$this->symbol[$this->reel[0][$stop[0][2]]]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$this->reel[1][$stop[1][2]]]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$this->reel[2][$stop[2][2]]]['image'].'"><br>';
		return $html;
	}
	
	/* method:	addSymbol
	usage:	addSymbol(string name, string image);
	params:	name = image text name.
			image = image filename.
	
	This method will add the image details to the class variable symbol.
	
	returns void
	*/
	function addSymbol($name,$image){
		$symbolID = count($this->symbol);
		$this->symbol[$symbolID]['name'] = $name;
		$this->symbol[$symbolID]['image'] = $image;
	}
	
	/* method:	setSymbol
	usage:	setSymbol(int symbolID, string name, string image);
	params:	symbolID = current id number for the image
			name = image text name.
			image = image filename.
	
	This method will change the image details of the specified image in the class variable symbol.
	
	returns void
	*/
	function setSymbol($symbolID,$name,$image){
		$this->symbol[$symbolID]['name'] = $name;
		$this->symbol[$symbolID]['image'] = $image;
	}
	
	/* method:	addStop
	usage:	addStop(int reel, int stop, int symbolID, int weight);
	params:	reel = reel number.
			stop = stop location on the reel.
			symbolID = id of the image located at this stop.
			weight = number of times this stop is represented on the virtual reel
	
	This method will add the details for the stop on the specified reel.
	
	returns void
	*/
	function addStop($reel,$stop,$symbolID,$weight=0){
		$this->reel[$reel][$stop] = $symbolID;
		$this->weight[$reel][$stop] = $weight;
	}
	
	/* method:	setWeight
	usage:	setWeight(int reel, int stop, int weight);
	params:	reel = reel number.
			stop = stop location on the reel.
			weight = number of times this stop is represented on the virtual reel
	
	This method will set the details for the weight on the specified reel.
	
	returns void
	*/
	function setWeight($reel,$stop,$weight){
		$this->weight[$reel][$stop] = $weight;
	}
	
	/* method:	setPayout
	usage:	setPayout(string payString, int payout);
	params:	payString = representation of the string for the payout. An example payString
				would be '3-3-3' which is the symbolID that appears on each reel, in this
				case it would represent grape-grape-grape. Use a lowercase a to represent
				any symbol, so '1-a-a' represents cherry-any-any.
			payout = the payout to the player when hit.
	
	This method will add the payout for a specified result.
	
	returns void
	*/
	function setPayout($payString,$payout){
		$this->payout[$payString] = $payout;
	}
	
	/* method:	findWeight
	usage:	findWeight(int reel, int symbolID);
	params:	reel = reel number.
			symbolID = id of the image from the result on this reel.
	
	This method will calculate the total wieghts of the specified image located anywhere on the reel.
	
	returns weight
	*/
	function findWeight($reel,$symbolID){
		$weight = 0;
		for($x=0;$x<count($this->reel[$reel]);$x++){
			$weight += ( $this->reel[$reel][$x] == $symbolID ) ? $this->weight[$reel][$x] : 0;
		}
		return $weight;
	}
	
	/* method:	findWeightAll
	usage:	findWeightAll(int reel, int excludeSymbol);
	params:	reel = reel number.
			excludeSymbol = id of the image to be excluded.
	
	This method will calculate the total wieght of all images on the reel, exluding the specified imageID.
	
	returns weight
	*/
	function findWeightAll($reel,$excludeSymbol){
		$weight = 0;
		for($x=0;$x<count($this->reel[$reel]);$x++){
			$weight += ( $this->reel[$reel][$x] == $excludeSymbol ) ? 0 : $this->weight[$reel][$x];
		}
		return $weight;
	}
	
	/* method:	mapStops
	usage:	mapStops(int reel);
	params:	reel = reel number.
	
	This method will generate the virtual reel and map the stops back to the specified reel. Once mapped, it will
	shuffle the results for a random outcome based on weight.
	
	returns void
	*/
	function mapStops($reel){
		$count = 0;
		for($x=0;$x<count($this->reel[$reel]);$x++){
			$weight = $this->weight[$reel][$x];
			for($y=0;$y<$weight;$y++){
				$this->vmap[$reel][$count] = $x;
				$count++;
			}
		}
		if( $count < $this->virtualStops-1 ){
			while( $count < $this->virtualStops ){
				$stop = mt_rand(0,count($this->reel[$reel])-1);
				$this->vmap[$reel][$count] = $stop;
				$count++;
			}
		}
		shuffle($this->vmap[$reel]);
	}
	
	function setDefaultSymbols(){
		/*
			0 = blank
			1 = cherry
			2 = lemon
			3 = grape
			4 = watermelon
			5 = plum
			6 = emerald
			7 = ruby
			8 = diamond
			9 = heart
			10 = green clover
			11 = gold clover
			12 = horseshoe
			13 = bell
			14 = green bar
			15 = red bar
			16 = gold bar
			17 = red seven
			18 = gold seven
		*/
		$this->addSymbol('blank','blank.jpg');
		$this->addSymbol('cherry','cherry.jpg');
		$this->addSymbol('lemon','lemon.jpg');
		$this->addSymbol('grape','grape.jpg');
		$this->addSymbol('watermelon','watermelon.jpg');
		$this->addSymbol('plum','plum.jpg');
		$this->addSymbol('emerald','emerald.jpg');
		$this->addSymbol('ruby','ruby.jpg');
		$this->addSymbol('diamond','diamond.jpg');
		$this->addSymbol('heart','heart.jpg');
		$this->addSymbol('green clover','greenclover.jpg');
		$this->addSymbol('gold clover','goldclover.jpg');
		$this->addSymbol('horseshoe','horseshoe.jpg');
		$this->addSymbol('bell','bell.jpg');
		$this->addSymbol('green bar','greenbar.jpg');
		$this->addSymbol('red bar','redbar.jpg');
		$this->addSymbol('gold bar','goldbar.jpg');
		$this->addSymbol('red seven','redseven.jpg');
		$this->addSymbol('gold seven','goldseven.jpg');
	}
	
	function setDefaultReels(){
		$this->addStop(0,0,1,20);
		$this->addStop(0,1,0,3);
		$this->addStop(0,2,2,8);
		$this->addStop(0,3,0,3);
		$this->addStop(0,4,3,9);
		$this->addStop(0,5,0,3);
		$this->addStop(0,6,4,6);
		$this->addStop(0,7,0,3);
		$this->addStop(0,8,5,8);
		$this->addStop(0,9,0,3);
		$this->addStop(0,10,12,6);
		$this->addStop(0,11,0,4);
		$this->addStop(0,12,13,6);
		$this->addStop(0,13,0,4);
		$this->addStop(0,14,14,6);
		$this->addStop(0,15,0,5);
		$this->addStop(0,16,15,6);
		$this->addStop(0,17,0,6);
		$this->addStop(0,18,16,6);
		$this->addStop(0,19,0,5);
		$this->addStop(0,20,17,4);
		$this->addStop(0,21,0,4);
		
		$this->mapStops(0);
		
		$this->addStop(1,0,1,20);
		$this->addStop(1,1,0,3);
		$this->addStop(1,2,2,12);
		$this->addStop(1,3,0,3);
		$this->addStop(1,4,3,8);
		$this->addStop(1,5,0,2);
		$this->addStop(1,6,4,6);
		$this->addStop(1,7,0,4);
		$this->addStop(1,8,5,4);
		$this->addStop(1,9,0,4);
		$this->addStop(1,10,12,6);
		$this->addStop(1,11,0,3);
		$this->addStop(1,12,13,4);
		$this->addStop(1,13,0,4);
		$this->addStop(1,14,14,3);
		$this->addStop(1,15,0,5);
		$this->addStop(1,16,15,6);
		$this->addStop(1,17,0,6);
		$this->addStop(1,18,16,4);
		$this->addStop(1,19,0,8);
		$this->addStop(1,20,17,3);
		$this->addStop(1,21,0,10);
		
		$this->mapStops(1);
		
		$this->addStop(2,0,1,15);
		$this->addStop(2,1,0,4);
		$this->addStop(2,2,2,10);
		$this->addStop(2,3,0,4);
		$this->addStop(2,4,3,6);
		$this->addStop(2,5,0,4);
		$this->addStop(2,6,4,6);
		$this->addStop(2,7,0,4);
		$this->addStop(2,8,5,4);
		$this->addStop(2,9,0,6);
		$this->addStop(2,10,12,3);
		$this->addStop(2,11,0,7);
		$this->addStop(2,12,13,3);
		$this->addStop(2,13,0,5);
		$this->addStop(2,14,14,3);
		$this->addStop(2,15,0,10);
		$this->addStop(2,16,15,2);
		$this->addStop(2,17,0,8);
		$this->addStop(2,18,16,1);
		$this->addStop(2,19,0,10);
		$this->addStop(2,20,17,1);
		$this->addStop(2,21,0,12);
		
		$this->mapStops(2);
	}
	
	function setDefaultPayout(){
		$this->setPayout('1-a-a',2); //cherry any any
		$this->setPayout('a-a-1',2); //any any cherry
		$this->setPayout('1-1-a',5); //cherry cherry any
		$this->setPayout('a-1-1',5); //any cherry cherry
		$this->setPayout('1-1-1',20); //cherry cherry cherry
		$this->setPayout('2-2-2',50); //lemon lemon lemon
		$this->setPayout('3-3-3',100); //grape grape grape
		$this->setPayout('4-4-4',200); //watermelon watermelon watermelon
		$this->setPayout('5-5-5',400); //plum plum plum
		$this->setPayout('12-12-12',600); //horseshoe horseshoe horseshoe
		$this->setPayout('13-13-13',800); //bell bell bell
		
		$this->setPayout('14-14-14',1200); //green bar - green bar - green bar
		$this->setPayout('15-15-15',1600); //red bar - red bar - red bar
		$this->setPayout('16-16-16',2000); //gold bar - gold bar - gold bar
		$this->setPayout('17-17-17',5000); //red seven - red seven - red seven
	}
	
	function checkSettings(){
		
		$weight0 = 0;
		$weight1 = 0;
		$weight2 = 0;
		$averageReturnTotal = 0;
		
		$totalCombinations = $this->virtualStops * $this->virtualStops * $this->virtualStops;
		
		$html = '';
		
		$html .= '<p>This machine has '.$this->virtualStops.' virtual stops for a total of '.number_format($totalCombinations).' combinations, using 3 reels with '.count($this->reel[0]).' physical stops on each reel</p>';
		
		$html .= '<table border="1">';
		$html .= '<tr><td colspan="5">Payout Table (a = any)</td></tr>';
		$html .='<tr><td>Code</td><td>&nbsp;</td><td>Probablity</td><td>Payout</td><td>Return</td></tr>';
		foreach($this->payout as $key=>$value){
			list($reel0,$reel1,$reel2) = explode('-',$key);
			
			if( $reel0 == 'a' ){
				$reel0Symbol = $this->blankSymbol;
				if( $reel1 != 'a' ){
					$excludeSymbol = $reel1;
				}elseif( $reel2 != 'a' ){
					$excludeSymbol = $reel2;
				}else{
					$excludeSymbol = '';
				}
				$reel0Weight = $this->findWeightAll(0,$excludeSymbol);
			}else{
				$reel0Symbol = $reel0;
				$reel0Weight = $this->findWeight(0,$reel0);
			}

			if( $reel1 == 'a' ){
				$reel1Symbol = $this->blankSymbol;
				if( $reel0 != 'a' ){
					$excludeSymbol = $reel0;
				}elseif( $reel2 != 'a' ){
					$excludeSymbol = $reel2;
				}else{
					$excludeSymbol = '';
				}
				$reel1Weight = $this->findWeightAll(1,$excludeSymbol);
			}else{
				$reel1Symbol = $reel1;
				$reel1Weight = $this->findWeight(1,$reel1);
			}
			
			if( $reel2 == 'a' ){
				$reel2Symbol = $this->blankSymbol;
				if( $reel0 != 'a' ){
					$excludeSymbol = $reel0;
				}elseif( $reel1 != 'a' ){
					$excludeSymbol = $reel1;
				}else{
					$excludeSymbol = '';
				}
				$reel2Weight = $this->findWeightAll(2,$excludeSymbol);
			}else{
				$reel2Symbol = $reel2;
				$reel2Weight = $this->findWeight(2,$reel2);
			}
			
			$payoffProbability = $reel0Weight*$reel1Weight*$reel2Weight/$totalCombinations;
			
			$averageReturn = $payoffProbability*$value*100;
			$averageReturnTotal += $payoffProbability*$value;
			
			$html .= '<tr><td>'.$key.'</td>';
			$html .= '<td><img src="'.$this->symbolPath.$this->symbol[$reel0Symbol]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$reel1Symbol]['image'].'"><img src="'.$this->symbolPath.$this->symbol[$reel2Symbol]['image'].'"></td>';
			$html .= '<td>'.$payoffProbability.'</td>';
			$html .= '<td>'.$value.'</td>';
			$html .= '<td>'.$averageReturn.'</td></tr>';
		}
		$averageReturnTotal = $averageReturnTotal * 100;
		
		$html .= '<tr><td colspan="5">Average return is '.$averageReturnTotal.' (this should be under 100 if the house plans on making a profit)</td></tr>';
		$html .= '</table>';
		
		$html .= '<div style="margin-top:10px;"></div>';
		$html .= '<table border="1">';
		$html .= '<tr><td colspan="4">Reels</td></tr>';
		$html .= '<tr><td>Stop</td><td align="center">0</td><td align="center">1</td><td align="center">2</td></tr>';
		for($x=0;$x<count($this->reel[0]);$x++){
			
			$weight0 += $this->weight[0][$x];
			$weight1 += $this->weight[1][$x];
			$weight2 += $this->weight[2][$x];
			
			$html .= '<tr><td>'.$x.'</td>';
			$html .= '<td><img src="'.$this->symbolPath.$this->symbol[$this->reel[0][$x]]['image'].'"></td>';
			$html .= '<td><img src="'.$this->symbolPath.$this->symbol[$this->reel[1][$x]]['image'].'"></td>';
			$html .= '<td><img src="'.$this->symbolPath.$this->symbol[$this->reel[2][$x]]['image'].'"></td></tr>';
			$html .= '<tr><td>weight</td>';
			$html .= '<td align="center">'.$this->weight[0][$x].'</td>';
			$html .= '<td align="center">'.$this->weight[1][$x].'</td>';
			$html .= '<td align="center">'.$this->weight[2][$x].'</td></tr>';
		}
		$html .= '<tr><td colspan="4">&nbsp;</td></tr>';
		$html .= '<tr><td align="center" colspan="4"><strong>Total weight below should equal '.$this->virtualStops.' on each reel</strong></td></tr>';
		$html .= '<tr><td>total</td>';
		$html .= '<td align="center">'.$weight0.'</td>';
		$html .= '<td align="center">'.$weight1.'</td>';
		$html .= '<td align="center">'.$weight2.'</td></tr>';
		$html .= '</table>';
		
		return $html;
	}
}
?>
