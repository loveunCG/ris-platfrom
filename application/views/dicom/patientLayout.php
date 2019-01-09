<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>影像云信息管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <?php $this->load->view('patient/header'); ?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed page-md">
<?php $this->load->view('patient/navigation'); ?>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <?php
            $this->load->view('patient/menu');
        ?>
        <?php echo $subview ?>
        <?php $this->load->view('patient/footer'); ?>
</body>
</html>