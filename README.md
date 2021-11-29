# Mailjet for WordPress
A simple Mailjet integration for WordPress.

Mailjet for WordPress is like any other Mailjet integration. It's aiming to be simple, lightweight, robust and customizable.

If you have any questions, check out the [wiki](https://github.com/grandeljay/grandeljay-mailjet-for-wordpress/wiki) or open an [issue](https://github.com/grandeljay/grandeljay-mailjet-for-wordpress/issues).


## Getting started
After cloning this repository you can get started after 2 easy steps.

1. Add a template

    After you have created your [transactional template](https://app.mailjet.com/templates/transactional),
	add the confirmation link variable (`{{var:confirmationlink:""}}`) to it.

1. Add shortcode

    Add `[mailjet_for_wordpress]` anywhere to see the subscription form.

## Configuration

### Shortcodes
So far the following shortcodes are available.

* `[mailjet_for_wordpress]`

  The subscription form

* `[mailjet_for_wordpress_response]`

  The response after clicking the confirmation link. Put this in your Success/Failure pages (`GJMJ4WP_PAGE_EMAIL_CONFIRMATION_SUCCESS`, `GJMJ4WP_PAGE_EMAIL_CONFIRMATION_FAILURE`)

### Template variables
So far the following variables are available and can be used in your transactional Mailjet templates.

* confirmationlink

    The link to confirm a subscribers email address.

* approximatename

    The subscribers name guessed, based on the email address. Currently the part before the `@` is used.

	Example:
	john.doe@domain.tld would extract `john.doe` and use it to greet the subscriber.


## Contributing

### Getting started
Install dependencies with composer.
```
composer install
```

### Coding standard
We are using the WordPress coding standard.

### Contributors
For a full list of all contributers please see [Contributors](https://github.com/grandeljay/grandeljay-mailjet-for-wordpress/graphs/contributors).
