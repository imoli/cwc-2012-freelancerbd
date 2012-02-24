<?php

include_once 'header.php';

//Paging initialization
$limit = 2;
$currentpage = $_GET['p'];
$link="?";
($currentpage) ? $start=($currentpage-1)*$limit : $start=0;
$categories = App::getRepository('Category')->getAllCategories();
$activeEvents = App::getRepository('Event')->getActiveEvents($limit,$start);
$tags = App::getRepository('Talk')->getAllTalkByTag($_GET['tag_name']);

//print_r($tags);

?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

            <h4>All Talk by tags <i>[ <?php echo $_GET['tag_name'];?>]</i></h4>

            <div class="events">

                <?php foreach ($tags as $tag): ?>

                <div class="row event">

                    <div class="span8">
                        <h3><a href="<?php ViewHelper::url('?page=talk&id=' . $tag['talk_id']) ?>"><?php echo $tag['title'] ?></a></h3>
                        <p class="align-justify"><?php echo $tag['summary'] ?></p>
                        <p>
                            <a href="<?php ViewHelper::url('?page=talk&id=' . $tag['talk_id'] . '#comments') ?>"><?php echo App::getRepository('Talk')->getCommentCount($tag['talk_id']); ?> comments</a> &nbsp;
                            
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