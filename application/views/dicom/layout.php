<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>影像云信息管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <?php $this->load->view('dicom/header'); ?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed page-md">
<?php $this->load->view('dicom/navigation'); ?>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <?php if($this->session->userdata('usr_role')==1||$this->session->userdata('usr_role')==1024||$this->session->userdata('usr_role')==100){
            $this->load->view('component/adminmenu');
        }else{
            $this->load->view('component/usermenu');
        }?>
        <?php echo $subview ?>
        <?php $this->load->view('dicom/footer'); ?>
</body>
</html>
