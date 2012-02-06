<div class = "row" >
   <div class="main">
  <a href=" <?php echo site_url("profile/edit_profile"); ?> " id = "edit_profile" class = "btn success"> 
    Edit Profile
  </a>
  <div id = "gravatar"> 
    <?php echo $profile_pic_url ?></br>

      Edit your profile to set your Gravatar
  </div>
  <div class = "line"> 
    Username: <span class = "profile_data_item"> <?php echo $username; ?> </span>
  </div>
  <div class = "line"> 
    Email: <span class = "profile_data_item"> <?php echo $email; ?> (not public) </span>
  </div>  
  <div class = "line"> 
    Age: <span class = "profile_data_item"> <?php echo $age; ?> </span>
  </div>   <div class = "line"> 
    Gender: <span class = "profile_data_item"> <?php echo $gender; ?> </span>
  </div>
  <div class = "line"> 
    Major: <span class = "profile_data_item"> <?php echo $major; ?> </span>
  </div>
  <div class = "line"> Team: <?php echo $link_to_team; ?> </div>

  <div id ="human_code"> 
    <div id = "code_text"> Human Code! </div>
    <div id = "color_box"> 
      <div id = "code">  <?php echo $human_code ?> </div>  
    </div>
  </div>

   </div>
   <div class="sidebar">
      <h3>Info</h3>
      <div class = "infoitem">
         <b> Game Play:</b> <br>
         Feb 6th - Feb 12th
      </div>
      <div class = "tinyline"></div>
      <div class = "infoitem">
         <b> Registration Deadline:</b><br>
         Jan 27th
      </div>
      <div class = "tinyline"></div>
      <div class = "infoitem">
         <b> Orientation Dates:</b><br>
         Jan 30th - Feb 3rd 
      </div>
      <div class = "tinyline"></div>
      <div class = "infoitem">
         <b> Contact:</b><br>
         <a href = "mailto:UofIHvZ@gmail.com"> UofIHvZ@gmail.com </a> <br>
         <a href = "http://www.facebook.com/groups/194292097284119/"> Facebook Group </a>
      </div>
      <div class = "tinyline"></div>
      <div class = "infoitem">
         <a href = "http://www.facebook.com/groups/194292097284119/"> Rules </a>
      </div>
   </div>
</div>
