<div class="wrapper">
  <fieldset>
    <legend>
      <?php _e('My Social Networks', self::locale); ?>
    </legend>
    
    <div class="option">
      <label for="twitter">
        <?php _e('Twitter Username', self::locale); ?>
      </label>
      <input type="text" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" value="<?php echo $instance['twitter_username']; ?>" class="" />
    </div>
    
    <div class="option">
      <label for="facebook">
        <?php _e('Facebook Username', self::locale); ?>
      </label>
      <input type="text" id="<?php echo $this->get_field_id('facebook_username'); ?>" name="<?php echo $this->get_field_name('facebook_username'); ?>" value="<?php echo $instance['facebook_username']; ?>" class="" />
    </div>
    
    <div class="option">
      <label for="google_plus">
        <?php _e('Google+ ID', self::locale); ?>
      </label>
      <input type="text" id="<?php echo $this->get_field_id('google_plus_id'); ?>" name="<?php echo $this->get_field_name('google_plus_id'); ?>" value="<?php echo $instance['google_plus_id']; ?>" class="" />
    </div>
    
  </fieldset>
</div><!-- /wrapper -->