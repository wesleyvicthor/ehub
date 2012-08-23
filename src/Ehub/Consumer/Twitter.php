<?php

namespace Ehub\Consumer;

class Twitter
{
	const URL = 'http://search.twitter.com/search.json';

	public function search($hashTag)
	{
		$url = self::URL . '?q=' . urlencode('#' . $hashTag);
		$url = isset($_SESSION['since_id']) ? $url . '&since_id=' . $_SESSION['since_id'] : $url;
		$tweets = json_decode(file_get_contents($url));
		var_dump($http_response_header);
		if (count($tweets->results) == 0) {
			return array();
		}

		$_SESSION['since_id'] = $tweets->results[0]->id_str;
		$tweetsInfo = array();

		foreach ($tweets->results as $tweet) {
			$t = new \StdClass();
			$t->user = $tweet->from_user;
			$t->profile = $tweet->profile_image_url;
			$t->text = $tweet->text;

			$tweetsInfo[] = $t;
		}
		var_dump($tweetsInfo);die;
		return $tweetsInfo;
	}
}