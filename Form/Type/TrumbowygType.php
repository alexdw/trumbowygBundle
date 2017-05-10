<?php

namespace Alexdw\TrumbowygBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Trumbowyg type.
 */
class TrumbowygType extends AbstractType
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('base_path', $options['base_path'])
            ->setAttribute('svg_path', $options['svg_path'])
            ->setAttribute('language', $options['language'])
            ->setAttribute('remove_format_pasted', $options['remove_format_pasted'])
            ->setAttribute('autogrow', $options['autogrow'])
            ->setAttribute('reset_css', $options['reset_css'])
            ->setAttribute('semantic', $options['semantic'])
            ->setAttribute('plugins', $options['plugins'])
            ->setAttribute('btns_def', $options['btns_def'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['base_path'] = $options['base_path'];
        $view->vars['svg_path'] = $options['svg_path'];
        $view->vars['language'] = $options['language'];
        $view->vars['btns_def'] = $options['btns_def'];
        $view->vars['btns'] = $options['btns'];
        $view->vars['remove_format_pasted'] = $options['remove_format_pasted'];
        $view->vars['autogrow'] = $options['autogrow'];
        $view->vars['reset_css'] = $options['reset_css'];
        $view->vars['semantic'] = $options['semantic'];
        $view->vars['plugins'] = $options['plugins'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'base_path' => $this->config["base_path"],
            'svg_path' => $this->config["svg_path"],
            'language' => $this->config["language"],
            'btns_def' => $this->config["btns_def"],
            'btns' => $this->config["btns"],
            'remove_format_pasted' => $this->config["remove_format_pasted"],
            'autogrow' => $this->config["autogrow"],
            'reset_css' => $this->config["reset_css"],
            'semantic' => $this->config["semantic"],
            'plugins' => $this->config["plugins"],
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        // Use the Fully Qualified Class Name if the method getBlockPrefix exists.
        if (method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix')) {
            return 'Symfony\Component\Form\Extension\Core\Type\TextareaType';
        }

        // BC - Remove this when support for Symfony <2.8 is dropped.
        return 'textarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'trumbowyg';
    }
}
