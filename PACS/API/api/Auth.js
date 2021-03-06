let jwt = require('jsonwebtoken');
let _ = require('lodash');
let md5 = require('js-md5');
let config = require('../config/config');
let got = require('got');
const axios = require('axios');
const SMSClient = require('@alicloud/sms-sdk');
const accessKeyId = config.accessKeyId;
const secretAccessKey = config.secretAccessKey;
let smsClient = new SMSClient({
	accessKeyId,
	secretAccessKey
});

export default class Auth {
	constructor(data) {
		this.AuthModel = data
		this.UserDatas = []
	}
	createToken(user) {
		return jwt.sign(_.omit(user, 'password'), config.secret, {
			expiresIn: 60 * 60 * 2
		});
	}

	async checkUser(req, res) {
		let AuthSelf = this;
		let userData = {
			usr_id: req.query.username,
			usr_passwd: md5(req.query.password)
		};
		if (!userData.usr_id || !req.query.password) {
			return res.status(400).send("You must send the username and the password");
		}
		this.AuthModel.getDoctorInfo(userData).then((params) => {
			if (params.length < 1) {
				let query = {
					pat_id: req.query.username,
					pat_passwd: md5(req.query.password)
				}
				AuthSelf.AuthModel.GetPatientInfo(query)
					.then(param => {
						if (param.length < 1) {
							return res.status(201).send({
								message: "The username or password don't match"
							});
						} else {
							query.pat_name = param[0].pat_name;
							query.pat_IdNum = param[0].pat_IdNum;
							query.pat_status = param[0].pat_status;
							query.usr_is_doctor = false;
							query.id_token = AuthSelf.createToken(query)
							res.status(201).json(query);
						}

					});

			} else if (params[0].usr_status != 1) {
				return res.status(201).json({
					message: "该账号已注销了"
				});
			} else if (!params[0].usr_status && params[0].pat_status != 1) {
				return res.status(201).json({
					message: "该账号已注销了"
				});
			} else {
				if (params[0].usr_id) {
					userData.usr_role = params[0].usr_role;
					userData.usr_is_doctor = true;
					userData.usr_name = params[0].usr_name;
					userData.id = params[0].id;
					userData.usr_hospital = params[0].usr_hospital;
					userData.usr_phone_num = params[0].usr_phone_num;
					async function getRoleUserData() {
						userData.doctor_role = await AuthSelf.AuthModel.getUserRole({
							rle_doctor_id: params[0].id
						});
						userData.id_token = AuthSelf.createToken(userData);
						res.status(201).json(userData);
					}
					getRoleUserData();
				}
			}
		});
	}

	async getUserRole(query) {
		const data = await this.AuthModel.getUserRole(query);
		return data;
	}

	async registerUser(req, res) {
		let AuthSelf = this;
		if (req.query.password != req.query.rpassword) {

			return res.send({
				meassage: 'No Match Password!',
				data: [],
				response_code: 0
			});
		}
		let registerData = {
			pat_id: req.query.phoneNum,
			pat_phone_num: req.query.phoneNum,
			pat_passwd: md5(req.query.password),
			pat_name: req.query.patName,
			pat_IdNum: req.query.patIDNum,
			pat_status: 1,
			pat_create_time: (new Date()).toISOString().replace(/T/, ' ').replace(/\..+/, '')
		};
		let checkPhone = {
			phonenum: req.query.phoneNum,
			verify_code: req.query.smsCode
		};
		console.log(checkPhone);
		let resultCheck = await this.AuthModel.checkPhoneNumber(checkPhone);
		if (!resultCheck.length) {
			return res.send('Please insert correctly verify code!');
		}
		if (!registerData.pat_id || !req.query.password) {
			return res.status(400).send("You must send the username and the password");
		}
		AuthSelf.AuthModel.registerPatient(registerData).then(function (id) {
			let token = AuthSelf.createToken(registerData)
			res.status(201).send({
				id_token: token
			});
		}).catch(function (e) {
			console.error(e);
		});
	}

