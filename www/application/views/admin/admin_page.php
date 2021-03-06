
  <div id = "game_panel">
 <div class="alert alert-info"><strong>With great power comes great responsibilty.</strong>
  This is the Moderator Tools page. Undoing changes made on this page is not trivial. So, be careful. </div>

  </br>
  </br>
  </div>
  <div class = "tinyline"></div>
<!--   <div id = "player_panel">
    Search for a player
    <input id ="player_chooser" type="text" class="span3" style="margin: 10px auto;" data-provide="typeahead" data-items="4" data-source='<?php echo $player_list?>'/>
    <button id = "manage_player" class = "btn success"> Manage Player</button>
    <div class ="controls" id = "player_controls" ></div>
  </div> -->

  <?php foreach($player_in_game as $gameid=>$player_list){ ?>
  <div class="row-fluid">
    <div class="well span12">
      <div class="form-horizontal">
        <fieldset>
          <!-- <div class="span7"> -->
            <div class="control-group">
            <h2><?php echo $game_names[$gameid];?></h2>
            <div>
                <button id="regenerate_zombie_tree<?php echo $gameid?>" class="btn" value="<?php echo $gameid?>">Regenerate Zombie Family Tree</button>
                <button id="check_missed_achievements<?php echo $gameid?>" class="btn" value="<?php echo $gameid?>">Check for Missed Achievements</button>
                <div id="message<?php echo $gameid?>"></div>
            </div>
              <div id="player_panel<?php echo $gameid?>">
                <label class="control-label">Search for a player</label>
                <div class="controls">
                  <input id ="player_chooser<?php echo $gameid?>" type="text" placeholder="Username" data-provide="typeahead" data-items="4" data-source='<?php echo $player_list?>'>
                    OR<br>
                  <input id="gameid<?php echo $gameid?>" type="hidden" value="<? echo $gameid ?>">
                <input id="humancode_chooser<?php echo $gameid?>" type="text" placeholder="Human Code" />
                  <span class="help-inline">
                    <button id="manage_player<?php echo $gameid?>" class="btn">Manage Player</button>
                  </span>
                </div>
              </div>
            </div>
          <!-- </div> -->

        </fieldset>

      </div>
                    <div class ="controls" id = "player_controls<?php echo $gameid?>" ></div>

    </div>
  </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#manage_player<?php echo $gameid?>").click(function(){
            $("#player_controls<?php echo $gameid?>").load('admin/player_controls',
                {player:$('#player_chooser<?php echo $gameid?>').val(),
                 human_code:$('#humancode_chooser<?php echo $gameid?>').val(),
                 gameid:$('#gameid<?php echo $gameid?>').val()});
        });
        $("#regenerate_zombie_tree<?php echo $gameid; ?>").click(function(){
            $("#message<?php echo $gameid; ?>").load("admin/regenerate_zombie_tree",
                {gameid:"<?php echo $gameid; ?>"});
        });
        $("#check_missed_achievements<?php echo $gameid; ?>").click(function(){
            $("#message<?php echo $gameid; ?>").load("admin/check_missed_achievements",
                {gameid:"<?php echo $gameid; ?>"});
        });
    });
    </script>
    <?php } ?>


  <div class = "tinyline"></div>





  <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-typeahead.js"></script>


