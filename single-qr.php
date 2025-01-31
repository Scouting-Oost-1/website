<?php /**
 * Single redirect
 */
$target = get_field('doel');
header("Location: $target");
die();
?>
