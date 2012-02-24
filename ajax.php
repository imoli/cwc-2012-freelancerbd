<?php
// Application base path
define('APPPATH', __DIR__);

// Include necessary path for class loading
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPPATH . '/lib'),
    realpath(APPPATH . '/lib/Sparrow'),
    realpath(APPPATH . '/includes'),
    get_include_path(),
)));

// Load app engine
include_once 'App.php';

// Initiate engine and run!
App::init(APPPATH . '/config/app.ini');

// attending functionality
if ($_POST['event_id'] && $_POST['action'] == 'attendMark') {
    $response=array();
    header('Content-type: application/json');
    $data['event_id'] = intval($_POST['event_id']);
    $data['user_id'] = intval($_SESSION['user']['user_id']);
    $attend = App::getRepository('Attend')->isUsedAlreadyAttend($data);
    if ($data['user_id'] == 0) {
        $rpath = ViewHelper::url('login', true);
        $response['status']='login';
        $response['path']=$rpath;
    }elseif(!$attend) {
        App::getRepository('Attend')->add($data);
        $msg = "Your attend request received successfully.";
        $response['status']='success';
        $response['msg']=$msg;
    } else {
        $msg = "You've already requested to attend.";
        $response['msg']=$msg;       
        $response['status']='warning';

    }
    
    echo json_encode($response);
}

if($_POST['action']=='submit_tag'){
    $response=array();
    header('Content-type: application/json');
    $data['talk_id'] = intval($_POST['talk_id']);
    $data['user_id'] = intval($_SESSION['user']['user_id']);
    $data['tag'] = trim(strip_tags($_POST['tag']));
    
    if ($data['user_id'] == 0) {
        $rpath = ViewHelper::url('login', true);
        $response['status']='login';
        $response['path']=$rpath;
    }else {
		try{
        $attend = App::getRepository('Talk')->tagCreate($data);
        $msg = "Your tag created.";
        $response['msg']=$msg;       
        $response['status']='success';
		}catch(Exception $e){
			$msg = "Your tag already created";
       		$response['msg']=$msg;       
        	$response['status']='success';
		}

    }
    
    echo json_encode($response);
    
}

?>