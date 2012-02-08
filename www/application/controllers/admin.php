<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        if(!$this->tank_auth->is_logged_in()){
            redirect('/auth/login');
        }
        $this->load->model('Player_model','',TRUE);
        $this->load->model('Team_model','',TRUE);
        $this->load->library('PlayerCreator', null);
        $this->load->library('TeamCreator', null);
        $this->load->helper('game_helper');
        $this->load->helper('tag_helper');
    }

	public function index(){
       //is mod check
        $userid = $this->tank_auth->get_user_id();
        $player = $this->playercreator->getPlayerByUserIDGameID($userid, GAME_KEY);
        $data['player_list'] = getPlayerString(GAME_KEY);

        $layout_data = array();
        $layout_data['active_sidebar'] = 'playerlist';
        $layout_data['top_bar'] = $this->load->view('layouts/logged_in_topbar','', true);
        $layout_data['content_body'] = $this->load->view('admin/admin_page', $data, true);
        $layout_data['footer'] = $this->load->view('layouts/footer', '', true);
        $this->load->view('layouts/main', $layout_data);
	}

    public function player_controls(){
        $username = $this->input->post('player');
        try{
            $userid = getUserIDByUsername($username);
            $player = $this->playercreator->getPlayerByUserIDGameID($userid, GAME_KEY);
            $data = getPrivatePlayerProfileDataArray($player);

            if($player->getStatus() == 'zombie'){ 
                $data['feed_disabled'] = "";
                $data['feed_message'] = "";

                if($player->isElligibleForTagUndo()){
                    $this->load->library('TagCreator');
                    $tagid = getInitialTagIDByPlayer($player);
                    $tag = $this->tagcreator->getTagByTagID($tagid);
                    $tagger_name = $tag->getTagger()->getUser()->getUsername();
                    $taggee_name = $player->getUser()->getUsername();

                    //spent 30 min trying to convert utc datetime to current 12 hour PST time to show the tag time and gave up due to time constraints.
                    //probably need a time helper.
                    $message = "TAG: <h3> $tagger_name </h3> tagged <h3> $taggee_name </h3>";
                    
                    $data['undo_tag_disabled'] = "";
                    $data['undo_tag_message'] = $message;  
                }else{ //is a zombie but can't be untaggged
                    $data['undo_tag_disabled'] = "disabled";
                    $data['undo_tag_message'] = "Zombie not elligble to be untagged";      
                }
            }else{ //is not a zombie, can't be feed or untagged
                $data['feed_disabled'] = "disabled";
                $data['feed_message'] = "Not a zombie";
                $data['undo_tag_disabled'] = "disabled";
                $data['undo_tag_message'] = "Not a zombie";               
            }

            $this->load->view('admin/player_controls.php', $data);
        }catch (Exception $e){
            $this->loadGenericMessageWithoutLayout("Player Not Found");
        }
    }

    public function undo_tag(){
        $this->load->library('TagCreator');

        //is mod check
        $player = $this->playercreator->getPlayerByPlayerID($this->input->post('player'));
        $username = $player->getUser()->getUsername();
        if($player->isElligibleForTagUndo()){ //just to be sure

            $tagid = getInitialTagIDByPlayer($player);
            $tag = $this->tagcreator->getTagByTagID($tagid);

            //the important part of this method.
            $tag->invalidate();

            if($tag->isInvalid()){
                $this->loadGenericMessageWithoutLayout("Success! Tag invalidated");
            }else{
                $this->loadGenericMessageWithoutLayout("$username is a Zombie still, something went wrong : /");
            }
        }
    }


    public function free_feed(){
        $this->load->library('FeedCreator');
        $player = $this->playercreator->getPlayerByPlayerID($this->input->post('player'));
        $username = $player->getUser()->getUsername(); 
        if($player->getStatus() == 'zombie'){ //is_a Zombie scares me, I don't know how it works. So I check the status. 
            //the important part of this method.
            $feed = $this->feedcreator->getNewFeed($player, null, gmdate("Y-m-d H:i:s", time()), true);
            if($feed ){
                $this->loadGenericMessageWithoutLayout("Success! $username has been fed");
            }else{
                $this->loadGenericMessageWithoutLayout("Something went wrong, $username may not have been fed");
            }
        }
    }

    //Duplicated and modified from Game.php because I'm not sure how to load views from a helper
    function loadGenericMessageWithoutLayout($message){
        $data = array("message" => $message);
        $this->load->view('helpers/display_generic_message',$data);
    }
}