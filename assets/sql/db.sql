/* static TABLEs */
CREATE TABLE IF NOT exists `static_gender` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(10) NOT NULL,
	abbreviation VARCHAR(10) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_gender` (name, abbreviation) VALUES 
("Male", "M"),
("Female", "F");

/******************************************************************/
CREATE TABLE IF NOT exists `static_highest_qualification` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_highest_qualification` (name) VALUES 
("Ordinary Level (O' Level ie Waec, Neco)"),
("Advannced Level (A' Level)"),
("Ordinary National Diploma (O.N.D.)"),
("Higher National Diploma (H.N.D.)"),
("Undergraduate Degree (B.Sc., B.Ed, e.t.c.)"),
("Postgraduate Diploma (PgD)"),
("Masters Degree (MBA, MPA, e.t.c.)"),
("Doctorate Degree (PhD)"),
("Others (Professional Certification)");

/******************************************************************/
CREATE TABLE IF NOT exists `static_payment_options` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_payment_options` (name) VALUES 
("I am self-funded"),
("I have a scholarship"),
("I need a scholarship"),
("I am interested in a scholarship");

/******************************************************************/
CREATE TABLE IF NOT exists `static_country` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	abbreviation VARCHAR(200) NOT NULL,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_country` (abbreviation, name) VALUES ("AF", "Afghanistan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AL", "Albania");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DZ", "Algeria");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DS", "American Samoa");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AD", "Andorra");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AO", "Angola");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AI", "Anguilla");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AQ", "Antarctica");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AG", "Antigua and Barbuda");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AR", "Argentina");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AM", "Armenia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AW", "Aruba");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AU", "Australia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AT", "Austria");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AZ", "Azerbaijan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BS", "Bahamas");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BH", "Bahrain");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BD", "Bangladesh");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BB", "Barbados");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BY", "Belarus");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BE", "Belgium");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BZ", "Belize");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BJ", "Benin");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BM", "Bermuda");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BT", "Bhutan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BO", "Bolivia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BA", "Bosnia and Herzegovina");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BW", "Botswana");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BV", "Bouvet Island");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BR", "Brazil");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IO", "British Indian Ocean Territory");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BN", "Brunei Darussalam");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BG", "Bulgaria");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BF", "Burkina Faso");
INSERT INTO `static_country` (abbreviation, name) VALUES ("BI", "Burundi");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KH", "Cambodia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CM", "Cameroon");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CA", "Canada");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CV", "Cape Verde");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KY", "Cayman Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CF", "Central African Republic");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TD", "Chad");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CL", "Chile");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CN", "China");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CX", "Christmas Island");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CC", "Cocos (Keeling) Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CO", "Colombia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KM", "Comoros");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CG", "Congo");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CK", "Cook Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CR", "Costa Rica");
INSERT INTO `static_country` (abbreviation, name) VALUES ("HR", "Croatia (Hrvatska)");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CU", "Cuba");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CY", "Cyprus");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CZ", "Czech Republic");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DK", "Denmark");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DJ", "Djibouti");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DM", "Dominica");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DO", "Dominican Republic");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TP", "East Timor");
INSERT INTO `static_country` (abbreviation, name) VALUES ("EC", "Ecuador");
INSERT INTO `static_country` (abbreviation, name) VALUES ("EG", "Egypt");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SV", "El Salvador");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GQ", "Equatorial Guinea");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ER", "Eritrea");
INSERT INTO `static_country` (abbreviation, name) VALUES ("EE", "Estonia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ET", "Ethiopia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FK", "Falkland Islands (Malvinas)");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FO", "Faroe Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FJ", "Fiji");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FI", "Finland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FR", "France");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FX", "France, Metropolitan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GF", "French Guiana");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PF", "French Polynesia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TF", "French Southern Territories");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GA", "Gabon");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GM", "Gambia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GE", "Georgia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("DE", "Germany");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GH", "Ghana");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GI", "Gibraltar");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GK", "Guernsey");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GR", "Greece");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GL", "Greenland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GD", "Grenada");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GP", "Guadeloupe");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GU", "Guam");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GT", "Guatemala");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GN", "Guinea");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GW", "Guinea-Bissau");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GY", "Guyana");
INSERT INTO `static_country` (abbreviation, name) VALUES ("HT", "Haiti");
INSERT INTO `static_country` (abbreviation, name) VALUES ("HM", "Heard and Mc Donald Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("HN", "Honduras");
INSERT INTO `static_country` (abbreviation, name) VALUES ("HK", "Hong Kong");
INSERT INTO `static_country` (abbreviation, name) VALUES ("HU", "Hungary");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IS", "Iceland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IN", "India");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IM", "Isle of Man");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ID", "Indonesia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IR", "Iran (Islamic Republic of)");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IQ", "Iraq");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IE", "Ireland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IL", "Israel");
INSERT INTO `static_country` (abbreviation, name) VALUES ("IT", "Italy");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CI", "Ivory Coast");
INSERT INTO `static_country` (abbreviation, name) VALUES ("JE", "Jersey");
INSERT INTO `static_country` (abbreviation, name) VALUES ("JM", "Jamaica");
INSERT INTO `static_country` (abbreviation, name) VALUES ("JP", "Japan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("JO", "Jordan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KZ", "Kazakhstan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KE", "Kenya");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KI", "Kiribati");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KP", "Korea, Democratic People""s Republic of");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KR", "Korea, Republic of");
INSERT INTO `static_country` (abbreviation, name) VALUES ("XK", "Kosovo");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KW", "Kuwait");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KG", "Kyrgyzstan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LA", "Lao People""s Democratic Republic");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LV", "Latvia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LB", "Lebanon");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LS", "Lesotho");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LR", "Liberia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LY", "Libyan Arab Jamahiriya");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LI", "Liechtenstein");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LT", "Lithuania");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LU", "Luxembourg");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MO", "Macau");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MK", "Macedonia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MG", "Madagascar");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MW", "Malawi");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MY", "Malaysia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MV", "Maldives");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ML", "Mali");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MT", "Malta");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MH", "Marshall Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MQ", "Martinique");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MR", "Mauritania");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MU", "Mauritius");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TY", "Mayotte");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MX", "Mexico");
INSERT INTO `static_country` (abbreviation, name) VALUES ("FM", "Micronesia, Federated States of");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MD", "Moldova, Republic of");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MC", "Monaco");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MN", "Mongolia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ME", "Montenegro");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MS", "Montserrat");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MA", "Morocco");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MZ", "Mozambique");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MM", "Myanmar");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NA", "Namibia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NR", "Nauru");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NP", "Nepal");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NL", "Netherlands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AN", "Netherlands Antilles");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NC", "New Caledonia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NZ", "New Zealand");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NI", "Nicaragua");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NE", "Niger");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NG", "Nigeria");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NU", "Niue");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NF", "Norfolk Island");
INSERT INTO `static_country` (abbreviation, name) VALUES ("MP", "Northern Mariana Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("NO", "Norway");
INSERT INTO `static_country` (abbreviation, name) VALUES ("OM", "Oman");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PK", "Pakistan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PW", "Palau");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PS", "Palestine");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PA", "Panama");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PG", "Papua New Guinea");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PY", "Paraguay");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PE", "Peru");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PH", "Philippines");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PN", "Pitcairn");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PL", "Poland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PT", "Portugal");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PR", "Puerto Rico");
INSERT INTO `static_country` (abbreviation, name) VALUES ("QA", "Qatar");
INSERT INTO `static_country` (abbreviation, name) VALUES ("RE", "Reunion");
INSERT INTO `static_country` (abbreviation, name) VALUES ("RO", "Romania");
INSERT INTO `static_country` (abbreviation, name) VALUES ("RU", "Russian Federation");
INSERT INTO `static_country` (abbreviation, name) VALUES ("RW", "Rwanda");
INSERT INTO `static_country` (abbreviation, name) VALUES ("KN", "SaINT Kitts and Nevis");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LC", "SaINT Lucia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VC", "SaINT Vincent and the Grenadines");
INSERT INTO `static_country` (abbreviation, name) VALUES ("WS", "Samoa");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SM", "San Marino");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ST", "Sao Tome and Principe");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SA", "Saudi Arabia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SN", "Senegal");
INSERT INTO `static_country` (abbreviation, name) VALUES ("RS", "Serbia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SC", "Seychelles");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SL", "Sierra Leone");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SG", "Singapore");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SK", "Slovakia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SI", "Slovenia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SB", "Solomon Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SO", "Somalia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ZA", "South Africa");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GS", "South Georgia South Sandwich Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ES", "Spain");
INSERT INTO `static_country` (abbreviation, name) VALUES ("LK", "Sri Lanka");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SH", "St. Helena");
INSERT INTO `static_country` (abbreviation, name) VALUES ("PM", "St. Pierre and Miquelon");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SD", "Sudan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SR", "Suriname");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SJ", "Svalbard and Jan Mayen Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SZ", "Swaziland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SE", "Sweden");
INSERT INTO `static_country` (abbreviation, name) VALUES ("CH", "Switzerland");
INSERT INTO `static_country` (abbreviation, name) VALUES ("SY", "Syrian Arab Republic");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TW", "Taiwan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TJ", "Tajikistan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TZ", "Tanzania, United Republic of");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TH", "Thailand");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TG", "Togo");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TK", "Tokelau");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TO", "Tonga");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TT", "Trinidad and Tobago");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TN", "Tunisia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TR", "Turkey");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TM", "Turkmenistan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TC", "Turks and Caicos Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("TV", "Tuvalu");
INSERT INTO `static_country` (abbreviation, name) VALUES ("UG", "Uganda");
INSERT INTO `static_country` (abbreviation, name) VALUES ("UA", "Ukraine");
INSERT INTO `static_country` (abbreviation, name) VALUES ("AE", "United Arab Emirates");
INSERT INTO `static_country` (abbreviation, name) VALUES ("GB", "United Kingdom");
INSERT INTO `static_country` (abbreviation, name) VALUES ("US", "United States");
INSERT INTO `static_country` (abbreviation, name) VALUES ("UM", "United States minor outlying islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("UY", "Uruguay");
INSERT INTO `static_country` (abbreviation, name) VALUES ("UZ", "Uzbekistan");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VU", "Vanuatu");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VA", "Vatican City State");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VE", "Venezuela");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VN", "Vietnam");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VG", "Virgin Islands (British)");
INSERT INTO `static_country` (abbreviation, name) VALUES ("VI", "Virgin Islands (U.S.)");
INSERT INTO `static_country` (abbreviation, name) VALUES ("WF", "Wallis and Futuna Islands");
INSERT INTO `static_country` (abbreviation, name) VALUES ("EH", "Western Sahara");
INSERT INTO `static_country` (abbreviation, name) VALUES ("YE", "Yemen");
INSERT INTO `static_country` (abbreviation, name) VALUES ("YU", "Yugoslavia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ZR", "Zaire");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ZM", "Zambia");
INSERT INTO `static_country` (abbreviation, name) VALUES ("ZW", "Zimbabwe");

