# Exercises for test-driven development

[![BuildStatus](https://github.com/oliverklee/tdd-exercises/workflows/CI/badge.svg?branch=main)](https://github.com/oliverklee/tdd-exercises/actions)
[![Latest Stable Version](https://poser.pugx.org/oliverklee/tdd-exercises/v/stable.svg)](https://packagist.org/packages/oliverklee/tdd-exercises)
[![Total Downloads](https://poser.pugx.org/oliverklee/tdd-exercises/downloads.svg)](https://packagist.org/packages/oliverklee/tdd-exercises)
[![Latest Unstable Version](https://poser.pugx.org/oliverklee/tdd-exercises/v/unstable.svg)](https://packagist.org/packages/oliverklee/tdd-exercises)
[![License](https://poser.pugx.org/oliverklee/tdd-exercises/license.svg)](https://packagist.org/packages/oliverklee/tdd-exercises)

This project contains code to be used in my TDD workshops.

## Installation

### PHP

#### Local PHP

You will need a local PHP installation with Composer.

If you would like to use Infection for mutation testing, you will also need
Xdebug.

### Installing the Composer packages

Run `composer install` to install the required Composer packages.

## Having a test list

For your test list, please create a fill `test-list.txt`.
Git will ignore it for you.

## Mutation testing

You can run the mutation testing with Infection to catch missing test cases:

```bash
vendor/bin/infection
```

Infection then will log its findings into the file `infection.log`.

## About me (Oliver Klee)

I am the maintainer of the
[PHPUnit TYPO3 extension](http://typo3.org/extensions/repository/view/phpunit),
which is available in the TYPO3 extension repository (TER).

You can book me for
[workshops](https://www.oliverklee.de/workshops/workshops.html)
at your company.

I also frequently give workshops at the TYPO3 Developer Days.

## More Documentation

* [Handout to my workshops on test-driven development (TDD)](https://github.com/oliverklee/tdd-reader)

## Other example projects

* [Selenium demo](https://github.com/oliverklee/selenium-demo)
  for using Selenium with PHPUnit
* [Coffee example](https://github.com/oliverklee/coffee)
  is my starting point for demonstrating TDD
* [Tea example](https://github.com/TYPO3-Documentation/tea)
  for unit tests for extbase extensions for TYPO3 CMS
