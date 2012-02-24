<?php

include_once 'header.php';
$ttl=$_GET['ttl'];
$search_type=$_GET['search_type'];

if(!empty($ttl)){
	//Paging initialization
	$limit = 10;
	$currentpage = $_GET['p'];
	$link = "?page=search&";
	($currentpage) ? $start=($currentpage-1)*$limit : $start=0;
	
	$events = App::getRepository('Search')->getSearchByType($ttl, $search_type, $limit, $start);
}
$categories = App::getRepository('Category')->getAllCategories();
?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

            <h4>Search <?php echo $search_type; ?></h4>

            <div class="events">
            
                <?php
				if($events)
				{
				foreach ($events as $event): ?>

                <div class="row event">
                    <div class="span8">
                        <h3><a href="<?php
                        if($search_type=="events")  
                        {
                            $p="event" ;
                            $eid=$event['event_id'];
                        }else {
                            $p="talk";
                            $eid=$event['talk_id'];
                        }
                        
                        ViewHelper::url('?page='.$p.'&id=' . $eid) ?>"><?php echo $event['title'] ?></a></h3>
                        <p class="align-justify"><?php echo $event['summary'] ?></p>
                    </div>

                </div>

                <?php endforeach;
				}
				else echo "No Data Found !!!";
				?>
                
                <?php
				//=========for paging===============
                //$totaldata = App::getRepository('Search')->countActiveEvents();
				//echo Cwc3::paging($totaldata,$limit,$currentpage,$start,$link);
				//=========for paging===============
				?>
                
            </div>

        </div>

       <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>