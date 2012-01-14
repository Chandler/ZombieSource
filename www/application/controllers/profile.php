<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('security');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
		$this->load->model('Player_model','',TRUE);
    }

    public function index()
    {
		// is logged in?
        if ($this->tank_auth->is_logged_in()) { 
			// is waiver signed
			$playerid = $this->Player_model->getPlayerID($this->tank_auth->get_user_id(), '9a051bbc-3ebc-11e1-b778-000c295b88cf');
			if ($playerid > 0 && $this->Player_model->getPlayerData($playerid, 'waiver_is_signed')) { 
				$this->load->view('header');
				$this->load->view('profile_page');
				$this->load->view('footer');
			}else{
				$this->form_validation->set_rules('waiver', 'Waiver', 'trim|required|xss_clean');
				$this->form_validation->set_rules('sig', 'Signature', 'trim|required|xss_clean');
				$this->form_validation->set_rules('age', 'Age', 'integer|trim|xss_clean');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|xss_clean');
				$this->form_validation->set_rules('major', 'Major', 'trim|xss_clean');

				if ($this->form_validation->run()) {
					//store data
					
					$this->Player_model->createPlayerInGame($this->tank_auth->get_user_id(), '9a051bbc-3ebc-11e1-b778-000c295b88cf');
					$playerid = $this->Player_model->getPlayerID($userid, $gameid);
					$this->Player_model->setPlayerData($playerid, 'waiver_is_signed', 'TRUE');
					$this->Player_model->setPlayerData($playerid, 'sig', $this->validation->sig);
					$this->Player_model->setPlayerData($playerid, 'age', $this->validation->age);
					$this->Player_model->setPlayerData($playerid, 'gender', $this->validation->gender);
					$this->Player_model->setPlayerData($playerid, 'major', $this->validation->major);
					redirect('profile');
				}
				else{
					$this->load->view('header');
					$this->load->view('registration_page_two');
					$this->load->view('footer');
				}
			}
        }
        else{
            $this->load->view('header');
            $this->load->view('please_login');
            $this->load->view('footer');
        }
    }

    public function profile()
    {


    }

}
