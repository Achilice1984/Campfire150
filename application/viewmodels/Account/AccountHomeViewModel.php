<?php
/**
* 
*/
class AccountHomeViewModel extends ViewModel
{
	//Lists of data
	public $friendsRecommendedStoryList;
	public $userRecommendedStoryList;
	public $usersStoryList;
	public $followingList;

	//Total Values
	public $totalFollowing; //How many people are they following
	public $totalFollowers; // How many people are following the user
	public $totalApprovedStories; //How many approved stories
	public $totalPendingStories; //How many pending stories
	public $totalDeniedStories; //How many denied stories
	public $totalApprovedComments; //How many approved comments
	public $totalPendingComments; //How many penfing comments

	function __construct()
	{		
		// $errors["ProfilePrivacyType_PrivacyTypeId"] = array(
		// 	'required' =>
		// 		array(
		// 			'Message' => gettext('The privacy field is required!'),
		// 			'Properties' => array()
		// 		)
		// );


		// //Pass validation to the View Model
		// parent::__construct($errors);
	}
}
?>