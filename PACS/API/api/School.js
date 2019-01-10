var fileList = require('node-filelist');
var fs = require('fs');
var path = require('path');
let moment = require('moment');
let dataSharePathRoot = "../../assets/uploads";
let formidable = require('formidable');
var rmdir = require('rmdir');
export default class School {

	constructor(data) {
		this.LessionModel = data
		this.UserDatas = []
	}

	async getUserRole() {
		let query = {
			hospital_name: userAuthData.usr_hospital
		}
		let hospital_class = await this.LessionModel.getHospitalClass(query);
		switch (userAuthData.usr_role) {
			case 1024:
				return '/';
				break;
			case 1:
				return userAuthData.usr_hospital;
				break;
			case 10, 1000, 100:
				return hospital_class[0].hospital_class + '/' + userAuthData.usr_hospital;
				break;
			default:
				return {};

		}
	}

	getlessionList(request, response) {
		this.LessionModel.getLessionListInfo().then(data => {
			console.log(data);
			if (data.length < 1) {
				response.json([]);
				return;
			} else {
				response.json(data);
				return;
			}
		});
	}

	getShareList(request, response) {
		var path = "../../assets/uploads";
		if (request.query.hasOwnProperty('dir_name')) {
			var paths = path + '/' + request.query.dir_name;
			fs.mkdir(paths, '0777', (data) => {
				if (data) {
					response.json('error');
				} else {
					fs.readdir(path, function (err, items) {
						response.json(items);
						// response.json('success');
					});
				}
			});
		} else {
			fs.readdir(path, function (err, items) {
				response.json(items);
			});
		}

	}

	uploadFile(request, response) {
		console.log(request.files);
		if (!request.files) {
			return response.send({
				data: [],
				message: 'No files were uploaded.!',
				response_code: 0
			}).status(400);
		}
		let sampleFile = request.files.file;
		var path = dataSharePathRoot + '/' + request.body.data_path + '/' + sampleFile.name;

		sampleFile.mv(path, function (err) {
			if (err) {
				return response.send({
					data: err,
					message: 'files can not uploaded.!',
					response_code: 0
				}).status(400);
			}
			return response.send({
				data: [],
				message: 'File uploaded!',
				response_code: 1
			});
		});

	}

	getShareListContent(request, response) {
		var files = ["../../assets/uploads"];
		if (request.query.hasOwnProperty('dir_name')) {
			files = files + '/' + request.query.dir_name;
		}
		var option = {
			"ext": "",
			"isStats": true
		};
		var sendData = [];
		fileList.read(files, option, function (results) {
			for (var i = 0; i < results.length; i++) {
				sendData[i] = {
					"title": path.basename(results[i].path),
					"uploadTime": results[i].stats.ctime
				};
			}
			response.json(sendData);
		});
	}

	async getPostList(request, response) {
		let postDatas = await this.LessionModel.getPostInfo();
		if (!postDatas.length) {
			return response.send('there is no post data');
		}
		let send_data = [];
		for (var key in postDatas) {
			let post_id = postDatas[key].post_id;
			let query = {
				cmt_pst_id: post_id
			}
			let comments = await this.LessionModel.getCommmentInfo(query);
			send_data[key] = {
				"author": postDatas[key].usr_name,
				"post_id": post_id,
				"author_id": postDatas[key].usr_id,
				"title": postDatas[key].pst_title,
				"createdate": postDatas[key].pst_time,
				"content": postDatas[key].pst_content,
				"number": comments.length,
				"comment": comments
			}
		}
		return response.send(send_data);
	}

	savePost(request, response) {
		if (request.query.hasOwnProperty('pst_title') && request.query.hasOwnProperty('pst_content')) {
			let save_data = {
				pst_title: request.query.pst_title,
				pst_content: request.query.pst_content,
				pst_doctor: userAuthData.id,
				pst_name: userAuthData.usr_name,
				pst_time: moment().format('YYYY-MM-DD h:mm:ss')
			}
			if (request.query.hasOwnProperty('post_id')) {
				this.LessionModel.savePostInfo(save_data, request.query.post_id).then(data => {
						return response.send({
							data: null,
							message: 'successfully!',
							response_code: 1
						});
					})
					.catch(e => {
						return response.send({
							data: null,
							message: 'could not save Post data!',
							response_code: 0
						});
					});
			} else {
				this.LessionModel.savePostInfo(save_data).then(data => {
						return response.send({
							data: null,
							message: 'successfully!',
							response_code: 1
						});
					})
					.catch(e => {
						return response.send({
							data: null,
							message: 'could not save Post data!',
							response_code: 0
						});
					});
			}
		} else {
			return response.send({
				data: null,
				message: 'Please Insert correctly data',
				response_code: 0
			});
		}

	}

	saveComment(request, response) {

		if (request.query.hasOwnProperty('cmt_content') && request.query.hasOwnProperty('cmt_pst_id')) {
			let save_data = {
				cmt_content: request.query.cmt_content,
				cmt_pst_id: request.query.cmt_pst_id,
				cmt_doctor: userAuthData.id,
				cmt_time: moment().format('YYYY-MM-DD h:mm:ss')
			}
			if (request.query.hasOwnProperty('comment_id')) {
				this.LessionModel.saveCommentInfo(save_data, request.query.comment_id).then(data => {
						return response.send({
							data: null,
							message: 'successfully',
							response_code: 1
						});
					})
					.catch(e => {
						return response.send({
							data: null,
							message: 'could not save Post data!',
							response_code: 0
						});
					});
			} else {
				this.LessionModel.saveCommentInfo(save_data).then(data => {
						return response.send({
							status: 'error',
							message: 'could not save Post data!',
							response_code: 0
						});
					})
					.catch(e => {
						return response.send({
							data: null,
							message: 'could not save Post data!',
							response_code: 0
						});
					});
			}
		} else {
			return response.send({
				data: null,
				message: 'please insert full parameter',
				response_code: 0
			});
		}

	}

