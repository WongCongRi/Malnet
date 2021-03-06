

<?php
 
/*
    The important thing to realize is that the config file should be included in every
    page of your project, or at least any page you want access to these settings.
    This allows you to confidently use these settings throughout a project because
    if something changes such as your database credentials, or a path to a specific resource,
    you'll only need to update it here.
*/
 
$config = array(
    "version" => "5.1",
    "db" => array(
        "storage" => array(
            "dbname" => "mrf",
            "username" => "root",
            "password" => "password",
            "host" => "localhost"
        ),
        "usercake" => array(
            "dbname" => "mrf",
            "username" => "root",
            "password" => "password",
            "host" => "localhost"
        )
    ),
	"leftnav" => array(
        array(
            "name" => "Repository",
            "link" => "/mrf/index.php",
            "icon" => "fa fa-bug",
        ),
	//	array(
        //    "name" => "Statistics",
        //    "link" => "/mrf/stats.php",
        //    "icon" => "fa fa-pie-chart",
        //),
		array(
            "name" => "Cuckoo",
            "link" => "/mrf/cuckoo.php",
            "icon" => "fa fa-industry",
        ),
		//array(
		//	"name" => "Project on Github",
		//	"link" => "https://github.com/wongcongri/malnet",
		//	"icon" => "fa fa-github",
		//	"target" => "_blank"
		//)
    ),
    "urls" => array(
        "baseUrl" => "http://localhost/mrf/",
        "storagePath" => "/var/www/html/mrf/storage/",
        "storageUrl"  => "http://localhost/mrf/storage/"
    ),
	"ui" => array(
		"files_per_page" => 40,
		"hex_max_length" => 65536, //64 kb *KEEP THAT VALUE LOW, OTHERWISE UI BECOMES UNRESPONSIVE*
	),
	"modules" => array(
		"mime" => array(
			"enabled" => True,
			"class" => "Mime",
			"priority" => 9,	// MIME is used by other modules
		),
		"pedata" => array(
			"enabled" => False,
			"class" => "PEData",
			"priority" => 10,
		),
		"officedata" => array(
			"enabled" => True,
			"class" => "OfficeData",
			"priority" => 10,
		),
		"pdfdata" => array(
			"enabled" => True,
			"class" => "PDFData",
			"priority" => 10,
		),
		"ssdeep" => array(
			"enabled" => True,
			"class" => "SSDEEP",
			"priority" => 10,
		),
		"cuckoo" => array(
			"enabled" => True,
			"class" => "Cuckoo",
			"priority" => 10,
			"api_base_url" => 'http://localhost:8090/',
			"web_base_url" => 'http://localhost:8000/',
			"scan" => array(
					//"package" => "",    // uncomment to use
					//"timeout" => "",    // uncomment to use
					//"priority" => 3,    // 1 to 3, uncomment to use
					//"options" => "",    // uncomment to use
					//"machine" => "",    // uncomment to use
					//"platform" => "",   // uncomment to use
					//"tags" => "mrf",       // uncomment to use
					//"custom" => "",     // uncomment to use
					//"owner" => "",      // uncomment to use
					//"memory" => False   // uncomment to use
			),
			"scan_optional" => array(
				//"options" => [ "option1", "option2" ],    // uncomment to use
			)
		),
		"virustotal" => array(
			"enabled" => True,
			"class" => "VirusTotal",
			"priority" => 10,
			"key" => '360fa173bbc4db9d0caaa3c3b7c3717559de5d42e28728a64578fcdcf22cb4e8',
			"automatic_upload" => True,
			"comment_uploaded" => array(
				"enabled" => False,	// If true, files uploaded (new analysis) will be commented upon completion
				"comment" => "Some comment you want to put in VirusTotal"
			),
			"vendors_priority" => array(	// List of vendors as seen in the VT API, the first one detecting will give its threat name to the sample
				"Microsoft",
				"Kaspersky",
				"BitDefender",
				"Malwarebytes"
			)
		)
	),	
     // Cron isn't enabled by this framework. 
     // Setting enabled to true means YOU have registered /src/cron.php in the cron table
     // and that VT / Cuckoo refreshes are performed by it.
     // This tells the uploader not to perform VT/Cuckoo checks when grabbing the displayed samples.
    "cron" => array(
        "enabled" => False
    ),
    // Paths can be different on several machines, and have either redirections or restrictions.
    // Default values are usually good, but can be tweaked for specific cases.
    "path" => array (
        "tmp" => "/tmp"
    ),
	
);

$GLOBALS["config"] = $config;
 
function IsModuleEnabled($module) {
	return isset($GLOBALS["config"]["modules"][$module]) && $GLOBALS["config"]["modules"][$module]["enabled"];
}

/*
    I will usually place the following in a bootstrap file or some type of environment
    setup file (code that is run at the start of every page request), but they work 
    just as well in your config file if it's in php (some alternatives to php are xml or ini files).
*/
 
/*
    Creating constants for heavily used paths makes things a lot easier.
    ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
//defined("LIBRARY_PATH")
//    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
     
//defined("TEMPLATES_PATH")
//    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 
/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
 
?>
