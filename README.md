# TrumbowygBundle

This bundle provide an easy integration for [Trumbowyg Editor](https://alex-d.github.io/Trumbowyg/) in your Symfony Project. 

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/89a48061-bd00-48dd-a00c-91322f99233f/small.png)](https://insight.sensiolabs.com/projects/89a48061-bd00-48dd-a00c-91322f99233f)


##Installation

```
 php composer.phar require alexdw/trumbowyg-bundle="0.9"
```


### Add trumbowygbundle to your application kernel.

```php
// app/AppKernel.php
<?php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Alexdw\TrumbowygBundle\AlexdwTrumbowygBundle(),
        );
    }
```

### Install bundle assets

```
$ php app/console assets:install web/
```
## Include in template

This bundle comes with an extension for Twig to makes it very easy to include the assets in your pages.

#### Include javascripts
```twig
    {{ trumbowyg_js() }}
```

You can also override the default configuration by passing an option like this:

```twig
    {{ trumbowyg_js({'include_jquery': false}) }}
```
#### Include stylesheets
```twig
    {{ trumbowyg_css() }}
```
##Usage

```php
// Symfony 2.7 and previous versions
$builder->add('field', 'trumbowyg', array(
        'reset_css' => true,
        //...
));

// Symfony 2.8 and newer versions
use Alexdw\TrumbowygBundle\Form\Type\TrumbowygType;

$builder->add('field', TrumbowygType::class, array(
    'reset_css' => true,
            //...
));
```

## Default configuration

```yaml
    alexdw_trumbowyg:
      base_path: /bundles/alexdwtrumbowyg/
      svg_path: /bundles/alexdwtrumbowyg/ui/icons.svg
      language: en
      autogrow: false
      reset_css: false
      semantic: false
      remove_format_pasted: false
      include_jquery: true
      jquery_path: /bundles/alexdwtrumbowyg/vendor/jquery-2.2.4.min.js
      btns:
        - ["viewHTML"]
        - ["formatting"]
        - "btnGrp-semantic"
        - ["superscript","subscript"]
        - ["link"]
        - ["insertImage"]
        - "btnGrp-justify"
        - "btnGrp-lists"
        - ["horizontalRule"]
        - ["removeformat"]
        - ["fullscreen"]
```

All parameters explained [here](https://alex-d.github.io/Trumbowyg/documentation.html)