/******************************************************************/
CREATE TABLE IF NOT exists `static_english_level` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;
INSERT INTO `static_english_level` (name) VALUES 

("Learner"),
("Intermidiate"),
("Professional"),
("Native");

/******************************************************************/
CREATE TABLE IF NOT exists `static_faculty` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL,
	imageUrl text
) ENGINE =INNODB;

INSERT INTO `static_faculty` (name) VALUES 
("Administration"),
("Agriculture"),
("Arts & Humanities"),
("Education"),
("Engineering, Enviroment & Technology"),
("Law"),
("Medical, Pharmaceutical & Health Sciences"),
("Sciences"),
("Social & Management Sciences"),
("Others");

/******************************************************************/
CREATE TABLE IF NOT exists `static_delivery_mode` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_delivery_mode` (name) VALUES 
("On Campus"),
("Online");

/******************************************************************/
CREATE TABLE IF NOT exists `static_educational_variant` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL,
	abbreviation VARCHAR(20) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_educational_variant` (name, abbreviation) VALUES 
("Full Time", "FT"),
("Part Time", "PT");

/******************************************************************/
CREATE TABLE IF NOT exists `static_message_status` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_message_status` (name) VALUES 
("Read"),
("Unread"),
("Junk"),
("Deleted");

/******************************************************************/
CREATE TABLE IF NOT exists `static_semesters` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL,
	abbreviation VARCHAR(20) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_semesters` (name, abbreviation) VALUES 
("First Semester", "1<sup>st</sup> Sem."),
("Second Semester", "2<sup>nd</sup> Sem."),
("Third Semester", "3<sup>rd</sup> Sem."),
("Summer Semester", "Sum. Sem.");

/******************************************************************/
CREATE TABLE IF NOT exists `static_states` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL,
	slogan text NOT NULL,
	emblem text NULL,
	description text NULL
) ENGINE =INNODB;

