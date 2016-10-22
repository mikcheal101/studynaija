module.exports = function (app, db, bcrypt) {
	
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
};