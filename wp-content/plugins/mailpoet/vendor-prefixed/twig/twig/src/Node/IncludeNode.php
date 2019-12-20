<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MailPoetVendor\Twig\Node;

if (!defined('ABSPATH')) exit;


use MailPoetVendor\Twig\Compiler;
use MailPoetVendor\Twig\Node\Expression\AbstractExpression;
/**
 * Represents an include node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class IncludeNode extends \MailPoetVendor\Twig\Node\Node implements \MailPoetVendor\Twig\Node\NodeOutputInterface
{
    public function __construct(\MailPoetVendor\Twig\Node\Expression\AbstractExpression $expr, \MailPoetVendor\Twig\Node\Expression\AbstractExpression $variables = null, $only = \false, $ignoreMissing = \false, $lineno, $tag = null)
    {
        $nodes = ['expr' => $expr];
        if (null !== $variables) {
            $nodes['variables'] = $variables;
        }
        parent::__construct($nodes, ['only' => (bool) $only, 'ignore_missing' => (bool) $ignoreMissing], $lineno, $tag);
    }
    public function compile(\MailPoetVendor\Twig\Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
        if ($this->getAttribute('ignore_missing')) {
            $compiler->write("try {\n")->indent();
        }
        $this->addGetTemplate($compiler);
        $compiler->raw('->display(');
        $this->addTemplateArguments($compiler);
        $compiler->raw(");\n");
        if ($this->getAttribute('ignore_missing')) {
            $compiler->outdent()->write("} catch (LoaderError \$e) {\n")->indent()->write("// ignore missing template\n")->outdent()->write("}\n\n");
        }
    }
    protected function addGetTemplate(\MailPoetVendor\Twig\Compiler $compiler)
    {
        $compiler->write('$this->loadTemplate(')->subcompile($this->getNode('expr'))->raw(', ')->repr($this->getTemplateName())->raw(', ')->repr($this->getTemplateLine())->raw(')');
    }
    protected function addTemplateArguments(\MailPoetVendor\Twig\Compiler $compiler)
    {
        if (!$this->hasNode('variables')) {
            $compiler->raw(\false === $this->getAttribute('only') ? '$context' : '[]');
        } elseif (\false === $this->getAttribute('only')) {
            $compiler->raw('twig_array_merge($context, ')->subcompile($this->getNode('variables'))->raw(')');
        } else {
            $compiler->raw('twig_to_array(');
            $compiler->subcompile($this->getNode('variables'));
            $compiler->raw(')');
        }
    }
}
\class_alias('MailPoetVendor\\Twig\\Node\\IncludeNode', 'MailPoetVendor\\Twig_Node_Include');