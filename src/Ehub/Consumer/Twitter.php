<?php

namespace Ehub\Consumer;

class Twitter
{
	public function search($hashTag)
	{
		var_dump(json_decode(file_get_contents('http://search.twitter.com/search.json?q=' . urlencode($hashTag))));
	}
}