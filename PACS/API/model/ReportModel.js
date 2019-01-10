import Base from '../model/BaseModel'

export default class ReportModel extends Base {

	constructor(data) {
		super(data);
	}

	getReportListInfo(query, between) {
		var bookingData = [];
		if (query) {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.where(query)
				.whereBetween('booking_time', between)
				.whereNotIn('checkup_status', [0, 6])
				.orderBy('checkup_time')
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"patient_age",
					"license_num",
					"tbl_patient_booking.hospital_name",
					"checked_time",
					"booking_time",
					"checkup_status",
					"req_doctor_name",
					"Imaging_performance",
					"tbl_patient_booking.hospital_name as hostipalName",
					"tbl_patient_booking.booking_id as pb_booking_id"
				);
		} else {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.whereNotIn('checkup_status', [0, 6])
				.whereNotIn('booking_status', 1)
				.orderBy('checkup_time')
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"patient_age",
					"tbl_patient_booking.hospital_name as hostipalName",
					"license_num",
					"checked_time",
					"booking_time",
					"checkup_status",
					"req_doctor_name",
					"report_doc_name",
					"Imaging_performance",
					"tbl_patient_booking.booking_id as pb_booking_id"
				);
		}
		return bookingData;
	}

	getmyReportListInfo(query, between, between1) {
		var bookingData = [];
		console.log(query);
		bookingData = this.DBCon('tbl_check_list')
			.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
			.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
			.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
		if (query) bookingData = bookingData.where(query);
		if (between) bookingData = bookingData.whereBetween('report_time', between);
		if (between1) bookingData = bookingData.whereBetween('booking_time', between1);
		bookingData = bookingData.whereNotIn('checkup_status', [1,3,6])
			.groupBy('tbl_patient_booking.booking_id')
			.select(
				"image_num",
				"patient_name",
				"patient_gender",
				"patient_type",
				"patient_age",
				"license_num",
				"tbl_patient_booking.hospital_name",
				"checked_time",
				"booking_time",
				"checkup_status",
				"req_doctor_name",
				"report_doc_name",
				"Imaging_performance",
				"tbl_patient_booking.hospital_name as hostipalName",
				"tbl_patient_booking.booking_id as pb_booking_id"
			)
			.where(query);
		return bookingData;
	}

	GetReportDetailInfo(query, alternative) {
		var bookingData = [];
		if (alternative) {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.where(query)
				.whereNot(alternative)
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"patient_age",
					"license_num",
					"remote_status",
					"checkup_status",
					"checked_time",
					"booking_time",
					"req_doctor_name",
					"image_degree",
					"urgency_status",
					"positive_status",
					"report_doc_name",
					"doctor_name",
					"impression",
					"recommend_report",
					"Imaging_performance",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				);
		} else if (query) {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.where(query)
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"patient_age",
					"impression",
					"remote_status",
					"license_num",
					"recommend_report",
					"booking_time",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"checked_time",
					"image_degree",
					"urgency_status",
					"positive_status",
					"checkup_status",
					"req_doctor_name",
					"report_doc_name",
					"doctor_name",
					"Imaging_performance",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				)
				.where(query)
		} else {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"impression",
					"patient_age",
					"checked_time",
					"license_num",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"image_degree",
					"urgency_status",
					"positive_status",
					"checkup_status",
					"booking_time",
					"req_doctor_name",
					"recommend_report",
					"report_doc_name",
					"doctor_name",
					"Imaging_performance",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				);

		}
		return bookingData;
	}

	GetReportListPast(query) {
		var bookingData = [];
		if (query) {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"patient_age",
					"impression",
					"remote_status",
					"license_num",
					"recommend_report",
					"checked_time",
					"booking_time",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"image_degree",
					"urgency_status",
					"positive_status",
					"checkup_status",
					"req_doctor_name",
					"report_doc_name",
					"doctor_name",
					"Imaging_performance",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				)
				.where(query)
		} else {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"impression",
					"patient_age",
					"checked_time",
					"license_num",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"image_degree",
					"urgency_status",
					"positive_status",
					"checkup_status",
					"booking_time",
					"req_doctor_name",
					"recommend_report",
					"report_doc_name",
					"doctor_name",
					"Imaging_performance",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				);

		}
		return bookingData;
	}

	getDeliberationInfo(query) {
		var bookingData = [];
		if (query) {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.whereNotIn('checkup_status', [0, 1, 2, 3, 7])
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"patient_type",
					"patient_age",
					"license_num",
					"booking_status",
					"checked_time",
					"checkup_status",
					"deliberation_content",
					"req_doctor_name",
					"image_degree",
					"urgency_status",
					"positive_status",
					"report_doc_name",
					"doctor_name",
					"deliberation_id",
					"recommend_report",
					"Imaging_performance",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				)
				.where(query);
		} else {
			bookingData = this.DBCon('tbl_check_list')
				.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
				.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
				.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
				.whereNotIn('checkup_status', [0, 1, 2, 3, 7])
				.select(
					"image_num",
					"patient_name",
					"patient_gender",
					"deliberation_id",
					"patient_type",
					"patient_age",
					"license_num",
					"booking_status",
					"checked_time",
					"checkup_status",
					"deliberation_content",
					"req_doctor_name",
					"image_degree",
					"urgency_status",
					"positive_status",
					"report_doc_name",
					"doctor_name",
					"recommend_report",
					"Imaging_performance",
					"tbl_patient_booking.hospital_name as hostipal_name",
					"tbl_report.report_id as pb_report_id",
					"tbl_patient_booking.booking_id as pb_booking_id"
				);

		}
		return bookingData;
	}

	getDeliList(query, reportTime, deliTime) {
		var bookingData = [];
		bookingData = this.DBCon('tbl_check_list')
		.leftJoin('tbl_patient_booking', 'tbl_patient_booking.booking_id', '=', 'tbl_check_list.chc_booking_id')
		.leftJoin('tbl_report', 'tbl_check_list.chc_id', '=', 'tbl_report.checkup_id')
		.leftJoin('tbl_deliberation', 'tbl_deliberation.report_id', '=', 'tbl_report.report_id')
		.whereNotIn('checkup_status', [0, 1, 2, 3, 7]);
		if (query) {
			bookingData = bookingData.where(query);
		}
		if (reportTime) {
			bookingData = bookingData.whereBetween('report_time', reportTime);

		}
		if (deliTime) {
			bookingData = bookingData.whereBetween('deliberation_time', deliTime);

		}
		bookingData = bookingData.select(
			"image_num",
			"patient_name",
			"patient_gender",
			"patient_type",
			"patient_age",
			"license_num",
			"checkup_status",
			"checked_time",
			"deliberation_content",
			"req_doctor_name",
			"image_degree",
			"urgency_status",
			"positive_status",
			"report_doc_name",
			"doctor_name",
			"recommend_report",
			"Imaging_performance",
			"tbl_report.report_id as pb_report_id",
			"tbl_patient_booking.booking_id as pb_booking_id"
		);
		return bookingData;
	}

	SaveReportInfo(saveData, where) {
		if (where) {
			return this.DBCon('tbl_report')
				.where(where)
				.update(saveData);
		} else {
			return this.DBCon('tbl_report')
				.insert(saveData);
		}

	}

	UpdateBookingData(data, where) {
		return this.DBCon('tbl_check_list')
			.where(where)
			.update(data);
	}

	UpdateCheckuoData(data, where) {
		return this.DBCon('tbl_check_list')
			.where(where)
			.update(data);
	}

	getReportModule(query){

		var moduleData = [];
		moduleData = this.DBCon('tbl_report_module')
			.leftJoin('tbl_module_class', 'tbl_module_class.class_id', '=', 'tbl_report_module.module_class')	
		if (query) moduleData = moduleData.where(query);	
		moduleData.groupBy('tbl_report_module.module_id')
			.select(
				"module_name",
				"module_id",
				"module_class",
				"class_name"
			);
		return moduleData;
	}

	getTemplateByDeviceType(){
		 return this.DBCon('tbl_template').groupBy('tbl_template.device_type').select("device_type");		
	}	

	saveTemplateClass(saveData, where){
		if (where) {
			return this.DBCon('tbl_report_module').where(where)
				.update(saveData);
		} else {
			return this.DBCon('tbl_report_module').insert(saveData);
		}
	}

	removeTemplateClass(where) {
		return this.DBCon('tbl_report_module').where(where).del()
	}

	

}
