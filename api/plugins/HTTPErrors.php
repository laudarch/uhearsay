<?php

class HTTPErrors {
	public function _404()
	{
		echo "FILE NOT FOUND\n";
	}

	public function _500()
	{
		echo "Internal Server Error. Administrators notified.";
	}
}

?>
