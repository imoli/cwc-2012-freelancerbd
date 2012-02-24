<?php

$userId=intval($_SESSION['user']['user_id']);
//Paging initialization
$limit = 2;
$currentpage = $_GET['p'];
$link="?";
($currentpage) ? $start=($currentpage-1)*$limit : $start=0;

$activeEvents = App::getRepository('Event')->getActiveEvents($limit,$start);
$categories = App::getRepository('Category')->getAllCategories();

if (!empty($_POST))
{
	
	if ($_POST['name'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide your name.';
	}
	else
	{
		$InputValidationObj = new InputValidation;
		$data = $InputValidationObj->xss_clean($_POST);
		App::getRepository('Profile')->updateName($userId, $data);
		
		$_SESSION['flash']['type'] = 'success';
		$_SESSION['flash']['message'] = 'Name Updated Successfully.';
		
		header('Location: ' . ViewHelper::url('?page=profile', true));
		exit();
	}
}
include_once 'header.php';

$user = App::getRepository('Profile')->getUserById($userId);

?>

<div class="content">

    <div class="row">

        <div id="main-content" class="span10">

            <?php ViewHelper::flushMessage(); ?>

            <?php //echo $user['email'] ?>
            
            
            <form action="<?php ViewHelper::url('?page=profile') ?>" class="form-stacked" method="post">

                    <div class="clearfix">
                        <label for="xlInput3">Your Name:</label>
                        <div class="input">
                            <input class="xlarge" id="name" name="name" size="30" type="text" value="<?php echo $user['name'];?>">
                        *</div>
                    </div>
                    <input type="submit"  class="btn primary" value="Submit" />

                </form>

        </div>

        <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>