INSERT INTO `static_states` (name, slogan, emblem, description) VALUES 
("Abia", "God’s Own State", "", ""),
("Adamawa", "Land of Beauty, Sunshine and Hospitality", "", ""),
("Akwa Ibom", "Promised Land", "", ""),
("Anambra", "Home For All / Light of the nation", "", ""),
("Bauchi", "Pearl of Tourism", "", ""),
("Bayelsa", "Glory of all Lands", "", ""),
("Benue", "Food Basket of The Nation", "", ""),
("Borno", "Home of Peace", "", ""),
("Cross River", "The Nation’s Paradise", "", ""),
("Delta", "The Big Heart", "", ""),
("Ebonyi", "Salt of the Nation", "", ""),
("Edo", "The Heartbeat of the Nation", "", ""),
("Ekiti", "Fountain of Knowledge", "", ""),
("Enugu", "Coal City State", "", ""),
("Gombe", "Jewel in the Savannah", "", ""),
("Imo", "The Eastern Heartland", "", ""),
("Jigawa", "The New World", "", ""),
("Kaduna", "Centre of Education", "", ""),
("Kano", "Centre of Commerce", "", ""),
("Katsina", "Home of Hospitality", "", ""),
("Kebbi", "Land of Equity", "", ""),
("Kogi", "The Influence State", "", ""),
("Kwara", "The Place of Harmony", "", ""),
("Lagos", "Centre of  Excellence", "", ""),
("Nassarawa", "Nigeria’s Home of  Solid Minerals", "", ""),
("Niger", "The Power State", "", ""),
("Ogun", "Gateway State", "", ""),
("Ondo", "Sunshine State", "", ""),
("Osun", "State of the Living Spring", "", ""),
("Oyo", "Pace Setter", "", ""),
("Plateau", "Home of Peace & Tourism", "", ""),
("Rivers", "Treasure Base", "", ""),
("Sokoto", "The Seat of the Caliphate", "", ""),
("Taraba", "Nature’s Gift to the Nation", "", ""),
("Yobe", "The Young Shall Grow", "", ""),
("Zamfara", "Home of Agricultural Products", "", ""),
("abuja, FCT", "Center of Unity", "", "");

/******************************************************************/
CREATE TABLE IF NOT exists `static_usertypes` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_usertypes` (name) VALUES 
("super-admin"),
("admin"),
("school-admin"),
("applicant");

/******************************************************************/
CREATE TABLE IF NOT exists `static_application_status` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_application_status` (name) VALUES 
("Pending"),
("Under Review"),
("Rejected"),
("Conditional Offer of Acceptance"),
("UnConditional Offer of Acceptance"),
("Completed"),
("InComplete"),
("Submitted");

/******************************************************************/
CREATE TABLE IF NOT exists `static_user_status` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE =INNODB;

INSERT INTO `static_user_status` (name) VALUES 
("Suspended"),
("Deactivated"),
("Activated"),
("Pending"); 

/******************************************************************/
CREATE TABLE IF NOT exists `static_sub_disciplines` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL
) ENGINE = INNODB;

