<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->library('form_validation');
		
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'student/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'student/index.html?q=' . urlencode($q);
			
        } else {
            $config['base_url'] = base_url() . 'student/index.html';
            $config['first_url'] = base_url() . 'student/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Student_model->total_rows($q);
        $student = $this->Student_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'student_data' => $student,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('student/student_list', $data);
		
    }

    public function read($id) 
    {
        $row = $this->Student_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'fakultas_id' => $row->fakultas_id,
		'jurusan_id' => $row->jurusan_id,
		'nim' => $row->nim,
		'name' => $row->name,
		'address' => $row->address,
		'phone' => $row->phone,
		'birthday' => $row->birthday,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->load->view('student/student_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('student'));
			
        }
    }

    public function create() 
    {
		echo"test";
        $data = array(
            'button' => 'Create',
            'action' => site_url('student/create_action'),
	    'id' => set_value('id'),
	    'fakultas_id' => set_value('fakultas_id'),
	    'jurusan_id' => set_value('jurusan_id'),
	    'nim' => set_value('nim'),
	    'name' => set_value('name'),
	    'address' => set_value('address'),
	    'phone' => set_value('phone'),
	    'birthday' => set_value('birthday'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->load->view('student/student_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'fakultas_id' => $this->input->post('fakultas_id',TRUE),
		'jurusan_id' => $this->input->post('jurusan_id',TRUE),
		'nim' => $this->input->post('nim',TRUE),
		'name' => $this->input->post('name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'birthday' => $this->input->post('birthday',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Student_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('student'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Student_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('student/update_action'),
		'id' => set_value('id', $row->id),
		'fakultas_id' => set_value('fakultas_id', $row->fakultas_id),
		'jurusan_id' => set_value('jurusan_id', $row->jurusan_id),
		'nim' => set_value('nim', $row->nim),
		'name' => set_value('name', $row->name),
		'address' => set_value('address', $row->address),
		'phone' => set_value('phone', $row->phone),
		'birthday' => set_value('birthday', $row->birthday),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->load->view('student/student_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('student'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'fakultas_id' => $this->input->post('fakultas_id',TRUE),
		'jurusan_id' => $this->input->post('jurusan_id',TRUE),
		'nim' => $this->input->post('nim',TRUE),
		'name' => $this->input->post('name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'birthday' => $this->input->post('birthday',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Student_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('student'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Student_model->get_by_id($id);

        if ($row) {
            $this->Student_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('student'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('student'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('fakultas_id', 'fakultas id', 'trim|required');
	$this->form_validation->set_rules('jurusan_id', 'jurusan id', 'trim|required');
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('birthday', 'birthday', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Student.php */
/* Location: ./application/controllers/Student.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-11 21:28:26 */
/* http://harviacode.com */