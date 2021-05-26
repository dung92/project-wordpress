<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ShopMagicVendor\Symfony\Component\CssSelector;

use ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\ClassParser;
use ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\ElementParser;
use ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\EmptyStringParser;
use ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\HashParser;
use ShopMagicVendor\Symfony\Component\CssSelector\XPath\Extension\HtmlExtension;
use ShopMagicVendor\Symfony\Component\CssSelector\XPath\Translator;
/**
 * CssSelectorConverter is the main entry point of the component and can convert CSS
 * selectors to XPath expressions.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class CssSelectorConverter
{
    private $translator;
    /**
     * @param bool $html Whether HTML support should be enabled. Disable it for XML documents
     */
    public function __construct($html = \true)
    {
        $this->translator = new \ShopMagicVendor\Symfony\Component\CssSelector\XPath\Translator();
        if ($html) {
            $this->translator->registerExtension(new \ShopMagicVendor\Symfony\Component\CssSelector\XPath\Extension\HtmlExtension($this->translator));
        }
        $this->translator->registerParserShortcut(new \ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\EmptyStringParser())->registerParserShortcut(new \ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\ElementParser())->registerParserShortcut(new \ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\ClassParser())->registerParserShortcut(new \ShopMagicVendor\Symfony\Component\CssSelector\Parser\Shortcut\HashParser());
    }
    /**
     * Translates a CSS expression to its XPath equivalent.
     *
     * Optionally, a prefix can be added to the resulting XPath
     * expression with the $prefix parameter.
     *
     * @param string $cssExpr The CSS expression
     * @param string $prefix  An optional prefix for the XPath expression
     *
     * @return string
     */
    public function toXPath($cssExpr, $prefix = 'descendant-or-self::')
    {
        return $this->translator->cssToXPath($cssExpr, $prefix);
    }
}
