# Mailjet for WordPress
A simple Mailjet integration for WordPress.

This plugin isn't meant to be user friendly and have a fancy user inferface. It is for developers who want to integrate Mailjet into WordPress without all the bloat. It is aiming to be simple, uncomplicated and very customizable.

## Getting started

1. Install dependencies

    ```
    composer install
    ```

2. Setup configuration

    Copy `/inc/config-example.php` to `/inc/config.php` and configure it (i. e. add your Mailjet API key and secret).

3. Add template

    After you have created your transactional template,
	add the confirmation link variable (`{{var:confirmationlink:""}}`) to it.

4. Add shortcode

    Add `[mailjet_for_wordpress]` anywhere to see the subscription form.

## Contributing

### Coding standard
We are using the WordPress-Core and WordPress-Extra coding standard.
