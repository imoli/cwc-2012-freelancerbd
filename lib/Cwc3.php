<?php
class Cwc3 {
    public static function getExtension($str) {
		$i=strrpos($str,".");
		if(!$i){return "";}
		$l=strlen($str)-$i;
		$ext=substr($str,$i+1,$l);
		return $ext;
	}
	
	
	public static function paging($totaldata,$limit,$currentpage,$start,$link){
		$nextsomepage="";
		$previoussomepage="";
		if($currentpage==0) $currentpage=1;
		$lastpage=ceil($totaldata/$limit);
		$prevpage=$currentpage-1;
		$nextpage=$currentpage+1;
	
		for($i=$currentpage+1; $i<$currentpage+6; $i++){
			if($currentpage<($lastpage-5)){
				$nextsomepage.=" <a href=\"".$link."p=$i\">$i</a> ";
			}
			elseif($i<$lastpage){
				$nextsomepage.=" <a href=\"".$link."p=$i\">$i</a> ";
			}
		}
		for($i=$currentpage-5; $i<$currentpage; $i++){
			if($i>0){
				if($currentpage<($lastpage-5)){
					$previoussomepage.=" <a href=\"".$link."p=$i\">$i</a> ";
				}
				elseif($i<$lastpage){
					$previoussomepage.=" <a href=\"".$link."p=$i\">$i</a> ";
				}
			}
		}
	
		if($prevpage!=0 && $currentpage<=$lastpage){$previousprint=" <a href=\"".$link."p=".$prevpage."\">&laquo;Prev</a> <a href=\"".$link."p=1\">First</a> ".$previoussomepage;}
		if($lastpage && $currentpage<=$lastpage && $lastpage>1){$currentprint="<span>".$currentpage."</span>".$nextsomepage;
		}
		if($lastpage>1 && $nextpage==$nextpage && $currentpage<$lastpage){$lastprint=" <a href=\"".$link."p=".$lastpage."\">Last</a> <a href=\"".$link."p=".$nextpage."\">Next&raquo;</a>";}
		return $pagination=$previousprint.$currentprint.$lastprint;
	}
	
}