	duplicationCheck(req, res) {
		let AuthSelf = this
		if (req.query.phonenum == '') {
			res.status(201).send({
				status: true
			});
		}
		let checkData = {
			pat_id: req.query.phonenum
		}
		AuthSelf.AuthModel.CheckDuplicationId(checkData).then(function (params) {
			if (params.length != 0) {
				return res.status(201).send({
					status: false
				})
			} else {
				res.status(201).send({
					status: true
				});
			}

		})
	}

	async forgetPassword(req, res) {
		let AuthSelf = this;
		if (!req.query.hasOwnProperty('pat_id') || !req.query.hasOwnProperty('password') || !req.query.hasOwnProperty('smsCode')) {
			return res.status(201).json('Please insert full field!');
		}
		let checkPhone = {
			phonenum: req.query.pat_id,
			verify_code: req.query.smsCode
		};
		let resultCheck = await this.AuthModel.checkPhoneNumber(checkPhone);
		if (!resultCheck.length) {
			return response.send('Please insert correctly verify code!');
		}
		let query = {
			pat_id: req.query.pat_id
		}
		let update = {
			pat_passwd: md5(req.query.password)
		}
		AuthSelf.AuthModel.changePass(query, update)
			.then(function (params) {
				if (params == 1) {
					res.status(201).json({
						status: true
					});
				} else {
					res.status(201).json({
						status: false
					});
				}
			})
			.catch((err) => {

			})
	}

	SendSMS(request, response) {
		let AuthSelf = this;
		let phonenum = 15698113717;
		if (request.query.hasOwnProperty('phonenum')) {
			phonenum = request.query.phonenum;
		}
		let url = config.smsUri;
		let smsContent = config.sms_content;
		let verify_code;
		smsContent += verify_code = this.getRandomNumber(100000, 999999);
		url += '&m=' + phonenum + '&c=' + smsContent;
		axios.get(encodeURI(url)).then(result => {
			if (parseInt(result.data) == 0) {
				let saveData = {
					phonenum: phonenum,
					verify_code: verify_code
				};
				let query = {
					phonenum: phonenum
				};
				console.log(saveData);
				AuthSelf.AuthModel.checkPhoneNumber(query).then(res => {
					console.log(res);
					AuthSelf.AuthModel.updatePhoneVerify(saveData, res.length).then(resdata => {
						return response.json({
							data: result.data
						});
					}).catch(err => {
						return response.json({
							data: 'error'
						});
					});
				}).catch(err => {
					return response.json({
						data: 'error'
					});
				});
			}
		}).catch(error => {  
			return response.json({
				data: 'error'
			});
		});
	}

	getRandomNumber(min, max) {
		return Math.round(Math.random() * (max - min) + min);
	}

	send_sms(request, response) {
		let AuthSelf = this;
		var phonenum = request.query.phonenum;
		var verify_code = this.getRandomNumber(100000, 999999);
		smsClient.sendSMS({
			PhoneNumbers: phonenum,
			SignName: '杭州健培',
			TemplateCode: 'SMS_126565268',
			TemplateParam: JSON.stringify({code: verify_code})
		}).then(function (res) {
			let {Code} = res
			if (Code === 'OK') {
				let saveData = {
					phonenum: phonenum,
					verify_code: verify_code
				};
				let query = {
					phonenum: phonenum
				};
				console.log(res);
				AuthSelf.AuthModel.checkPhoneNumber(query).then(res1 => {
					AuthSelf.AuthModel.updatePhoneVerify(saveData, res1.length).then(result => {
						return response.send({
							meassage:'短信验证码送发了',
							data: [],
							response_code:1
						});
					}).catch(err => {
						return response.send({
							meassage:'送发失败了',
							data: err,
							response_code:0
						});						
					});
				}).catch(err => {
					return response.send({
						meassage:'送发失败了',
						data: err,
						response_code:0
					});		
					
				});
				//处理返回参数
			}
		}, function (err) {
			return response.send({
				meassage:'送发失败了',
				data: err,
				response_code:0
			});		
		});
	}

}
