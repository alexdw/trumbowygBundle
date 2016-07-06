<?php

namespace Alexdw\TrumbowygBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Trumbowyg type.
 */
class TrumbowygType extends AbstractType
{
    protected $container;
    protected $transformers;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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
        $view->vars['btns'] = $options['btns'];
        $view->vars['remove_format_pasted'] = $options['remove_format_pasted'];
        $view->vars['autogrow'] = $options['autogrow'];
        $view->vars['reset_css'] = $options['reset_css'];
        $view->vars['semantic'] = $options['semantic'];
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
            'base_path' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.base_path'),
            'svg_path' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.svg_path'),
            'language' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.language'),
            'btns' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.btns'),
            'remove_format_pasted' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.remove_format_pasted'),
            'autogrow' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.autogrow'),
            'reset_css' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.reset_css'),
            'semantic' => $this->container->getParameter('alexdw_trumbowyg.trumbowyg.semantic'),
        ));

        $allowedValues = array(
        );

        $allowedTypes = array(
        );

        // BC: Remove version check when support for Symfony <2.6 is dropped.
        if (Kernel::VERSION_ID >= 20600) {
            foreach ($allowedValues as $option => $values) {
                $resolver->setAllowedValues($option, $values);
            }

            foreach ($allowedTypes as $option => $types) {
                $resolver->setAllowedTypes($option, $types);
            }
        } else {
            $resolver->setAllowedValues($allowedValues);
            $resolver->setAllowedTypes($allowedTypes);
        }
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