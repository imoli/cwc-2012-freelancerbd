<?php
include_once 'header.php';
$apiUrl = "http://192.168.1.4/api/events/";
$allContent = App::getRepository('Api')->getAllEvents($apiUrl);
$categories = App::getRepository('Category')->getAllCategories();
	?>
    <div class="content">
        <div class="row">
            <div id="main-content" class="span10">
                <h4>All Events</h4>
                <div class="events">
                    <?php 
    
                    foreach($allContent as $event)
                    {
                        $data['title'] = $event->name;
                        $data['summary'] = $event->description;
                        $data['href'] = $event->href;
                        $data['start_date'] = $event->start_date;
                        $data['end_date'] = $event->end_date;
                        
                        
                        $checkTitle = App::getRepository('Api')->checkDuplicity($data);
                            if ( !$checkTitle )
                            {
                                App::getRepository('Api')->create($data);
                     ?>
                    <div class="row event">  
                        <div class="span8">
                            <h3><?php echo $data['title'] ?></h3>
                            <p class="align-justify"><?php echo $data['summary'] ?></p>
                            <p>Start Date: <?php echo $data['start_date'] ?></p>
                            <p>End Date: <?php echo $data['end_date'] ?></p>
                            <p>Website: <a href="<?php echo $data['href'] ?>" target="_blank"><?php echo $data['href'] ?></a></p>
                        </div>
    
                    </div>
                    		<?php
                            }
                    }
                    ?>
            </div>
        </div>
       <?php include_once 'right-sidebar.php'; ?>
    </div>
    </div>
<?php include_once 'footer.php';?>