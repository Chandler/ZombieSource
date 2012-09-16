<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('UTC');

class Achievement{
    private $ci = null;

    public function __construct(){
        $this->ci =& get_instance();

        $this->ci->load->model('Achievement_model', '', true);
        $this->ci->load->model('Player_team_model', '', true);
        $this->ci->load->model('Tag_model', '', true);
        $this->ci->load->library('TagCreator');

    }

    // recalculate achievements (does not delete, only adds)
    public function backgenerate(){
        $tags_raw = $this->ci->Tag_model->getTagsInOrder();
        foreach($tags_raw as $tag){
            $this->registerKillAchievements($this->ci->tagcreator->getTagByTagID($tag['id']), FALSE);
        }
    }

    public function registerKillAchievements($tag, $break_early=TRUE){
        $taggerid = $tag->getTaggerID();
        // test for killstreak achievements
        $kill_info = $this->ci->Achievement_model->getLargestKillStreakInXHours($tag, 3);
        $levels = array( // num_kills => achievement_id
            6 => 5,
            5 => 4,
            4 => 3,
            3 => 2,
            2 => 1
        );
        foreach($levels as $kills => $achievementid){
            if($kill_info->count >= $kills){
                $this->addAchievement($taggerid, $achievementid, $kill_info->latest);
                if($break_early) break; // presumably the other cases have already happened
            }
        }

        $kill_info = $this->ci->Achievement_model->getKillCountByPlayerID($taggerid);

        // test for time independent kill achievements
        $levels = array( // num_kills => achievement_id
            20 => 12,
            15 => 11,
            10 => 10,
            5  => 9,
            1  => 8
        );
        foreach($levels as $kills => $achievementid){
            if($kill_info->count >= $kills){
                $this->addAchievement($taggerid, $achievementid, $kill_info->latest);
                if($break_early) break; // presumably the other cases have already happened
            }
        }

        // check for True Friend
        if ($kill_info->count == 1){ // must be first kill
            try{
                $tagger_team = $this->ci->Player_team_model->getLastTeam($taggerid);
                $taggee_team = $this->ci->Player_team_model->getLastTeam($tag->getTaggeeID());
                if($tagger_team == $taggee_team){ // former teammates
                    // this totally ignores corner cases, like if the tagger quit the team and didn't join another
                    $this->addAchievement($taggerid, 8, $kill_info->latest);
                }
            } catch (PlayerNotMemberOfAnyTeamException $e){
                // no fear, and no achievement
            }
        }

    }

    private function addAchievement($playerid, $achievementid, $date){
        if(!$this->ci->Achievement_model->checkAchievementExistsByPlayerIDAchievementID($playerid, $achievementid)){
            // achievements can only be earned once per game
            $this->ci->Achievement_model->addAchievement($playerid, $achievementid, $date);
        }
    }

}