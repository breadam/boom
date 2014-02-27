<?php

return array(

	"boom" => app_path()."/boom",
	"source" => app_path()."/assets",
	"target" => public_path()."/assets",
	
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