INSERT INTO `static_sub_disciplines` (name) VALUES 
("Accountancy"),
("Accountancy/Accounting"),
("Accountancy/Finance/Accounting"),
("Accounting"),
("Accounting Technology"),
("Actuarial Science"),
("Adult Education"),
("Adult Education/English Literature"),
("Adult Education/Geography and Regional Planning"),
("Adult Education/Political Science and Public Administration"),
("Adult and Community Education"),
("Adult and Non-Formal Education"),
("Agric- Business"),
("Agricultural Administration"),
("Agricultural And Management Engineering"),
("Agricultural Economics"),
("Agricultural Economics and Extension"),
("Agricultural Economics and Farm Management"),
("Agricultural Engineering"),
("Agricultural Engineering/Technology"),
("Agricultural Extension Services"),
("Agricultural Extension and Communication Technology"),
("Agricultural Extension and Rural Development"),
("Agricultural Extension and Rural Sociology"),
("Agricultural Production and Management Science and Education"),
("Agricultural Resource Extension"),
("Agricultural Science"),
("Agricultural Science and Education"),
("Agricultural Technology"),
("Agricultural and Bio-Environmental Engineering/Technology"),
("Agricultural and Bio-Resources Engineering"),
("Agricultural and Environmental Engineering"),
("Agriculture"),
("Agriculture Cooperative Management"),
("Agronomy"),
("Aircraft Engineering Technology"),
("Anatomy"),
("Animal Biology and Environment"),
("Animal Breeding and Genetics"),
("Animal Health And Production Technology"),
("Animal Nutrition"),
("Animal Nutrition and Biotechnology"),
("Animal Physiology"),
("Animal Production"),
("Animal Production and Fisheries"),
("Animal Production and Health"),
("Animal Production and Health Service"),
("Animal Science"),
("Animal Science and Fisheries"),
("Animal Science and Fisheries Management"),
("Animal Science and Range Management"),
("Animal Science and Technology"),
("Animal and Environmental Biology"),
("Anthropology"),
("Anthropology (Biological)"),
("Applied Biochemistry"),
("Applied Biology"),
("Applied Biology and Biotechnology"),
("Applied Botany"),
("Applied Geology"),
("Applied Geophysics"),
("Applied Mathematics with Statistics"),
("Applied Microbiology"),
("Applied Microbiology and Brewing"),
("Applied Zoology"),
("Arabic Language and Literature"),
("Arabic Medium"),
("Arabic Studies"),
("Arabic and Islamic Studies"),
("Arabic/Christian Regional Studies"),
("Arabic/Creative And Cultural Arts"),
("Arabic/Economics"),
("Arabic/English"),
("Arabic/French"),
("Arabic/Geography"),
("Arabic/Hausa"),
("Arabic/History"),
("Arabic/Igbo"),
("Arabic/Islamic Studies"),
("Arabic/Kanuri"),
("Arabic/Political Science"),
("Arabic/Social Studies"),
("Arabic/Theatre Arts"),
("Arabic/Yoruba"),
("Archaeology"),
("Archealology"),
("Archealology (Single Honour)"),
("Architectural Technology"),
("Architecture"),
("Art and Design"),
("Arts (Combined Honours)"),
("Automobile Technology Education"),
("Automoblie Engineering"),
("Automotive Engineering"),
("Banking And Finance"),
("Banking and Finance (Admin)"),
("Banking and Finance (Mgt)"),
("Bio-Informatics"),
("Bio-medical Technology"),
("Biochemistry"),
("Biological Science(s)"),
("Biology"),
("Biology/Chemistry"),
("Biology/Geography"),
("Biology/Integrated Science"),
("Biology/Mathematics"),
("Biology/Physics"),
("Biomedical Engineering"),
("Biotechnology"),
("Boat And Ship Engineering Technology"),
("Botany"),
("Botany And Ecological Studies"),
("Botany and Microbiology"),
("Building"),
("Building Education"),
("Building Technology"),
("Business Administration"),
("Business Administration and Management"),
("Business Administration/Marketing"),
("Business And Entrepreneurship Studies"),
("Business Education"),
("Business Enterprise Management"),
("Business Management"),
("Business Management/Management Science"),
("Cartography and Geographic Information System"),
("Cell Biology and Genetics"),
("Chemical And Polymer Engineering"),
("Chemical Engineering"),
("Chemical Engineering Technology"),
("Chemical Sciences"),
("Chemical/Petrochemical Engineering"),
("Chemistry"),
("Chemistry and Industrial Chemistry"),
("Chemistry/Integrated Science"),
("Chemistry/Mathematics"),
("Chemistry/Physics"),
("Chinese Studies"),
("Christian Religious Knowledge / Studies"),
("Christian Religious Studies/Computer Education"),
("Christian Religious Studies/Economics"),
("Christian Religious Studies/Efik"),
("Christian Religious Studies/English"),
("Christian Religious Studies/French"),
("Christian Religious Studies/Geography"),
("Christian Religious Studies/Hausa L2"),
("Christian Religious Studies/History"),
("Christian Religious Studies/Ibibio"),
("Christian Religious Studies/Idoma"),
("Christian Religious Studies/Igala"),
("Christian Religious Studies/Maths"),
("Christian Religious Studies/Theatre Arts"),
("Christian Religious Studies/Tiv"),
("Christian Religious Stusies/Fine Arts"),
("Christian Religiuos Studies/Hausa"),
("Christian Religiuos Studies/Political Science"),
("Christian Studies"),
("Christians Religion Studies/Igbo"),
("Christians Religion Studies/Igbo L2"),
("Christians Religion Studies/Social Studies"),
("Christians Religion Studies/Yoruba"),
("Civil Engineering"),
("Civil Law"),
("Classical Studies"),
("Common Law"),
("Common and Islamic Law"),
("Communication And Wireless Technology"),
("Communication Arts"),
("Communication Technology"),
("Communication Technology And Wireless Technology"),
("Communication and Language Arts"),
("Communications Technology"),
("Community Health"),
("Comparative Religious Studies"),
("Computer And Communication Engineering"),
("Computer Education"),
("Computer Education/ English"),
("Computer Education/ Geography"),
("Computer Education/ Physics"),
("Computer Education/Accounting"),
("Computer Education/Biology"),
("Computer Education/Chemistry"),
("Computer Education/Economics"),
("Computer Education/Music"),
("Computer Engineering"),
("Computer Information And Communication Science"),
("Computer Science"),
("Computer Science And Informatics"),
("Computer Science And Information Science"),
("Computer Science And Mathematics"),
("Computer Science Education/ Integrated Science"),
("Computer Science Education/ Mathematics"),
("Computer Science With Economics"),
("Computer Science with (Economics) (Mathematics)"),
("Computer Science/ Business Studies"),
("Computer Science/ Political Science"),
("Computer Science/ Secretarial Studies"),
("Computer Science/ Social Studies"),
("Computer Science/Fine And Applied Arts"),
("Computer Sciences and Information Technology"),
("Computer With Electronics"),
("Computer with Statistics"),
("Conflict And Peace Resolution"),
("Conservation Biology"),
("Cooperative Economics and Management"),
("Cooperative and Rural Development"),
("Counsellor Education"),
("Creative And Visual Arts"),
("Creative Arts"),
("Criminology"),
("Criminology And Security Studies"),
("Criminology and Penology"),
("Crop And Environmental Protection"),
("Crop Production"),
("Crop Production And Horticulture"),
("Crop Production And Protection"),
("Crop Production And Soil Science"),
("Crop Production Technology"),
("Crop Production and Landscape Management"),
("Crop Protection"),
("Crop Science"),
("Crop Science And Biotechnology"),
("Crop Science And Horticulture"),
("Crop Science And Production"),
("Crop Science And Technology"),
("Crop, Soil And Environmental Science"),
("Crop, Soil And Pest Management"),
("Cultural and Creative Art / Political Science"),
("Cultural and Creative Art /C.R.S"),
("Cultural and Creative Art /English"),
("Cultural and Creative Art /French"),
("Cultural and Creative Art /Hausa"),
("Cultural and Creative Art /Igbo"),
("Cultural and Creative Art /Islamic Studies"),
("Cultural and Creative Art /Social Studies"),
("Cultural and Creative Art /Yoruba"),
("Curriculum Studies"),
("Curriculum and Instruction"),
("Cyber Security Science"),
("Demography and Social Statistics"),
("Dental Technology"),
("Dental Therapy"),
("Dentistry And Dental Surgery"),
("Drama/Dramatic/Performing Arts"),
("Early Childhood Care Education"),
("Early Childhood Education"),
("Early Childhood and Primary Education"),
("Earth Science"),
("Eco-Tourism and Wildlife Management"),
("Ecology"),
("Ecology And Environmental Studies"),
("Economics"),
("Economics and Development Studies"),
("Economics and Operative Research"),
("Economics and Statistics"),
("Economics/ English"),
("Economics/ French"),
("Economics/ Geography"),
("Economics/ History"),
("Economics/ Igbo"),
("Economics/ Mathematics"),
("Economics/ Physics"),
("Economics/ Political Science"),
("Economics/ Yoruba"),
("Economics/Geography/Physics"),
("Economics/Social Studies"),
("Edo/Computer Science"),
("Edo/English"),
("Edo/Social Studies"),
("Education Accounting"),
("Education Arts"),
("Education Foundation and Management"),
("Education and Accountancy"),
("Education and Arabic"),
("Education and Biology"),
("Education and Business Administration"),
("Education and Chemistry"),
("Education and Christian Religious Studies"),
("Education and Computer Science"),
("Education and Economics"),
("Education and Edo Language"),
("Education and Efik/Ibibio"),
("Education and English Language"),
("Education and English Language and Literature"),
("Education and Fine and Applied Arts"),
("Education and French"),
("Education and Geography"),
("Education and Geography/Physics"),
("Education and Government"),
("Education and Hausa"),
("Education and History"),
("Education and Igbo"),
("Education and Integrated Science"),
("Education and Islamic Studies"),
("Education and Language Arts"),
("Education and Mathematics"),
("Education and Music"),
("Education and Physics"),
("Education and Political Science"),
("Education and Religious Studies"),
("Education and Science"),
("Education and Social Science"),
("Education and Social Studies"),
("Education and Sociology"),
("Education and Yoruba"),
("Education, Language and French"),
("Education/Fine Art"),
("Educational Administration"),
("Educational Administration and Planning"),
("Educational Administration and Supervision"),
("Educational Foundation"),
("Educational Foundations and Administration"),
("Educational Management"),
("Educational Management and Planning"),
("Educational Management and Policy"),
("Educational Technology/Introductory Technology"),
("Educational/ Psychology, Guidance and Counseling"),
("Efik-Ibibio"),
("Electrical And Computer Engineering"),
("Electrical And Information Engineering"),
("Electrical Engineering"),
("Electrical/Electronic Engineering"),
("Electrical/Electronics Education"),
("Electronics"),
("Electronics And Computer Engineering"),
("Electronics Engineering"),
("Electronics and Computer Technology"),
("Elementary Education"),
("Energy Studies"),
("Energy and Petroleum Studies"),
("Engineering Physics"),
("English And Fine And Applied Arts"),
("English Language"),
("English Language and Communication Studies"),
("English Language and Literature"),
("English Studies"),
("English and International Studies"),
("English and Literary Studies"),
("English/Ecunemics"),
("English/Efik"),
("English/French"),
("English/Geography"),
("English/Hausa"),
("English/Hausa L2"),
("English/History"),
("English/Ibibio"),
("English/Idoma"),
("English/Igala"),
("English/Igbo"),
("English/Igbo L2"),
("English/Ika"),
("English/Integrated Science"),
("English/Islamic Studies"),
("English/Kanuri"),
("English/Mathematics"),
("English/Music"),
("English/Okpameri"),
("English/Political Science"),
("English/Social Studies"),
("English/Theatre Arts"),
("English/Tiv"),
("English/Ukwani"),
("English/Yoruba"),
("English/Yoruba L2"),
("Entrepreneurial Studies"),
("Entrepreneurship"),
("Entrepreneurship And Business Studies"),
("Entrepreneurship Management Technology"),
("Environmental Biology and Fisheries"),
("Environmental Education"),
("Environmental Health Technology"),
("Environmental Management"),
("Environmental Management And Toxicology"),
("Environmental Management Technology"),
("Environmental Management and Toxicology"),
("Environmental Protection And Resources Management"),
("Environmental Resources Management"),
("Environmental Science"),
("Environmental Science And Technology"),
("Environmental Technology"),
("Estate Management"),
("Estate Mangement And Valuation"),
("European and Nigerian Languages"),
("Explosive Ordinance Technology"),
("Family, Nutrition and Consumer Sciences"),
("Fashion Design And Clothing Technology"),
("Film And Video Studies"),
("Film and Video Studies"),
("Finance"),
("Financial Management Technology"),
("Fine And Applied Art"),
("Fine And Applied Art/Hausa L2"),
("Fine And Applied Art/Yoruba"),
("Fine And Industrial Arts"),
("Fine Art"),
("Fine Art/Fine and Applied Arts"),
("Fine Arts And Design"),
("Fine/Applied Art"),
("Fisheries"),
("Fisheries And Aquaculture Technology"),
("Fisheries And Aquatic Environment Management"),
("Fisheries And Aquatic Resources Management"),
("Fisheries Management"),
("Fisheries Technology"),
("Fisheries and Aquaculture"),
("Fisheries and Wildlife Management"),
("Food Engineering"),
("Food Science"),
("Food Science And Nutrition"),
("Food Science And Technology"),
("Food Science With Business"),
("Food Science and Engineering"),
("Food Science and Technology"),
("Food Science with Business"),
("Food Technology"),
("Forensic Science"),
("Forestry"),
("Forestry And WildLife"),
("Forestry And Wildlife Management"),
("Forestry And Wildlife Technology"),
("Forestry Technology"),
("Forestry Wildlife And Fisheries"),
("Forestry and Environmental Management"),
("Forestry and Environmental Technology"),
("Forestry and Wood Technology"),
("Forestry/Forest Resources Management"),
("Foundry Engineering Technology"),
("French"),
("French and International Relations"),
("French and International Studies"),
("French with German/Russian"),
("French/ Social Studies"),
("French/ Ukwani"),
("French/Computer Science"),
("French/Hausa"),
("French/Hausa L2"),
("French/History"),
("French/IKA"),
("French/Ibibio"),
("French/Igala"),
("French/Igbo"),
("French/Igbo L2"),
("French/Islamic Studies"),
("French/Kanuri"),
("French/Mathematics"),
("French/Music"),
("French/Political Science"),
("French/Theatre Arts"),
("French/Tiv"),
("French/Yoruba"),
("French/Yoruba L2"),
("Fulfulde"),
("Fulfulde/Arabic"),
("Fulfulde/English"),
("Fulfulde/Hausa"),
("Fulfulde/Islamic Studies"),
("Fulfulde/Social Studies"),
("Gas Engineering"),
("Genetics and Bio-Technology"),
("Geography"),
("Geography /Political Science"),
("Geography And Environmental Management"),
("Geography And Geosciences"),
("Geography And Meteorology"),
("Geography and Environmental Science"),
("Geography and Meteorology"),
("Geography and Planning"),
("Geography and Regional Planning"),
("Geography/Chemistry"),
("Geography/Fine Art"),
("Geography/French"),
("Geography/History"),
("Geography/Integrated Science"),
("Geography/Mathematics"),
("Geography/Physics"),
("Geography/Social Studies"),
("Geography/Yoruba"),
("Geological Sciences"),
("Geology"),
("Geology And Mineral Sciences"),
("Geology and Exploration Geophysics"),
("Geology and Geo-Physics"),
("Geology and Mineral Science"),
("Geology and Petroleum Studies"),
("Geology and minning"),
("Geology/Regional Planning"),
("Geophysis"),
("Geosciences"),
("German"),
("German Combined with French Russian"),
("Glass Technology"),
("Glass/Ceramics Technology"),
("Goegraphy And Fine And Applied Arts"),
("Government And Public Administration"),
("Guidance and Counseling"),
("Hausa"),
("Hausa / Kanuri"),
("Hausa / Music"),
("Hausa L 2 / Islamic Studies"),
("Hausa L2 / Music"),
("Hausa L2 / Social Studies"),
("Hausa L2 /Yoruba"),
("Hausa/Economics"),
("Hausa/Geography"),
("Hausa/History"),
("Hausa/Igbo"),
("Hausa/Igbo L2"),
("Hausa/Islamic Studies"),
("Hausa/Political Science"),
("Hausa/Social Studies"),
("Hausa/Theater Arts"),
("Hausa/Yoruba"),
("Hausa/Yoruba L2"),
("Health Education"),
("Health Information Management"),
("Health and Safety Education"),
("History"),
("History / Political Science"),
("History / Social Studies"),
("History / Sociology"),
("History / Theatre Art"),
("History / Yoruba"),
("History And Fine And Applied Arts"),
("History And International Relations"),
("History and Archeology"),
("History and Diplomacy"),
("History and Diplomatic Studies"),
("History and International Relation"),
("History and International Studies"),
("History and Strategic Studies"),
("History/Idoma"),
("History/Igbo"),
("History/Igbo L2"),
("History/Ika"),
("History/Islamic Studies"),
("History/Nigerian Laguages"),
("History/Tiv"),
("History/Ukwani"),
("Home And Hotel Management"),
("Home Economics"),
("Home Economics And Food Management"),
("Home Economics and Education"),
("Home Economics and Hotel Management and Education"),
("Home Science"),
("Home Science and Management"),
("Home Science, Nutrition and Dietetics"),
("Home and Rural Economics"),
("Horticulture"),
("Hospitality And Tourism"),
("Hospitality And Tourism Management"),
("Hospitality Management"),
("Hotel And Tourism Management"),
("Hotel Management And Tourism"),
("Hotel Management and Tourism"),
("Hotel Tourism Management"),
("Human Anatomy"),
("Human Biology"),
("Human Kinetics"),
("Human Kinetics and Health Education"),
("Human Nutrition and Dietetics"),
("Human Physiology"),
("Human Resources Management"),
("Human/ Theatre Arts"),
("Ibibio /English"),
("Igbo"),
("Igbo / Computer Science"),
("Igbo / Integarted Science"),
("Igbo / Mathematics"),
("Igbo /Hausa L2"),
("Igbo /Islamic Studies"),
("Igbo /Music"),
("Igbo /Political Science"),
("Igbo /Social Studies"),
("Igbo /Yoruba"),
("Igbo /Yoruba L2"),
("Igbo And Fine And Applied Arts"),
("Igbo L2 / Mathematics"),
("Igbo L2/Social Studies"),
("Igbo/Linguistics"),
("Igbo/Theatre Arts"),
("Ikar/Social Studies"),
("Industrial And Environmental Chemistry"),
("Industrial And Labour Relations"),
("Industrial And Production Engineering"),
("Industrial Chemistry"),
("Industrial Design"),
("Industrial Education Technology"),
("Industrial Maintenance Engineering Technology"),
("Industrial Mathematics"),
("Industrial Mathematics/Applied Statistics"),
("Industrial Mathematics/Computer"),
("Industrial Microbiology"),
("Industrial Physics"),
("Industrial Physics/Electronics/IT Application"),
("Industrial Physics/Renewable Energy"),
("Industrial Production Engineering"),
("Industrial Relations"),
("Industrial Relations And Human Resources Management"),
("Industrial Relations and Personnel Management"),
("Industrial Safety And Environmental Engineering Technology"),
("Industrial Technical Education"),
("Industrial Technology Education"),
("Information And Communication Engineering"),
("Information And Communication Science"),
("Information And Communication Technology Engineering"),
("Information And Media Technology Engineering"),
("Information Management Technology"),
("Information Resource Management"),
("Information Science And Media Studies"),
("Information System"),
("Information Technology"),
("Information and Communication Tech."),
("Insurance"),
("Insurance and Actuarial Science"),
("Insurance and Risk Management"),
("Integrated Science"),
("Integrated Science/Economics"),
("Integrated Science/Mathematics Education"),
("Integrated Science/Physics"),
("Integrated Science/Social Studies"),
("Integrated Science/Yoruba"),
("Intelligence and Security Studies"),
("International And Comparative Politics"),
("International Relations"),
("International Relations And Human Resource Management"),
("International Relations and Diplomacy"),
("International Relations and Strategics Studies"),
("International Relationship and Strategic Studies"),
("International Studies"),
("International Studies and Diplomacy"),
("International and Comparative Politics"),
("Irrigation Engineering"),
("Islamic Studies"),
("Islamic Studies/Christain Religious Studies"),
("Islamic Studies/Computer Education"),
("Islamic Studies/Economics"),
("Islamic Studies/Geography"),
("Islamic Studies/Kanuri"),
("Islamic Studies/Political Science"),
("Islamic Studies/Social Studies"),
("Islamic Studies/Yoruba"),
("Islamic/ Sharia Law"),
("Isoko/Christain Religious Studies"),
("Isoko/English"),
("Isoko/Social Studies"),
("Itsekiri/English"),
("Izon/Christain Religious Studies"),
("Izon/English"),
("Izon/Social Studies"),
("Kanuri"),
("Kanuri/History"),
("Kanuri/Social Studies"),
("Laboratory Technology"),
("Labour studies"),
("Land Survey"),
("Land Surveying And Geo-Informatics"),
("Languages and Linguistics"),
("Languages and Literature"),
("Law"),
("Leather Technology."),
("Leisure And Tourism management"),
("Library Science"),
("Library and Information Management"),
("Library and Information Science"),
("Library and Information Studies"),
("Library and Information Technology"),
("Linguistics"),
("Linguistics / Edo"),
("Linguistics / Urhobo"),
("Linguistics / Yoruba"),
("Linguistics and African Languages"),
("Linguistics, Igbo and other African Languages"),
("Literature in English"),
("Livestock Production Technology"),
("Local Government Administration"),
("Local Government And Development Studies"),
("Local Government Studies"),
("Management"),
("Management And Entrepreneurship"),
("Management Information System"),
("Management Studies"),
("Management Technology"),
("Marine Biology"),
("Marine Biology and Fishery"),
("Marine Engineering"),
("Marine Engineering Technology"),
("Marine Science And Technology"),
("Marine Transport and Business Studies"),
("Maritime Management Technology"),
("Marketing"),
("Marketing And Advertising"),
("Marketing Education"),
("Mass Communication"),
("Mass Communication And Media Technology"),
("Material Engineering"),
("Mathematical Sciences"),
("Mathematics"),
("Mathematics And Statistics"),
("Mathematics and Economics"),
("Mathematics and Education Technology"),
("Mathematics with Computer Science"),
("Mathematics with Statistics"),
("Mathematics/Computer Science"),
("Mathematics/Computer Science Education"),
("Mathematics/Hausa"),
("Mathematics/Hausa L2"),
("Mathematics/Physics"),
("Mathematics/Social Studies"),
("Mathematics/Statistics"),
("Mathematics/Statistics Education"),
("Mathematics/Yoruba"),
("Mathematics/Yoruba L2"),
("Mechanical Engineering"),
("Mechanical Engineering Technology"),
("Mechanical and Production Engineering"),
("Mechatronics And System Engineering"),
("Mechatronics Engineering"),
("Mechatronics Engineering Technology"),
("Medical Biochemistry"),
("Medical Imaging Technology"),
("Medical Laboratory Technology/Science"),
("Medical Radiography And Radiological Science"),
("Medical Rehabilitation"),
("Medicine and Surgery"),
("Metal Work Technology Education"),
("Metallurgical Engineering"),
("Metallurgical Engineering Technology"),
("Metallurgical and Material Engineering"),
("Meteorology"),
("Microbiology"),
("Microbiology And Biotechnology"),
("Microbiology and Industrial Biotechnology"),
("Mining Engineering"),
("Modern and European Language"),
("Molecular Biology"),
("Music"),
("Music / Igbo L2"),
("Music Technology"),
("Music/Arabic"),
("Music/Christian Religious Studies"),
("Music/Economics"),
("Music/History"),
("Music/Islamic Studies"),
("Music/Mathematics"),
("Music/Physics"),
("Music/Political Science"),
("Music/Social Studies"),
("Music/Theatre Arts"),
("Music/Yoruba"),
("Natural and Environmental Science"),
("Nautical Science"),
("Nigerian Languages"),
("Nursery and Primary Education"),
("Nursing/Nursing Science"),
("Nutrition And Consumer Services"),
("Nutrition And Dietetics"),
("Nutrition and Dietetics"),
("Oceanography"),
("Office And Information Management"),
("Office Technology And Management"),
("Operations Research"),
("Optometry"),
("Orthopedic Cast Technology"),
("Parastitology and Entomology"),
("Pasture and Range Management"),
("Peace And Conflict Studies"),
("Peace Studies And Conflict Resolution"),
("Peace and Development Studies"),
("Performing Arts"),
("Performing Arts and Culture"),
("Personnel Management"),
("Petroleum Chemistry"),
("Petroleum Engineering"),
("Petroleum and Gas Engineering"),
("Pharmaceutical Technology"),
("Pharmacology"),
("Pharmacology And Therapeutics"),
("Pharmacy"),
("Philosoph and Religious Studies"),
("Philosophy"),
("Photogrammetry and Remote Sensing"),
("Physical Education"),
("Physical Sciences"),
("Physical and Health Education"),
("Physics"),
("Physics And Computer Electronics"),
("Physics Electronics"),
("Physics and Applied Physics"),
("Physics with Electronics"),
("Physics/Astrology"),
("Physics/Computational Modeling"),
("Physics/Industrial Physics"),
("Physics/Material Science"),
("Physics/Music"),
("Physics/Solar Energy"),
("Physiology"),
("Physiotherapy"),
("Plant Biology"),
("Plant Breeding And Seed Science"),
("Plant Breeding and Seed Technology"),
("Plant Physiology and Crop Production"),
("Plant Science"),
("Plant Science and Biotechnology"),
("Plant Science and Crop Production"),
("Plant Science and Forestry"),
("Plant Science and Microbiology"),
("Policy And Strategic Studies"),
("Policy and Administrative Studies"),
("Political Science"),
("Political Science / Fine And Applied Arts"),
("Political Science /Islamic Studies"),
("Political Science /Tiv"),
("Political Science /Yoruba"),
("Political Science and Conflict Resolution"),
("Political Science and Defence Studies"),
("Political Science and Diplomacy"),
("Political Science and International Relations"),
("Political Science and International Studies"),
("Political Science and Public Administration"),
("Political Science/Ibibio"),
("Political Science/Igala"),
("Political Science/International Law and Diplomacy"),
("Political Science/Mathematics"),
("Political Science/Social Studies"),
("Political and Administrative Studies"),
("Polymer Engineering"),
("Polymer Technology"),
("Polymer and Textile Engineering"),
("Population Studies"),
("Portugues/English"),
("Portuguese"),
("Pre-Primary and Primary Education"),
("Primary Education Studies"),
("Primary and Elementary Education"),
("Printing Technology"),
("Private and Islamic Law"),
("Production Engineering"),
("Project Management Technology"),
("Prosthesis and Orthopaedic Technology"),
("Prosthetics/Orthotics Technology"),
("Psychology"),
("Psychology Education"),
("Public Administration"),
("Public Administration And Local Government"),
("Public Health"),
("Public Health Technology"),
("Public Relations and Advertising"),
("Public and Community Health"),
("Public and Private International Law"),
("Purchasing and Supply"),
("Pure Physics"),
("Pure and Industrial Chemistry"),
("Pure/Applied Biology"),
("Pure/Applied Chemistry"),
("Pure/Applied Mathematics"),
("Pure/Applied Physics"),
("Pure/Industrial Physics"),
("Quantity Surveying"),
("Radiography"),
("Religious Studies"),
("Religious and Cultural Studies"),
("Religious and Human Relations"),
("Remote Sensing And Geosciences Information System"),
("Russain with French/ German"),
("Russian"),
("Science Education"),
("Science Laboratory Technology"),
("Secretarial Administration"),
("Secretarial Administration and Education"),
("Secretarial Education"),
("Shipping And Maritime Technology"),
("Social Justice"),
("Social Studies"),
("Social Studies/Creative Arts"),
("Social Studies/Efik"),
("Social Studies/Fine And Applied Arts"),
("Social Studies/Fine Art"),
("Social Studies/Ibibio"),
("Social Studies/Idoma"),
("Social Studies/Igala"),
("Social Studies/Tiv"),
("Social Studies/Yoruba"),
("Social Works"),
("Sociology"),
("Sociology and Anthropology"),
("Software Engineering"),
("Soil Science"),
("Soil Science And Land Agro-Climatology"),
("Soil Science Management"),
("Soil Science and Environmental Management"),
("Soil Science and Land Management"),
("Special Education"),
("Special Education/Agricultural Science"),
("Special Education/Arabic"),
("Special Education/Biology"),
("Special Education/Business Education"),
("Special Education/Chemistry"),
("Special Education/Christian Studies"),
("Special Education/Computer Science"),
("Special Education/Economics"),
("Special Education/English"),
("Special Education/Fine Art (D/M)"),
("Special Education/French"),
("Special Education/Geography"),
("Special Education/Hausa"),
("Special Education/Home Economics (Double Major)"),
("Special Education/Igbo"),
("Special Education/Integrated Science"),
("Special Education/Islamic Studies"),
("Special Education/Mathematics"),
("Special Education/Music"),
("Special Education/Physical And Health Education"),
("Special Education/Social Studies"),
("Special Education/Theatre Arts"),
("Special Education/Yoruba"),
("Special Needs Education"),
("Sport Science"),
("Sport Science and Health Education"),
("Statistics"),
("Statistics Education"),
("Statistics and Computer Science"),
("Statistics/Computer Science Education"),
("Statistics/Demography"),
("Structural Engineering"),
("Surveying And Geoinformatics"),
("Surveying and Geo-Informatics"),
("Systems Engineering"),
("Taxation"),
("Teacher Education"),
("Teacher Education Science"),
("Technical Education"),
("Technological Management"),
("Technology Education"),
("Technology and Vocational Education"),
("Telecommunication And Wireless Technology"),
("Telecommunication Management"),
("Telecommunication Science"),
("Telecommuniction Engineering"),
("Textile Science and Technology"),
("Textile Technology"),
("Theatre And Film Studies"),
("Theatre And Media Arts"),
("Theatre And Performing Arts"),
("Theatre Art/Fine And Applied Art"),
("Theatre Art/Ika"),
("Theatre Arts"),
("Theatre Arts/Edo"),
("Theatre Arts/Irs"),
("Theatre Arts/Isoko"),
("Theatre Arts/Itsekiri"),
("Theatre Arts/Izon"),
("Theatre Arts/Social Studies"),
("Theatre Arts/Urhobo"),
("Theatre Arts/Yoruba"),
("Theology"),
("Tiv/Theatre Arts"),
("Tourism And Event Management"),
("Tourism Studies"),
("Transport And Planning"),
("Transport Management Technology"),
("Transport Planning and Management"),
("Transport Planning and Management Education (TPM)"),
("Transport and Tourism"),
("Ukwani/Social Studies"),
("Urban and Regional Planning"),
("Urhobo/English"),
("Urhobo/Social Studies"),
("Veterinary Medicine"),
("Veterinary Science"),
("Visual Arts and Technology"),
("Visualand Applied Arts"),
("Vocational Education"),
("Vocational Industrial Education"),
("Vocational and Technical Education"),
("Water Resources And Agrometeorology"),
("Water Resources Engineering Technology"),
("Water Resources and Environmental Engr."),
("Water Resources, Aquaculture and Fisheries Technology"),
("Welding and Fabrication Technology"),
("Wildlife Management"),
("Wildlife and Eco-Tourism"),
("Wood And Paper Technology"),
("Wood Product Engineering"),
("Wood Production Engineering"),
("Wood Work/Education"),
("Yoruba"),
("Yoruba / Social Studies"),
("Yoruba L1/Hausa L2"),
("Yoruba and Communication Arts"),
("Yoruba/Computer Science"),
("Yoruba/Mathematics"),
("Zoology"),
("Zoology and Aquaculture"),
("Zoology and Environmental Biology");

