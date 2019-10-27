<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities_history extends API_Controller{
    function __construct()
    {    
        parent::__construct();
        $this->load->model('activities_history_model');
    }

    function get_all_get(){
        $keyword = $this->get('keyword');
        $result = $this->activities_history_model->get_all($keyword);
        $this->response([
            'stetus' => true,
            'massage' => $result
        ], REST_Controller::HTTP_OK);
        

        /*error
        $this->response([
            'stetus' => false,
            'massage' => $result
        ], REST_Controller::HTTP_CONFLICT);*/
    }
}