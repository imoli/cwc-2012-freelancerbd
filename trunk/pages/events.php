<?php

include_once 'header.php';

//Paging initialization
$limit = 3;
$currentpage = $_GET['p'];
$link="?";
($currentpage) ? $start=($currentpage-1)*$limit : $start=0;

$activeEvents = App::getRepository('Event')->getActiveEvents($limit,$start);
$categories = App::getRepository('Category')->getAllCategories();

?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

            <h4>All Events</h4>

            <div class="events">

                <?php foreach ($activeEvents as $event): ?>

                <div class="row event">

                    <div class="span2">
                        <?php if (!empty($event['logo'])): ?>
                            <img src="<?php echo $event['logo'] ?>" />
                        <?php else: ?>
                            <img src="http://placehold.it/90x90" />
                        <?php endif; ?>
                    </div>

                    <div class="span8">
                        <h3><a href="<?php ViewHelper::url('event/' . $event['event_id']) ?>"><?php echo $event['title'] ?></a></h3>
                        <p class="align-justify"><?php echo $event['summary'] ?></p>
                        <p>
                            <a href="<?php ViewHelper::url('event/' . $event['event_id'] . '#comments') ?>"><?php echo $event['total_comments'] ?> comments</a> &nbsp;
                            <strong><span class="a_count_<?php echo $event['event_id'] ?>"><?php echo $event['total_attending'] ?></span> attending</strong> &nbsp;
                            <a href="#<?php echo $event['event_id'] ?>" class="btn small attend-event">I'm attending</a>
                        </p>
                    </div>

                </div>

                <?php endforeach; ?>
                
                <?php
				//=========for paging===============
                $totaldata = App::getRepository('Event')->countActiveEvents();
				echo Cwc3::paging($totaldata,$limit,$currentpage,$start,$link);
				//=========for paging===============
				?>

            </div>

        </div>

       <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>