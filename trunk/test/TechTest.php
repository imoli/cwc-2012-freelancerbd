<?php
// Include necessary path for class loading
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPPATH . '../includes/'),
    realpath(APPPATH . '../resources/'),
    get_include_path(),
)));
class TechTest extends PHPUnit_Framework_TestCase
{
	public function testloadResourceHasAClass()
    {
		$request = new Request();
		$this->assertClassHasAttribute("loadResource", $request);
    }
}





?>