<?php /**
 * Get photos from photoalbum - needs $album_id
 */

$theme_info = wp_get_theme();
$transient_key = 'album_' . $album_id . $theme_info->version;
$cached_response = get_transient($transient_key);

// Check if we have a cached response
if ($cached_response === false) {
  $rsp_obj = flickr_request($album_id);
  if (WP_DEBUG) {
  $lifespan = 30;
  } else {
  $lifespan = 10 * MINUTE_IN_SECONDS;
  }

  set_transient($transient_key, $rsp_obj, $lifespan);
} else {
  $rsp_obj = $cached_response;
}

#
# display the photoset
#

if ($rsp_obj['stat'] == 'ok') {

  $farm = $rsp_obj['photoset']['photo'][0]['farm'];
  $server = $rsp_obj['photoset']['photo'][0]['server'];
  $base_url = sprintf('https://farm%s.staticflickr.com/%s', $farm, $server);

  foreach ($rsp_obj['photoset']['photo'] as $key => $photo):

  $photo_url = sprintf('%s/%s_%s_b.jpg',
  $base_url, $photo['id'], $photo['secret']);

  $thumbnail_url = sprintf('%s/%s_%s_q.jpg',
  $base_url, $photo['id'], $photo['secret']); ?>

  <a class="photo fancybox" rel="group"
  id="<?php echo $photo['id']; ?>"
  href="<?php echo $photo_url; ?>"
  ><img src="<?php echo $thumbnail_url; ?>"></a>

<?php endforeach;

} else {
  echo "Er is iets mis gegaan bij het ophalen van de foto’s, excuses!";
}





/**
 * Request data from Flickr.
 *
 * @param	string $album_id	The id of the album to get
 * @return array $rsp_obj The photoset response
 */
function flickr_request($album_id) {
  $params = array(
  'api_key'	=> FLICKR_API_KEY,
  'method'	=> 'flickr.photosets.getPhotos',
    'user_id' => FLICKR_USER_ID,
    'photoset_id' => $album_id,
  'format'	=> 'php_serial',
  );

  $encoded_params = array();

  foreach ($params as $k => $v){
  $encoded_params[] = urlencode($k).'='.urlencode($v);
  }


  #
  # call the API and decode the response
  #

  $url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);

  $rsp = file_get_contents($url);

  $rsp_obj = unserialize($rsp);

  return $rsp_obj;
}
