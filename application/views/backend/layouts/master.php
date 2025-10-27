<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <?php $this->load->view('backend/layouts/head'); ?>
</head>
<body class="bg-primary">
    
    <?php $this->load->view('backend/layouts/header'); ?>
    
    <?php $this->load->view($content); ?>
    
    <!-- @include('backend.layouts.footer') -->

</body>
</html>