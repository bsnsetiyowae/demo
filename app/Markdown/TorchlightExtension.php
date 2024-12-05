<?php

namespace App\Markdown;

use App\Support\SiteConfig;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use Torchlight\Block;

class TorchlightExtension extends BaseExtension implements ExtensionInterface, NodeRendererInterface
{
    /**
     * This method just proxies to our base class, but the
     * signature has to match Commonmark V2.
     *
     * @param  EnvironmentBuilderInterface  $environment
     */
    public function register(EnvironmentBuilderInterface $environment): void
    {

        $this->useCustomBlockRenderer(function (Block $block, AbstractBlock $node) {

            $attributes = $node->data['attributes'] ?? [];

            $inner = '';

            // Clones come from multiple themes.
            $blocks = $block->clones();
            array_unshift($blocks, $block);

            foreach ($blocks as $block) {
                $inner .= "<code {$block->attrsAsString()}class='{$block->classes}' style='{$block->styles}'>{$block->highlighted}</code>";
            }

            if ($node->data['title'] ?? null) {
                $attributes['title'] = $node->data['title'];
            }

            $copyButton = new HtmlElement('button', [
                'type' => 'button',
                'id' => 'copy-button',
                'class' => 'absolute right-4 top-3 overflow-hidden rounded-lg bg-stone-900/50 py-1 pl-2 pr-3 text-xs'
            ], '<span aria-hidden="true" class="text-stone-100">Copy</span>');

            // Create the <pre> element wrapping the <code> element
            $preElement = new HtmlElement('pre', ["class" => "p-2.5"], $inner);

            // Create the <figcaption> element for the title
            $titleElement = null;
            if ($attributes['title'] ?? null) {
                $titleElement = new HtmlElement('figcaption', [
                    "class" => "bg-stone-900/95 rounded-t-lg text-stone-50 py-3.5 px-3",
                    "title" => ""
                ], $attributes['title']);
            }
            // Create the <figure> element with appropriate children
            $figureElementChildren = [$preElement, $copyButton];

            if ($titleElement !== null) {
                array_unshift($figureElementChildren, $titleElement);
            }


            return new HtmlElement('figure', array_merge($node->data->getData('attributes')->export(), ["class" => "relative [&_figcaption+pre]:rounded-t-none"]), $figureElementChildren);
        });

        $this->bind($environment, 'addRenderer');
    }

    /**
     * This method just proxies to our base class, but the
     * signature has to match Commonmark V2.
     *
     * @param  Node  $node
     * @param  ChildNodeRendererInterface  $childRenderer
     * @return mixed|string|\Stringable|null
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        return $this->renderNode($node);
    }


    /**
     * V2 Code node classes.
     *
     * @return string[]
     */
    protected function codeNodes()
    {
        return [
            FencedCode::class,
            // IndentedCode::class,
        ];
    }

    /**
     * Get the string content from a V2 node.
     *
     * @param $node
     * @return string
     */
    protected function getLiteralContent($node)
    {
        $config = SiteConfig::get();
        $content = preg_replace('/{api_url}/i', $config['api_url'], $node->getLiteral());

        return $content;
    }
}
