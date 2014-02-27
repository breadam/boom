<?php

return array(

	"boomPath" => app_path()."/boom",
	"sourcePath" => app_path()."/assets",
	"targetPath" => public_path()."/assets",
	
	"bower" => array(
		"dependencies" => array()
	),
	
	"assets" => array(
	
		"js" => array(
			"source" => "js",
			"target" => "js",
			"imports" => array(),
			"order" => array()
		),
		"coffee" => array(
			"source" => "coffee",
			"target" => "coffee",
			"imports" => array()
		),
		"css" => array(
			"source" => "css",
			"target" => "css",
		),
		"less" => array(
			"source" => "less",
			"target" => "less",
		),
		"scss" => array(
			"source" => "scss",
			"target" => "scss",
			"imports" => array()
		)
	)
);