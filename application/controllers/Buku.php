<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MBuku');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'buku/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'buku/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'buku/index';
            $config['first_url'] = base_url() . 'buku/index';
        }

        $config['per_page'] = 3;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MBuku->total_rows($q);
        $buku = $this->MBuku->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'buku_data' => $buku,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('buku/buku_list', $data);
    }

    public function read($id)
    {
        $row = $this->MBuku->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode_buk' => $row->kode_buk,
                'judul' => $row->judul,
                'pengarang' => $row->pengarang,
                'peneribit' => $row->peneribit,
            );
            $this->load->view('buku/buku_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('buku/create_action'),
            'id' => set_value('id'),
            'kode_buk' => set_value('kode_buk'),
            'judul' => set_value('judul'),
            'pengarang' => set_value('pengarang'),
            'peneribit' => set_value('peneribit'),
        );
        $this->load->view('buku/buku_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_buk' => $this->input->post('kode_buk', TRUE),
                'judul' => $this->input->post('judul', TRUE),
                'pengarang' => $this->input->post('pengarang', TRUE),
                'peneribit' => $this->input->post('peneribit', TRUE),
            );

            $this->MBuku->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('buku'));
        }
    }

    public function update($id)
    {
        $row = $this->MBuku->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('buku/update_action'),
                'id' => set_value('id', $row->id),
                'kode_buk' => set_value('kode_buk', $row->kode_buk),
                'judul' => set_value('judul', $row->judul),
                'pengarang' => set_value('pengarang', $row->pengarang),
                'peneribit' => set_value('peneribit', $row->peneribit),
            );
            $this->load->view('buku/buku_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode_buk' => $this->input->post('kode_buk', TRUE),
                'judul' => $this->input->post('judul', TRUE),
                'pengarang' => $this->input->post('pengarang', TRUE),
                'peneribit' => $this->input->post('peneribit', TRUE),
            );

            $this->MBuku->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('buku'));
        }
    }

    public function delete($id)
    {
        $row = $this->MBuku->get_by_id($id);

        if ($row) {
            $this->MBuku->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('buku'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_buk', 'kode buku', 'trim|required|numeric');
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        $this->form_validation->set_rules('pengarang', 'pengarang', 'trim|required');
        // $this->form_validation->set_rules('peneribit', 'peneribit', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "buku.xls";
        $judul = "buku";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Buk");
        xlsWriteLabel($tablehead, $kolomhead++, "Judul");
        xlsWriteLabel($tablehead, $kolomhead++, "Pengarang");
        xlsWriteLabel($tablehead, $kolomhead++, "Peneribit");

        foreach ($this->MBuku->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_buk);
            xlsWriteLabel($tablebody, $kolombody++, $data->judul);
            xlsWriteLabel($tablebody, $kolombody++, $data->pengarang);
            xlsWriteLabel($tablebody, $kolombody++, $data->peneribit);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=buku.doc");

        $data = array(
            'buku_data' => $this->MBuku->get_all(),
            'start' => 0
        );

        $this->load->view('buku/buku_doc', $data);
    }
}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-30 06:10:12 */
/* http://harviacode.com */