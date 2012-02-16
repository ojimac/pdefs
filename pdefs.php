#!/usr/bin/php
<?php
function main($filename) {
	$CLASS_RE = '/\A\s*(?:
		class\s\d+
	)/x';

	$DEF_RE = '/\A\s*
		(?: function\s
		| class
		| public\b
		| private\b
		| protected\b
		| include\b
		| include_once\b
		| require\b
		| require_once\b
		)/x';

	$re = $DEF_RE;

	$print_line_number_p = false;
	if (file_exists($filename)) {
		$f = fopen("$filename", 'r');
		if ($f) {
			while (!feof($f)) {
				$buf = fgets($f, 4096);
				if (preg_match($re, $buf)) {
					echo getdef($buf);
				}
			}
		}
	} else {
		echo "$filename not exists!\n";
	}
}

function getdef($str) {
	while(! balanced($str)) {
		$line = $buf;
		if (! $line) {
			$str .= $line;
		}
	}
	return $str;
}

function balanced($str) {
	$s = preg_replace('/.*?/', '', $str);
	$s = preg_replace("/.*?/", '', $str);
	return mb_substr_count('(', $s) == mb_substr_count(')', $s);
}

$options = array();
/*
$options = array(
	'--class',
	'-n',
	'--lineno',
	'--help',
);
*/
if (
	   $argc !== 2
	|| in_array($argv[1], $options)
) {
	echo "invalid arguments!\n";
} else {
	main($argv[1]);
}
