<?php

/**
 * return amount of days between dt1 and dt2 
 * (how many midnights pass going from dt1 to dt2)
 *  0 = same day, 
 * -1 = dt2 is 1 day before dt1, 
 *  1 = dt2 is 1 day after  dt1, etc.
 *
 * @param \DateTime $dt1
 * @param \DateTime $dt2
 * @return int|false 
 */
function getNightsBetween(\DateTime $dt1, \DateTime $dt2){
    if(!$dt1 || !$dt2){
        return false;
    }
    $dt1->setTime(0,0,0);
    $dt2->setTime(0,0,0);
    $dti = $dt1->diff($dt2);    // DateInterval
    return $dti->days * ( $dti->invert ? -1 : 1);   // nb: ->days always positive
}



/**
 * Request an url.
 *
 * @param	string $url	The url to get
 * @return string $result The result from the url OR bool $result FALSE
 */
function request($url) {
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
    ));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}



/**
 * Get the upcoming events.
 *
 * @return  array $result	List of events
 */
function createEventArray() {
    $calendar_url = sprintf("https://www.googleapis.com/calendar/v3/calendars/%s/events?key=%s", 
        CALENDAR_ID,
        CALENDAR_API_KEY);
    $data = request($calendar_url);

    if (!$data) {
        // If the request fails, return an empty array
        return array();
    }

    $events = json_decode($data, true)['items'];
    $now = new DateTime();
    
    $result = [];

    foreach ($events as $event) {
        if (array_key_exists('dateTime', $event['start'])) {
            $start = new DateTime($event['start']['dateTime']);
            $end = new DateTime($event['end']['dateTime']);
            $has_time = true;
        } else {
            $start = new DateTime($event['start']['date'], new DateTimeZone('Europe/Amsterdam'));
            $end = new DateTime($event['end']['date'], new DateTimeZone('Europe/Amsterdam'));
            $has_time = false;
        }

        if ($start > $now) {
            $result[] = [
                'summary' => $event['summary'],
                'description' => (array_key_exists('description', $event)) ? $event['description'] : "",
                'location' => (array_key_exists('location', $event)) ? $event['location'] : "",
                'start' => $start,
                'end' => $end,
                'has_time' => $has_time
            ];
        }

    }

    return $result;
}



/**
 * Render all lists
 *
 * @param	array $latestPosts	List of the arrays we get from the respective
 *		social network request functions
 * @return void
 */
function upcomingEvents($events) {

    $response = array(
        'events' => array(),
        'success' => true,
        'cache_time' => time(),
        'event_amount' => 0
    );

    foreach ($events as $key => $event) {

		$response['events'][$key] = $event;
		$response['event_amount']++;

	}

    return $response;

}



function getEvents() {
    $theme_info = wp_get_theme();
    $transient_key = 'calendar_feed_' . $theme_info->version;
    
    $cached_response = get_transient($transient_key);
    
    // Check if we have a cached response
    if ($cached_response === false) {
        // if not, excecute all functions, put it in response and store it
        $events = createEventArray();
        $sorted_events = usort($events, function ($a, $b) {
            return $a['start'] > $b['start'];
        });
        $response = upcomingEvents(
            $events
        );
    
        $lifespan = 30;
    
        set_transient($transient_key, $response, $lifespan);
    } else {
        $response = $cached_response;
    }
    
    // Add the age of the cache to the response
    $response['cache_age'] = (time() - $response['cache_time']) . ' seconds';
    return $response;
}
