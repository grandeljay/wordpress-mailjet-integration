# Mailjet for WordPress
A simple Mailjet integration for WordPress.

All you have to do is edit the configuration. Optionally add your own style.

Mailjet for WordPress is like any other Mailjet integration just without the graphical user interface in the WordPress admin. It's aiming to be simple, lightweight, robust and customizable.

If you have any questions, check out the [wiki](https://github.com/grandeljay/grandeljay-mailjet-for-wordpress/wiki) or open an [issue](https://github.com/grandeljay/grandeljay-mailjet-for-wordpress/issues).


## Getting started

1. Install dependencies

    ```
    composer install --no-dev
    ```
	or just `composer install` if you plan to contribute.

2. Setup configuration

    Copy `/inc/config-example.php` to `/inc/config.php` and configure it (i. e. add your [Mailjet API key and secret](https://app.mailjet.com/account/api_keys)).

3. Add a template

    After you have created your [transactional template](https://app.mailjet.com/templates/transactional),
	add the confirmation link variable (`{{var:confirmationlink:""}}`) to it.

4. Add shortcode

    Add `[mailjet_for_wordpress]` anywhere to see the subscription form.


## Template variables
So far the following variables are available and can be used in your transactional Mailjet templates.

* confirmationlink

    The link to confirm a subscribers email address.

* approximatename

    The subscribers name guessed, based on the email address. Currently the part before the `@` is used.

	Example:
	john.doe@domain.tld would extract `john.doe` and use it to greet the subscriber.


## Contributing

### Coding standard
We are using the WordPress-Core and WordPress-Extra coding standard.

### Contributors
For a full list of all contributers please see [Contributors](https://github.com/grandeljay/grandeljay-mailjet-for-wordpress/graphs/contributors).
