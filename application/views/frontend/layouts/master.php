<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php $this->load->view('frontend/layouts/head'); ?>
</head>
<body class="bg-primary">

    <?php $this->load->view('frontend/layouts/header'); ?>
    
    <?php $this->load->view($content); ?>

    <!-- @include('frontend.layouts.footer')

    @include('frontend.layouts.chat') -->
    
</body>
</html>