#!/bin/env php
<?php

use OliverKlee\TddSeed\Service\WordListReader;
use OliverKlee\TddSeed\Service\PalindromeChecker;

require_once __DIR__ . '/../vendor/autoload.php';

$wordListReader = new WordListReader();
#$wordList = $wordListReader->readFile( __DIR__ . '/../Resources/Private/Dictionaries/brit-a-z.txt' );
$wordList = $wordListReader->readFile( __DIR__ . '/../Resources/Private/Dictionaries/word_list_german_spell_checked.txt' );

$palindromeChecker = new PalindromeChecker();
foreach( $wordList AS $word ) {
  if ($palindromeChecker->check($word)) {
    echo $word . " ist ein palindrome \n";
  }
}