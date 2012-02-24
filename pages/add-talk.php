<?php
if (!empty($_POST))
{
	if ($_POST['title'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide event name.';
	}
	elseif ($_POST['summary'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide talk description.';
	}
	elseif ($_POST['speaker'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide speaker name.';
	}
  
  else  {

		  $InputValidationObj = new InputValidation;
		  $data = $InputValidationObj->xss_clean($_POST);
		  $eventId = App::getRepository('Talk')->create($data);
	      $_SESSION['flash']['type'] = 'success';
		  $_SESSION['flash']['message'] = 'Talk Added Successfully.';
			
		  header('Location: ' . ViewHelper::url('?page=event&id=' . $_POST['event_id'], true));
		  exit();
	 }
}
$categories = App::getRepository('Category')->getAllCategories();
?>

<?php include_once 'header.php';?>
<div class="content">

    <div class="row">

        <div id="main-content" class="span10">
         <?php ViewHelper::flushMessage(); ?>
            <h2>Submit an talk!</h2>

            <p class="align-justify">Submit your talk here to be included on Tech Adda.</p>

            <div class="post-comment">

                <form action="<?php ViewHelper::url('?page=add-talk&id='.$_GET['id']) ?>" class="form-stacked" method="post">
                    <div class="clearfix">
                        <label for="xlInput3">Talk Title:</label>
                        <div class="input">
                            <input class="xxlarge" id="title" name="title" size="30" type="text" value="<?php echo $_POST['title'];?>">
                        *</div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">Talk Description:</label>
                        <div class="input">
                            <textarea class="xxlarge" id="summary" name="summary" rows="7" cols="50"><?php echo $_POST['summary'];?></textarea>
                        *</div>
                    </div>
                     <div class="clearfix">
                        <label for="xlInput3">speaker:</label>
                        <div class="input">
                          <input class="xxlarge" id="speaker" name="speaker" size="30" type="text" value="<?php echo $_POST['speaker'];?>">
                        *</div>
                    </div>
                     <div class="clearfix">
                        <label for="xlInput3">Slide Link:</label>
                        <div class="input">
                            <input class="xxlarge" id="slide_link" name="slide_link" size="30" type="text" value="<?php echo $_POST['slide_link'];?>">
                        </div>
                    </div>
                     <div class="clearfix">
                        <label for="xlInput3">Slide Link:</label>
                        <div class="input">
                            <input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>"
                        </div>
                    </div>
           


                    <input type="submit"  class="btn primary" value="Submit" />

                </form>

            </div>

        </div>

       

    </div>

</div>
<?php include_once 'footer.php'; ?>