module.exports = function (app) {
	const pgp 		= require ('pg-promise')();
	const conn 		= process.env.DATABASE_URL || 'postgres://mikkytrionze:mikkytrionze@127.0.0.1:5432/studynaija';
	const db 		= pgp (conn);
	const bcrypt 	= require ('bcryptjs');


	app.use ((req, res, next) => {
		req.session.user = req.session.user || {authenticated: false, user:{}};
		next ();
	});

	app.get ('/api/session', (req, res, next) => {
		res.json ({
			session : req.session.user
		});
	});

	app.get ('/api/signout', (req, res, next) => {
		req.session.destroy ();
		res.json ({
			done: true
		});
	});

	app.get ('/api/english', (req, res) => {
		db.any ('SELECT * FROM static_english_level ORDER BY name DESC')
		.then ((english) => {
			res.status (200).json ({
				english : english
			});
		});
	});

	app.get ('/api/semesters', (req, res) => {
		db.any ('SELECT * FROM static_semesters ORDER BY name DESC')
		.then ((semesters) => {
			res.status (200).json ({
				semesters: semesters
			});
		});
	});

	app.get ('/api/funding', (req, res) => {
		db.any ('SELECT * FROM static_payment_options ORDER BY name DESC')
		.then ((funding) => {
			res.status (200).json ({
				funding: funding
			});
		});
	});

	app.get ('/api/news',  function (req, res, next) {

		var sql = `
			SELECT 
				n.id, n.subject, n.details, n.poster, n.date, p.username, p.email, p.profile_image
			FROM 
				users AS p, news AS n 
			WHERE 
				n.poster = p.id 
			ORDER BY 
				n.date DESC
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
				res.json ({news:news});
			}, (error) => {
				res.json ({news:[]});
			}
		);
	});

	app.post ('/api/single_news',  function (req, res, next) {
		var id  = req.body.id || 0;
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
					res.json ({news:news});
				}, (error) => {
					res.json ({news:[]});
				}
			);	
		}
	});

	app.get ('/api/states', (req, res) => {
		db.any (`
			SELECT 
				s.id, s.name, s.slogan, s.emblem, s.description, (SELECT COUNT(*) FROM school sch WHERE sch.state = s.id) AS schools 
			FROM 
				static_states s
			ORDER BY 
				s.name ASC`)
		.then (
			data => {
				res.json ({states:data});
			}, error => {
				res.json ({states:[]});
			}
		);
	});

	app.post ('/api/states', (req, res) => {
		if (req.body.id) {
			db.any (`
				SELECT 
					s.id, s.name, s.slogan, s.emblem, s.description, (SELECT COUNT(*) FROM school sch WHERE sch.state = s.id) AS schools 
				FROM 
					static_states s
				WHERE
					s.id = $1
				LIMIT 1
				`, [req.body.id]
			)
			.then (
				data => {
					res.status (200).json ({ state:data });
				}, error => {
					res.status (200).json ({ state:[] });
				}
			);
		} else res.status (404).json ({ state:{} });
	});
	
	app.get ('/api/institutions', (req, res) => {
		db.any ('SELECT * FROM school ORDER BY name ASC').then (data => { res.json ({ schools:data }); }, err => { res.json ({ schools:[] }); });
	});

	app.get ('/api/educational_variants', (req, res) => {
		db.any ('SELECT * FROM static_educational_variant ORDER BY name ASC').then (data => { res.json ({ variants:data }); }, err => { res.json ({ variants:[] }); });
	});	

	app.get ('/api/disciplines', (req, res) => {
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
		db.any (sql).then (data => { res.json ({ disciplines: data }); }, err => { res.json ({ disciplines: [] })});
	});

	app.get ('/api/faculties', (req, res) => {
		db.any ('SELECT * FROM static_faculty ORDER BY name DESC').then (data => { res.json ({ faculties:data }); }, err => { res.json ({ faculties:[] }); });
	});

	app.get ('/api/highest_qualification', (req, res) => {
		db.any ('SELECT * FROM static_highest_qualification ORDER BY name DESC').then (data => { res.json ({ highest_qualification:data }); }, err => { res.json ({ highest_qualification:[] }); });
	});

	app.get ('/api/scholarships', (req, res) => {
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
		db.any (sql).then (data => { res.json ({ scholarships:data }); }, err => { res.json ({ scholarships:[] }); });
	});

	app.post ('/api/scholarships', (req, res) => {
		if (!req.body.id) {
			res.status (404);
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
			db.any (sql, [req.body.id]).then (data => { res.json ({ scholarship:data }); }, err => { res.json ({ scholarship:[] }); });	
		}
	});

	app.get ('/api/countries', (req, res) => {
		db.any ("SELECT * FROM static_country").then (data => { res.json ({ countries:data }); }, err => { res.json ({ countries:[] }); });
	});

	/* this is a general route so login, logout, forgot_password, register urls would also reside here */
	app.post ('/api/authenticate', (req, res) => {
		var user = req.body.user || {username:'', password:''};

		var sql = `SELECT * FROM users WHERE username = $1 AND status=$2 LIMIT 1`;

		db.one (sql, [user.username, 3])
		.then (
			data => {

				var valid = bcrypt.compareSync (user.password, data.password);
				if (valid) {
					req.session.user = { authenticated: true, user:data };
					res.status (200).json ({
						msg		: 'authenticated',
						auth 	: true,
						data 	: data
					});
				} else {
					req.session.user = { authenticated: false, user:{} };
					res.status (200).json ({
						msg		: bcrypt.hashSync ('password'),
						auth 	: false,
						data 	: {}
					});
				}
			}, err => {
				req.session.user = { authenticated: false, user:{} };
				res.status (200).json ({
					msg 	: err,
					auth 	: false,
					data 	: {}
				});
			}
		);
	});

	app.post ('/api/forgot_password', (req, res, next) => {
		var sql = `

		`;

		db.any ().then (data => { res.json ({  }); }, err => { res.json ({  }); });
	});

	app.post ('/api/register', (req, res, next) => {
		if (req.body.user) {
			var applicant 			= req.body.user;
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
					res.json ({
						msg: saved,
						data: true
					});
				}, err => {
					res.json ({
						msg: err,
						data: false
					});
				}
			);
		} else {
			res.status (404).json ({
				msg: 'unfilled fields',
				data: false
			});
		}
	});

	app.post ('/api/verifyemail', (req, res) => {
		console.log ('email', req.body);

		if (req.body.email) {
			db.any ('SELECT * FROM users WHERE email=$1', [req.body.email])
			.then (
				found => {
					if (found.length >= 1) {
						console.log ('found: email ', found);
						res.status (200).json ({ valid: true });
					}
					else {
						console.log ('notfound: email ', found);
						res.status (200).json ({ valid: false });	
					}
				}, err => {
					console.log ('notfound err: ', err);
					res.status (200).json ({ valid: false });
				}
			);
		} else {
			res.status (404).json ({
				message: 'no such url'
			});
		}
	});

	app.post ('/api/verifyusername', (req, res) => {
		if (req.body.username) {
			db.any ('SELECT * FROM users WHERE username=$1', [req.body.username])
			.then (
				found => {
					if (found.length >= 1) {
						console.log ('found: username', found);
						res.status (200).json ({ valid: true });
					}
					else {
						console.log ('notfound: username ', found);
						res.status (200).json ({ valid: false });	
					}
				}, err => {
					console.log ('notfound err: ', err);
					res.status (200).json ({ valid: false });
				}
			);
		} else {
			res.status (404).json ({
				message: 'no such url'
			});
		}
	});

	app.post ('/api/applicantUpdateProfile', app.applicant_upload.single ('file'), (req, res) => {
		console.log ('files: ', req.files);
		console.log ('applicant: ', req.body);

		if (req.body.applicant) {
			var applicant = req.body.applicant;
			// update user
			applicant.password = (applicant.password === applicant.oldpassword) ? applicant.oldpassword : bcrypt.hashSync (applicant.password);

			var sql = `
				UPDATE applicant set address=$1, country_of_residence=$2, country_of_study=$3, dob=$4, english_level=$5, extra_notes=$6, firstname=$7, 
				gender=$8, highest_qualification=$9, lastname=$10, middlename=$11, nationality=$12, payment_options=$13,  start_semester=$14, tel=$15,
				years_of_expirence=$16 WHERE id=$17;
			`;
			db.task (t => {
				return t.map ('UPDATE users SET username = $1, password = $2, profile_image=$3, email=$4 WHERE id = $5 returning id',
					[applicant.username, applicant.password, applicant.profile_image, applicant.email, applicant.user_data], applicant_ => {
					return t.any (sql, [applicant.address, applicant.country_of_residence, applicant.country_of_study, applicant.dob, 
						applicant.english_level, applicant.extra_notes, applicant.firstname, applicant.gender, applicant.highest_qualification, 
						applicant.lastname, applicant.middlename, applicant.nationality, applicant.payment_options, applicant.start_semester, 
						applicant.tel, applicant.years_of_expirence, applicant.__id])
					.then (
						y => {
							return y;
						}, no => {
							return no;
						}
					);
				})
				.then (t.batch);		
			})
			.then (
				updated => {
					res.status (200).json ({
						msg: 'updated',
						data: true
					});
				}, err => {
					res.status (200).json ({
						msg: err,
						data: false
					});
				}
			);
		} else {
			res.status (404);
		}
	});

	/** this is the applicant urls */
	require ('./applicant.routes.js')(app, db, bcrypt);

	// not existant
	app.get ('*', function (req, res) {
		var p = app.path.join (__dirname, '../../public/index.html');
		res.sendFile (p);
	});
}