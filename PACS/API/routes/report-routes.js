let express = require('express'),
	jwt = require('express-jwt');
let app = module.exports = express.Router();
let config = require('../config/config');
let knex = require('knex')(require('../config/config').dbconfig);
import Reporting from '../api/Report';
import ReportModel from '../model/ReportModel';
let model = new ReportModel(knex);
let reportings = new Reporting(model);
let jwtCheck = jwt({
	secret: config.secret
});

// app.use('/', jwtCheck);

app.get('/checkauth', function (req, res) {
	res.json({
		msg: 'ok'
	});
});
app.get('/reportlist', function (req, res) {
	reportings.reportList(req, res, userAuthData);
});

app.get('/reportdetail', function (req, res) {
	reportings.reportDeatial(req, res);
});

app.get('/reportingview', function (req, res) {
	reportings.reportingView(req, res);
});

app.get('/reporting', function (req, res) {
	reportings.reporting(req, res);
});

app.get('/myreportlist', function (req, res) {
	reportings.myReportList(req, res);
});

app.get('/deliberationDetial', function (req, res) {
	reportings.deliberationDetial(req, res);
});

app.get('/deliberationlist', function (req, res) {
	reportings.deliberationList(req, res);
});

app.get('/deliberation', function (req, res) {
	reportings.deliberation(req, res);
});

app.get('/test', function (req, res) {
	reportings.test(req, res);
});

app.get('/dicomimg_list', function (req, res) {
	reportings.dicomimg_list(req, res);
});


app.get('/urltemplate', function (req, res) {
	reportings.getTemplate(req, res);
});

app.get('/urltemplateDevice', function (req, res) {
	reportings.getTemplateDeviceAndClass(req, res);
});

app.get('/urltemplateContent', function (req, res) {
	reportings.getTemplateContent(req, res);
});

app.get('/urltemplateSubClass', function (req, res) {
	reportings.getModuleClass(req, res);
});

app.get('/urltemplateContentEdit', function (req, res) {

	req.check('template_title', 'template_title is required').notEmpty();
	req.check('template_device', 'template_device is required').notEmpty();
	req.check('template_subclass_id', 'template_subclass_id is required').notEmpty();
	req.check('template_content_image', 'template_content_image is required').notEmpty();
	req.check('template_content_suggestion', 'template_content_suggestion is required').notEmpty();
	req.check('template_content_checkup', 'template_content_checkup is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			data: errors
		});
	} else {
		reportings.saveTemplate(req, res);
	}
	
});


app.get('/urltemplateSubClassEdit', function (req, res) {

	req.check('template_device', 'template_device is required').notEmpty();
	req.check('template_class_id', 'template_class_id is required').notEmpty();
	req.check('template_subclass_name', 'template_subclass_name is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({data: errors});
	} else {
		reportings.saveTemplateClass(req, res);
	}
	
});

app.get('/urltemplateSubClassRemove', function (req, res) {

	req.check('template_subclass_id', 'subclass id is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({data: errors});
	} else {
		reportings.removeTemplateClass(req, res);
	}
	
});


app.get('/urltemplateContentRemove', function (req, res) {

	req.check('template_content_id', 'template id is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({data: errors});
	} else {
		reportings.removeTemplate(req, res);
	}
	
});
