<a href="https://beapi.fr">![Be API Github Banner](banner-github.png)</a>

# Composer Go Maintenance

External composer command to put a WordPress website in maintenance mode the WordPress way.

# Disclaimer

This is deeply based on our current project's structure, so WordPress in `/wp/` and maintenance file in `tools/maintenance.model`.
Nevertheless you can override paths with additional arguments in command lines.

# What ?

A simple command to activate / deactivate maintenance mod.

# Example of .maintenance model

This allows you to skip WordPress maintenance mode. The rest of the World will get maintenance page :

```PHP
<?php
if ( 'REPLACE_WITH_YOUR_IP' !== $_SERVER['REMOTE_ADDR'] )
    $upgrading = time();
?>
```

# How ?

## 1 - Add to [Composer](http://composer.rarst.net/)

- Add repository source : `{ "type": "vcs", "url": "https://github.com/BeAPI/composer-go-maintenance" }`.
- Include `"beapi/composer-go-maintenance: "dev-master"` into your composer.json file as require.
- Then `composer update` before use.

## 2 - Run command 

Then you can launch `composer go-maintenance start` to enable maintenance mode and reciprocally `composer go-maintenance stop` to disable maintenance mode.

Optionally you can override paths e.g :

`composer go-maintenance start wp tools/maintenance.model`

*If you use these additional parameters, please make sure you use relative paths in command lines.*
*Also make sure your model file is named 'maintenance.model'*

Optionally you can create a file called `maintenance.php` at the root of your WordPress content dir e.g `wp-content/maintenance.php`.
This is a good way to customize maintenance page displayed in WordPress by default.

# Who ?

Created by [Be API](https://beapi.fr), the French WordPress leader agency since 2009. Based in Paris, we are more than 30 people and always [hiring](https://beapi.workable.com) some fun and talented guys. So we will be pleased to work with you.

This plugin is only maintained, which means we do not guarantee some free support. If you identify any errors or have an idea for improving this script, feel free to open an [issue](../../issues/new). Please provide as much info as needed in order to help us resolving / approve your request. And .. be patient :)

If you really like what we do or want to thank us for our quick work, feel free to [donate](https://www.paypal.me/BeAPI) as much as you want / can, even 1€ is a great gift for buying cofee :)

## License

Composer Go Maintenance is licensed under the [GPLv3 or later](LICENSE.md).
