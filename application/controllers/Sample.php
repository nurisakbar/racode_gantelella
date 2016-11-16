<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sample extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sample_model');
        $this->load->library('form_validation');
    }    
function data() {
        $table = 'sample';
        $primaryKey = 'asa';
        $columns = array(
         array('db' => 'asa', 'dt' => 0),array('db' => 'asa', 'dt' => 0),
array('db' => 'sas1', 'dt' => 1),
array('db' => 'assa2', 'dt' => 2),
array('db' => 'sas3', 'dt' => 3),
array(
                'db' => 'asa',
                'dt' => 4,
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
        $sample = $this->Sample_model->get_all();

        $data = array(
            'sample_data' => $sample
        );

        $this->template->load('template','sample/sample_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Sample_model->get_by_id($id);
        if ($row) {
            $data = array(
		'asa' => $row->asa,
		'sas1' => $row->sas1,
		'assa2' => $row->assa2,
		'sas3' => $row->sas3,
	    );
            $this->load->view('sample/sample_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sample'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sample/create_action'),
	    'asa' => set_value('asa'),
	    'sas1' => set_value('sas1'),
	    'assa2' => set_value('assa2'),
	    'sas3' => set_value('sas3'),
	);
        $this->template->load('template','sample/sample_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'sas1' => $this->input->post('sas1',TRUE),
		'assa2' => $this->input->post('assa2',TRUE),
		'sas3' => $this->input->post('sas3',TRUE),
	    );

            $this->Sample_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sample'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sample_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sample/update_action'),
		'asa' => set_value('asa', $row->asa),
		'sas1' => set_value('sas1', $row->sas1),
		'assa2' => set_value('assa2', $row->assa2),
		'sas3' => set_value('sas3', $row->sas3),
	    );
            $this->template->load('template','sample/sample_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sample'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('asa', TRUE));
        } else {
            $data = array(
		'sas1' => $this->input->post('sas1',TRUE),
		'assa2' => $this->input->post('assa2',TRUE),
		'sas3' => $this->input->post('sas3',TRUE),
	    );

            $this->Sample_model->update($this->input->post('asa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sample'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sample_model->get_by_id($id);

        if ($row) {
            $this->Sample_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sample'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sample'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('sas1', 'sas1', 'trim|required');
	$this->form_validation->set_rules('assa2', 'assa2', 'trim|required');
	$this->form_validation->set_rules('sas3', 'sas3', 'trim|required');

	$this->form_validation->set_rules('asa', 'asa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sample.xls";
        $judul = "sample";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Sas1");
	xlsWriteLabel($tablehead, $kolomhead++, "Assa2");
	xlsWriteLabel($tablehead, $kolomhead++, "Sas3");

	foreach ($this->Sample_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sas1);
	    xlsWriteNumber($tablebody, $kolombody++, $data->assa2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sas3);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sample.doc");

        $data = array(
            'sample_data' => $this->Sample_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sample/sample_doc',$data);
    }

}

/* End of file Sample.php */
/* Location: ./application/controllers/Sample.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-20 20:57:24 */
/* http://harviacode.com */