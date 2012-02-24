<?php
include_once 'header.php';

$event = App::getRepository('Event')->getEventById($_GET['id']);
$talks = App::getRepository('Talk')->getTalksByEvent($_GET['id']);
$categories = App::getRepository('Category')->getAllCategories();

$comments = App::getRepository('Comment')->getCommentsByEvent($_GET['id']);


?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

<?php ViewHelper::flushMessage(); ?>

            <div class="row single-event">

                <div class="span2" style="padding: 10px 0 10px 10px;">
<?php if (!empty($event['logo'])): ?>
                        <img src="<?php echo $event['logo'] ?>" />
                    <?php else: ?>
                        <img src="http://placehold.it/90x90" />
                    <?php endif; ?>
                </div>

                <div class="span7">
                    <h2><?php echo $event['title'] ?></h2>
                    <div class="meta">
                        <?php echo ViewHelper::formatDate($event['start_date']) ?> - <?php echo ViewHelper::formatDate($event['end_date']) ?> <br />
                        <?php echo $event['location'] ?><br />
                        <a href="#<?php echo $event['event_id'] ?>" class="btn small attend-event">I'm attending</a> &nbsp; <strong><span class="a_count_<?php echo $event['event_id'] ?>"><?php echo $event['total_attending'] ?></span> people</strong> attending so far!

                    </div>
                </div>

            </div>

            <p class="align-justify"><?php echo nl2br($event['summary']) ?></p>
            <p><strong>Event Link:</strong> <br /><a href="<?php echo $event['href'] ?>"><?php echo $event['href'] ?></a></p>
            <h3>Comments</h3>

            <div class="comments">
                    <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="meta"><strong><?php echo empty($comment['name']) ? $comment['email'] : $comment['name'] ?></strong> on <em><?php echo ViewHelper::formatDate($comment['create_date']) ?></em> said:</div>
                    <?php echo nl2br($comment['body']) ?>
                    </div>
                    <?php endforeach; ?>
            </div>
                <?php
                $data['user_id'] = $_SESSION['user']['user_id'];
                if ($data['user_id'] != 0) {
                    ?>
                <div class="post-comment">

                    <h4>Write a comment:</h4>
                    <form action="<?php ViewHelper::url('?page=comment') ?>" class="form-stacked" method="post">

                        <textarea class="xxlarge" id="comment" name="body" rows="7" cols="50"></textarea>
                        <span class="help-block">Please be polite in your comment as this is a social site.</span> <br />
                        <input type="hidden" value="<?php echo $event['event_id'] ?>" name="event_id" />
                        <input type="submit" class="btn primary comment_submit" value="Submit" />

                    </form>

                </div>
                    <?php
                }else{
                    ?>
                    <div class="alert-message block-message warning">
                <h4><a href="<?php ViewHelper::url('?page=login') ?>">login</a> to write comment here</h4>
                
                </div>
            <?php
                }
                ?>

            <div>
	         <h3 style="float:left;">Talks</h3>
	          <div style="float:left;padding-left:20px;">
	          	 <p style="text-align: center;">
	                	<?php if ($_SESSION['user']['user_id']): ?>
	                		<a href="<?php ViewHelper::url('?page=add-talk&id='.$_GET['id']) ?>" class="btn success">Submit Talk!</a>
	                	<?php else: ?>
	                		<a href="<?php ViewHelper::url('?page=login') ?>" class="btn success">Submit Talk!</a>
	                	<?php endif; ?>	
	               </p>
	          </div>
	          <div style="clear:both;"></div>
         </div>
            <ul>
                <?php foreach ($talks as $talk): ?>
                    <li><a href="<?php ViewHelper::url('?page=talk&id=' . $talk['talk_id']) ?>"><?php echo $talk['title'] ?></a></li>
                <?php endforeach; ?>

            </ul>

        </div>

    <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>