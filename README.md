# Core Sitemaps Quickstart

This is the developer setup repository for the Google XML Sitemap project.

This repository is developed by [Human Made](https://humanmade.com/), powered by [WordPress](https://wordpress.org), and [Chassis](https://beta.chassis.io).

---

* [Onboarding](#onboarding)
* [Local Development Environment](#local-development-environment)
* [Development Process](#development-process)
* [Deployment](#deployment)
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
1. Clone this repository into a `content` directory:
	 
	 - `git clone --recursive https://github.com/humanmade/core-sitemaps-quickstart/ content`
1. Set up the Chassis VM:
	 - `vagrant up --provision`  
	 This will take a while to run. Go and put the kettle on, but don't forget to come back and complete the next steps.
1. Symlink the WordPress configuration file into place using a relative symlink:
	 - Unix: `ln -s content/local-config.php.dist local-config.php`
	 - Windows: `mklink local-config.php content/local-config.php.dist`
1. When the machine has finished provisioning, install the development dependencies:
	 
	 - `cd content && composer install`
	 
	 

Your environment can then be accessed at [https://sitemaps.local](https://sitemaps.local). You'll likely see an SSL certificate error message because the environment uses a self-signed certificate. See below for instructions for adding the certificate to your trust store in order to avoid this warning.

Log in to [the admin area](https://rsdms.local/wp/wp-admin/) with the username `wordpress` and password `password`.

## Trusting the Chassis Security Certificate

In order to avoid security errors and get that nice green padlock in your browser's location bar, you should add the site's security certificate to your trust store. The certificate can be found at `/sitemaps.local.cert` (one level above `content`).

### Firefox on all operating systems:

* Open Firefox's Preferences.
* Go to Advanced -> Certificates -> View certificates -> Authorities.
* Import the certificate.
* Click "Trust this CA to identify web sites".

### Other browsers on macOS:

* Open the "Keychain Access" app.
* Drag the certificate into the "System" keychain.
* Right-click it and click "Get Info".
* Expand the "Trust" section if it's not already.
* In the "Secure Sockets Layer (SSL)" list, select "Always Trust".
* Close the window. At this point you may have to enter your macOS account password.
* Restart your browser for this to take effect.

### Other browsers on Windows:

This is a slightly more involved process. [See this third-party guide for step by step instructions](https://www.thewindowsclub.com/manage-trusted-root-certificates-windows).

# Development Process

Before you begin committing code, [double check that you have the correct email address configured for this particular Git repo](https://help.github.com/articles/setting-your-email-in-git/#setting-your-email-address-for-a-single-repository). It's likely that this should be your **work** email address instead of a **personal** email address.

The development process mostly follows the [Git Flow](http://jeffkreeftmeijer.com/2010/why-arent-you-using-git-flow/) model. 

`To be decided`

# Deployment

`to be decided`

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

