<?PHP
switch($playSlot){
	case 1:
		$vslot->virtualStops = 128;
		$vslot->reel = '';
		$vslot->vmap = '';
		$vslot->weight = '';
		$vslot->payout = '';
		
		$vslot->addStop(0,0,1,20);
		$vslot->addStop(0,1,0,3);
		$vslot->addStop(0,2,2,8);
		$vslot->addStop(0,3,0,3);
		$vslot->addStop(0,4,3,9);
		$vslot->addStop(0,5,0,3);
		$vslot->addStop(0,6,4,6);
		$vslot->addStop(0,7,0,3);
		$vslot->addStop(0,8,5,8);
		$vslot->addStop(0,9,0,3);
		$vslot->addStop(0,10,12,6);
		$vslot->addStop(0,11,0,4);
		$vslot->addStop(0,12,13,6);
		$vslot->addStop(0,13,0,4);
		$vslot->addStop(0,14,14,6);
		$vslot->addStop(0,15,0,5);
		$vslot->addStop(0,16,15,6);
		$vslot->addStop(0,17,0,6);
		$vslot->addStop(0,18,16,6);
		$vslot->addStop(0,19,0,5);
		$vslot->addStop(0,20,17,4);
		$vslot->addStop(0,21,0,4);
		
		$vslot->mapStops(0);
		
		$vslot->addStop(1,0,1,20);
		$vslot->addStop(1,1,0,3);
		$vslot->addStop(1,2,2,12);
		$vslot->addStop(1,3,0,3);
		$vslot->addStop(1,4,3,8);
		$vslot->addStop(1,5,0,2);
		$vslot->addStop(1,6,4,6);
		$vslot->addStop(1,7,0,4);
		$vslot->addStop(1,8,5,4);
		$vslot->addStop(1,9,0,4);
		$vslot->addStop(1,10,12,6);
		$vslot->addStop(1,11,0,3);
		$vslot->addStop(1,12,13,4);
		$vslot->addStop(1,13,0,4);
		$vslot->addStop(1,14,14,3);
		$vslot->addStop(1,15,0,5);
		$vslot->addStop(1,16,15,6);
		$vslot->addStop(1,17,0,6);
		$vslot->addStop(1,18,16,4);
		$vslot->addStop(1,19,0,8);
		$vslot->addStop(1,20,17,3);
		$vslot->addStop(1,21,0,10);
		
		$vslot->mapStops(1);
		
		$vslot->addStop(2,0,1,15);
		$vslot->addStop(2,1,0,4);
		$vslot->addStop(2,2,2,10);
		$vslot->addStop(2,3,0,4);
		$vslot->addStop(2,4,3,6);
		$vslot->addStop(2,5,0,4);
		$vslot->addStop(2,6,4,6);
		$vslot->addStop(2,7,0,4);
		$vslot->addStop(2,8,5,4);
		$vslot->addStop(2,9,0,6);
		$vslot->addStop(2,10,12,3);
		$vslot->addStop(2,11,0,7);
		$vslot->addStop(2,12,13,3);
		$vslot->addStop(2,13,0,5);
		$vslot->addStop(2,14,14,3);
		$vslot->addStop(2,15,0,10);
		$vslot->addStop(2,16,15,2);
		$vslot->addStop(2,17,0,8);
		$vslot->addStop(2,18,16,1);
		$vslot->addStop(2,19,0,10);
		$vslot->addStop(2,20,17,1);
		$vslot->addStop(2,21,0,12);
		
		$vslot->mapStops(2);
	
		$vslot->setPayout('1-a-a',2); //cherry any any
		$vslot->setPayout('a-a-1',2); //any any cherry
		$vslot->setPayout('1-1-a',5); //cherry cherry any
		$vslot->setPayout('a-1-1',5); //any cherry cherry
		$vslot->setPayout('1-1-1',20); //cherry cherry cherry
		$vslot->setPayout('2-2-2',50); //lemon lemon lemon
		$vslot->setPayout('3-3-3',100); //grape grape grape
		$vslot->setPayout('4-4-4',200); //watermelon watermelon watermelon
		$vslot->setPayout('5-5-5',400); //plum plum plum
		$vslot->setPayout('12-12-12',600); //horseshoe horseshoe horseshoe
		$vslot->setPayout('13-13-13',800); //bell bell bell
		
		$vslot->setPayout('14-14-14',1200); //green bar - green bar - green bar
		$vslot->setPayout('15-15-15',1600); //red bar - red bar - red bar
		$vslot->setPayout('16-16-16',2000); //gold bar - gold bar - gold bar
		$vslot->setPayout('17-17-17',5000); //red seven - red seven - red seven
		
		break;
	case 2:
		$vslot->virtualStops = 64;
		$vslot->reel = '';
		$vslot->vmap = '';
		$vslot->weight = '';
		$vslot->payout = '';
		
		$vslot->addStop(0,0,6,3);
		$vslot->addStop(0,1,7,3);
		$vslot->addStop(0,2,8,3);
		$vslot->addStop(0,3,10,3);
		$vslot->addStop(0,4,11,1);
		$vslot->addStop(0,5,12,4);
		$vslot->addStop(0,6,18,1);
		$vslot->addStop(0,7,6,4);
		$vslot->addStop(0,8,7,3);
		$vslot->addStop(0,9,8,3);
		$vslot->addStop(0,10,10,4);
		$vslot->addStop(0,11,18,1);
		$vslot->addStop(0,12,12,4);
		$vslot->addStop(0,13,6,5);
		$vslot->addStop(0,14,7,1);
		$vslot->addStop(0,15,6,3);
		$vslot->addStop(0,16,10,3);
		$vslot->addStop(0,17,10,3);
		$vslot->addStop(0,18,12,3);
		$vslot->addStop(0,19,6,3);
		$vslot->addStop(0,20,7,3);
		$vslot->addStop(0,21,8,3);
		
		$vslot->mapStops(0);
		
		$vslot->addStop(1,0,6,4);
		$vslot->addStop(1,1,9,7);
		$vslot->addStop(1,2,12,1);
		$vslot->addStop(1,3,10,4);
		$vslot->addStop(1,4,12,1);
		$vslot->addStop(1,5,10,2);
		$vslot->addStop(1,6,18,1);
		$vslot->addStop(1,7,9,8);
		$vslot->addStop(1,8,7,3);
		$vslot->addStop(1,9,6,3);
		$vslot->addStop(1,10,10,3);
		$vslot->addStop(1,11,11,1);
		$vslot->addStop(1,12,10,3);
		$vslot->addStop(1,13,6,3);
		$vslot->addStop(1,14,7,3);
		$vslot->addStop(1,15,9,7);
		$vslot->addStop(1,16,10,2);
		$vslot->addStop(1,17,18,1);
		$vslot->addStop(1,18,8,2);
		$vslot->addStop(1,19,6,1);
		$vslot->addStop(1,20,9,3);
		$vslot->addStop(1,21,6,1);
		
		$vslot->mapStops(1);
		
		$vslot->addStop(2,0,6,3);
		$vslot->addStop(2,1,7,3);
		$vslot->addStop(2,2,8,3);
		$vslot->addStop(2,3,6,3);
		$vslot->addStop(2,4,6,3);
		$vslot->addStop(2,5,12,1);
		$vslot->addStop(2,6,18,1);
		$vslot->addStop(2,7,6,6);
		$vslot->addStop(2,8,7,3);
		$vslot->addStop(2,9,8,3);
		$vslot->addStop(2,10,7,3);
		$vslot->addStop(2,11,6,5);
		$vslot->addStop(2,12,12,1);
		$vslot->addStop(2,13,9,4);
		$vslot->addStop(2,14,7,3);
		$vslot->addStop(2,15,8,3);
		$vslot->addStop(2,16,8,3);
		$vslot->addStop(2,17,11,1);
		$vslot->addStop(2,18,12,1);
		$vslot->addStop(2,19,6,5);
		$vslot->addStop(2,20,7,3);
		$vslot->addStop(2,21,8,3);
		
		$vslot->mapStops(2);
	
		$vslot->setPayout('10-a-a',2); //green clover - any - any
		$vslot->setPayout('10-10-a',5); //green clover - green clover - any
		$vslot->setPayout('6-6-9',5); //emerald - emerald - heart
		$vslot->setPayout('6-6-6',10); //emerald - emerald - emerald
		$vslot->setPayout('7-7-9',10); //ruby - ruby - heart
		$vslot->setPayout('7-7-7',20); //ruby - ruby - ruby
		$vslot->setPayout('8-8-9',20); //diamond - diamond - heart
		$vslot->setPayout('8-8-8',40); //diamond - diamond - diamond
		$vslot->setPayout('12-12-9',50); //horseshoe - horseshoe - heart
		$vslot->setPayout('12-12-12',100); //horseshoe - horseshoe - horseshoe
		$vslot->setPayout('18-18-9',250); //gold seven - gold seven - heart
		$vslot->setPayout('18-18-18',500); //gold seven - gold seven - gold seven
		$vslot->setPayout('11-11-11',1000); //gold clover - gold clover - gold clover
		
		break;
	case 3:
		$vslot->virtualStops = 64;
		$vslot->reel = '';
		$vslot->vmap = '';
		$vslot->weight = '';
		$vslot->payout = '';
		
		$vslot->addStop(0,0,14,3);
		$vslot->addStop(0,1,0,3);
		$vslot->addStop(0,2,15,3);
		$vslot->addStop(0,3,0,3);
		$vslot->addStop(0,4,16,1);
		$vslot->addStop(0,5,0,4);
		$vslot->addStop(0,6,17,1);
		$vslot->addStop(0,7,0,4);
		$vslot->addStop(0,8,18,3);
		$vslot->addStop(0,9,0,3);
		$vslot->addStop(0,10,16,4);
		$vslot->addStop(0,11,0,1);
		$vslot->addStop(0,12,17,4);
		$vslot->addStop(0,13,0,5);
		$vslot->addStop(0,14,14,1);
		$vslot->addStop(0,15,0,3);
		$vslot->addStop(0,16,17,3);
		$vslot->addStop(0,17,0,3);
		$vslot->addStop(0,18,14,3);
		$vslot->addStop(0,19,0,3);
		$vslot->addStop(0,20,15,3);
		$vslot->addStop(0,21,0,3);
		
		$vslot->mapStops(0);
		
		$vslot->addStop(1,0,14,1);
		$vslot->addStop(1,1,0,4);
		$vslot->addStop(1,2,16,3);
		$vslot->addStop(1,3,0,3);
		$vslot->addStop(1,4,17,1);
		$vslot->addStop(1,5,0,4);
		$vslot->addStop(1,6,17,1);
		$vslot->addStop(1,7,0,4);
		$vslot->addStop(1,8,14,3);
		$vslot->addStop(1,9,0,4);
		$vslot->addStop(1,10,14,3);
		$vslot->addStop(1,11,0,4);
		$vslot->addStop(1,12,15,2);
		$vslot->addStop(1,13,0,5);
		$vslot->addStop(1,14,17,1);
		$vslot->addStop(1,15,0,3);
		$vslot->addStop(1,16,16,3);
		$vslot->addStop(1,17,0,3);
		$vslot->addStop(1,18,18,3);
		$vslot->addStop(1,19,0,3);
		$vslot->addStop(1,20,15,3);
		$vslot->addStop(1,21,0,3);
		
		$vslot->mapStops(1);
		
		$vslot->addStop(2,0,14,3);
		$vslot->addStop(2,1,0,3);
		$vslot->addStop(2,2,15,2);
		$vslot->addStop(2,3,0,3);
		$vslot->addStop(2,4,16,1);
		$vslot->addStop(2,5,0,4);
		$vslot->addStop(2,6,15,1);
		$vslot->addStop(2,7,0,8);
		$vslot->addStop(2,8,18,1);
		$vslot->addStop(2,9,0,8);
		$vslot->addStop(2,10,15,1);
		$vslot->addStop(2,11,0,1);
		$vslot->addStop(2,12,14,1);
		$vslot->addStop(2,13,0,5);
		$vslot->addStop(2,14,16,1);
		$vslot->addStop(2,15,0,4);
		$vslot->addStop(2,16,17,1);
		$vslot->addStop(2,17,0,4);
		$vslot->addStop(2,18,14,3);
		$vslot->addStop(2,19,0,4);
		$vslot->addStop(2,20,17,1);
		$vslot->addStop(2,21,0,4);
		
		$vslot->mapStops(2);
		
		//green bar - any bar - any bar
		$vslot->setPayout('14-15-14',2); //green bar - red bar - green bar
		$vslot->setPayout('14-15-15',2); //green bar - red bar - red bar
		$vslot->setPayout('14-15-16',2); //green bar - red bar - gold bar
		$vslot->setPayout('14-16-14',2); //green bar - gold bar - green bar
		$vslot->setPayout('14-16-15',2); //green bar - gold bar - red bar
		$vslot->setPayout('14-16-16',2); //green bar - gold bar - gold bar
		
		//green bar - green bar - any bar
		$vslot->setPayout('14-14-15',5); //green bar - green bar - red bar
		$vslot->setPayout('14-14-16',5); //green bar - green bar - gold bar
		
		//red bar - any bar - any bar
		$vslot->setPayout('15-14-14',10); //red bar - green bar - green bar
		$vslot->setPayout('15-14-15',10); //red bar - green bar - red bar
		$vslot->setPayout('15-14-16',10); //red bar - green bar - gold bar
		$vslot->setPayout('15-16-14',10); //red bar - gold bar - green bar
		$vslot->setPayout('15-16-15',10); //red bar - gold bar - red bar
		$vslot->setPayout('15-16-16',10); //red bar - gold bar - gold bar
		
		//red bar - red bar - any bar
		$vslot->setPayout('15-15-14',20); //red bar - red bar - green bar
		$vslot->setPayout('15-15-16',20); //red bar - red bar - gold bar
		
		//gold bar - any bar - any bar
		$vslot->setPayout('16-14-14',50); //gold bar - green bar - green bar
		$vslot->setPayout('16-14-15',50); //gold bar - green bar - red bar
		$vslot->setPayout('16-14-16',50); //gold bar - green bar - gold bar
		$vslot->setPayout('16-15-14',50); //gold bar - red bar - green bar
		$vslot->setPayout('16-15-15',50); //gold bar - red bar - red bar
		$vslot->setPayout('16-15-16',50); //gold bar - red bar - gold bar
		
		//gold bar - gold bar - any bar
		$vslot->setPayout('16-16-14',100); //gold bar - gold bar - green bar
		$vslot->setPayout('16-16-15',100); //gold bar - gold bar - red bar
		
		$vslot->setPayout('14-14-14',200); //green bar - green bar - green bar
		$vslot->setPayout('15-15-15',300); //red bar - red bar - red bar
		$vslot->setPayout('16-16-16',400); //gold bar - gold bar - gold bar
		$vslot->setPayout('17-17-17',500); //red seven - red seven - red seven
		$vslot->setPayout('18-18-18',1000); //gold seven - gold seven - gold seven
		
		break;
}
?>
