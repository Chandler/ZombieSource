      <h2> Register a Kill </h2>
        <?php //echo form_open("http://postcatcher.in/catchers/4f1182876366150100000004"); 
             echo form_open($this->uri->uri_string());
         ?>

         <?php if($form_error != '') print("<div class=\"error\">".$form_error."</div>");?>
      
         <div class="clearfix">
            <label>Human Code</label>
            <div class="input">
              <?php echo form_error('human_code'); ?>
              <input type="text" name="human_code" value="<?php echo set_value('human_code'); ?>"/>
            </div>
        </div> 
      
        <div id = "feed_friends"> Feed friends (optional)  </div>
         <div class="clearfix">
            <label>Username</label>
            <div class="input">
              <?php echo form_error('sig'); ?>
              <input type="text" name="sig" value="<?php echo set_value('sig'); ?>"/>
            </div>
        </div> 
         <div class="clearfix">
            <label>Username</label>
            <div class="input">
              <?php echo form_error('sig'); ?>
              <input type="text" name="sig" value="<?php echo set_value('sig'); ?>"/>
            </div>
         </div>         
          <div class="clearfix">
            <label>Username</label>
            <div class="input">
              <?php echo form_error('sig'); ?>
              <input type="text" name="sig" value="<?php echo set_value('sig'); ?>"/>
            </div>
         </div>    
        <div class="actions">
          <input type="submit" value = "Submit kill" class = "btn success"/></form> 
      </div>   