/* ediTABLE TABLES */
/******************************************************************/
CREATE TABLE IF NOT exists `school` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(200) NOT NULL, 
	year_of_est year NOT NULL,
	url text NULL,
	logo text NULL,
	state INT NOT NULL,
	FOREIGN KEY (state) REFERENCES static_states(id)
) ENGINE =INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `users` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	username VARCHAR(200) UNIQUE,
	password TEXT NOT NULL,
	email TEXT,
	profile_image TEXT,
	usertype INT,
	
	FOREIGN KEY (usertype) REFERENCES static_usertypes(id)
) ENGINE =INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `messages` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	msg_from INT NOT NULL,
	msg_to INT NOT NULL,
	msg_message LONGTEXT NULL,
	msg_subject TEXT NOT NULL,
	msg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	from_status INT NOT NULL DEFAULT '2',
	to_status INT NOT NULL DEFAULT '2',
	msg_status INT NOT NULL DEFAULT '2',
	
	FOREIGN KEY (msg_from) REFERENCES users(id),
	FOREIGN KEY (msg_to) REFERENCES users(id),
	FOREIGN KEY (from_status) REFERENCES static_message_status(id),
	FOREIGN KEY (to_status) REFERENCES static_message_status(id),
	FOREIGN KEY (msg_status) REFERENCES static_message_status(id)
) ENGINE =INNODB;


