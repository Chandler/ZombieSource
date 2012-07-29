
  <div id = "game_panel">
  You wanted powers, now you've got them! (well some). Tread carefully here, if you undo a zombie tag on accident it's not exactly trival to reset it.
  Good luck and godspeed - Chandler

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
    <div class="well">
      <div class="form-horizontal">
        <fieldset>
          <div class="control-group">
            <div id="player_panel<?php echo $gameid?>">
              <label class="control-label">Search for a player</label>
              <div class="controls">
                <input id ="player_chooser<?php echo $gameid?>" type="text" data-provide="typeahead" data-items="4" data-source='<?php echo $player_list?>'>
                <input id="gameid<?php echo $gameid?>" type="hidden" value="<? echo $gameid ?>">
                <span class="help-inline">
                  <button id="manage_player<?php echo $gameid?>" class="btn">Manage Player</button>
                  <div class ="controls" id = "player_controls<?php echo $gameid?>" ></div>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#manage_player<?php echo $gameid?>").click(function(){
            $("#player_controls<?php echo $gameid?>").load('admin/player_controls',
                {player:$('#player_chooser<?php echo $gameid?>').val(),
                 gameid:$('#gameid<?php echo $gameid?>').val()});
        });
    });
    </script>
    <?php } ?>


  <div class = "tinyline"></div>





  <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-typeahead.js"></script>

