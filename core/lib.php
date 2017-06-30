<?php


function include_icon()
{
	echo '<link rel="shortcut icon" href="' . IMAGES_URL . 'favicon.ico" />';
}

function include_head_js($controller, $action)
{
	$head_js = head_js();
	$count = count($head_js);
	for($i=0;$i<$count;$i++)
	{
		echo '<script src="' . JS_URL . 'com/' . $head_js[$i] .'"></script>';
	}
	echo '<script src="' . JS_URL . 'mdl/js_model.js"></script>';
	$js_file = JS_PATH . $controller . '/' . $action . '.js';

	if(file_exists($js_file))
	{
		echo '<script src="' . JS_URL . $controller . '/' . $action . '.js' . '"></script>';
	}
}

function include_foot_js($controller, $action)
{
	$foot_js = foot_js();
	$count = count($foot_js);
	for($i=0;$i<$count;$i++)
	{
		echo '<script src="' . JS_URL . 'com/' . $foot_js[$i] .'"></script>';
	}
}

function include_head_css($controller, $action)
{
	$head_css = head_css();
	$count = count($head_css);
	for($i=0;$i<$count;$i++)
	{
		echo '<link rel="stylesheet" type="text/css" href="' . CSS_URL .'com/'. $head_css[$i] . '">';
	}
	$css_file = CSS_PATH . $controller . '/' . $action . '.css';
	if(file_exists($css_file))
	{
		$css_file = CSS_URL . $controller . '/' . $action . '.css';
		echo '<link rel="stylesheet" type="text/css" href="' . $css_file .'">';
	}
}
