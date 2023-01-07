<?php

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
 * Get the items in a folder.
 *
 * @return  array $result	List of items
 */
function createFolderArray($folder_id) {
    $fields = "files(webContentLink,thumbnailLink,name,id,capabilities(canListChildren))";
    $additional_parameters = "includeItemsFromAllDrives=true&supportsAllDrives=true";
    $calendar_url = sprintf("https://content.googleapis.com/drive/v3/files?q='%s'+in+parents&fields=%s&key=%s&%s", 
        $folder_id,
        $fields,
        CALENDAR_API_KEY,
        $additional_parameters);
    $data = request($calendar_url);

    if (!$data) {
        // If the request fails, return an empty array
        return array();
    }

    $json = json_decode($data, true);
    $files = $json['files'];
    
    $result = [];

    foreach ($files as $item) {
        if ($item['capabilities']['canListChildren']) {
            $result['folders'][] = [
                'name' => $item['name'],
                'id' => $item['id']
            ];
        } else {
            $result['photos'][] = [
                'url' => substr($item['webContentLink'], 0, -15),
                'thumbnail' => $item['thumbnailLink']
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
function folderResponse($items) {

    $response = array(
        'items' => $items,
        'success' => true,
        'cache_time' => time()
    );

    return $response;

}



function getFolder($folder_id) {
    $theme_info = wp_get_theme();
    $transient_key = "photo_feed_{$theme_info->version}_{$folder_id}";
    
    $cached_response = get_transient($transient_key);
    
    // Check if we have a cached response
    if ($cached_response === false) {
        // if not, excecute all functions, put it in response and store it
        $items = createFolderArray($folder_id);
        $response = folderResponse($items);
        $lifespan = 30;
        set_transient($transient_key, $response, $lifespan);
    } else {
        $response = $cached_response;
    }
    
    // Add the age of the cache to the response
    $response['cache_age'] = (time() - $response['cache_time']) . ' seconds';
    return $response;
}
