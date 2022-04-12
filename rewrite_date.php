<?php 
function dateSeparator($date)
{
	if (date('Y-m-d') == $date) {
		$timestamp = "2013-09-30 01:16:06";
		$date = date("F jS, Y, h:i",strtotime($timestamp));
	}

	return $date;
}


echo dateSeparator(date('Y-m-d'));



 ?>