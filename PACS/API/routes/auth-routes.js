let express = require('express');
let app = module.exports = express.Router();
let knex = require('knex')(require('../config/config').dbconfig);
import Auth from '../api/Auth';
import AuthModel from '../model/AuthModel';
let auth_model = new AuthModel(knex);
let auths = new Auth(auth_model);

app.get('/register', function(req, res) {
	req.check('phoneNum', 'phoneNum is required').notEmpty();
	req.check('password', 'password is required').notEmpty();
	req.check('smsCode', 'smsCode is required').notEmpty();
	req.check('patName', 'patName is required').notEmpty();
	req.check('patIDNum', 'patIDNum is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		return res.send({
			meassage:'submit error',
			data: errors,
			response_code:0
		});
	} else {
		auths.registerUser(req, res);
	}
});

app.get('/login', function(req, res) {
	req.check('username', 'username is required').notEmpty();
	req.check('password', 'password is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		return res.send({
			meassage:'submit error',
			data: errors,
			response_code:0
		});
	} else {
		auths.checkUser(req, res);
	}
});

app.get('/checkduplication', function(req, res){
	req.check('phonenum', 'phonenum is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		return res.send({
			meassage:'submit error',
			data: errors,
			response_code:0
		});
	} else {
		auths.duplicationCheck(req, res);
	}
});

app.get('/forget', function(req, res){
	auths.forgetPassword(req, res)
});

app.get('/sendSMS', function (req, res) {
	req.check('phonenum', 'phonenum is required').notEmpty();
	var errors = req.validationErrors();
	if (errors) {
		return res.send({
			meassage:'submit error',
			data: errors,
			response_code:0
		});
	} else {
		auths.send_sms(req,res);
	}
});

app.get('/getRole', function(req, res){

	auths.getUserRole();
});
