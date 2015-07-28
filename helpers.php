<?php

if ( ! function_exists('redirect'))
{
	/**
	 * Redirect user to a specified resource.
	 *
	 * @param  string  $location
	 * @return void
	 */
	function redirect($location)
	{
		session_write_close();

		header("location: {$location}");
		exit();
	}
}
