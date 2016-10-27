// modules =======================================================
var express 		= require ('express');
var app 			= express ();
var server 			= require ('http').createServer(app);
var bodyParser		= require ('body-parser');
var path			= require ('path');
var favicon 		= require ('serve-favicon');
var cookieParser 	= require ('cookie-parser');
var socket			= require ('socket.io')(server);
var multer          = require ('multer');
var flash			= require ('connect-flash');
var session			= require ('express-session');
var fs 				= require ('fs');


// configuation ===================================================
var admin_upload		= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/admin/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

var applicant_upload	= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/applicant/photos/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

var applicant_docs		= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/applicant/docs/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

var school_upload		= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/school/photos/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

var news_upload			= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/news/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

var school_admin_upload	= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/school/admin/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

var scholarship_upload	= multer.diskStorage ({ 
	destination : function (req, file, cb) {
		cb (null, 'public/uploads/scholarship/')	
	}, 
	filename : function (req, file, cb) {
		cb (null, file.originalname)
	}
});

app.io 					= socket;
app.path 				= path;
app.fs 					= fs;
app.pgp					= require ('pg-promise')();
app.conn 				= 'postgres://postgres:mikkytrionze@localhost:5432/studynaija';
//app.conn 				= process.env.DATABASE_URL || 'postgres://mikkytrionze:mikkytrionze@127.0.0.1:5432/studynaija';
app.db 					= app.pgp (app.conn);
app.bcrypt 				= require ('bcryptjs');

app.applicant_upload 	= multer ({ storage: applicant_upload}).single ('file');
app.admin_upload 		= multer ({ storage: admin_upload }).single ('file');	 
app.school_admin_upload	= multer ({ storage: school_admin_upload }).single ('file');	
app.scholarship_upload 	= multer ({ storage: scholarship_upload }).single ('file');	

app.school_upload		= multer ({ storage: school_upload}).fields ([{ name:'_logo', maxCount:1 }, { name:'_cover_photo', maxCount:1 }]);
app.applicant_docs 		= multer ({ storage: applicant_docs}).array ('files');
app.news_upload			= multer ({ storage: news_upload}).array ('files');


// port details  ==================================================
var port 	= process.env.PORT || 9090;

// get post return as json  =======================================
app.use (bodyParser.json ());
app.use (bodyParser.json ({ type: 'application/vnd.api+json' }));
app.use (bodyParser.urlencoded ({ extended: true }));


// access angular dir =============================================
app.use (express.static (path.join (__dirname, 'public'))); 

// session and flash setting ======================================
app.use (session ({
	secret 				: 'th1sisd53cretk3y4thew3bAppl1cationStudynaija', 
	resave				:true, 
	saveUninitialized	:true,
	cookie : {
		maxAge: 86400000,
		resave : true
	}
}));
app.use (flash ());

// enable cors ====================================================
app.use (function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

// access routing dir =============================================
require ('./app/routes')(app);
require ('./app/routes/admin.routes.js')(app);
require ('./app/routes/applicant.routes.js')(app);
require ('./app/routes/institution.routes.js')(app);

// not existant
app.get ('*', function (request, response, next) {
	var p = app.path.join (__dirname, './public/index.html');
	response.sendFile (p);
});

// start running server ===========================================
app.listen (port);
