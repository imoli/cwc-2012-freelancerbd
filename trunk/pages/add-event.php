<?php
if (!empty($_POST))
{
	if ($_POST['title'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide event name.';
	}
	elseif ($_POST['summary'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide event description.';
	}
	elseif ($_POST['category_id'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide category.';
	}
	elseif ($_POST['location'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide venue.';
	}
	elseif ($_POST['start_date'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide start date.';
	}
	elseif ($_POST['end_date'] == '')
	{
		$_SESSION['flash']['message'] = 'Please provide end date.';
	}
	elseif (strtotime($_POST['start_date']) > strtotime($_POST['end_date']))
	{
		$_SESSION['flash']['message'] = 'The end date must be greater than the start date.';
	}
	elseif ((ViewHelper::dateIsvalid($_POST['start_date']) == FALSE) || (ViewHelper::dateIsvalid($_POST['end_date']) == FALSE))
	{
		$_SESSION['flash']['message'] = 'Please provide valid date.';
	}
  else  
	{
		  $_POST['start_date'] = ViewHelper::formatDate($_POST['start_date']);
		  $_POST['end_date'] = ViewHelper::formatDate($_POST['end_date']);
		  $InputValidationObj = new InputValidation;
		  $data = $InputValidationObj->xss_clean($_POST);
                  
      
      
      
                   //============================================OLI==============================================
			$image=$_FILES['logo']['name'];
			$uploadedfile=$_FILES['logo']['tmp_name'];
			$upload_dir = APPPATH."/assets/images/";
			define("MAX_SIZE","2000");

			if($image){
				$filename=stripslashes($image);
				$extension=Cwc3::getExtension($filename);
				$extension=strtolower($extension);
				$size=filesize($uploadedfile);
				
				if(($extension!="jpg") && ($extension!="jpeg") && ($extension!="png")){
					$msg="Only JPG OR PNG File";
				}
				elseif($size>MAX_SIZE*1024){
					$msg="File size must be not more than 2MB.";
				}
				
				else{
					if($extension=="jpg" || $extension=="jpeg" ){
						$src=imagecreatefromjpeg($uploadedfile);
					}
					else if($extension=="png"){
						$src=imagecreatefrompng($uploadedfile);
					}
					//$imagebasename=basename($_FILES['uploadfile']['name'],".".$extension);
					list($width,$height)=getimagesize($uploadedfile);
					$imgnewname="eventlogo_".strtotime(date('Y-m-d H:i:s'));
					$newfilename=$imgnewname.".".$extension;
					
					if($width>90){
						$newwidth=90;
						$newheight=($height/$width)*$newwidth;
						$tmp=imagecreatetruecolor($newwidth,$newheight);
						$bg=imagecolorallocatealpha($tmp,255,255,255,127);
						imagefill($tmp,0,0,$bg);
						imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
						$upload_to=$upload_dir.$newfilename;
						imagejpeg($tmp,$upload_to,100);
						imagedestroy($tmp);
					}
					else{
						$newwidth=$width;
						$newheight=($height/$width)*$newwidth;
						$tmp=imagecreatetruecolor($newwidth,$newheight);
						$bg=imagecolorallocatealpha($tmp,255,255,255,127);
						imagefill($tmp,0,0,$bg);
						imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
						$upload_to=$upload_dir.$newfilename;
						imagejpeg($tmp,$upload_to,100);
						imagedestroy($tmp);
					}
				}
			}
			//============================================OLI==============================================
			//$newfilename;
			$data['logo'] = ($newfilename!='') ? "http://localhost/cwc2012/assets/images/".$newfilename : 'http://placehold.it/90x90';
		  
			$eventId = App::getRepository('Event')->create($data);
			
			
			$_SESSION['flash']['type'] = 'success';
			$_SESSION['flash']['message'] = 'Event Added Successfully.';
			
			header('Location: ' . ViewHelper::url('event/' . $eventId, true));
			exit();
	 }
}
$categories = App::getRepository('Category')->getAllCategories();
?>

<?php include_once 'header.php';?>
<script>
	$(function() {
		$( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>


<div class="content">

    <div class="row">

        <div id="main-content" class="span10">
         <?php ViewHelper::flushMessage(); ?>
            <h2>Submit an event!</h2>

            <p class="align-justify">Submit your event here to be included on Tech Adda. The site is aimed at events with sessions, where organisers are looking to use this as a tool to gather feedback.</p>

            <div class="post-comment">

                <form action="<?php ViewHelper::url('add-event') ?>" class="form-stacked" method="post"  enctype="multipart/form-data">

                    <div class="clearfix">
                        <label for="xlInput3">Event Title:</label>
                        <div class="input">
                            <input class="xxlarge" id="title" name="title" size="30" type="text" value="<?php echo $_POST['title'];?>">
                        *</div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">Event Description:</label>
                        <div class="input">
                            <textarea class="xxlarge" id="summary" name="summary" rows="7" cols="50"><?php echo $_POST['summary'];?></textarea>
                        *</div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">Category:</label>
                        <div class="input">
                            <select name="category_id">
                            	 <option value = ""> --Please Select-- </option>
								<?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['category_id'] ?>"><?php echo $category['title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        *</div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">Venue:</label>
                        <div class="input">
                            <input class="xlarge" id="location" name="location" size="30" type="text" value="<?php echo $_POST['location'];?>">
                        *</div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">URL:</label>
                        <div class="input">
                            <input class="xlarge" id="href" name="href" size="30" type="text" value="<?php echo $_POST['href'];?>">
                        </div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">Date:</label>
                        <div class="inline-inputs">
                            <input class="small datepicker" id="start_date" name="start_date" type="text" value="<?php echo $_POST['start_date'];?>"> to
                            <input class="small datepicker" id="end_date" name="end_date" type="text" value="<?php echo $_POST['end_date'];?>">
                            *
                            <span class="help-block">Please enter date in this format: mm/dd/yyyy.</span>
                        </div>
                    </div>

                    <div class="clearfix">
                        <label for="xlInput3">Logo:</label>
                        <div class="input">
                            <input class="xlarge" type="file" name="logo" id="logo" >
                            <span class="help-block">The logo should be of dimension 90x90.</span>
                        </div>
                    </div>

                    <input type="submit"  class="btn primary" value="Submit" />

                </form>

            </div>

        </div>

        <?php include_once 'right-sidebar.php'; ?>

    </div>

</div>

<?php include_once 'footer.php'; ?>