/******************************************************************/
CREATE TABLE IF NOT exists `scholarships` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	name VARCHAR(200) NOT NULL,
	requirements LONGTEXT NOT NULL,
	details LONGTEXT NOT NULL,
	image TEXT
) ENGINE =INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `documents` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	applicant INT NOT NULL,
	url TEXT
) ENGINE =INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `applicant` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	firstname VARCHAR(250) NOT NULL,
	middlename VARCHAR(250) NOT NULL,
	lastname VARCHAR(250) NOT NULL,
	years_of_expirence INT,
	extra_notes longtext,
	
	user INT NOT NULL,
	gender INT NOT NULL,
	highest_qualification INT,
	payment_options INT,
	country_of_study INT,
	english_level INT,
	start_semester INT,
	nationality INT NOT NULL,
	
	FOREIGN KEY (user) REFERENCES users(id),
	
	FOREIGN KEY (gender) REFERENCES static_gender(id),
	FOREIGN KEY (highest_qualification) REFERENCES static_highest_qualification(id),
	FOREIGN KEY (payment_options) REFERENCES static_payment_options(id),
	FOREIGN KEY (country_of_study) REFERENCES static_country(id),
	FOREIGN KEY (english_level) REFERENCES static_english_level(id),
	FOREIGN KEY (nationality) REFERENCES static_country(id),
	
	FOREIGN KEY (start_semester) REFERENCES static_semesters(id)
) ENGINE =INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `applications` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	applicant INT NOT NULL,
	subdiscipline INT,
	semester INT NOT NULL,
	status INT NOT NULL,
	delivery_mode INT NOT NULL,
	educational_variant INT NOT NULL,
	creation_date DATETIME NOT NULL,
 	last_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
	FOREIGN KEY (applicant) REFERENCES users(id),
	FOREIGN KEY (subdiscipline) REFERENCES static_sub_disciplines(id),
	FOREIGN KEY (semester) REFERENCES static_semesters(id),
	FOREIGN KEY (status) REFERENCES static_application_status(id),
	FOREIGN KEY (delivery_mode) REFERENCES static_delivery_mode(id),
	FOREIGN KEY (educational_variant) REFERENCES static_educational_variant(id)
) ENGINE =INNODB;

