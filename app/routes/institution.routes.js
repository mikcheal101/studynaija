// import the institution model

module.exports 		= function (app) {
	const db		= app.db;
	const bcrypt	= app.bcrypt;

	/** data posting */
	app.post ('/api/inst/subadmins', (request, response, next) => {
		var x = request.body;
		if (x.school) {
			db.any (`
				select 
					u.username, u.password, u.profile_image, u.usertype, u.status, u.email 
				from 
					users AS u 
					left outer join schooltousers AS s on s.user = u.id 
				where 
					s.school = $1 AND u.useertype=$2
				ORDER BY 
					u.username DESC
			`, [x.school, 5])
			.then (
				y => {
					response.json ({
						data:y
					});
				}, n => {
					response.json ({
						data:[]
					});
				}
			);
		} else {
			response.json ({
				data:[]
			});
		}
	});

	app.get ('/api/inst/welcome_note', (request, response, next) => {
		response.json ({
			data:'pending'
		});
	});

	app.get ('/api/inst/principal_officers', (request, response, next) => {
		response.json ({
			data:'pending'
		});
	});

	app.get ('/api/inst/accounting', (request, response, next) => {
		response.json ({
			data:'pending'
		});
	});

	app.post ('/api/inst/scholarships', (request, response, next) => {
		var x = request.body;
		if (x.poster) {
			db.any ('select * from scholarships where poster=$1 order by ts DESC', [x.poster])
			.then (
				y=> {
					response.json ({
						data:y
					});
				}, n => {
					response.json ({
						data:[]
					});
				}
			);
		} else {
			response.json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/recieved_applications', (request, response, next) => {
		var x = request.body;
		if (x.school) {
			db.task (t => {
				return t.map (`
					select 
						a.id AS __id, a.name, a.institution, a.start_date, a.end_date
					from
						institution_application AS a 
					where 
						a.institution = $1
					order by 
						a.start_date DESC
				`, [x.school], application => {
					return t.any ('select * from application_discipline where application = $1', [application.id], sub => {
						return t.any (`
							select 
								d.name, d.id, d.type, d.faculty, f.name, t.name
							from 
								static_sub_disciplines as d,
								static_faculty as f,
								static_highest_qualification as t
							where 
								d.id = $1
						`, [sub.discipline]).then (
							yes => {
								application.disciplines = yes;
							}, no => {
								application.disciplines = [];
							}
						);
					});
				}).then (t.batch);
			})
			.then (
				y => {
					response.json ({
						data:y
					});
				}, n => {
					response.json ({
						data:[]
					});
				}
			);
		} else {
			response.json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/create_scholarship', app.scholarship_upload, (request, response, next) => {
		var s = request.body;

		if (s.name && s.details && s.image && s.poster) {

			s.image = request.file ? request.file.filename : s.image || '';

			db.any ('INSERT INTO scholarships (name, details, image, poster) VALUES ($1,$2,$3,$4) RETURNING id', [s.name, s.details, s.image, s.poster])
			.then (saved => {
				response.json ({
					done : true,
					data:saved
				});
			}, err => {
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

	app.post ('/api/inst/edit_scholarship',app.scholarship_upload, (request, response) => {
		var s = request.body;
		if (s.name && s.details && s.image && s.poster, s.id) {

			s.image = request.file ? request.file.filename : s.image || '';

			db.any ('UPDATE scholarships SET name=$1, details=$2, image=$3, poster=$4 WHERE id=$5', [s.name, s.details, s.image, s.poster, s.id])
			.then (saved => {
				response.json ({
					done : true
				});
			}, err => {
				response.json ({
					done: false
				});
			});
		} else {
			response.status (404).json ({
				done: false
			});
		}
	});

	app.post ('/api/inst/drop_scholarship', (request, response, next) => {
		var x = request.body;
		if (x.id && x.image && x.poster) {
			db.none ('DELETE FROM scholarships WHERE id=$1 AND poster=$2', [x.id, x.poster])
			.then (
				y => {
					app.fs.stat (('public/uploads/scholarship/').concat (x.image), (err, stat) => {
						if (!err) {
							fs.unlink (('public/uploads/scholarship/').concat (x.image));
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

	app.post ('/api/inst/create_application', (request, response, next) => {
		var x = request.body;
		if (x.institution && x.start_date && x.end_date && x.name && x.disciplines) {
			db.task (t => {
				return t.map (`insert into institution_application (name, institution, start_date, end_date) values ($1,$2,$3,$4) RETURNING id`, [
					x.name, x.institution, x.start_date, x.end_date], application => {
						x.disciplines.map (discipline => {
							return t.one ('insert into application_disciplines (application, discipline) values ($1, $2)', [application.id, discipline]);
						});
					})
				.then (t.batch);
			})
			.then (
				yes => {
					response.json ({
						done: true,
						id:yes
					});
				}, no => {
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

	app.post ('/api/inst/close_application', (request, response, next) => {
		var x = request.body;
		if (x.school && x.application) {
			db.none ('update institution_application set end_date=$1 where institution=$2 AND id=$3', [Date.now(), x.school, x.application])
			.then (
				yes => {
					response.json ({
						done: true
					});
				}, no => {
					response.json ({
						done: false
					});
				}
			);
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/drop_application', (request, response, next) => {
		var x = request.body;
		if (x.school && x.application) {
			db.none ('delete from institution_application where institution=$1 AND id=$1', [x.school, x.application])
			.then (
				yes => {
					response.json ({
						done: true
					});
				}, no => {
					response.json ({
						done: false
					});
				}
			);
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/edit_application', (request, response, next) => {
		var x = request.body;
		if (x.institution && x.start_date && x.end_date && x.name && x.disciplines && x.id) {
			db.task (t => {
				return t.map (`update institution_application set name=$1, institution=$2, start_date=$3, end_date=$4 where id=$5 RETURNING id`, [
					x.name, x.institution, x.start_date, x.end_date, x.id], application => {
						return t.any ('delete from application_disciplines where application=$1', [x.id])
						.then (
							y=> {
								x.disciplines.map (discipline => {
									return t.one ('insert into application_disciplines (application, discipline) values ($1, $2)', [x.id, discipline]);
								});		
							}
						);
						
					})
				.then (t.batch);
			})
			.then (
				yes => {
					response.json ({
						done: true,
						id:yes
					});
				}, no => {
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

	app.post ('/api/inst/view_applicants', (request, response, next) => {
		response.json ({
			data:'pending'
		});
	});

	app.post ('/api/inst/review_applicant', (request, response, next) => {
		response.json ({
			data:'pending'
		});
	});

	app.post ('/api/inst/view_applicant', (request, response, next) => {
		var x = request;
		if (x.school && x.applicant) {
			db.one (`SELECT * from applicant where id=$1`, [x.applicant])
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/news', (request, response, next) => {
		var x = request.body;
		if (x.poster) {
			db.task (t=> {
				return t.map (`select * from news where poster=$1 ORDER BY date DESC`, [x.poster], news => {
					news.resources = [];
					return t.any (`select * from news_resources WHERE news=$1 order by ts desc`, [news.id], resources => {
						news.resources = resources;
						return news;
					})
				}).then (t.batch);
			})
			.then (
				y => {
					response.json ({
						data:y
					});
				}, n => {
					response.json ({
						data:[]
					});
				}
			);
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/add_news', app.news_upload, (request, response) => {
		var n = request.body;
		
		var resources = [];
		if (request.files && request.files.length > 0)
			 resources = request.files.map (file => {
			 	return file.filaname;
			 });

		if (n.subject && n.details && n.poster) {
			db.task (t=> {
				return t.map (`INSERT INTO news (subject, details, poster) VALUES ($1,$2,$3) RETURNING id`, [n.subject, n.details, n.poster], news => {
					news.resourses = [];
					if (resourses.length > 0) {
						resourses.map (r => {
							return t.one ('INSERT INTO news_resources (resource, news) VALUES ($1,$2) RETURNING id, resource, news', [r.resource, news.id], res => {
								news.resourses.push (res);
								return news;
							});
						});
					} else return news;
				})
				.then (t.batch)
			})
			.then (
				done => {
					response.json ({
						done : true,
						news:done
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

	app.post ('/api/inst/drop_news', (request, response) => {
		var x = request.body;
		if (x.id && x.resources && x.poster) {
			db.none ('DELETE FROM news WHERE id=$1 AND poster=$2', [x.id, x.poster])
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

	app.post ('/api/inst/update_profile', app.school_admin_upload, (request, response, next) => {
		var x = request.body;
		if (x.username && x.password && x.profile_image && x.email && x.id) {
			
			x.password 		= bcrypt.compareSync (x.pwd, x.password) ? x.password : bcrypt.hashSync (x.pwd);
			x.profile_image = request.file ? request.file.filename : x.profile_image || '';

			db.none (`update users set username=$1, password=$2, profile_image=$3, email=$4 WHERE id=$5`, [x.username, x.password, x.profile_image, x.email, x.id])
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
			response.status (404).json ({
				done:false
			});
		}
	});

	app.post ('/api/inst/assign_courses', (request, response, next) => {
		var x = request.body;
		if (x.school && x.courses) {
			db.task (t => {
				x.courses.map (course => {
					return t.any ('insert into schooltodisciplines (discipline, school, description, local, intl, content) values ($1,$2,$3,$4,$5)', [
						course.discipline, x.school, course.description || '', course.local || 0, course.intl || 0, course.content || '']).then (t.batch);
				});
			}).then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.json ({
						done:false
					});
				}
			)
		} else {
			response.status (404).json ({
				done: false
			});
		}
	});

	app.post ('/api/inst/our_courses', (request, response, next) => {
		var x = request.body;
		if (x.school) {
			db.any (`
				select  
					sd.description, sd.id, sd.local, sd.intl, sd.content, 
					d.name, d.type, d.faculty, f.name, t.name
				from 
					schooltodisciplines as sd
					left outer join static_sub_disciplines as d on d.id = sd.discipline
					left outer join static_faculty as f on f.if = d.faculty
					left outer join static_highest_qualification as t on t.id = d.type
				where 
					sd.school = $1
				order by 
					d.name desc
			`, [x.school])
			.then (
				y => {
					data:y
				}, n => {
					data:[]
				}
			);
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/get_course', (request, response, next) => {
		var x = request.body;
		if (x.school && x.discipline) {
			db.one (`
				select  
					sd.description, sd.id, sd.local, sd.intl, sd.content, 
					d.name, d.type, d.faculty, f.name, t.name
				from 
					schooltodisciplines as sd
					left outer join static_sub_disciplines as d on d.id = sd.discipline
					left outer join static_faculty as f on f.if = d.faculty
					left outer join static_highest_qualification as t on t.id = d.type
				where 
					sd.school = $1 AND d.id = $2
				limit 1
			`)
			.then (
				y => {
					data:y
				}, n => {
					data:[]
				}
			);
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});

	app.post ('/api/inst/update_course', (request, response, next) => {
		var x = request.body;
		if (x.school && x.discipline && x.id) {
			db.none (`
				update schooltodisciplines set description=$1, local=$2, intl=$3, content=$4 WHERE school=$5 AND discipline=$6 where id=$7
			`, [x.description || '', x.local || 0, x.intl || 0, x.content || '', x.school, x.discipline, x.id])
			.then (
				y => {
					done: true
				}, n => {
					done: false
				}
			);
		} else {
			response.status (404).json ({
				done:false
			});
		}
	});

	app.post ('/api/inst/drop_course', (request, response, next) => {
		var x = request.body;
		if (x.school && x.discipline) {
			db.none ('delete from schooltodisciplines where school=$1 and discipline=$2', [x.school, x.discipline])
			.then (
				y => {
					response.json ({
						done:true
					});
				}, n => {
					response.status (404).json ({
						done: false
					});
				}
			);
		} else {
			response.status (404).json ({
				data:[]
			});
		}
	});
}