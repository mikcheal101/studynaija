module.exports = function (app) {

	const db		= app.db;
	const bcrypt	= app.bcrypt;
	
	// get profile
	app.post ('/api/applicantprofile', (req, res) => {
		if (req.body.id) {
			//get the applicant details from the database table applicant
			db.any (`SELECT *, applicant.id as __id FROM applicant join users on users.id = applicant.user_data WHERE applicant.user_data=$1 LIMIT 1`, [req.body.id])
			.then (
				applicant => {
					res.status (200).json ({
						applicant: applicant
					});
				}
			);
		} else {
			res.status (404).json ({
				msg: 'no such url',
				data:[]
			});
		}
	});
	
	app.post ('/api/applicantUpdateProfile', app.applicant_upload, (req, res) => {
		console.log ('files: ', req.files);
		console.log ('applicant: ', req.body);

		if (req.body.applicant) {
			var applicant = req.body.applicant;
			// update user
			applicant.password = (applicant.password === req.session.user.password) ? req.session.user.password : bcrypt.hashSync (applicant.password);

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
};