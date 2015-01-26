<?php
/**
* 
*/
class Module extends Model
{
	public $module;
	public $models;
	public $crud;

	function __construct()
	{
		parent::__construct(array());
	}
}
?>