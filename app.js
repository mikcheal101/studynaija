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


// configuation ===================================================
app.io 		= socket;
app.path 	= path;
app.upload  = multer ({dest : './public/uploads/'});
app.applicant_upload = multer ({ dest: 'images/applicants/' });


// port details  ==================================================
var port 	= process.env.PORT || 9090;

// get post return as json  =======================================
app.use (bodyParser.json ());
app.use (bodyParser.json ({ type: 'application/vnd.api+json' }));
app.use (bodyParser.urlencoded ({ extended: true }));

app.use (cookieParser());

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


// access routing dir =============================================
var routes  	= require ('./app/routes')(app);

// enable cors ====================================================
app.use (function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

// start running server ===========================================
app.listen (port);
