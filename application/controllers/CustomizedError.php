<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 10/8/17
 * Time: 10:20 PM
 */

class CustomizedError extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        $this->load->view('errors/error_404',$data);//loading in my template
    }
}

?>