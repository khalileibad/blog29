<?php
	/**
	* class kb9
	* for contacting kb9
	*/
	class kb9
	{
		/**The Default Method Like Main in java*/
		function __construct()
		{
		}
		
		public static $land_type 		= array("RESID"		=>array("AR"=>"سكني","EN"=>"residential")
												,"COMM"		=>array("AR"=>"تجاري","EN"=>"commercial")
												,"OTHER"	=>array("AR"=>"اخرى","EN"=>"Other")
												);
		
		public static $house_live_type 	= array("OWNER"		=>array("AR"=>"مالك","EN"=>"Oner")
												,"TENANT"	=>array("AR"=>"مستأجر","EN"=>"Tenant")
												,"OTHER"	=>array("AR"=>"اخرى","EN"=>"Other")
												);
		
		public static $gender 			= array("M"			=>array("AR"=>"ذكر","EN"=>"Male")
												,"F"		=>array("AR"=>"أنثى","EN"=>"Female")
												);
		
		public static $Religion 		= array("MUS"		=> array('AR'=>"مسلم",'EN'=>"Muslim")
												,"CRS"		=> array('AR'=>"مسيحي",'EN'=>"Christian")
												,"OTH"		=> array('AR'=>"أخرى",'EN'=>"other")
												);
		
		public static $blood_types		= array("A-P"		=>"A+"
												,"A-M"		=>"A-"
												,"B-P"		=>"B+"
												,"B-M"		=>"B-"
												,"AB-P"		=>"AB+"
												,"AB-M"		=>"AB-"
												,"O-P"		=>"O+"
												,"O-M"		=>"0-"
												);
		
		public static $id_type 			= array("NAT_CARD"	=> array('AR'=>"بطاقة قومية",'EN'=>"National card")
												,"NAT_NO"	=> array('AR'=>"رقم وطني",'EN'=>"National Number")
												,"PASS"		=> array('AR'=>"جواز سفر",'EN'=>"Passport")
												,"DRIVE"	=> array('AR'=>"رخصة قيادة",'EN'=>"Driving License")
												,"NAT"		=> array('AR'=>"الجنسية",'EN'=>"Nationality")
												);
		
		
		public static $Social 			= array("CELI"		=> array('AR'=>"عازب",'EN'=>"Celibate")
												,"MARR"		=> array('AR'=>"متزوج",'EN'=>"Married")
												,"WIDO"		=> array('AR'=>"ارمل",'EN'=>"Widower")
												,"ABSO"		=> array('AR'=>"مطلق",'EN'=>"absolute")
												);
		
		public static $Acadimic 		= array("BASIC"		=> array('AR'=>"اساس",'EN'=>"Basis")
												,"SECO"		=> array('AR'=>"ثانوي",'EN'=>"secondary")
												,"UNIV"		=> array('AR'=>"جامعي",'EN'=>"University")
												,"ABOV"		=> array('AR'=>"فوق الجامعي",'EN'=>"Above the university")
												);
		
		
		public static $relation 		= array("HUS"		=> array('AR'=>"زوج / زوجة",'EN'=>"Husband / Wife")
												,"PARENT"	=> array('AR'=>"والد/ والدة",'EN'=>"Parent")
												,"BROTH"	=> array('AR'=>"أخ / أخت",'EN'=>"Brother / Sister")
												,"SON"		=> array('AR'=>"إبن / إبنة",'EN'=>"ٍSon / Daughter")
												,"OTH"		=> array('AR'=>"أخرى",'EN'=>"Other")
												);
		
		
		public static $countries		= array('AD'	=>array('AR'=>'أندورا','EN'=>'Andorra'),
												'AE'	=>array('AR'=>'الامارات','EN'=>'United Arab Emirates'),
												'AF'	=>array('AR'=>'أفغانستان','EN'=>'Afghanistan'),
												'AG'	=>array('AR'=>'أنتيغوا وبربودا','EN'=>'Antigua And Barbuda'),
												'AI'	=>array('AR'=>'أنغيلا','EN'=>'Anguilla'),
												'AL'	=>array('AR'=>'ألبانيا','EN'=>'Albania'),
												'AM'	=>array('AR'=>'أرمينيا','EN'=>'Armenia'),
												'AO'	=>array('AR'=>'أنغولا','EN'=>'Angola'),
												'AQ'	=>array('AR'=>'القارة القطبية الجنوبية','EN'=>'Antarctica'),
												'AR'	=>array('AR'=>'الأرجنتين','EN'=>'Argentina'),
												'AS'	=>array('AR'=>'ساموا الأمريكية','EN'=>'American Samoa'),
												'AT'	=>array('AR'=>'النمسا','EN'=>'Austria'),
												'AU'	=>array('AR'=>'أستراليا','EN'=>'Australia'),
												'AW'	=>array('AR'=>'أروبا','EN'=>'Aruba'),
												'AX'	=>array('AR'=>'جزر آلاند','EN'=>'Aland Islands'),
												'AZ'	=>array('AR'=>'أذربيجان','EN'=>'Azerbaijan'),
												
												'BA'	=>array('AR'=>'البوسنة والهرسك','EN'=>'Bosnia And Herzegovina'),
												'BB'	=>array('AR'=>'بربادوس','EN'=>'Barbados'),
												'BD'	=>array('AR'=>'بنغلاديش','EN'=>'Bangladesh'),
												'BE'	=>array('AR'=>'بلجيكا','EN'=>'Belgium'),
												'BF'	=>array('AR'=>'بوركينا فاسو','EN'=>'Burkina Faso'),
												'BG'	=>array('AR'=>'بلغاريا','EN'=>'Bulgaria'),
												'BH'	=>array('AR'=>'البحرين','EN'=>'Bahrain'),
												'BI'	=>array('AR'=>'بوروندي','EN'=>'Burundi'),
												'BJ'	=>array('AR'=>'بنين','EN'=>'Benin'),
												'BL'	=>array('AR'=>'سانت بارتيليمي','EN'=>'Saint Barthélemy'),
												'BM'	=>array('AR'=>'برمودا','EN'=>'Bermuda'),
												'BN'	=>array('AR'=>'بروناي دار السلام','EN'=>'Brunei Darussalam'),
												'BO'	=>array('AR'=>'بوليفيا','EN'=>'Bolivia, Plurinational State Of'),
												'BQ'	=>array('AR'=>'Bonaire, Sint Eustatius And Saba','EN'=>'Bonaire, Sint Eustatius And Saba'),
												'BR'	=>array('AR'=>'البرازيل','EN'=>'Brazil'),
												'BS'	=>array('AR'=>'جزر البهاما','EN'=>'Bahamas'),
												'BT'	=>array('AR'=>'بوتان','EN'=>'Bhutan'),
												'BV'	=>array('AR'=>'جزيرة بوفيت','EN'=>'Bouvet Island'),
												'BW'	=>array('AR'=>'بوتسوانا','EN'=>'Botswana'),
												'BY'	=>array('AR'=>'روسيا البيضاء','EN'=>'Belarus'),
												'BZ'	=>array('AR'=>'بليز','EN'=>'Belize'),
												
												'CA'	=>array('AR'=>'كندا','EN'=>'Canada'),
												'CC'	=>array('AR'=>'كوكوس (كيلينغ) ، جزر','EN'=>'Cocos (Keeling) Islands'),
												'CD'	=>array('AR'=>'الكنغو','EN'=>'Congo, The Democratic Republic Of The'),
												'CF'	=>array('AR'=>'أفريقيا الوسطى','EN'=>'Central African Republic'),
												'CG'	=>array('AR'=>'الكونغو','EN'=>'الكونغو'),
												'CH'	=>array('AR'=>'سويسرا','EN'=>'Switzerland'),
												'CI'	=>array('AR'=>'كوت ديفوار','EN'=>'Cote D Ivoire'),
												'CK'	=>array('AR'=>'جزر كوك','EN'=>'Cook Islands'),
												'CL'	=>array('AR'=>'شيلي','EN'=>'Chile'),
												'CM'	=>array('AR'=>'الكاميرون','EN'=>'Cameroon'),
												'CN'	=>array('AR'=>'الصين','EN'=>'China'),
												'CO'	=>array('AR'=>'كولومبيا','EN'=>'Colombia'),
												'CR'	=>array('AR'=>'كوستاريكا','EN'=>'Costa Rica'),
												'CU'	=>array('AR'=>'كوبا','EN'=>'Cuba'),
												'CV'	=>array('AR'=>'الرأس الأخضر','EN'=>'Cabo Verde'),
												'CW'	=>array('AR'=>'Curaçao','EN'=>'Curaçao'),
												'CX'	=>array('AR'=>'جزيرة كريسماس','EN'=>'Christmas Island'),
												'CY'	=>array('AR'=>'قبرص','EN'=>'Cyprus'),
												'CZ'	=>array('AR'=>'الجمهورية التشيكية','EN'=>'Czech Republic'),
											
												'DE'	=>array('AR'=>'ألمانيا','EN'=>'Germany'),
												'DJ'	=>array('AR'=>'جيبوتي','EN'=>'Djibouti'),
												'DK'	=>array('AR'=>'الدنمارك','EN'=>'Denmark'),
												'DM'	=>array('AR'=>'دومينيكا','EN'=>'دومينيكا'),
												'DO'	=>array('AR'=>'جمهورية الدومينيكان','EN'=>'Dominican Republic'),
												'DZ'	=>array('AR'=>'الجزائر','EN'=>'Algeria'),
											
												'EC'	=>array('AR'=>'الاكوادور','EN'=>'Ecuador'),
												'EE'	=>array('AR'=>'استونيا','EN'=>'Estonia'),
												'EG'	=>array('AR'=>'مصر','EN'=>'Egypt'),
												'EH'	=>array('AR'=>'الصحراء الغربية','EN'=>'Western Sahara'),
												'ER'	=>array('AR'=>'اريتريا','EN'=>'Eritrea'),
												'ES'	=>array('AR'=>'إسبانيا','EN'=>'Spain'),
												'ET'	=>array('AR'=>'أثيوبيا','EN'=>'Ethiopia'),
											
												'FI'	=>array('AR'=>'فنلندا','EN'=>'Finland'),
												'FJ'	=>array('AR'=>'فيجي','EN'=>'Fiji'),
												'FK'	=>array('AR'=>'جزر فوكلاند','EN'=>'Falkland Islands (Malvinas)'),
												'FM'	=>array('AR'=>'ميكرونيزين','EN'=>'Micronesia, Federated States Of'),
												'FO'	=>array('AR'=>'جزر فارو','EN'=>'Faroe Islands'),
												'FR'	=>array('AR'=>'فرنسا','EN'=>'France'),
												
												'GA'	=>array('AR'=>'الغابون','EN'=>'Gabon'),
												'GB'	=>array('AR'=>'المملكة المتحدة','EN'=>'United Kingdom'),
												'GD'	=>array('AR'=>'غرينادا','EN'=>'Grenada'),
												'GE'	=>array('AR'=>'جورجيا','EN'=>'Georgia'),
												'GF'	=>array('AR'=>'غيانا الفرنسية','EN'=>'French Guiana'),
												'GG'	=>array('AR'=>'غيرنسي','EN'=>'Guernsey'),
												'GH'	=>array('AR'=>'غانا','EN'=>'Ghana'),
												'GI'	=>array('AR'=>'جبل طارق','EN'=>'Gibraltar'),
												'GL'	=>array('AR'=>'جرينلاند','EN'=>'Greenland'),
												'GM'	=>array('AR'=>'غامبيا','EN'=>'Gambia'),
												'GN'	=>array('AR'=>'غينيا','EN'=>'Guinea'),
												'GP'	=>array('AR'=>'غواديلوب','EN'=>'Guadeloupe'),
												'GQ'	=>array('AR'=>'غينيا الاستوائية','EN'=>'Equatorial Guinea'),
												'GR'	=>array('AR'=>'اليونان','EN'=>'Greece'),
												'GS'	=>array('AR'=>'جورجيا الجنوبية وجزر ساندويتش الجنوبية','EN'=>'South Georgia And The South Sandwich Islands'),
												'GT'	=>array('AR'=>'غواتيمالا','EN'=>'Guatemala'),
												'GU'	=>array('AR'=>'غوام','EN'=>'Guam'),
												'GW'	=>array('AR'=>'غينيا بيساو','EN'=>'Guinea-Bissau'),
												'GY'	=>array('AR'=>'غيانا','EN'=>'Guyana'),
												
												'HK'	=>array('AR'=>'هونج كونج','EN'=>'Hong Kong'),
												'HM'	=>array('AR'=>'جزيرة هيرد وجزر ماكدونالد','EN'=>'Heard Island And Mcdonald Islands'),
												'HN'	=>array('AR'=>'هندوراس','EN'=>'Honduras'),
												'HR'	=>array('AR'=>'كرواتيا','EN'=>'Croatia'),
												'HT'	=>array('AR'=>'هايتي','EN'=>'Haiti'),
												'HU'	=>array('AR'=>'هنغاريا','EN'=>'Hungary'),
												
												'ID'	=>array('AR'=>'أندونيسيا','EN'=>'Indonesia'),
												'IE'	=>array('AR'=>'أيرلندا','EN'=>'Ireland'),
												'IL'	=>array('AR'=>'إسرائيل','EN'=>'Israel'),
												'IM'	=>array('AR'=>'جزيرة مان','EN'=>'Isle Of Man'),
												'IN'	=>array('AR'=>'الهند','EN'=>'India'),
												'IO'	=>array('AR'=>'إقليم المحيط الهندي البريطاني','EN'=>'British Indian Ocean Territory'),
												'IQ'	=>array('AR'=>'العراق','EN'=>'Iraq'),
												'IR'	=>array('AR'=>'إيران','EN'=>'Iran, Islamic Republic Of'),
												'IS'	=>array('AR'=>'أيسلندا','EN'=>'Iceland'),
												'IT'	=>array('AR'=>'إيطاليا','EN'=>'Italy'),
												
												'JE'	=>array('AR'=>'جيرسي','EN'=>'Jersey'),
												'JM'	=>array('AR'=>'جامايكا','EN'=>'Jamaica'),
												'JO'	=>array('AR'=>'الأردن','EN'=>'Jordan'),
												'JP'	=>array('AR'=>'اليابان','EN'=>'Japan'),
												
												'KE'	=>array('AR'=>'كينيا','EN'=>'Kenya'),
												'KG'	=>array('AR'=>'قيرغيزستان','EN'=>'Kyrgyzstan'),
												'KH'	=>array('AR'=>'كمبوديا','EN'=>'Cambodia'),
												'KI'	=>array('AR'=>'كيريباتي','EN'=>'Kiribati'),
												'KM'	=>array('AR'=>'جزر القمر','EN'=>'Comoros'),
												'KN'	=>array('AR'=>'سانت كيتس ونيفيس','EN'=>'Saint Kitts And Nevis'),
												'KP'	=>array('AR'=>'جمهورية كوريا الديمقراطية الشعبية','EN'=>'Korea, Democratic People\'s Republic Of'),
												'KR'	=>array('AR'=>'جمهورية كوريا','EN'=>'Korea, Republic Of'),
												'KW'	=>array('AR'=>'الكويت','EN'=>'Kuwait'),
												'KY'	=>array('AR'=>'جزر كايمان','EN'=>'Cayman Islands'),
												'KZ'	=>array('AR'=>'كازاخستان','EN'=>'Kazakhstan'),
											
												'LA'	=>array('AR'=>'جمهورية لاوس الديمقراطية الشعبية','EN'=>'Lao People\'s Democratic Republic'),
												'LB'	=>array('AR'=>'لبنان','EN'=>'Lebanon'),
												'LC'	=>array('AR'=>'سانت لوسيا','EN'=>'Saint Lucia'),
												'LI'	=>array('AR'=>'ليختنشتاين','EN'=>'Liechtenstein'),
												'LK'	=>array('AR'=>'سري لانكا','EN'=>'Sri Lanka'),
												'LR'	=>array('AR'=>'ليبيريا','EN'=>'Liberia'),
												'LS'	=>array('AR'=>'ليسوتو','EN'=>'Lesotho'),
												'LT'	=>array('AR'=>'ليتوانيا','EN'=>'Lithuania'),
												'LU'	=>array('AR'=>'لوكسمبورغ','EN'=>'Luxembourg'),
												'LV'	=>array('AR'=>'لاتفيا','EN'=>'Latvia'),
												'LY'	=>array('AR'=>'ليبيا','EN'=>'Libya'),
												
												'MA'	=>array('AR'=>'المغرب','EN'=>'Morocco'),
												'MC'	=>array('AR'=>'موناكو','EN'=>'Monaco'),
												'MD'	=>array('AR'=>'جمهورية مولدوفا','EN'=>'Moldova, Republic Of'),
												'ME'	=>array('AR'=>'الجبل الأسود','EN'=>'Montenegro'),
												'MF'	=>array('AR'=>'سانت مارتن','EN'=>'Saint Martin (French Part)'),
												'MG'	=>array('AR'=>'مدغشقر','EN'=>'Madagascar'),
												'MH'	=>array('AR'=>'جزر مارشال','EN'=>'Marshall Islands'),
												'MK'	=>array('AR'=>'يوغوسلافيا','EN'=>'Macedonia, The Former Yugoslav Republic Of'),
												'ML'	=>array('AR'=>'مالي','EN'=>'Mali'),
												'MM'	=>array('AR'=>'ميانمار','EN'=>'Myanmar'),
												'MN'	=>array('AR'=>'منغوليا','EN'=>'Mongolia'),
												'MO'	=>array('AR'=>'ماكاو','EN'=>'Macao'),
												'MP'	=>array('AR'=>'جزر ماريانا الشمالية','EN'=>'Northern Mariana Islands'),
												'MQ'	=>array('AR'=>'مارتينيك','EN'=>'Martinique'),
												'MR'	=>array('AR'=>'موريتانيا','EN'=>'Mauritania'),
												'MS'	=>array('AR'=>'مونتسيرات','EN'=>'Montserrat'),
												'MT'	=>array('AR'=>'مالطا','EN'=>'Malta'),
												'MU'	=>array('AR'=>'موريشيوس','EN'=>'Mauritius'),
												'MV'	=>array('AR'=>'جزر المالديف','EN'=>'Maldives'),
												'MW'	=>array('AR'=>'ملاوي','EN'=>'Malawi'),
												'MX'	=>array('AR'=>'المكسيك','EN'=>'Mexico'),
												'MY'	=>array('AR'=>'ماليزيا','EN'=>'Malaysia'),
												'MZ'	=>array('AR'=>'موزامبيق','EN'=>'Mozambique'),
											
												'NA'	=>array('AR'=>'ناميبيا','EN'=>'Namibia'),
												'NC'	=>array('AR'=>'كاليدونيا الجديدة','EN'=>'New Caledonia'),
												'NE'	=>array('AR'=>'النيجر','EN'=>'Niger'),
												'NF'	=>array('AR'=>'جزيرة نورفولك','EN'=>'Norfolk Island'),
												'NG'	=>array('AR'=>'نيجيريا','EN'=>'Nigeria'),
												'NI'	=>array('AR'=>'نيكاراغوا','EN'=>'Nicaragua'),
												'NL'	=>array('AR'=>'هولندا','EN'=>'Netherlands'),
												'NO'	=>array('AR'=>'النرويج','EN'=>'Norway'),
												'NP'	=>array('AR'=>'نيبال','EN'=>'Nepal'),
												'NR'	=>array('AR'=>'ناورو','EN'=>'Nauru'),
												'NU'	=>array('AR'=>'نيوي','EN'=>'Niue'),
												'NZ'	=>array('AR'=>'نيوزيلندا','EN'=>'New Zealand'),
												
												'OM'	=>array('AR'=>'عمان','EN'=>'Oman'),
												
												'PA'	=>array('AR'=>'بنما','EN'=>'Panama'),
												'PE'	=>array('AR'=>'بيرو','EN'=>'Peru'),
												'PF'	=>array('AR'=>'بولينيزيا الفرنسية','EN'=>'French Polynesia'),
												'PG'	=>array('AR'=>'بابوا غينيا الجديدة','EN'=>'Papua New Guinea'),
												'PH'	=>array('AR'=>'الفلبين','EN'=>'Philippines'),
												'PK'	=>array('AR'=>'باكستان','EN'=>'Pakistan'),
												'PL'	=>array('AR'=>'بولندا','EN'=>'Poland'),
												'PM'	=>array('AR'=>'سان بيار وميكلون','EN'=>'Saint Pierre And Miquelon'),
												'PN'	=>array('AR'=>'بيتكيرن','EN'=>'Pitcairn'),
												'PR'	=>array('AR'=>'بورتوريكو','EN'=>'Puerto Rico'),
												'PS'	=>array('AR'=>'الأراضي الفلسطينية والأراضي المحتلة','EN'=>'Palestine, State Of'),
												'PT'	=>array('AR'=>'البرتغال','EN'=>'Portugal'),
												'PW'	=>array('AR'=>'بالاو','EN'=>'Palau'),
												'PY'	=>array('AR'=>'باراغواي','EN'=>'Paraguay'),
												
												'QA'	=>array('AR'=>'قطر','EN'=>'Qatar'),
												
												'RE'	=>array('AR'=>'réunion','EN'=>'Réunion'),
												'RO'	=>array('AR'=>'رومانيا','EN'=>'Romania'),
												'RS'	=>array('AR'=>'صربيا','EN'=>'Serbia'),
												'RU'	=>array('AR'=>'روسيا الاتحادية','EN'=>'Russian Federation'),
												'RW'	=>array('AR'=>'رواندا','EN'=>'Rwanda'),
											
												'SA'	=>array('AR'=>'السعودية','EN'=>'Saudi Arabia'),
												'SB'	=>array('AR'=>'جزر سليمان','EN'=>'Solomon Islands'),
												'SC'	=>array('AR'=>'سيشيل','EN'=>'Seychelles'),
												'SD'	=>array('AR'=>'السودان','EN'=>'Sudan'),
												'SE'	=>array('AR'=>'السويد','EN'=>'Sweden'),
												'SG'	=>array('AR'=>'سنغافورة','EN'=>'Singapore'),
												'SH'	=>array('AR'=>'سانت هيلانة','EN'=>'Saint Helena, Ascension And Tristan Da Cunha'),
												'SI'	=>array('AR'=>'سلوفينيا','EN'=>'Slovenia'),
												'SJ'	=>array('AR'=>'سفالبارد وجان مايان','EN'=>'Svalbard And Jan Mayen'),
												'SK'	=>array('AR'=>'سلوفاكيا','EN'=>'Slovakia'),
												'SL'	=>array('AR'=>'سيراليون','EN'=>'Sierra Leone'),
												'SM'	=>array('AR'=>'سان مارينو','EN'=>'San Marino'),
												'SN'	=>array('AR'=>'السنغال','EN'=>'Senegal'),
												'SO'	=>array('AR'=>'الصومال','EN'=>'Somalia'),
												'SR'	=>array('AR'=>'سورينام','EN'=>'Suriname'),
												'SS'	=>array('AR'=>'جنوب السودان','EN'=>'South Sudan'),
												'ST'	=>array('AR'=>'سان تومي وبرينسيبي','EN'=>'Sao Tome And Principe'),
												'SV'	=>array('AR'=>'السلفادور','EN'=>'El Salvador'),
												'SX'	=>array('AR'=>'Sint Maarten','EN'=>'Sint Maarten (Dutch Part)'),
												'SY'	=>array('AR'=>'سوريا','EN'=>'Syrian Arab Republic'),
												'SZ'	=>array('AR'=>'سوازيلاند','EN'=>'Swaziland'),
												
												'TC'	=>array('AR'=>'جزر تركس وكايكوس','EN'=>'Turks And Caicos Islands'),
												'TD'	=>array('AR'=>'تشاد','EN'=>'Tchad'),
												'TF'	=>array('AR'=>'الأقاليم الجنوبية الفرنسية','EN'=>'French Southern Territories'),
												'TG'	=>array('AR'=>'توغو','EN'=>'Togo'),
												'TH'	=>array('AR'=>'تايلاند','EN'=>'Thailand'),
												'TJ'	=>array('AR'=>'طاجيكستان','EN'=>'Tajikistan'),
												'TK'	=>array('AR'=>'توكيلاو','EN'=>'Tokelau'),
												'TL'	=>array('AR'=>'تيمور الشرقية','EN'=>'Timor-Leste'),
												'TM'	=>array('AR'=>'تركمانستان','EN'=>'Turkmenistan'),
												'TN'	=>array('AR'=>'تونس','EN'=>'Tunisia'),
												'TO'	=>array('AR'=>'تونغا','EN'=>'Tonga'),
												'TR'	=>array('AR'=>'تركيا','EN'=>'Turkey'),
												'TT'	=>array('AR'=>'ترينيداد وتوباغو','EN'=>'Trinidad And Tobago'),
												'TV'	=>array('AR'=>'توفالو','EN'=>'Tuvalu'),
												'TW'	=>array('AR'=>'تايوان','EN'=>'Taiwan'),
												'TZ'	=>array('AR'=>'تنزانيا','EN'=>'Tanzania, United Republic Of'),
											
												'UA'	=>array('AR'=>'أوكرانيا','EN'=>'Ukraine'),
												'UG'	=>array('AR'=>'أوغندا','EN'=>'Uganda'),
												'UM'	=>array('AR'=>'جزر الولايات المتحدة البعيدة الصغيرة','EN'=>'United States Minor Outlying Islands'),
												'US'	=>array('AR'=>'الولايات المتحدة','EN'=>'United States'),
												'UY'	=>array('AR'=>'أوروغواي','EN'=>'Uruguay'),
												'UZ'	=>array('AR'=>'أوزبكستان','EN'=>'Uzbekistan'),
												
												'VA'	=>array('AR'=>'دولة الفاتيكان','EN'=>'Holy See (Vatican City State)'),
												'VC'	=>array('AR'=>'سانت فنسنت وغرينادين','EN'=>'Saint Vincent And The Grenadines'),
												'VE'	=>array('AR'=>'فنزويلا','EN'=>'Venezuela, Bolivarian Republic Of'),
												'VG'	=>array('AR'=>'الجزر العذراء البريطانية','EN'=>'Virgin Islands, British'),
												'VI'	=>array('AR'=>'الجزر العذراء ، الولايات المتحدة','EN'=>'Virgin Islands, U.S.'),
												'VN'	=>array('AR'=>'فيتنام','EN'=>'Viet Nam'),
												'VU'	=>array('AR'=>'فانواتو','EN'=>'Vanuatu'),
												
												'WF'	=>array('AR'=>'واليس وفوتونا','EN'=>'Wallis And Futuna'),
												'WS'	=>array('AR'=>'ساموا','EN'=>'Samoa'),
												
												'YE'	=>array('AR'=>'اليمن','EN'=>'Yemen'),
												'YT'	=>array('AR'=>'مايوت','EN'=>'Mayotte'),
												
												'ZA'	=>array('AR'=>'جنوب أفريقيا','EN'=>'South Africa'),
												'ZM'	=>array('AR'=>'زامبيا','EN'=>'Zambia'),
												'ZW'	=>array('AR'=>'زيمبابوي','EN'=>'Zimbabwe')
											);
		
		
		
		//save notification
		public static function save_notification($db, $data = array(),$type)
		{
			/*
			Type:
			1: Email (admin)
			2: New Registration
			
			
			
			3: transfire Booking (spec_dr)
			4: New DR (Group Admin)
			5: New Group (admin)
			6: Patient Booking actions
			*/
			
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$ans_array = array('noti_user'		=>1
								,'noti_type'	=>$type
								,'noti_title'	=>""
								,'noti_url'		=>""
								,'create_at'	=>$time
								);
			$send_noti = array();
			switch($type)
			{
				case 1:
					/*
					Email
					For Admin
					data: array('con_subject'	=>$fdata['subject'] // MSG subject
								,'con_name'		=>$fdata['name'] 	//Who Send MSG
								,'con_email'	=>$fdata['email']	//Who Send MSG Email
								,'con_msg'		=>$fdata['message'] // MSG
								,'con_date'		=>$time				// MSG Time
								);
					Pages:
					dashboard_model 	-> new_cont
					*/
					
					$ans_array['noti_title'] = "رسالة من ".$data['con_name']." راجع الايميل";
					array_push($send_noti,$ans_array);
				break;
				case 2:
					/*
					New Registration
					For Admin AND Statistics
					data: array('id'		=> ID
								,'req_name'	=> NAME
								,'req_land'	=> LAND NO
								,'req_card'	=> CARD NO
								,'req_email'=> Email
								,'req_phone'=> PHONE
								,'create_at'=> time
								);
					pages:
					login_model		->reg
					*/
					
					$ans_array['noti_title']= "طلب تسجيل جديد من ".$data['req_name']." ";
					$ans_array['noti_url'] 	= "reg/".$data['id'];
					array_push($send_noti,$ans_array);
				break;
				case 3:
					
				break;
				case 4:
					
				break;
				case 5:
					
				break;
				case 6:
					
				break;
				
			}
			
			//send_noti
			foreach($send_noti as $val)
			{
				$db->insert(DB_PREFEX.'notification',$val);
			}
			
		}
		
		//save notification
		public static function notification_read($db, $id ,$type)
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form = new form();
			
			if(empty($id) || empty($type))
			{
				$form	->post('id')
						->valid('Integer')
							
						->post('type')
						->valid('Integer')
							
						->submit();
				$d = $form->fetch();
				
				if(!empty($d['MSG']))
				{
					return array('Error'=>$d['MSG']);
				}
				
				$id = $d['id'];
				$type = $d['type'];
			}
			
			$table_name = "notification";
			$where = "1 != 1";
			switch($type)
			{
				case 1:
					/*
					Admin noti
					id: noti ID
					notificate	->read_noti() 
					*/
					$where = "noti_id = ".$id." AND noti_user = ".session::get('user_id');
				break;
				
				case 2:
				case 3:
					/*
					Booking noti
					New Booking
					transfire Booking
					id: book_id
					//actions		->booking()
					*/
					$where = "noti_book = ".$id;
					
				break;
				case 4:
					/*
					DR noti
					New DR
					id: DR_ID
					//staff		->index()
					*/
					$where = "noti_dr = ".$id;
					
				break;
				case 5:
					/*
					Group noti
					New Group
					id: Group_ID
					//group		->index()
					*/
					$where = "noti_gr = ".$id;
					
				break;
				case 6:
					/*
					Patient noti
					patient		->index()
					ID: Booking no
					*/
					
					$table_name = "pa_notification";
					$where = "noti_book = ".$id." 
							AND noti_book IN (SELECT bo_id FROM ".DB_PREFEX."booking
											WHERE bo_patient = ".session::get('user_id').")";
					
				break;
			}
			$db->update(DB_PREFEX.$table_name,array("noti_status"=>1),$where);
			return array('ok'=>1);
		}
		
	}
?>