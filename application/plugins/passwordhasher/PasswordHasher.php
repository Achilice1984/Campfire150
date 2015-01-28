<?php
/**
* 
*/
class PasswordHasher
{
	public static function hashPassword($password)
	{
		/**
		 * We just want to hash our password using the current DEFAULT algorithm.
		 * This is presently BCRYPT, and will produce a 60 character result.
		 *
		 * Beware that DEFAULT may change over time, so you would want to prepare
		 * By allowing your storage to expand past 60 characters (255 would be good)
		 */
		return password_hash($password, PASSWORD_DEFAULT);
	}
	
	public static function verifyPassword($password, $hash)
	{
		return password_verify($password, $hash);
	}
}
?>