	async deleteComment(request, response) {
		let query = {
			comment_id: request.query.comment_id
		}
		let postData = await this.LessionModel.getCommmentInfo(query);
		console.log(postData[0].cmt_doctor, userAuthData.id);

		if (postData[0].cmt_doctor == userAuthData.id) {
			console.log(query);
			this.LessionModel.deleteCommentInfo(query).then(data => {
				if (data) {
					return response.send({
						data: null,
						message: 'could not save Post data!',
						response_code: 0
					});
				} else {
					return response.send({
						status: 'error',
						message: 'could not delete Comment Data!',
						response_code: 0
					});
				}
			});
		} else {

			return response.send({
				status: 'error',
				message: 'could not delete Comment Data!',
				response_code: 0
			});

		}

	}

	async deletePost(request, response) {
		let query = {
			post_id: request.query.post_id
		}
		let postData = await this.LessionModel.getPostInfo(query);
		if (postData[0].pst_doctor == userAuthData.id) {
			this.LessionModel.deletePostInfo(query).then(data => {
				if (data) {
					return response.send({
						data: null,
						message: 'successfully',
						response_code: 1
					});
				} else {
					return response.send({
						status: 'error',
						message: 'could not delete Post data!',
						response_code: 0
					});
				}

			});
		} else {
			return response.send({
				status: 'error',
				message: 'could not delete Post data!',
				response_code: 0
			});
		}
	}

	async getDataRootDir(request, response) {
		var hospital_name;
		let query = {
			hospital_name: userAuthData.usr_hospital
		}
		let hospital_class = await this.LessionModel.getHospitalClass(query);
		console.log(hospital_class);

		switch (userAuthData.usr_role) {
			case 1024:
				hospital_name = '';
				break;
			case 1:
				hospital_name = userAuthData.usr_hospital;
				break;
			case 10:
			case 100:
			case 1000:
				hospital_name = hospital_class[0].hospital_class + '/' + userAuthData.usr_hospital;
				break;
			default:
				break;

		}
		var paths = dataSharePathRoot + '/' + hospital_name;
		fs.exists(paths, (exists) => {
			if (exists) {
				return response.send({
					hospital_folder: hospital_name
				});
			} else {
				fs.mkdir(paths, '0777', (data) => {
					console.log('making');
					return response.send({
						hospital_folder: hospital_name
					});
				});
			}
		});


	}

	getDataDir(request, response) {
		var paths = dataSharePathRoot;
		if (request.query.hasOwnProperty('folder_path')) {
			paths += '/' + request.query.folder_path
		}
		try {
			fs.readdir(paths, function (err, items) {
				let send_data = [];
				for (const key in items) {
					var tmpPath = paths + '/' + items[key];
					var createTime1 = fs.statSync(tmpPath).birthtime;
					var createTime = new Date(createTime1).toISOString().slice(0,10);
					send_data[key] = {
						"name": items[key],
						isFolder:fs.statSync(tmpPath).isDirectory(),
						birthTime:createTime
					};
				}
				return response.send({
					data: send_data,
					message: 'this is folder tree',
					response_code: 1
				});
			});
		} catch (error) {
			return response.send({
				data: error,
				message: 'could not delete Post data!',
				response_code: 0
			});
		}

	}

	createDirectory(request, response) {
		var paths = dataSharePathRoot + '/' + request.query.folder_path + '/' + request.query.folder_name;;
		fs.mkdir(paths, '0777', (data) => {
			if (data) {
				return response.send({
					data: data,
					message: 'could not create this folder!',
					response_code: 0
				});
			} else {
				fs.readdir(paths, function (err, items) {
					return response.send({
						data: items,
						message: 'successfully create',
						response_code: 1
					});
				});
			}
		});


	}

	removeDirectory(request, response) {
		var paths = dataSharePathRoot + '/' + request.query.folder_path_name;
		console.log(paths);
		fs.unlink(paths, (err) => {
			if (err) {
				rmdir(paths, function (err, dirs, files) {
					if(err){
						return response.send({
							data: err,
							message: 'failed!',
							response_code: 0
						});
					}
					return response.send({
						data: dirs,
						message: 'deleted!',
						response_code: 1
					});
				});				
			} else {
				return response.send({
					data: paths,
					message: 'deleted!',
					response_code: 1
				});
			}
		});
	}

	rename(request, response) {
		var oldPath = dataSharePathRoot + '/' + request.query.data_path + '/' + request.query.preve_name;
		var newPath = dataSharePathRoot + '/' + request.query.data_path + '/' + request.query.change_name;

		fs.rename(oldPath, newPath, (err) => {
			if (err) {
				return response.send({
					message: 'Rename is failed',
					response_code: 0,
					data: err
				});

			} else {
				return response.send({
					message: 'Rename is okay',
					response_code: 1
				});

			}

		});

	}


	downloadFile(request, response){
		var downloadPath = dataSharePathRoot + '/' + request.query.data_path;
		console.log(path.resolve(downloadPath));
		fs.exists(downloadPath, (exists) => {
			if(exists){
				response.download(path.resolve(downloadPath));
			} else {
				return response.send({
					message: 'Download is failed',
					response_code: 0,
					data: []
				});
			}
		});
			
	}

}
