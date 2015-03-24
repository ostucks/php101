<?php

	// Homework 1

	array_shift($argv);
	$input = join(' ', $argv);

	function multiplyText($str) {
		$result = '';

		for ($i = 1; $i <= 10; $i++) {
			$result .= $i . ': ' . $str . PHP_EOL;
		}

		return $result;
	}

	if (empty($input)) {
		echo "You did not say anything!\n";
	} else {
		echo "Your string is this long: " . strlen($input) . PHP_EOL;
		echo "Your string backwards: " . strrev($input) . PHP_EOL;
		echo "Your string uppercase: " . strtoupper($input) . PHP_EOL;

		echo multiplyText($input);
	}