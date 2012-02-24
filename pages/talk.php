<?php

include_once 'header.php';

$talk = App::getRepository('Talk')->getTalkById($_GET['id']);
$event = App::getRepository('Event')->getEventById($talk['event_id']);
$comments = App::getRepository('Comment')->getCommentsByTalk($talk['talk_id']);
$categories = App::getRepository('Category')->getAllCategories();

?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

            <h2><?php echo $talk['title'] ?></h2>
            <div class="meta">
                by <strong><?php echo $talk['speaker'] ?></strong> <br />
                Talk at <a href="<?php ViewHelper::url('?page=event&id=' . $event['event_id']) ?>"><?php echo $event['title'] ?></a>
            </div>

            <p class="align-justify"><?php echo nl2br($talk['summary']) ?></p>

            <h3>Comments</h3>

            <div class="comments">
                <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <div class="meta"><strong><?php echo empty($comment['name']) ? $comment['email'] : $comment['name'] ?></strong> on <em><?php echo ViewHelper::formatDate($comment['create_date']) ?></em> said:</div>
                    <?php echo nl2br($comment['body']) ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="post-comment">

                <h4>Write a comment:</h4>
                <form action="<?php ViewHelper::url('?page=comment') ?>" class="form-stacked" method="post">

                    <textarea class="xxlarge" id="comment" name="body" rows="7" cols="50"></textarea>
                    <span class="help-block">Please be polite in your comment as this is a social site.</span> <br />

                    <input type="hidden" value="<?php echo $talk['talk_id'] ?>" name="talk_id" />
                    <input type="submit" class="btn primary comment_submit" value="Submit" />

                </form>
                <form action="#" class="form-stacked" method="post">
                    <input type="hidden" value="<?php echo $talk['talk_id'] ?>" name="talk_id" id="talk_id"/>
                    Enter tag here: <input type="text" name="tag" id="tag" value="" class="small" />
                    <input type="submit" class="btn primary tag_submit" value=" Add Tag" />

                </form>

            </div>
            
           
        </div>

        <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>