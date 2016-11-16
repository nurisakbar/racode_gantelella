<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }    
function data() {
        $table = 'users';
        $primaryKey = 'id';
        $columns = array(
         array('db' => 'id', 'dt' => 0),array('db' => 'id', 'dt' => 0),
array('db' => 'ip_address', 'dt' => 1),
array('db' => 'username', 'dt' => 2),
array('db' => 'password', 'dt' => 3),
array('db' => 'salt', 'dt' => 4),
array('db' => 'email', 'dt' => 5),
array('db' => 'activation_code', 'dt' => 6),
array('db' => 'forgotten_password_code', 'dt' => 7),
array('db' => 'forgotten_password_time', 'dt' => 8),
array('db' => 'remember_code', 'dt' => 9),
array('db' => 'created_on', 'dt' => 10),
array('db' => 'last_login', 'dt' => 11),
array('db' => 'active', 'dt' => 12),
array('db' => 'first_name', 'dt' => 13),
array('db' => 'last_name', 'dt' => 14),
array('db' => 'company', 'dt' => 15),
array('db' => 'phone', 'dt' => 16),
array(
                'db' => 'id',
                'dt' => 17,
                'formatter' => function( $d, $row ) {
            return anchor('groups/read/'.$d,'<i class="fa fa-eye"></i>',"class='btn btn-sm btn-danger'").' '.
                   anchor('groups/update/'.$d,'<i class="fa fa-edit"></i>',"class='btn btn-sm btn-danger'").' '.
                   anchor('groups/delete/'.$d,'<i class="fa fa-trash"></i>',"class='btn btn-sm btn-danger'");
                }
            )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
        
        $this->load->library('ssp');
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    public function index()
    {
        $users = $this->Users_model->get_all();

        $data = array(
            'users_data' => $users
        );

        $this->template->load('template','users/users_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ip_address' => $row->ip_address,
		'username' => $row->username,
		'password' => $row->password,
		'salt' => $row->salt,
		'email' => $row->email,
		'activation_code' => $row->activation_code,
		'forgotten_password_code' => $row->forgotten_password_code,
		'forgotten_password_time' => $row->forgotten_password_time,
		'remember_code' => $row->remember_code,
		'created_on' => $row->created_on,
		'last_login' => $row->last_login,
		'active' => $row->active,
		'first_name' => $row->first_name,
		'last_name' => $row->last_name,
		'company' => $row->company,
		'phone' => $row->phone,
	    );
            $this->load->view('users/users_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users/create_action'),
	    'id' => set_value('id'),
	    'ip_address' => set_value('ip_address'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'salt' => set_value('salt'),
	    'email' => set_value('email'),
	    'activation_code' => set_value('activation_code'),
	    'forgotten_password_code' => set_value('forgotten_password_code'),
	    'forgotten_password_time' => set_value('forgotten_password_time'),
	    'remember_code' => set_value('remember_code'),
	    'created_on' => set_value('created_on'),
	    'last_login' => set_value('last_login'),
	    'active' => set_value('active'),
	    'first_name' => set_value('first_name'),
	    'last_name' => set_value('last_name'),
	    'company' => set_value('company'),
	    'phone' => set_value('phone'),
	);
        $this->template->load('template','users/users_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ip_address' => $this->input->post('ip_address',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'salt' => $this->input->post('salt',TRUE),
		'email' => $this->input->post('email',TRUE),
		'activation_code' => $this->input->post('activation_code',TRUE),
		'forgotten_password_code' => $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' => $this->input->post('forgotten_password_time',TRUE),
		'remember_code' => $this->input->post('remember_code',TRUE),
		'created_on' => $this->input->post('created_on',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'active' => $this->input->post('active',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'company' => $this->input->post('company',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
		'id' => set_value('id', $row->id),
		'ip_address' => set_value('ip_address', $row->ip_address),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'salt' => set_value('salt', $row->salt),
		'email' => set_value('email', $row->email),
		'activation_code' => set_value('activation_code', $row->activation_code),
		'forgotten_password_code' => set_value('forgotten_password_code', $row->forgotten_password_code),
		'forgotten_password_time' => set_value('forgotten_password_time', $row->forgotten_password_time),
		'remember_code' => set_value('remember_code', $row->remember_code),
		'created_on' => set_value('created_on', $row->created_on),
		'last_login' => set_value('last_login', $row->last_login),
		'active' => set_value('active', $row->active),
		'first_name' => set_value('first_name', $row->first_name),
		'last_name' => set_value('last_name', $row->last_name),
		'company' => set_value('company', $row->company),
		'phone' => set_value('phone', $row->phone),
	    );
            $this->template->load('template','users/users_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'ip_address' => $this->input->post('ip_address',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'salt' => $this->input->post('salt',TRUE),
		'email' => $this->input->post('email',TRUE),
		'activation_code' => $this->input->post('activation_code',TRUE),
		'forgotten_password_code' => $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' => $this->input->post('forgotten_password_time',TRUE),
		'remember_code' => $this->input->post('remember_code',TRUE),
		'created_on' => $this->input->post('created_on',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'active' => $this->input->post('active',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'company' => $this->input->post('company',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Users_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('salt', 'salt', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('activation_code', 'activation code', 'trim|required');
	$this->form_validation->set_rules('forgotten_password_code', 'forgotten password code', 'trim|required');
	$this->form_validation->set_rules('forgotten_password_time', 'forgotten password time', 'trim|required');
	$this->form_validation->set_rules('remember_code', 'remember code', 'trim|required');
	$this->form_validation->set_rules('created_on', 'created on', 'trim|required');
	$this->form_validation->set_rules('last_login', 'last login', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');
	$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
	$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
	$this->form_validation->set_rules('company', 'company', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "users.xls";
        $judul = "users";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Ip Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Salt");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Activation Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Forgotten Password Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Forgotten Password Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Remember Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Created On");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Login");
	xlsWriteLabel($tablehead, $kolomhead++, "Active");
	xlsWriteLabel($tablehead, $kolomhead++, "First Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Company");
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");

	foreach ($this->Users_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ip_address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->salt);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->activation_code);
	    xlsWriteLabel($tablebody, $kolombody++, $data->forgotten_password_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->forgotten_password_time);
	    xlsWriteLabel($tablebody, $kolombody++, $data->remember_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->created_on);
	    xlsWriteNumber($tablebody, $kolombody++, $data->last_login);
	    xlsWriteLabel($tablebody, $kolombody++, $data->active);
	    xlsWriteLabel($tablebody, $kolombody++, $data->first_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->last_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=users.doc");

        $data = array(
            'users_data' => $this->Users_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('users/users_doc',$data);
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-20 20:56:57 */
/* http://harviacode.com */