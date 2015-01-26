<?php
/**
* 
*/
class DevelopmentModel extends Model
{
	public $name;// = "Josh";
	public $email;// = "josh.dvrs@gmail.com";

	function __construct()
	{
		parent::__construct(array('email' => 'email'));
	}

	public function getSomething($id)
	{
		$id = $this->escapeString($id);
		$result = $this->query('SELECT * FROM something WHERE id="'. $id .'"');
		return $result;
	}
}
?>