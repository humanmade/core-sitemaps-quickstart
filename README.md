# Core Sitemaps Quickstart

This is the developer setup repository for the Google XML Sitemap project.

This repository is developed by [Human Made](https://humanmade.com/), powered by [WordPress](https://wordpress.org), and [Chassis](https://beta.chassis.io).

---

* [Onboarding](#onboarding)
* [Local Development Environment](#local-development-environment)
* [Development Process](#development-process)
* [Running the Tests](#running-the-tests)

---

# Onboarding

To be onboarded to the project you'll need the following:

## From HM (for HM team members)

* Access to [the Google P2](https://google.hmn.md/)

# Local Development Environment

It's recommended that you use the [Chassis virtual server](https://docs.chassis.io) for your local development environment.

> Chassis is a virtual server for WordPress, designed for simplicity and speed.

Using Chassis gives you maximum ease of setup and provides assurance that your development environment mirrors HM developers as closely as possible. However, the structure of this project means that it is environment-agnostic, so if you prefer to install and administer WordPress using another method then you can do so.

## Setting up the Development Environment Using Chassis

Ensure you have the prerequisite software installed:

* [Git](https://git-scm.com/) 2.15+
* [Virtualbox](https://www.virtualbox.org/wiki/Downloads) 5.1+
* [Vagrant](https://www.vagrantup.com/downloads.html) 1.9+
* [Composer](https://getcomposer.org/) 1.8+

In order to run the automated testing suite, you'll also need:

* [Selenium Standalone](https://www.npmjs.com/package/selenium-standalone) (which requires the [Java Platform JDK](https://www.oracle.com/technetwork/java/javase/downloads/index.html)).

Install the development environment:

1. Clone Chassis into a directory on your machine:
	 - `git clone --recursive https://github.com/Chassis/Chassis.git core-sitemaps`
	 - `cd core-sitemaps`
1. Clone this quickstart repository into a `content` directory:
	 - `git clone --recursive https://github.com/humanmade/core-sitemaps-quickstart/ content`
1. Clone the plugin repository inside the plugins directory:
     - `git clone https://github.com/humanmade/core-sitemaps content/plugins/core-sitemaps`
1. Set up the Chassis VM:
	 - `vagrant up --provision`  
	 This will take a while to run. Go and put the kettle on, but don't forget to come back and complete the next steps.
1. Symlink the WordPress configuration file into place using a relative symlink:
	 - Unix: `ln -s content/local-config.php.dist local-config.php`
	 - Windows: `mklink local-config.php content/local-config.php.dist`
1. When the machine has finished provisioning, install the development dependencies:
	 - `cd content/plugins/core-sitemaps && composer install`
	 
	 

Your environment can then be accessed at [sitemaps.local](http://sitemaps.local). 

Log in to [the admin area](http://sitemaps.local/wp/wp-admin/) with the username `wordpress` and password `password`.

# Development Process

Before you begin committing code, [double check that you have the correct email address configured for this particular Git repo](https://help.github.com/articles/setting-your-email-in-git/#setting-your-email-address-for-a-single-repository). It's likely that this should be your **work** email address instead of a **personal** email address.

See the [Contributing document](https://github.com/humanmade/core-sitemaps/blob/master/docs/CONTRIBUTING.md) for our 
branching strategy.

# Running the Tests

The project contains three types of automated tests:

* **Coding standards** which are run via [PHP Code Sniffer (PHPCS)](https://github.com/squizlabs/PHP_CodeSniffer).
* **Unit tests** which are run via [PHPUnit](https://phpunit.de/) and the WordPress unit testing framework.
* **Functional tests** which are run via [Behat](http://behat.org/en/latest/) and the [WordHat](https://wordhat.info/) integration layer.

All of the test frameworks are installed with Composer as part of the development environment setup. All of the tests are run via Composer scripts which are defined in `composer.json`.

## Running the Entire Test Suite

The functional tests, by default, require the Google Chrome browser, and [Selenium Standalone](https://www.npmjs.com/package/selenium-standalone). If you use the linked package to install Selenium, to start it, in a seperate terminal, enter: 

`selenium-standalone install && selenium-standalone start`

To run the entire test suite in one go:

* `composer run local-tests`

## Running the Unit Tests

To run just the unit tests, run:

* `composer run test:phpunit-local`

## Running the Functional Tests

To run just the functional tests, run:

* `composer run test:behat-local`

