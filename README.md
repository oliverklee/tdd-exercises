# TDD seed project

[![HitHub CI Status](https://github.com/oliverklee/tdd-seed/workflows/CI/badge.svg?branch=main)](https://github.com/oliverklee/tdd-seed/actions)
[![Build Status](https://travis-ci.org/oliverklee/tdd-seed.svg?branch=master)](https://travis-ci.org/oliverklee/tdd-seed)
[![Latest Stable Version](https://poser.pugx.org/oliverklee/tdd-seed/v/stable.svg)](https://packagist.org/packages/oliverklee/tdd-seed)
[![Total Downloads](https://poser.pugx.org/oliverklee/tdd-seed/downloads.svg)](https://packagist.org/packages/oliverklee/tdd-seed)
[![Latest Unstable Version](https://poser.pugx.org/oliverklee/tdd-seed/v/unstable.svg)](https://packagist.org/packages/oliverklee/tdd-seed)
[![License](https://poser.pugx.org/oliverklee/tdd-seed/license.svg)](https://packagist.org/packages/oliverklee/tdd-seed)

This is a starter repository for a project with PHPUnit.

## Installation

### PHP

#### Local PHP

You will need a local PHP (>= 7.2) installation with Composer (which is the
preferred way).

#### Vagrant

Instead, you can also use Vagrant to run on a PHP 7 box.

```bash
vagrant up
vagrant ssh
cd tdd-seed/
```

You will then need to set up a remote PHP interpreter and PHPUnit as described
in the [PhpStorm documentation](https://confluence.jetbrains.com/display/PhpStorm/Running+PHPUnit+tests+over+SSH+on+a+remote+server+with+PhpStorm).

The PHP executable path on the Vagrant machine is `/usr/local/bin/php`.

### Composer packages

Run `composer install` to install the required Composer packages.

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
