<?php
/**
* 
*/
class AccountHomeViewModel extends ViewModel
{
	//Lists of data
	//public $friendsRecommendedStoryList;
	public $recommendedStoryList;
	public $usersStoryList;
	public $followingList;
	public $followerList;

	//Total Values
	public $totalFollowing; //How many people are they following
	public $totalFollowers; // How many people are following the user
	public $totalApprovedStories; //How many approved stories
	public $totalPendingStories; //How many pending stories
	public $totalDeniedStories; //How many denied stories
	public $totalApprovedComments; //How many approved comments
	public $totalPendingComments; //How many penfing comments

	public $backgroundImage;
	public $profileImage;
	public $profilePictureURL;
	public $backgroundPictureURL;

	public $newsFeed;
	public $pendingStories;
	public $draftStories;
	public $rejectedStories;
	public $publishedStories;

	public $ActionTakenList;

	public $pendingComments;

	//ProfileViewModel.php
	public $userDetails;

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