CREATE TABLE IF NOT exists `news` (
	id INT NOT NULL AUTO_INCREMENT PRIMARY key,
	subject TEXT NOT NULL,
	date DATETIME NOT NULL,
	details LONGTEXT NOT NULL
) ENGINE =INNODB;


/* connection or relationship TABLEs */
/******************************************************************/
CREATE TABLE IF NOT exists `schoolToSemesters` (
	id INT NOT NULL AUTO_INCREMENT,
	school INT NOT NULL,
	semester INT NOT NULL,
	FOREIGN KEY (school) REFERENCES `school`(id),
	FOREIGN KEY (semester) REFERENCES `static_semesters`(id),
	PRIMARY KEY (id, school, semester),
	UNIQUE KEY (semester, school)
) ENGINE =INNODB;  

/******************************************************************/
CREATE TABLE IF NOT exists `schoolToApplications` (
	id INT NOT NULL AUTO_INCREMENT,
	application INT,
	school INT,
	FOREIGN KEY (application) REFERENCES `applications`(id),
	FOREIGN KEY (school) REFERENCES `school`(id),
	PRIMARY KEY (id, school, application),
	UNIQUE KEY (application, school)
) ENGINE = INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `schoolToNews` (
	id INT NOT NULL AUTO_INCREMENT,
	school INT,
	news INT,
	
	FOREIGN KEY (news) REFERENCES `news`(id),
	FOREIGN KEY (school) REFERENCES `school`(id),
	PRIMARY KEY (id, news, school),
	UNIQUE KEY (news, school)
) ENGINE = INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `schoolToDisciplines` (
	id INT NOT NULL AUTO_INCREMENT,
	discipline INT,
	school INT,
	
	FOREIGN KEY (school) REFERENCES `school`(id),
	FOREIGN KEY (discipline) REFERENCES `static_sub_disciplines`(id),
	PRIMARY KEY (id, discipline, school),
	UNIQUE KEY (discipline, school)
) ENGINE = INNODB;

/******************************************************************/
CREATE TABLE IF NOT exists `schoolToUsers` (
	id INT NOT NULL AUTO_INCREMENT,
	school INT,
	user INT,
	
	FOREIGN KEY (school) REFERENCES `school`(id),
	FOREIGN KEY (user) REFERENCES `users`(id),
	PRIMARY KEY (id, school, user),
	UNIQUE KEY (school, user)
) ENGINE = INNODB;

