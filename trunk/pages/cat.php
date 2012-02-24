<?php

include_once 'header.php';

$catId = App::urlParameter(2);

$category = App::getRepository('Category')->getCategoryById($catId);
$activeEvents = App::getRepository('Event')->getActiveEventsByCategory($category['category_id']);
$categories = App::getRepository('Category')->getAllCategories();

?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

            <h4>Events on <?php echo $category['title'] ?></h4>

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
                            <strong><?php echo $event['total_attending'] ?> attending</strong> &nbsp;
                            <a href="<?php ViewHelper::url('?event_id=' . $event['event_id']) ?>" class="btn small">I'm attending</a>
                        </p>
                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

       <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>