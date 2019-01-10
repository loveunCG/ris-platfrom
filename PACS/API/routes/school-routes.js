let express = require('express'),
	jwt = require('express-jwt');
let app = module.exports = express.Router();
let config = require('../config/config');
let knex = require('knex')(require('../config/config').dbconfig)
import School from '../api/School';
import SchoolModel from '../model/SchoolModel';
let model = new SchoolModel(knex);
let schools = new School(model);
let jwtCheck = jwt({ secret: config.secret});
const fileUpload = require('express-fileupload');
// app.use('/', jwtCheck);
app.use(fileUpload());

app.get('/getBookingDataInfo', function(req, res) {
	bookings.GetPatientBookingInfo(req, res)
});

app.get('/studyList', function(req, res) {
	schools.getlessionList(req, res)
});

app.post('/upload', function(req, res) {
	schools.uploadFile(req, res);
});

app.get('/urlStduyDiscussList', function(req, res) {
	schools.getPostList(req, res);
});

app.get('/savePost', function(req, res) {
	schools.savePost(req, res);
});

app.get('/savecomment', function(req, res) {
	schools.saveComment(req, res);
});

app.get('/urlDeletePost', function(req, res) {
	req.check('post_id', 'post_id is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			data: errors
		});
	} else {
		console.log('here');
		schools.deletePost(req, res);
	}

});


app.get('/urlDeleteComment', function(req, res) {
	req.check('comment_id', 'comment_id is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			data: errors
		});
	} else {
		schools.deleteComment(req, res);
	}

});


app.get('/urlStduyDataShareHospitalList',(req, res)=>{

	schools.getDataRootDir(req, res);

});

app.get('/urlStduyDataShareList',(req, res)=>{
	schools.getDataDir(req, res);

});

app.get('/urlStduyMakeDataShare',(req, res)=>{

	req.check('folder_path', 'folder_path is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			data: errors
		});
	} else {
		schools.createDirectory(req, res);	
	}


});

app.get('/urlStduyRemoveDataShare',(req, res)=>{
	req.check('folder_path_name', 'folder_path_name is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			data: errors
		});
	} else {
		schools.removeDirectory(req, res);	
	}
});

app.get('/urlStduyRenameDataShare',(req, res)=>{

	req.check('data_path', 'data_path is required').notEmpty();
	req.check('change_name', 'change_name is required').notEmpty();
	req.check('preve_name', 'preve_name is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			message:'submit error',
			data: errors,
			response_code:1
		});
	} else {
		schools.rename(req, res);
	}

});

app.get('/urlStduyRenameDataShare',(req, res)=>{

	req.check('data_path', 'data_path is required').notEmpty();
	req.check('change_name', 'change_name is required').notEmpty();
	req.check('preve_name', 'preve_name is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			message:'submit error',
			data: errors,
			response_code:1
		});
	} else {
		schools.rename(req, res);
	}

});

app.post('/StduyDataShareListContent',(req, res)=>{

	req.check('data_path', 'data_path is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			message:'submit error',
			data: errors,
			response_code:1
		});
	} else {
		schools.uploadFile(req, res);
	}
});

app.get('/StduyDataShareDownload',(req, res)=>{

	req.check('data_path', 'data_path is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		res.send({
			message:'submit error',
			data: errors,
			response_code:1
		});
	} else {
		schools.downloadFile(req, res);
	}
});

