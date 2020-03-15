<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publik extends CI_Controller
{
	public function index()
	{
		$data['judul'] = 'Portal SMS UTM';

		$this->load->view('template/header_public', $data);
		$this->load->view('template/topbar_public', $data);
		$this->load->view('Public/index', $data);
		$this->load->view('template/footer_public');
	}
}
