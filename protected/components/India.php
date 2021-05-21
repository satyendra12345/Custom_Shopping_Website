<?php


namespace app\components;



class India {

	public static function cities($state = null) {

		if ($state != null && isset ( self::$indianCities [$state] ))

			return self::$indianCities [$state];



		$cities = [ ];

		foreach ( self::$indianCities as $state ) {

			$cities = array_merge ( $cities, $state );

		}

		return $cities;

	}

	public static function states() {

		return array_keys ( self::$indianCities );

	}

	public static $indianCities = array (

			'Andaman and Nicobar' => array (

					'North and Middle Andaman',

					'South Andaman',

					'Nicobar'

			),

			'Andhra Pradesh' => array (

					'Adilabad',

					'Anantapur',

					'Chittoor',

					'East Godavari',

					'Guntur',

					'Hyderabad',

					'Kadapa',

					'Karimnagar',

					'Khammam',

					'Krishna',

					'Kurnool',

					'Mahbubnagar',

					'Medak',

					'Nalgonda',

					'Nellore',

					'Nizamabad',

					'Prakasam',

					'Rangareddi',

					'Srikakulam',

					'Vishakhapatnam',

					'Vizianagaram',

					'Warangal',

					'West Godavari'

			),

			'Arunachal Pradesh' => array (

					'Anjaw',

					'Changlang',

					'East Kameng',

					'Lohit',

					'Lower Subansiri',

					'Papum Pare',

					'Tirap',

					'Dibang Valley',

					'Upper Subansiri',

					'West Kameng'

			),

			'Assam' => array (

					'Barpeta',

					'Bongaigaon',

					'Cachar',

					'Darrang',

					'Dhemaji',

					'Dhubri',

					'Dibrugarh',

					'Goalpara',

					'Golaghat',

					'Hailakandi',

					'Jorhat',

					'Karbi Anglong',

					'Karimganj',

					'Kokrajhar',

					'Lakhimpur',

					'Marigaon',

					'Nagaon',

					'Nalbari',

					'North Cachar Hills',

					'Sibsagar',

					'Sonitpur',

					'Tinsukia'

			),

			'Bihar' => array (

					'Araria',

					'Aurangabad',

					'Banka',

					'Begusarai',

					'Bhagalpur',

					'Bhojpur',

					'Buxar',

					'Darbhanga',

					'Purba Champaran',

					'Gaya',

					'Gopalganj',

					'Jamui',

					'Jehanabad',

					'Khagaria',

					'Kishanganj',

					'Kaimur',

					'Katihar',

					'Lakhisarai',

					'Madhubani',

					'Munger',

					'Madhepura',

					'Muzaffarpur',

					'Nalanda',

					'Nawada',

					'Patna',

					'Purnia',

					'Rohtas',

					'Saharsa',

					'Samastipur',

					'Sheohar',

					'Sheikhpura',

					'Saran',

					'Sitamarhi',

					'Supaul',

					'Siwan',

					'Vaishali',

					'Pashchim Champaran'

			),

			'Chandigarh' => array (),

			'Chhattisgarh' => array (

					'Bastar',

					'Bilaspur',

					'Dantewada',

					'Dhamtari',

					'Durg',

					'Jashpur',

					'Janjgir-Champa',

					'Korba',

					'Koriya',

					'Kanker',

					'Kawardha',

					'Mahasamund',

					'Raigarh',

					'Rajnandgaon',

					'Raipur',

					'Surguja'

			),

			'Dadra and Nagar Haveli' => array (),

			'Daman and Diu' => array (

					'Diu',

					'Daman'

			),

			'Delhi' => array (

					'Central Delhi',

					'East Delhi',

					'New Delhi',

					'North Delhi',

					'North East Delhi',

					'North West Delhi',

					'South Delhi',

					'South West Delhi',

					'West Delhi'

			),

			'Goa' => array (

					'North Goa',

					'South Goa'

			),

			'Gujarat' => array (

					'Ahmedabad',

					'Amreli District',

					'Anand',

					'Banaskantha',

					'Bharuch',

					'Bhavnagar',

					'Dahod',

					'The Dangs',

					'Gandhinagar',

					'Jamnagar',

					'Junagadh',

					'Kutch',

					'Kheda',

					'Mehsana',

					'Narmada',

					'Navsari',

					'Patan',

					'Panchmahal',

					'Porbandar',

					'Rajkot',

					'Sabarkantha',

					'Surendranagar',

					'Surat',

					'Vadodara',

					'Valsad'

			),

			'Haryana' => array (

					'Ambala',

					'Bhiwani',

					'Faridabad',

					'Fatehabad',

					'Gurgaon',

					'Hissar',

					'Jhajjar',

					'Jind',

					'Karnal',

					'Kaithal',

					'Kurukshetra',

					'Mahendragarh',

					'Mewat',

					'Panchkula',

					'Panipat',

					'Rewari',

					'Rohtak',

					'Sirsa',

					'Sonepat',

					'Yamuna Nagar',

					'Palwal'

			),

			'Himachal Pradesh' => array (

					'Bilaspur',

					'Chamba',

					'Hamirpur',

					'Kangra',

					'Kinnaur',

					'Kulu',

					'Lahaul and Spiti',

					'Mandi',

					'Shimla',

					'Sirmaur',

					'Solan',

					'Una'

			),

			'Jammu and Kashmir' => array (

					'Anantnag',

					'Badgam',

					'Bandipore',

					'Baramula',

					'Doda',

					'Jammu',

					'Kargil',

					'Kathua',

					'Kupwara',

					'Leh',

					'Poonch',

					'Pulwama',

					'Rajauri',

					'Srinagar',

					'Samba',

					'Udhampur'

			),

			'Jharkhand' => array (

					'Bokaro',

					'Chatra',

					'Deoghar',

					'Dhanbad',

					'Dumka',

					'Purba Singhbhum',

					'Garhwa',

					'Giridih',

					'Godda',

					'Gumla',

					'Hazaribagh',

					'Koderma',

					'Lohardaga',

					'Pakur',

					'Palamu',

					'Ranchi',

					'Sahibganj',

					'Seraikela and Kharsawan',

					'Pashchim Singhbhum',

					'Ramgarh'

			),

			'Karnataka' => array (

					'Bidar',

					'Belgaum',

					'Bijapur',

					'Bagalkot',

					'Bellary',

					'Bangalore Rural District',

					'Bangalore Urban District',

					'Chamarajnagar',

					'Chikmagalur',

					'Chitradurga',

					'Davanagere',

					'Dharwad',

					'Dakshina Kannada',

					'Gadag',

					'Gulbarga',

					'Hassan',

					'Haveri District',

					'Kodagu',

					'Kolar',

					'Koppal',

					'Mandya',

					'Mysore',

					'Raichur',

					'Shimoga',

					'Tumkur',

					'Udupi',

					'Uttara Kannada',

					'Ramanagara',

					'Chikballapur',

					'Yadagiri'

			),

			'Kerala' => array (

					'Alappuzha',

					'Ernakulam',

					'Idukki',

					'Kollam',

					'Kannur',

					'Kasaragod',

					'Kottayam',

					'Kozhikode',

					'Malappuram',

					'Palakkad',

					'Pathanamthitta',

					'Thrissur',

					'Thiruvananthapuram',

					'Wayanad'

			),

			'Lakshadweep' => array (),

			'Madhya Pradesh' => array (

					'Alirajpur',

					'Anuppur',

					'Ashok Nagar',

					'Balaghat',

					'Barwani',

					'Betul',

					'Bhind',

					'Bhopal',

					'Burhanpur',

					'Chhatarpur',

					'Chhindwara',

					'Damoh',

					'Datia',

					'Dewas',

					'Dhar',

					'Dindori',

					'Guna',

					'Gwalior',

					'Harda',

					'Hoshangabad',

					'Indore',

					'Jabalpur',

					'Jhabua',

					'Katni',

					'Khandwa',

					'Khargone',

					'Mandla',

					'Mandsaur',

					'Morena',

					'Narsinghpur',

					'Neemuch',

					'Panna',

					'Rewa',

					'Rajgarh',

					'Ratlam',

					'Raisen',

					'Sagar',

					'Satna',

					'Sehore',

					'Seoni',

					'Shahdol',

					'Shajapur',

					'Sheopur',

					'Shivpuri',

					'Sidhi',

					'Singrauli',

					'Tikamgarh',

					'Ujjain',

					'Umaria',

					'Vidisha'

			),

			'Maharashtra' => array (

					'Ahmednagar',

					'Akola',

					'Amrawati',

					'Aurangabad',

					'Bhandara',

					'Beed',

					'Buldhana',

					'Chandrapur',

					'Dhule',

					'Gadchiroli',

					'Gondiya',

					'Hingoli',

					'Jalgaon',

					'Jalna',

					'Kolhapur',

					'Latur',

					'Mumbai City',

					'Mumbai suburban',

					'Nandurbar',

					'Nanded',

					'Nagpur',

					'Nashik',

					'Osmanabad',

					'Parbhani',

					'Pune',

					'Raigad',

					'Ratnagiri',

					'Sindhudurg',

					'Sangli',

					'Solapur',

					'Satara',

					'Thane',

					'Wardha',

					'Washim',

					'Yavatmal'

			),

			'Manipur' => array (

					'Bishnupur',

					'Churachandpur',

					'Chandel',

					'Imphal East',

					'Senapati',

					'Tamenglong',

					'Thoubal',

					'Ukhrul',

					'Imphal West'

			),

			'Meghalaya' => array (

					'East Garo Hills',

					'East Khasi Hills',

					'Jaintia Hills',

					'Ri-Bhoi',

					'South Garo Hills',

					'West Garo Hills',

					'West Khasi Hills'

			),

			'Mizoram' => array (

					'Aizawl',

					'Champhai',

					'Kolasib',

					'Lawngtlai',

					'Lunglei',

					'Mamit',

					'Saiha',

					'Serchhip'

			),

			'Nagaland' => array (

					'Dimapur',

					'Kohima',

					'Mokokchung',

					'Mon',

					'Phek',

					'Tuensang',

					'Wokha',

					'Zunheboto'

			),

			'Orissa' => array (

					'Angul',

					'Boudh',

					'Bhadrak',

					'Bolangir',

					'Bargarh',

					'Baleswar',

					'Cuttack',

					'Debagarh',

					'Dhenkanal',

					'Ganjam',

					'Gajapati',

					'Jharsuguda',

					'Jajapur',

					'Jagatsinghpur',

					'Khordha',

					'Kendujhar',

					'Kalahandi',

					'Kandhamal',

					'Koraput',

					'Kendrapara',

					'Malkangiri',

					'Mayurbhanj',

					'Nabarangpur',

					'Nuapada',

					'Nayagarh',

					'Puri',

					'Rayagada',

					'Sambalpur',

					'Subarnapur',

					'Sundargarh'

			),

			'Puducherry' => array (

					'Karaikal',

					'Mahe',

					'Puducherry',

					'Yanam'

			),

			'Punjab' => array (

					'Amritsar',

					'Bathinda',

					'Firozpur',

					'Faridkot',

					'Fatehgarh Sahib',

					'Gurdaspur',

					'Hoshiarpur',

					'Jalandhar',

					'Kapurthala',

					'Ludhiana',

					'Mansa',

					'Moga',

					'Mukatsar',

					'Nawan Shehar',

					'Patiala',

					'Rupnagar',

					'Sangrur'

			),

			'Rajasthan' => array (

					'Ajmer',

					'Alwar',

					'Bikaner',

					'Barmer',

					'Banswara',

					'Bharatpur',

					'Baran',

					'Bundi',

					'Bhilwara',

					'Churu',

					'Chittorgarh',

					'Dausa',

					'Dholpur',

					'Dungapur',

					'Ganganagar',

					'Hanumangarh',

					'Juhnjhunun',

					'Jalore',

					'Jodhpur',

					'Jaipur',

					'Jaisalmer',

					'Jhalawar',

					'Karauli',

					'Kota',

					'Nagaur',

					'Pali',

					'Pratapgarh',

					'Rajsamand',

					'Sikar',

					'Sawai Madhopur',

					'Sirohi',

					'Tonk',

					'Udaipur'

			),

			'Sikkim' => array (

					'East Sikkim',

					'North Sikkim',

					'South Sikkim',

					'West Sikkim'

			),

			'Tamil Nadu' => array (

					'Ariyalur',

					'Chennai',

					'Coimbatore',

					'Cuddalore',

					'Dharmapuri',

					'Dindigul',

					'Erode',

					'Kanchipuram',

					'Kanyakumari',

					'Karur',

					'Madurai',

					'Nagapattinam',

					'The Nilgiris',

					'Namakkal',

					'Perambalur',

					'Pudukkottai',

					'Ramanathapuram',

					'Salem',

					'Sivagangai',

					'Tiruppur',

					'Tiruchirappalli',

					'Theni',

					'Tirunelveli',

					'Thanjavur',

					'Thoothukudi',

					'Thiruvallur',

					'Thiruvarur',

					'Tiruvannamalai',

					'Vellore',

					'Villupuram'

			),

			'Tripura' => array (

					'Dhalai',

					'North Tripura',

					'South Tripura',

					'West Tripura'

			),

			'Uttarakhand' => array (

					'Almora',

					'Bageshwar',

					'Chamoli',

					'Champawat',

					'Dehradun',

					'Haridwar',

					'Nainital',

					'Pauri Garhwal',

					'Pithoragharh',

					'Rudraprayag',

					'Tehri Garhwal',

					'Udham Singh Nagar',

					'Uttarkashi'

			),

			'Uttar Pradesh' => array (

					'Agra',

					'Allahabad',

					'Aligarh',

					'Ambedkar Nagar',

					'Auraiya',

					'Azamgarh',

					'Barabanki',

					'Badaun',

					'Bagpat',

					'Bahraich',

					'Bijnor',

					'Ballia',

					'Banda',

					'Balrampur',

					'Bareilly',

					'Basti',

					'Bulandshahr',

					'Chandauli',

					'Chitrakoot',

					'Deoria',

					'Etah',

					'Kanshiram Nagar',

					'Etawah',

					'Firozabad',

					'Farrukhabad',

					'Fatehpur',

					'Faizabad',

					'Gautam Buddha Nagar',

					'Gonda',

					'Ghazipur',

					'Gorkakhpur',

					'Ghaziabad',

					'Hamirpur',

					'Hardoi',

					'Mahamaya Nagar',

					'Jhansi',

					'Jalaun',

					'Jyotiba Phule Nagar',

					'Jaunpur District',

					'Kanpur Dehat',

					'Kannauj',

					'Kanpur Nagar',

					'Kaushambi',

					'Kushinagar',

					'Lalitpur',

					'Lakhimpur Kheri',

					'Lucknow',

					'Mau',

					'Meerut',

					'Maharajganj',

					'Mahoba',

					'Mirzapur',

					'Moradabad',

					'Mainpuri',

					'Mathura',

					'Muzaffarnagar',

					'Pilibhit',

					'Pratapgarh',

					'Rampur',

					'Rae Bareli',

					'Saharanpur',

					'Sitapur',

					'Shahjahanpur',

					'Sant Kabir Nagar',

					'Siddharthnagar',

					'Sonbhadra',

					'Sant Ravidas Nagar',

					'Sultanpur',

					'Shravasti',

					'Unnao',

					'Varanasi'

			),

			'West Bengal' => array (

					'Birbhum',

					'Bankura',

					'Bardhaman',

					'Darjeeling',

					'Dakshin Dinajpur',

					'Hooghly',

					'Howrah',

					'Jalpaiguri',

					'Cooch Behar',

					'Kolkata',

					'Malda',

					'Midnapore',

					'Murshidabad',

					'Nadia',

					'North 24 Parganas',

					'South 24 Parganas',

					'Purulia',

					'Uttar Dinajpur'

			)

	);

}