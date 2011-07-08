<h3>
  <?php _e('My Social Networks', PLUGIN_LOCALE); ?>
</h3>
<ul class="my-social-networks">

  <?php if(strlen(trim($twitter_username)) > 0) { ?>
    <li>
      <a href="http://twitter.com/<?php echo $twitter_username; ?>">
        <?php _e('Twitter', PLUGIN_LOCALE); ?>
      </a>
    </li>
  <?php } // end if ?>
  
  <?php if(strlen(trim($facebook_username)) > 0) { ?>
    <li>
      <a href="http://facebook.com/<?php echo $facebook_username; ?>">
        <?php _e('Facebook', PLUGIN_LOCALE); ?>
      </a>
    </li>
  <?php } // end if ?>
  
  <?php if(strlen(trim($google_plus_id)) > 0) { ?>
    <li>
      <a href="http://plus.google.com/<?php echo $google_plus_id; ?>">
        <?php _e('Google+', PLUGIN_LOCALE); ?>
      </a>
    </li>
  <?php } // end if ?>
  
</ul><!-- /my-social-networks -->