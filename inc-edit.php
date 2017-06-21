<?php

if (is_user_logged_in()) {
  global $current_user;
  wp_get_current_user();
  edit_post_link('<i class="fa fa-pencil" aria-hidden="true"></i> <span>Edit Page</span>', '<p class="edit_link">', '</p>');

  if ($current_user->ID === 1) {
    $selector = uniqid();
    $_SESSION['renew_cp_cache_uri_selector'] = $selector;
    echo '<p class="cp_cache"><a href="' . get_permalink() . '?' . $selector . '=' . time() . '"><i class="fa fa-hdd-o" aria-hidden="true"></i> <span>Renew CP Cache</span></a></p>';
  }
}
