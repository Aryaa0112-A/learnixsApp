<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['upload_path'] = './uploads/tugas/';
$config['allowed_types'] = 'pdf|doc|docx|zip|rar';
$config['max_size'] = 2048; // 2MB
$config['encrypt_name'] = TRUE;
$config['overwrite'] = FALSE;
$config['remove_spaces'] = TRUE; 