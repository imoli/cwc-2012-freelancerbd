<?php

$data['user_id'] = $_SESSION['user']['user_id'];
if($data['user_id']==0){
    ViewHelper::jsRedirect('login');
    exit();
}
if (!empty($_POST)) {
    
    App::getRepository('Comment')->create($_POST);
	if($_POST['event_id'])
	{
		header('Location: ' . ViewHelper::url('event/' . $_POST['event_id'], true));
	}
	else{
		 header('Location: ' . ViewHelper::url('talk/' . $_POST['talk_id'], true));
	}
   
} else {
    header('Location: ' . ViewHelper::url('', true));
}