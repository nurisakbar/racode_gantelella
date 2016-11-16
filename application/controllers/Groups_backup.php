<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Groups_model');
        $this->load->library('form_validation');
    }

    function data() {
        $table = 'groups';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'name', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => 'description', 'dt' => 2),
           array(
                'db' => 'id',
                'dt' => 3,
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

    public function index() {
        $groups = $this->Groups_model->get_all();

        $data = array(
            'groups_data' => $groups
        );

        $this->template->load('template', 'groups/groups_list', $data);
    }

    public function read($id) {
        $row = $this->Groups_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'description' => $row->description,
            );
            $this->load->view('groups/groups_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('groups/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'description' => set_value('description'),
        );
        $this->template->load('template', 'groups/groups_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
            );

            $this->Groups_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('groups'));
        }
    }

    public function update($id) {
        $row = $this->Groups_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('groups/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'description' => set_value('description', $row->description),
            );
            $this->template->load('template', 'groups/groups_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
            );

            $this->Groups_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('groups'));
        }
    }

    public function delete($id) {
        $row = $this->Groups_model->get_by_id($id);

        if ($row) {
            $this->Groups_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('groups'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Groups.php */
/* Location: ./application/controllers/Groups.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-20 17:54:50 */
/* http://harviacode.com */