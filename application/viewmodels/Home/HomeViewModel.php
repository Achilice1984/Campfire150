<?php
/**
* 
*/
class HomeViewModel extends ViewModel
{
	public $WordCloud;
	public $LatestStories;
	public $ChallengesList;

	public $totalPublishedStories;
	public $totalActiveUsers;
	public $totalPublishedComments;
	public $totalRecommendations;
	
	function __construct()
	{		
		parent::__construct(array());
	}
}
?>