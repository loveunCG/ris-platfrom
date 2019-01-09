<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-login"></i></a>
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
	<div class="page-quick-sidebar">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> 医生
                                <span class="badge badge-danger">2</span>
                            </a>
			</li>			
		</ul>
	</div>
</div>


<script>
    $(function(){
        var get_contact_info = '<?=base_url()?>contact/getContactAddrInfo';
        $.ajax({
            url: get_contact_info, // point to server-side controller method
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            type: 'post',
            success: function (response) {
                var contactAddr = '';
                for ( var index in response){
                    contactAddr += '<li class="media"><div class="media-status"><span class="badge badge-success"></span></div>';
                    contactAddr +=  '<img class="media-object" src="<?=base_url()?>assets/layouts/layout/img/avatar3.jpg" alt="..."><div class="media-body">';
                    contactAddr +=  '<h4 class="media-heading">'+response[index].usr_name+'</h4><div class="media-heading-sub">';
                    contactAddr += response[index].usr_department+' </div></div></li>';
                }
                $('#chataddress_field').html(contactAddr);
            },
            error: function (response) {


            }
        });

    });




</script>
