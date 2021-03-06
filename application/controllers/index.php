<?php
/**
 * Created by PhpStorm.
 * User: bin.shen
 * Date: 5/2/16
 * Time: 09:56
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//t
class Index extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('news_model');
    }

    function _remap($method,$params = array()) {
        if(!$this->session->userdata('login_user_id')) {

        } else {
            if($method == 'jinrong' || $method == 'peixun' || $method == 'quanzheng' || $method == 'xingcheng'){
                if($this->session->userdata('login_flag') == 1){
                    redirect(site_url('/finance/finance_list'));
                    exit();
                }
                if($this->session->userdata('login_flag') == 2){
                    redirect(site_url('/examination/mark_list'));
                    exit();
                }
                if($this->session->userdata('login_flag') == 3){
                    redirect(site_url('/agenda/list_agenda'));
                    exit();
                }
                if($this->session->userdata('login_flag') == 4){
                    redirect(site_url('/activity/list_activity'));
                    exit();
                }
            }

        }
        return call_user_func_array(array($this, $method), $params);
    }
    public function index() {
        if($this->session->userdata('login_flag') == 1){
            redirect(site_url('/finance/finance_list'));
            exit();
        }
        if($this->session->userdata('login_flag') == 2){
            redirect(site_url('/examination/mark_list'));
            exit();
        }
        if($this->session->userdata('login_flag') == 3){
            redirect(site_url('/agenda/list_agenda'));
            exit();
        }
        if($this->session->userdata('login_flag') == 4){
            redirect(site_url('/activity/list_activity'));
            exit();
        }
    }

/*
    public function index($page=1) {

        $data = $this->news_model->list_news($page);
        $pager = $this->pagination->getPageLink('/index/index', $data['countPage'], $data['numPerPage']);
        $this->assign('pager', $pager);
        $this->assign('news_list', $data);
        $position_id = array();
        $user_id = $this->session->userdata('login_user_id');
        if(!empty($user_id)) {
            $position_id = $this->session->userdata('login_position_id_array');
            $icons = $this->user_model->get_icons($user_id);
            $icon_count = $this->user_model->get_icon_count($user_id);

            if(empty($icons)) {
                $icons = array(
                    array('id'=> 1, 'name' => '行程管理', 'img' => 'index_nav1.jpg', 'url' => '/activity/list_activity'),
                    array('id'=> 2, 'name' => '绩效排行', 'img' => 'index_nav14.jpg', 'url' => '/activity/list_ranking'),
                    array('id'=> 4, 'name' => '预约场地', 'img' => 'index_nav4.jpg', 'url' => '/appointment/book_room')
                );
                $icon_count = count($icons);
            }
        } else {
            $icons = $this->user_model->get_icons();
            $icon_count = $this->user_model->get_icon_count();
            if($icon_count > 6) $icon_count = 6;
        }
        $this->assign('position_id', $position_id);
        $this->assign('icon_data', json_encode($icons));
        $this->assign('icon_count', $icon_count);

        //$this->display('index.html');
        $this->display('testhtml/index_test.html');
    }

    public function index_test($page=1) {

        $data = $this->news_model->list_news($page);
        $pager = $this->pagination->getPageLink('/index/index_test', $data['countPage'], $data['numPerPage']);
        $this->assign('pager', $pager);
        $this->assign('news_list', $data);
        $position_id = array();
        $user_id = $this->session->userdata('login_user_id');
        if(!empty($user_id)) {
            $position_id = $this->session->userdata('login_position_id_array');
            $icons = $this->user_model->get_icons($user_id);
            $icon_count = $this->user_model->get_icon_count($user_id);

            if(empty($icons)) {
                $icons = array(
                    array('id'=> 1, 'name' => '行程管理', 'img' => 'index_nav1.jpg', 'url' => '/activity/list_activity'),
                    array('id'=> 2, 'name' => '绩效排行', 'img' => 'index_nav14.jpg', 'url' => '/activity/list_ranking'),
                    array('id'=> 4, 'name' => '预约场地', 'img' => 'index_nav4.jpg', 'url' => '/appointment/book_room')
                );
                $icon_count = count($icons);
            }
        } else {
            $icons = $this->user_model->get_icons();
            $icon_count = $this->user_model->get_icon_count();
            if($icon_count > 6) $icon_count = 6;
        }
        $this->assign('position_id', $position_id);
        $this->assign('icon_data', json_encode($icons));
        $this->assign('icon_count', $icon_count);

        $this->display('testhtml/index_test.html');
    }
*/
    public function login() {
        echo $this->user_model->check_login();
        die;
    }

    public function logout() {
        //die('asd');

        $login_flag = $this->session->userdata('login_flag')?$this->session->userdata('login_flag'):-1;
        $this->session->sess_destroy();
        switch ($login_flag){
            case 1:
                redirect(site_url('/index/jinrong'));
                break;
            case 2:
                redirect(site_url('/index/peixun'));
                break;
            case 3:
                redirect(site_url('/index/quanzheng'));
                break;
            case 4:
                redirect(site_url('/index/xingcheng'));
                break;
            default:
                redirect(site_url('/'));
        }

    }

    public function check_login() {
        if($this->session->userdata('login_user_id')){
            if(in_array(1,$this->session->userdata('login_position_id_array'))){
                echo 2;
            }elseif(in_array(11,$this->session->userdata('login_position_id_array'))){
                echo 3;
            }else{
                echo 1;
            }
        }else{
            echo 0;
        }
        die;
    }

    public function check_pass($pass) {
        $login_password = $this->session->userdata('login_password');
        echo $login_password == sha1($pass) ? 1 : 0;
        die;
    }

    public function update_password() {
        echo $this->user_model->update_password();
        die;
    }

    public function upload_pic() {
        $config['upload_path'] = './././uploadfiles/profile';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if($this->upload->do_upload()) {
            $img_info = $this->upload->data();
            $this->user_model->update_tmp_pic($img_info['file_name']);
        }
        die;
    }

    public function update_user() {
        echo $this->user_model->update_user();
        die;
    }
    
    public function set_icon() {
        $user_id = $this->session->userdata('login_user_id');
        $this->user_model->reset_icon_config($user_id);

        redirect(site_url('/'));
    }

    public function set_wx_msg($flag = -1){
        $this->user_model->set_wx_msg($flag);

    }

    public function set_cggg_msg(){
        $this->user_model->set_cggg_msg();
    }

    public function jinrong(){
        if($this->input->post('username')){
            $res = $this->user_model->ksls_2_login(1);
            if($res == 1){
                redirect(site_url('/finance/finance_list'));
            }
            $this->assign('flag', $res);
        }else{
            $this->assign('flag', 0);
        }
        $this->display('jinrong_index.html');
    }

    public function peixun(){
        if($this->input->post('username')){
            $res = $this->user_model->ksls_2_login(2);
            if($res == 1){
                redirect(site_url('/examination/mark_list'));
            }
            $this->assign('flag', $res);
        }else{
            $this->assign('flag', 0);
        }
        $this->display('peixun_index.html');
    }

    public function quanzheng(){
        if($this->input->post('username')){
            $res = $this->user_model->ksls_2_login(3);
            if($res == 1){
                redirect(site_url('/agenda/list_agenda'));
            }
            $this->assign('flag', $res);
        }else{
            $this->assign('flag', 0);
        }
        $this->display('quanzheng_index.html');
    }

    public function xingcheng(){
        if($this->input->post('username')){
            $res = $this->user_model->ksls_2_login(4);
            if($res == 1){
                redirect(site_url('/activity/list_activity'));
            }
            $this->assign('flag', $res);
        }else{
            $this->assign('flag', 0);
        }
        $this->display('xingcheng_index.html');
    }
}