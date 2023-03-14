<a href="https://hosted.weblate.org/engage/mailjet-integration/">
<img src="https://hosted.weblate.org/widgets/mailjet-integration/-/mailjet-integration-pot/svg-badge.svg" alt="Oversettelsesstatus" />
</a>

# Integration for Mailjet

A simple Mailjet integration for WordPress.

Integration for Mailjet unlike any other. Aims to be simple, lightweight, robust and customizable.

Consultthe [wiki](https://github.com/grandeljay/wordpress-mailjet-integration/wiki) or open an [issue](https://github.com/grandeljay/wordpress-mailjet-integration/issues) if you have questions.

## Getting started

After cloning this repository you can get started after 2 easy steps.

1. Add a template

    After you have created your [transactional template](https://app.mailjet.com/templates/transactional),
    add the confirmation link variable (`{{var:confirmationlink:""}}`) to it.

1. Add shortcode

    Add `[mailjet_integration]` anywhere to see the subscription form.

## Configuration

### Shortcodes

So far the following shortcodes are available.

-   `[mailjet_integration]`

    The subscription form

-   `[mailjet_integration_response]`

    The response after clicking the confirmation link. Put this in your Success/Failure pages.

### Template variables

So far the following variables are available and can be used in your transactional Mailjet templates.

-   confirmationlink

    The link to confirm a subscribers e-mail address.

-   approximatename

    The subscribers name guessed, based on the e-mail address. Currently the part before the `@` is used.

    Example:
    john.doe@domain.tld would extract `john.doe` and use it to greet the subscriber.

## Compatibility

Integration for Mailjet works with:

-   [WPML](https://wpml.org/)
-   [Git Updater](https://github.com/afragen/git-updater)

## Contributing

### Getting started

Install dependencies with composer.

```
composer install
```
---

And/or help translate the app on Hosted Weblate \
<a href="https://hosted.weblate.org/engage/mailjet-integration/">
<img src="https://hosted.weblate.org/widgets/mailjet-integration/-/mailjet-integration-pot/multi-blue.svg" alt="Translation status" />
</a>

### Coding standard

We are using the WordPress coding standard.

### Contributors

For a full list of all contributers please see [Contributors](https://github.com/grandeljay/wordpress-mailjet-integration/graphs/contributors).
