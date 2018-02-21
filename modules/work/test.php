<?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');
//
//	$wp = new WorkPhases();


$work = new Work();
$phase = new WorkPhases();

	$work->setWorkNumber(9);
	$work->setYear(2018);
	$work->setTitle('Test Alpha');
	$work->setClient(8);
	$work->setClientRep(2);
	$work->setDb(1);
	$work->setJID();
	$work->setPID();
	$work->setBID();
	$work->setSID();
	$work->setCID();

	$w = $work->addEntry();
	echo '<br /><br /><br /><h2>WORK ENTRY RESULTS</h2><pre>';
	print_r($w);
	echo '</pre>';

	//Update with new Pri Key
	$work->setId($w['info']);

	//Lets work a phase up.
	$phase->setParentId($w['info']);
	$phase->setStatus();
	$phase->setPercentComplete();
	$phase->setSOW();
	$phase->setPhaseId($phase->generateNextPhaseId($w['info'], 'b'));

	//Add the phase...
	$p = $phase->addEntry('b');
	if($p['success']){
		$work->setBID($p['info']);
		echo '<br /><br /><br /><h2>B RESULTS PASSED</h2><pre>';
			print_r($p);
		echo '</pre>';
	}else{
		echo '<br /><br /><br /><h2>B RESULTS FAILED</h2><pre>';
			print_r($p);
		echo '</pre>';
	}
	
	//Update Work...
	$x = $work->updateEntry();

	echo '<br /><br /><br /><h2>WORK UPDATE RESULTS</h2><pre>';
		print_r($x);
	echo '</pre>';

?>