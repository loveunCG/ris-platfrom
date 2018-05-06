<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Ris System</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
    <?php $this->load->view('dicom/header'); ?>

    </head>

    <?php $this->load->view('dicom/navigation'); ?>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <?php if($this->session->userdata('admin_status')){
                    $this->load->view('component/adminmenu');
                }else{
                    $this->load->view('component/usermenu');
                }   ?>
        <?php echo $subview ?>
        <?php $this->load->view('dicom/footer'); ?>
    </body>
    </html>
