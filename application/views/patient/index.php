
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col s12">
				<div class="card horizontal">
					<div class="card-image">
				        <img class="circle responsive-img" style="padding: 15px; width:250px;" src="<?=base_url()?>assets/images/faces/face<?=$info->patient_gender + 1?>.jpg">
				     </div>
				   <div class="card-stacked">
					<div class="card-content">
					<table class="" style="font-size: 18px;">
						<tbody>
							<tr>
								<td>
									姓名: &nbsp;&nbsp; <underline>   <?=isset($info->patient_name) ? $info->patient_name : ''?>    </underline>
								</td>
								<td>
									性别: &nbsp;&nbsp; <underline>    <?=$info->patient_gender == 0 ? '男' : '女'?>     </underline>
								</td>
								<td>
									年龄: &nbsp;&nbsp; <underline>    <?=isset($info->patient_age) ? $info->patient_age : ''?>     </underline>
								</td>
							</tr>
							<tr>
								<td>
									身份证号: &nbsp;&nbsp; <underline>    <?=isset($info->license_num) ? $info->license_num : ''?>     </underline>
								</td>
								<td>
									联系方式: &nbsp;&nbsp; <underline>    <?=isset($info->patient_phone_num) ? $info->patient_phone_num : ''?>     </underline>
								</td>
								<td>
									申请时间: &nbsp;&nbsp; <underline>    <?=isset($info->pat_create_time) ? $info->pat_create_time : ''?>     </underline>
								</td>
							</tr>
							<tr>
								<td>
									家庭住址: &nbsp;&nbsp; <underline>    <?=isset($info->patient_address) ? $info->patient_address : ''?>     </underline>
								</td>
							</tr>
						</tbody>
					</table>
					</div>
				   </div>

				</div>
			</div>
			<div class="col s12 m12">
				<div class="card">
					<div class="card-content">
						<span style="text-align-last: center;" class="card-title">检查记录</span>
						<table class="centered highlight"   id="patient_table">
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<style type="text/css" media="screen">
	underline {
		display: inline-block;
	    text-decoration: none;
	    border-bottom: 1px solid black;
	    margin-bottom: -1px;
	    padding-left: 5%;
	    padding-right: 10%;
	}
</style>
<script src="<?=base_url()?>assets/global/scripts/datatable.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
	var table = '';
    var base_url = '<?=base_url()?>';
    var patient_url = base_url + 'patient/patient_table';
    $(document.body).ready(function () {

		$('#searchBtn').click(function () {
			var formData = $('#searchForm').serialize();
			var ajaxurl = patient_url+'?'+ formData;
			table.ajax.url(ajaxurl).load();
		});

        $('#viewDicomBtn').click(function () {
            var booking_id = $('#booking_id').val();
            window.location.href=base_url+'patient/viewDicom/'+booking_id;
        });

        $('#viewReportBtn').click(function () {
            var report_id = $('#booking_id').val();
            window.location.href=base_url+'patient/viewReport/'+report_id;
        });

		$('#replayBtn').click(function () {
			$('#searchForm')[0].reset();
		});
		$('select').material_select();

		$('.datepicker').pickadate({
			monthsFull: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
			weekdaysShort: ['周一', '周二', '周三', '周四', '周五', '周六', '周末'],
			today: '今天',
			clear: '清理',
			formatSubmit: 'yyyy-mm-dd',
			close: '确认',
		});

		table = $('#patient_table').DataTable( {
	        "ajax": patient_url,
	        "order": [[ 1, "asc" ]],
		    "bLengthChange": false,
            'searching': false,
            language: {
				aria: {
					sortAscending: ": activate to sort column ascending",
					sortDescending: ": activate to sort column descending"
				},
				emptyTable: "没有数据",
				info: "显示 _START_ 到 _END_ 的 _TOTAL_ 条记录",
				infoEmpty: "找不到",
				search: "",
				infoFiltered: "(filtered1 from _MAX_ total records)",
				lengthMenu: "显示 _MENU_",
				zeroRecords: "找不到匹配的记录",
				paginate: {
					previous: "Prev",
					next: "Next",
					last: "Last",
					first: "First"
				}
			},
            "columnDefs": [
			    {  "title": "操作",  "targets": 0 },
			    {  "title": "序号", "targets": 1 },
			    {  "title": "病人编号", "targets": 2 },
			    {  "title": "登记时间",  "targets": 3 },
			    {  "title": "检查时间", "targets": 4 },
			    {  "title": "检查类型",  "targets": 5 },
			    {  "title": "检查项目", "targets": 6 },
			    {  "title": "报告写医生", "targets": 8 },
			    {  "title": "报告审核医生",  "targets": 9 },
			    {  "title": "接入医院",  "targets": 10 },
			    {  "title": "报告状态", "targets": 7 },
			 ],
	    } );
	});

	function reportView(chc_id){
		var strUrl = base_url+'patient/reporting_view/'+chc_id;
		window.location.href = strUrl;

	}
    function selectPatientInfo(param) {
        if(param.booking_status=='2'){
            $('#viewDicomBtn').removeAttr('disabled');
            $('#booking_id').val(param.bk_id);
            $('#viewReportBtn').attr('disabled', 'true');

        }else if(param.booking_status=='4'||param.booking_status=='3'){
            $('#viewDicomBtn').removeAttr('disabled');
            $('#viewReportBtn').removeAttr('disabled');
            $('#booking_id').val(param.bk_id);
            $('#report_id').val(param.report_id);

        }else{
            $('#viewDicomBtn').attr('disabled', 'true');
            $('#viewReportBtn').attr('disabled', 'true');
        }
    }

    	function dicom_view(chc_id) {
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "patient/dicomProc/" + chc_id;
			window.location.href = strURL;
		}

</script>
