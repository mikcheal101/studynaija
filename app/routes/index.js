module.exports = function (app) {
	const db 		= app.db;
	const bcrypt 	= app.bcrypt;


	app.use ((request, response, next) => {
		request.session.user = request.session.user || {authenticated: false, user:{}};
		next ();
	});

	app.get ('/api/session', (request, response, next) => {
		response.json ({
			session : request.session.user
		});
	});

	app.get ('/api/signout', (request, response, next) => {
		request.session.destroy ();
		response.json ({
			done: true
		});
	});

	app.get ('/api/english', (request, response, next) => {
		db.any ('SELECT * FROM static_english_level ORDER BY name DESC')
		.then ((english) => {
			response.status (200).json ({
				english : english
			});
		});
	});

	app.get ('/api/semesters', (request, response, next) => {
		db.any ('SELECT * FROM static_semesters ORDER BY name DESC')
		.then ((semesters) => {
			response.status (200).json ({
				semesters: semesters
			});
		});
	});

	app.get ('/api/funding', (request, response, next) => {
		db.any ('SELECT * FROM static_payment_options ORDER BY name DESC')
		.then ((funding) => {
			response.status (200).json ({
				funding: funding
			});
		});
	});

	app.get ('/api/news',  function (request, response, next) {

		var sql = `
			SELECT 
				n.id, n.subject, n.details, n.poster, n.date, p.username, p.email, p.profile_image
			FROM 
				users AS p, news AS n 
			WHERE 
				n.poster = p.id 
			ORDER BY 
				n.id DESC
		`;

		db.task (t => {
			return t.map (sql, [], news => {
				return t.any ("SELECT * FROM news_resources WHERE news_resources.news = $1", [news.id])
				.then ((news_resources) => {
					news.news_resources = news_resources;
					return news;
				});
			})
			.then (t.batch);
		})
		.then (
			(news) => {
				response.json ({news:news});
			}, (error) => {
				response.json ({news:[]});
			}
		);
	});

	app.post ('/api/excel_to_json', app.tmp_storage, function (request, response, next) {
		var file = request.file ? request.file : null;
		var type = request.body.type ? request.body.type : 0;

		if (file !== null) {
			app.excel ({
				input		: request.file.path,
				output 		: null
			}, (err, records) => {
				if (!err) {
					response.json ({
						data: records
					});
				} else {
					console.log (err);
					response.json ({
						data:[]
					});
				}
			});
		} else {
			response.status (404);
		}

	});

	app.post ('/api/single_news',  function (request, response, next) {
		var id  = request.body.id || 0;
		if (id !== 0) {
			var sql = `
				SELECT 
					n.id, n.subject, n.details, n.poster, n.date, p.username, p.email, p.profile_image
				FROM 
					users AS p, news AS n 
				WHERE 
					n.poster = p.id AND n.id = $1
				ORDER BY 
					n.date DESC
				LIMIT 1
			`;

			db.task (t => {
				return t.map (sql, [id], news => {
					return t.any ("SELECT * FROM news_resources WHERE news_resources.news = $1", [news.id])
					.then ((news_resources) => {
						news.news_resources = news_resources;
						return news;
					});
				})
				.then (t.batch);
			})
			.then (
				(news) => {
					response.json ({news:news});
				}, (error) => {
					response.json ({news:[]});
				}
			);	
		}
	});

	app.get ('/api/states', (request, response, next) => {
		db.any (`
			SELECT 
				s.id, s.name, s.slogan, s.emblem, s.description, (SELECT COUNT(*) FROM school sch WHERE sch.state = s.id) AS schools 
			FROM 
				static_states s
			ORDER BY 
				s.name ASC`)
		.then (
			data => {
				response.json ({states:data});
			}, error => {
				response.json ({states:[]});
			}
		);
	});

	app.post ('/api/states', (request, response, next) => {
		if (request.body.id) {
			db.any (`
				SELECT 
					s.id, s.name, s.slogan, s.emblem, s.description, (SELECT COUNT(*) FROM school sch WHERE sch.state = s.id) AS schools 
				FROM 
					static_states s
				WHERE
					s.id = $1
				LIMIT 1
				`, [request.body.id]
			)
			.then (
				data => {
					response.status (200).json ({ state:data });
				}, error => {
					response.status (200).json ({ state:[] });
				}
			);
		} else response.status (404).json ({ state:{} });
	});
	
	app.get ('/api/institutions', (request, response, next) => {
		db.any (`
			SELECT 
				s.name, s.year_of_est, s.url, s.logo, s.state, s.email, s.address, s.cover_photo, s.history, s.type, s.id AS __id, s.tel, s.mail,
				t.name as type_name, st.name as state_name
			FROM 
				school as s, static_states as st, institution_types as t
			WHERE
				s.type = t.id AND s.state = st.id
			ORDER BY 
				s.name ASC`).then (data => { 
					response.json ({ 
						schools:data 
					}); 
				}, err => { 
					response.json ({ 
						schools:[] 
					}); 
				}
			);
	});

	app.get ('/api/institution_types', (request, response, next) => {
		db.any ('SELECT * FROM institution_types ORDER BY name DESC').then (data => {
			response.json ({
				institutionTypes : data
			});
		}, error => {
			response.status (404).json ({
				institutionTypes:[]
			});
		});
	});

	app.get ('/api/educational_variants', (request, response, next) => {
		db.any ('SELECT * FROM static_educational_variant ORDER BY name ASC')
		.then (data => { response.json ({ variants:data }); }, err => { response.json ({ variants:[] }); });
	});	

	app.get ('/api/disciplines', (request, response, next) => {
		var sql = `
			SELECT 
				d.id, d.name, d.faculty, d.type,
				t.name, f.name, f.imageurl, 
				s.name, s.year_of_est, s.url, s.logo, s.state, s.email, s.address, s.cover_photo, s.history, s.type, s.tel, s.id AS sid, s,mail,
				sch_type.name, sch_state.name, sch_state.slogan, sch_state.emblem, sch_state.description,
				std.description, std.duration
			FROM 
				static_sub_disciplines  d, static_highest_qualification t, school s, schooltodisciplines std, institution_types sch_type, static_states sch_state
			WHERE
				d.id = std.discipline AND std.school = s.id AND sch_type.id = s.type AND s.state = sch_state.id AND f.id = std.faculty AND d.type = t.id
			ORDER BY 
				d.name ASC
		`;
		db.any (sql).then (data => { response.json ({ disciplines: data }); }, err => { response.json ({ disciplines: [] })});
	});

	app.get ('/api/faculties', (request, response, next) => {
		db.any ('SELECT * FROM static_faculty ORDER BY name DESC').then (data => { response.json ({ faculties:data }); }, err => { response.json ({ faculties:[] }); });
	});

	app.get ('/api/highest_qualification', (request, response, next) => {
		db.any ('SELECT * FROM static_highest_qualification ORDER BY name DESC').then (data => { response.json ({ highest_qualification:data }); }, err => { response.json ({ highest_qualification:[] }); });
	});

	app.get ('/api/scholarships', (request, response, next) => {
		var sql = `
			SELECT 
				s.id, s.ts, s.name, s.details, s.image, s.poster, p.username, p.profile_image
			FROM 
				scholarships s, users p 
			WHERE
				s.poster = p.id
			ORDER BY 
				s.ts DESC
		`;
		db.any (sql).then (data => { response.json ({ scholarships:data }); }, err => { response.json ({ scholarships:[] }); });
	});

	app.post ('/api/scholarships', (request, response, next) => {
		if (!request.body.id) {
			response.status (404);
		} else {
			var sql = `
				SELECT 
					s.id, s.ts, s.name, s.details, s.image, s.poster, p.username, p.profile_image
				FROM 
					scholarships s, users p 
				WHERE
					s.poster = p.id AND s.id = $1
				ORDER BY 
					s.ts DESC
				LIMIT 1
			`;
			db.any (sql, [request.body.id]).then (data => { response.json ({ scholarship:data }); }, err => { response.json ({ scholarship:[] }); });	
		}
	});

	app.get ('/api/countries', (request, response, next) => {
		db.any ("SELECT * FROM static_country").then (data => { response.json ({ countries:data }); }, err => { response.json ({ countries:[] }); });
	});

	/* this is a general route so login, logout, forgot_password, register urls would also reside here */
	app.post ('/api/authenticate', (request, response, next) => {
		var user = request.body.user || {username:'', password:''};

		var sql = `SELECT * FROM users WHERE username = $1 AND status=$2 LIMIT 1`;

		db.one (sql, [user.username, 3])
		.then (
			data => {

				var valid = bcrypt.compareSync (user.password, data.password);
				if (valid) {
					request.session.user = { authenticated: true, user:data };
					response.status (200).json ({
						msg		: 'authenticated',
						auth 	: true,
						data 	: data
					});
				} else {
					request.session.user = { authenticated: false, user:{} };
					response.status (200).json ({
						msg		: bcrypt.hashSync ('password'),
						auth 	: false,
						data 	: {}
					});
				}
			}, err => {
				request.session.user = { authenticated: false, user:{} };
				response.status (200).json ({
					msg 	: err,
					auth 	: false,
					data 	: {}
				});
			}
		);
	});

	app.post ('/api/forgot_password', (request, response, next) => {
		var sql = `

		`;

		db.any ().then (data => { response.json ({  }); }, err => { response.json ({  }); });
	});

	app.post ('/api/register', (request, response, next) => {
		if (request.body.user) {
			var applicant 			= request.body.user;
			applicant.middlename 	= applicant.middlename || '';

			var sql = `INSERT INTO users (username, password, usertype, status, email) VALUES ($1, $2, $3, $4, $5) returning id`;
			db.task (t => {
				return t.map (sql, [applicant.username, bcrypt.hashSync (applicant.password), 4, 4, applicant.email], _user => {
					return t.any ("INSERT INTO applicant (firstname, middlename, lastname, gender, dob, tel, user_data) VALUES ($1, $2, $3, $4, $5, $6, $7)", 
						[applicant.firstname, applicant.middlename, applicant.lastname, applicant.gender, applicant.dob, applicant.tel, _user.id]);
					}
				)
				.then (t.batch);
			})
			.then (
				saved => {
					response.json ({
						msg: saved,
						data: true
					});
				}, err => {
					response.json ({
						msg: err,
						data: false
					});
				}
			);
		} else {
			response.status (404).json ({
				msg: 'unfilled fields',
				data: false
			});
		}
	});

	app.post ('/api/verifyemail', (request, response, next) => {
		
		if (request.body.email) {
			db.any ('SELECT * FROM users WHERE email=$1 AND id != $2', [request.body.email, request.body.id])
			.then (
				found => {
					console.log ('found: ', found);
					if (found.length >= 1) {
						response.status (200).json ({ valid: true });
					}
					else {
						response.status (200).json ({ valid: false });	
					}
				}, err => {
					response.status (200).json ({ valid: false });
				}
			);
		} else {
			response.status (404).json ({
				message: 'no such url'
			});
		}
	});

	app.post ('/api/verifyusername', (request, response, next) => {
		if (request.body.username) {
			db.any ('SELECT * FROM users WHERE username=$1 AND id!=$2', [request.body.username, request.body.id])
			.then (
				found => {
					if (found.length >= 1) {
						response.status (200).json ({ valid: true });
					}
					else {
						response.status (200).json ({ valid: false });	
					}
				}, err => {
					response.status (200).json ({ valid: false });
				}
			);
		} else {
			response.status (404).json ({
				message: 'no such url'
			});
		}
	});
}