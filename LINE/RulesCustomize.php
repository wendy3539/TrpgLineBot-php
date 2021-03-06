<?php
function Rules_Operating($inputStr,$userName) { 
		$googledataspi = "https://spreadsheets.google.com/feeds/list/1Hux0vPFA47hZgjPYcoHvMzHP4Q_azPZYDZKnD6H5r78/od6/public/values?alt=json";
		$json = file_get_contents($googledataspi);
	    $data = json_decode($json, true); 
	    $skill='';
	    foreach ($data['feed']['entry'] as $item) 
	    {
	    	if($userName == $item['gsx$玩家名稱']['$t'])
	    	{
				$player = $item['gsx$姓名']['$t'];
	    		$序號 = $item['gsx$序號']['$t'];
				if($inputStr=='判資料')
				{
				     return  buildTextMessage($data['feed']['entry'][$序號]['content']['$t']);
				}
				else if($inputStr=='判勇'||$inputStr=='判勇武' )
				{
				     return nomalDiceRoller_Customize("2d6".$data['feed']['entry'][$序號]['gsx$勇武加值']['$t'],$inputStr,$player);		
				}
				else if($inputStr=='判敏'||$inputStr=='判靈敏')
				{
				     return nomalDiceRoller_Customize("2d6".$data['feed']['entry'][$序號]['gsx$靈敏加值']['$t'],$inputStr,$player);
				}
				else if($inputStr=='判魅'||$inputStr=='判魅力')
				{
				     return nomalDiceRoller_Customize("2d6".$data['feed']['entry'][$序號]['gsx$魅力加值']['$t'],$inputStr,$player);
				}
				else if($inputStr=='判意'||$inputStr=='判意志')
				{
				     return nomalDiceRoller_Customize("2d6".$data['feed']['entry'][$序號]['gsx$意志加值']['$t'],$inputStr,$player);
				}
				else if($inputStr=='判智'||$inputStr=='判智慧')
				{
				     return nomalDiceRoller_Customize("2d6".$data['feed']['entry'][$序號]['gsx$智慧加值']['$t'],$inputStr,$player);
				}
				else if($inputStr=='判精'||$inputStr=='判精神')
				{
				     return nomalDiceRoller_Customize("2d6".$data['feed']['entry'][$序號]['gsx$精神加值']['$t'],$inputStr,$player);
				}	
				else if($inputStr=='判防')
				{
					return nomalDiceRoller_Customize("1d0-1".$data['feed']['entry'][$序號]['gsx$防禦數值']['$t'],$inputStr,$player);
				}	  				
				else if($inputStr=='判一')
				{
					 $skill = $data['feed']['entry'][$序號]['gsx$a攻擊招式']['$t'];
				     return nomalDiceRoller_Attack($data['feed']['entry'][$序號]['gsx$a攻擊數值']['$t'],$inputStr,$player,$skill);
				}				
				else if($inputStr=='判二')
				{
					 $skill = $data['feed']['entry'][$序號]['gsx$b攻擊招式']['$t'];
				     return nomalDiceRoller_Attack($data['feed']['entry'][$序號]['gsx$b攻擊數值']['$t'],$inputStr,$player,$skill);
				}
				else if($inputStr=='判三')
				{
					 $skill = $data['feed']['entry'][$序號]['gsx$c攻擊招式']['$t'];
				     return nomalDiceRoller_Attack($data['feed']['entry'][$序號]['gsx$c攻擊數值']['$t'],$inputStr,$player,$skill);
				}
	    	}
		}	
	
		return null;
}
