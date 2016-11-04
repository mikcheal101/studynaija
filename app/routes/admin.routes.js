// import the admin model
module.exports = function (app) {
	const db 		= app.db;
	const bcrypt	= app.bcrypt;

	app.get ('/api/admin/loadApplicants', (request, response) => {
		var sql = `
			SELECT 
				a.id AS __id, a.firstname, a.middlename, a.lastname, a.years_of_expirence, a.extra_notes, a.user_data, a.gender, a.highest_qualification, 
				a.payment_options, a.country_of_study, a.english_level, a.start_semester, a.nationality, a.dob, a.tel, a.country_of_residence,
				a.address, a.id, u.username AS _username, u.profile_image, u.email, g.name AS _gender, po.name AS _payment_options, eng.name AS _english, q.name AS _qualification, 
				cos.name AS _cos, cor.name AS _cor, n.name AS _n, sem.name AS _sem
			FROM
				applicant As a 
				join users AS u on u.id = a.user_data
				left outer join static_gender AS g on g.id = a.gender
				left outer join static_payment_options AS po on po.id = a.payment_options 
				left outer join static_english_level AS eng on eng.id = a.english_level
				left outer join static_highest_qualification AS q on q.id = a.highest_qualification
				left outer join static_country AS cos on cos.id = a.country_of_study
				left outer join static_country AS cor on cor.id = a.country_of_residence
				left outer join static_country AS n on n.id = a.nationality
				left outer join static_semesters AS sem on sem.id = a.start_semester
			ORDER BY 
				a.firstname DESC
		`;
		db.task (t => {
			return t.map (sql, [], applicant => {
				applicant.documents = [];
				return t.any (`
					SELECT 
						d.id AS __id, d.applicant, d.url, d.document_type, t.name
					FROM 
						documents d
						LEFT OUTER JOIN document_types t ON t.id = d.document_type
					WHERE
						d.applicant=$1
					ORDER BY
						d.document_type DESC`, [applicant.__id])
				.then (y => {
					applicant.documents = y;
					return applicant;
				}, n => {
					applicant.documents = [];
					return applicant;
				});
			}).then (t.batch)
		})
		.then (
			applicants => {
				response.json ({ applicants: applicants });
			}, err => {
				response.json ({ applicants : [] });
			}
		);
	});

	app.get ('/api/admin/webAdmins', (request, response) => {
		db.any (`SELECT * FROM users WHERE usertype = $1`, [2])
		.then (
			data => {
				response.json ({
					data:data
				});
			}, err => {
				response.json ({
					data:[]
				});
			}
		);
	});

	app.get ('/api/admin/schoolAdmins', (request, response) => {
		db.any (`
			SELECT 
				u.id as __id, u.username, u.password, u.profile_image, u.usertype, u.status, u.email, 
				s.name, s.year_of_est, s.url, s.logo, s.state, s.email as school_email, s.address, s.cover_photo, 
				s.history, s.type, s.id as school, s.tel, s.mail, i.name as institutiontype
			FROM 
				users AS u, school s, schooltousers us, institution_types i
			WHERE
				(u.usertype = 3 OR u.usertype = 5) AND u.id = us.user AND s.id = us.school AND i.id = s.type 
			ORDER BY 
				u.username DESC
		`)
		.then (
			school_admins => {
				
				response.json ({
					admins: school_admins
				});
			}, err => {
				response.json ({
					admins: err
				});
			}
		);
	});

	app.get ('/api/admin/document_types', (request, response) => {
		db.any (`SELECT * FROM document_types ORDER BY name DESC`)
		.then (
			y=> {
				response.json ({
					data:y
				});
			}, err=> {
				response.json ({
					data:[]
				});
			}
		);
	});

	
	/* data posting */

	app.post ('/api/admin/updateAdminProfile', app.admin_upload, (request, response, next) => {
		
		var admin = request.body;

		if (admin.username && admin.password && admin.email) {

			admin.profile_image =  (request.file) ? request.file.filename : admin.profile_image || '';
			if (admin.pwd)
				admin.password 		= (bcrypt.compareSync (admin.pwd, admin.password)) ? admin.password:bcrypt.hashSync (admin.pwd);

			db.any ('UPDATE users SET username = $1, password = $2, profile_image=$3, email=$4 WHERE id = $5', [
				admin.username, admin.password, admin.profile_image, admin.email, request.session.user.user.id])
				.then (
					updated => {
						request.session.user.user.username = admin.username;
						request.session.user.user.password = admin.password;
						request.session.user.user.profile_image = admin.profile_image;
						request.session.user.user.email = admin.email;
						
						response.json ({
							done:true
						});
					}, err => {
						response.json ({
							done:false
						});
					}
				);	
		} else {
			response.json ({
				done:false
			});
		}	
	});

	app.post ('/api/admin/createDocumentType', (request, response) => {
		var d = request.body;
		if (d.name) {
			db.one (`INSERT INTO document_types (name) VALUES ($1)`, [d.name])
			.then (y => {
				response.json ({
					done:true,
					id:y.id
				});
			}, n => {
				response.json ({
					done:false,
					id:0
				});
			});
		} else {
			response.json ({
				done:false,
				id:0
			});
		}
	});

	app.post ('/api/admin/dropDocumentType', (request, response) => {
		var x = request.body;
		if (x.id) {
			db.none (`DELETE FROM document_types WHERE id=$2`, [x.id])
			.then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/updateDocumentType', (request, response) => {
		var x = request.body;
		if (x.name && x.id) {
			db.none (`UPDATE document_types SET name=$1 WHERE id=$2`, [x.name, x.id])
			.then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/createWebAdmin', app.admin_upload, (request, response, next) => {
		var admin = request.body;
		
		if (admin.username && admin.password && admin.status && admin.usertype && admin.email) {
			
			admin.profile_image = request.file ? request.file.filename : admin.profile_image || '';

			db.one (`INSERT INTO users (username, password, profile_image, status, usertype, email) VALUES ($1, $2, $3, $4, $5, $6) RETURNING id`, [
				admin.username, bcrypt.hashSync (admin.password), admin.profile_image, admin.status, admin.usertype, admin.email]
				)
				.then (
					done => {
						response.json ({
							done : true,
							id:done.id,
							image: admin.profile_image
						});
					}, err => {
						response.json ({
							done:false,
							id:0,
							image: null
						});
					}
				);
		} else {
			
			response.json ({
				done:false,
				id:0,
				image:null
			});
		}
	});

	app.post ('/api/admin/createSchoolAdmin', app.school_admin_upload, (request, response) => {

		var admin = request.body;
		
		if (admin.username && admin.password && admin.status && admin.usertype && admin.email && admin.school) {

			admin.profile_image = request.file ? request.file.filename : admin.profile_image || '';

			db.task (t => {
				return t.one (`INSERT INTO users (username, password, profile_image, status, usertype, email) VALUES ($1, $2, $3, $4, $5, $6) RETURNING id`, [
					admin.username, bcrypt.hashSync (admin.password), admin.profile_image, admin.status, admin.usertype, admin.email])
					.then (user =>  {
						console.log ('here: ', user, admin.school, user.id);
						return t.any (`INSERT INTO schooltousers (school, "user") VALUES ($1,$2)`, [admin.school, user.id]);
					}, error => {
						console.log ('error', error);
						return error;
					})
			})
			.then (
				done => {
					console.log ('done: ', done);
					response.json ({
						done : true,
						id: done.id
					});
				}, err => {
					console.log ('err: ', err);
					response.json ({
						done:false,
						id:0
					});
				}
			);
		} else {
			console.log (admin);
			response.status (404).json ({
				done:false,
				id:0
			});
		}
		
	});

	app.post ('/api/admin/createScholarship', app.scholarship_upload, (request, response) => {
		var s = request.body;
		
		if (s.name && s.details && s.poster) {
			
			s.image = request.file ? request.file.filename : s.image || '';

			db.one ('INSERT INTO scholarships (name, details, image, poster, ts) VALUES ($1,$2,$3,$4,CURRENT_TIMESTAMP) RETURNING id, image', [s.name, s.details, s.image, s.poster])
			.then (saved => {
				response.json ({
					done : true,
					data:saved
				});
			}, err => {
				console.log (err);
				response.json ({
					done: false,
					data:[]
				});
			});
		} else {
			response.status (404).json ({
				done: false,
				data:[]
			});
		}
	});

	app.post ('/api/admin/asignCourseInstitution', (request, response) => {
		var x = request.body;
		if (x.discipline && x.school && x.description && x.local && x.intl && x.content) {
			db.any ('INSERT INTO schooltodisciplines (discipline, school, faculty, description, local, intl, content) VALUES ($1,$2,$3,$4,$5,$6,$7) RETURNING id', [
				x.disciplines, x.school, x.description, x.local, x.intl, x.content])
			.then (done=> {
				response.status (404).json ({
					done: true,
					data:done
				});
			}, err=>{
				response.status (404).json ({
					done: false,
					data:[]
				});
			});
		} else {
			response.status (404).json ({
				done: false,
				data:[]
			});
		}
	});

	app.post ('/api/admin/createNews', app.news_upload, (request, response) => {
		var n = request.body;
	
		var resources = [];
		if (request.files && request.files.length > 0) {
			request.files.forEach (function (item) {
				resources.push (item);
			});
		}

		if (n.subject && n.details && n.poster) {
			db.task (t=> {
				return t.one (`INSERT INTO news (subject, details, poster, date) VALUES ($1,$2,$3,CURRENT_DATE) RETURNING id`, [n.subject, n.details, n.poster])
				.then (news => {
					return t.batch (resources.map (function (r) {
						return t.any ('INSERT INTO news_resources (resource, news, ts) VALUES ($1,$2,CURRENT_TIMESTAMP) RETURNING id, resource, news', 
							[r.originalname, news.id])
						.then (
							y => {
								return y;
							}, no => {
								return no;
							}
						);
					}));
				});
			})
			.then (
				done => {
					var news = {
						id : 0,
						resources : []
					};
					
					done.forEach (function (n) {
						news.id = n[0].news;
						news.resources.push (n);
					});

					response.json ({
						done : true,
						news:news
					});
				}, err => {
					response.json ({
						done : false,
						news:[]
					});
				}
			);

		} else {
			response.status (404).json ({
				done: false,
				news:[]
			});
		}
	});

	app.post ('/api/admin/createFaculty', (request, response) => {
		var f = request.body;
		if (f.name) {
			db.one ('INSERT INTO static_faculty (name) VALUES ($1) RETURNING id', [f.name])
			.then (
				done => {
					response.json ({
						done: true,
						id:done.id
					});
				}, err => {
					response.json ({
						done: false,
						id:0
					});
				}
			);
		}
	});

	app.post ('/api/admin/createInstitutionType', (request, response) => {
		var i = request.body;
		if (i.name) {
			db.one ('INSERT INTO institution_types (name) VALUES ($1) RETURNING id', [i.name])
			.then (
				x=>{
					console.log (x);
					response.json ({
						done:true,
						id:x.id,
					});
				}, err => {
					console.log (err);
					response.json ({
						done:false,
						id:0
					});
				}
			);
		} else {
			response.json ({
				done:false,
				id:0
			});
		}
	});

	app.post ('/api/admin/createInstitution', app.school_upload, (request, response) => {
		var inst = request.body;
		
		if (request.files['_logo']) 
			inst.logo 			= inst.logo ? inst.logo : request.files['_logo'][0] || '';
		else 
			inst.logo 			= inst.logo ? inst.logo : '';
		
		if (request.files['_cover_photo']) 
			inst.cover_photo	= inst.cover_photo ? inst.cover_photo : request.files['_cover_photo'][0] || '';
		else 
			inst.cover_photo	= inst.cover_photo ? inst.cover_photo : '';

		if (inst.year_of_est === 'null') 
			inst.year_of_est = null;
		
		console.log (inst);

		if (inst.name && inst.state && inst.type) {
			db.one (`INSERT INTO school (name, year_of_est, url, logo, state, email, address, cover_photo, history, type, tel, mail) VALUES 
				($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12) RETURNING id, logo`, [inst.name, inst.year_of_est, inst.url, inst.logo, inst.state, inst.email, inst.address, inst.cover_photo, 
				inst.history, inst.type, inst.tel, inst.mail])
			.then (
				d => {
					response.json ({
						done: true,
						id: d.id,
						logo:d.logo
					});
				}, err => {
					console.log (err);
					response.json ({
						done: false,
						id: 0,
						logo:''
					});
				}
			);
		} else {
			response.json ({
				done: false,
				id: 0,
				logo:''
			});
		}
	
	});

	/**
	 * the updating part of the admin panel
	 */
	
	app.post ('/api/admin/editWebAdmin', app.admin_upload, (request, response) => {
		var admin = request.body;
		
		//console.log (request.file);

		if (admin.username && admin.password && admin.email && admin.id) {
			
			admin.profile_image = request.file ? request.file.filename : admin.profile_image || '';
			admin.password 		= admin.pwd ? bcrypt.hashSync (admin.pwd) : admin.password;

			db.none (`UPDATE users SET username=$1, password=$2, profile_image=$3, status=$4, usertype=$5, email=$6 WHERE id=$7`, [
				admin.username, admin.password, admin.profile_image, admin.status, admin.usertype, admin.email, admin.id]
				)
				.then (
					done => {
						response.json ({
							done : true,
							password: admin.password,
							profile_image: admin.profile_image
						});
					}, err => {
						response.json ({
							done:false,
							password: admin.password,
							profile_image: admin.profile_image
						});
					}
				);
		} else {
			response.status (404).json ({
				done:false,
				password: '',
				profile_image: ''
			});
		}
	});

	app.post ('/api/admin/editSchoolAdmin', app.school_admin_upload, (request, response) => {
		var admin = request.body;

		if (admin.username && admin.password && admin.status && admin.usertype && admin.email && admin.id && admin.school) {

			admin.profile_image = request.file ? request.file.filename : admin.profile_image || '';
			admin.password 		= (bcrypt.compareSync (admin.pwd, admin.password)) ? admin.password : bcrypt.hashSync (admin.pwd);

			db.one (`UPDATE users SET username=$1, password=$2, profile_image=$3, status=$4, usertype=$5, email=$6 WHERE id=$7 returning profile_image`, [
				admin.username, bcrypt.hashSync (admin.password), admin.profile_image, admin.status, admin.usertype, admin.email, admin.id]
			).then (
				done => {
					response.json ({
						done : true,
						image:done.profile_image
					});
				}, err => {
					response.json ({
						done:false,
						image:null
					});
				}
			);
		} else {
			console.log ('something missing');
			response.status (404).json ({
				done:false,
				image:null
			});
		}
	});

	app.post ('/api/admin/editScholarship', app.scholarship_upload, (request, response) => {
		var s = request.body;
		if (s.name && s.details && s.poster && s.id) {

			s.image = request.file ? request.file.filename : s.image || '';

			db.one ('UPDATE scholarships SET name=$1, details=$2, image=$3, poster=$4 WHERE id=$5 RETURNING image', [s.name, s.details, s.image, s.poster, s.id])
			.then (saved => {
				response.json ({
					done : true,
					image: saved.image,
				});
			}, err => {
				response.json ({
					done: false,
					image:''
				});
			});
		} else {
			response.status (404).json ({
				done: false,
				image:''
			});
		}
	});

	app.post ('/api/admin/editFaculty', (request, response) => {
		var f = request.body;
		if (f.name && f.id) {
			db.one ('UPDATE static_faculty SET name=$1 WHERE id=$2', [f.name, f.id])
			.then (
				done => {
					response.json ({
						done: true
					});
				}, err => {
					response.json ({
						done: false
					});
				}
			);
		}
	});

	app.post ('/api/admin/editInstitutionType', (request, response) => {
		var x = request.body;
		if (x.name && x.id) {
			db.none (`UPDATE institution_types SET name=$1 WHERE id=$2`, [x.name, x.id])
			.then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/editInstitution', app.school_upload, (request, response) => {
		var inst = request.body;

		if (request.files) {
			inst.logo 			= request.files[0] || inst.logo || '';
			inst.cover_photo	= request.files[1] || inst.cover_photo || '';
		} else {
			inst.logo 			= inst.logo || '';
			inst.cover_photo	= inst.cover_photo || '';
		}

		if (inst.name && inst.year_of_est && inst.url && inst.logo && inst.state && inst.email && inst.address && inst.cover_photo && inst.history && inst.type &&
			inst.tel && inst.mail && inst.id) {
			db.one (`UPDATE school SET name=$1, year_of_est=$2, url=$3, logo=$4, state=$4, email=$5, address=$6, cover_photo=$7, history=$8, type=$9, tel=$10, mail=$11 WHERE 
				id=$12`, [inst.name, inst.year_of_est, inst.url, inst.logo, inst.state, inst.email, inst.address, inst.cover_photo, 
				inst.history, inst.type, inst.tel, inst.mail, inst.id])
			.then (
				d => {
					response.json ({
						done: false
					});
				}, err => {
					response.json ({
						done: false
					});
				}
			);
		} else {
			response.json ({
				done: false
			});
		}
	});

	/**
	 * the deleting part
	 */
	
	app.post ('/api/admin/dropWebAdmin', (request, response) => {
		var x = request.body;
		if (x.id) {
			db.none ('DELETE FROM users WHERE id=$1', [x.id])
			.then (
				y => {
					if (x.profile_image) {
						app.fs.stat (('public/uploads/admin/').concat (x.profile_image), (err, stat) => {
							if (!err) {
								fs.unlink (('public/uploads/admin/').concat (x.profile_image));
							}
						})	
					}
					
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/dropSchoolAdmin', (request, response) => {
		var x = request.body;
		if (x.id && x.profile_image) {
			db.none ('DELETE FROM users WHERE id=$1', [x.id])
			.then (
				y => {
					app.fs.stat (('public/uploads/school/admin/').concat (x.profile_image), (err, stat) => {
						if (!err) {
							fs.unlink (('public/uploads/school/admin/').concat (x.profile_image));
						}
					});
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/dropScholarship', (request, response) => {
		var x = request.body;
		if (x.id) {
			db.none ('DELETE FROM scholarships WHERE id=$1', [x.id])
			.then (
				y => {
					if (x.image)
						app.fs.stat (('public/uploads/scholarship/').concat (x.image), (err, stat) => {
							if (!err) {
								fs.unlink (('public/uploads/scholarship/').concat (x.image));
							}
						});
					console.log (y);
					response.json ({
						done:true
					});
				}, n => {
					console.log (n);
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/dropNews', (request, response) => {
		var x = request.body;
		if (x.id && x.resources) {
			db.none ('DELETE FROM news WHERE id=$1', [x.id])
			.then (
				y => {
					x.resources.map (res => {
						app.fs.stat (('public/uploads/news/').concat (res), (err, stat) => {
							if (!err) {
								fs.unlink (('public/uploads/news/').concat (res));
							}
						})	
					});
					
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/dropFaculty', (request, response) => {
		var x = request.body;
		if (x.id) {
			db.none ('DELETE FROM static_faculty WHERE id=$1', [x.id])
			.then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/dropInstitutionType', (request, response) => {
		var x = request.body;
		if (x.id) {
			db.none ('DELETE FROM institution_types WHERE id=$1', [x.id])
			.then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/dropInstitution', (request, response) => {
		var x = request.body;
		if (x.id && x.logo && x.cover_photo) {
			db.none ('DELETE from school WHERE id=$1', [x.id])
			.then (
				y => {

					app.fs.stat (('public/uploads/school/photos/').concat (x.logo), (err, stat) => {
						if (!err) {
							fs.unlink (('public/uploads/school/photos/').concat (x.logo));
						}
					});

					app.fs.stat (('public/uploads/school/photos/').concat (x.cover_photo), (err, stat) => {
						if (!err) {
							fs.unlink (('public/uploads/school/photos/').concat (x.cover_photo));
						}
					});

					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	/**
	 * verification of duplicates
	 */
	
	app.post ('/api/admin/verifyInstitutionName', (request, response) => {
		var x = request.body;
		if (x.name) {
			db.none ('SELECT * FROM school WHERE name=$1', [x.name])
			.then (
				y => {
					if (y.length > 0) {
						response.json ({
							done:true
						});
					} else {
						response.json ({
							done:false
						});
					}
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});

	app.post ('/api/admin/verifyfacultyName', (request, response) => {
		var x = request.body;
		if (x.name) {
			db.none ('SELECT * FROM static_faculty WHERE name=$1', [x.name])
			.then (
				y => {
					if (y.length > 0) {
						response.json ({
							done:true
						});
					} else {
						response.json ({
							done:false
						});
					}
				}, n => {
					response.json ({
						done:false
					});
				}
			);
		} else {
			response.json ({
				done:false
			});
		}
	});	

};