<?php

namespace App\Markdown;

use App\Services\Seapay;
use Illuminate\Support\Facades\Blade;
use illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Event\DocumentRenderedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Renderer\HtmlRenderer;

class BladeRendererExtension implements ExtensionInterface
{
    protected $environment;

    protected $rendered = [];

    protected $seapay;

    public function __construct() {
       $this->seapay = new Seapay(config('services.seapay.enpoint'));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $this->environment = $environment;

        $environment->addEventListener(
            DocumentParsedEvent::class,
            [$this, 'onDocumentParsed'],
            -10
        );

        $environment->addEventListener(
            DocumentRenderedEvent::class,
            [$this, 'onDocumentRendered'],
            10
        );
    }

    public function onDocumentParsed(DocumentParsedEvent $event)
    {
        // Walk through every node in the document
        foreach ($event->getDocument()->iterator() as $node) {

            // We're only looking for code nodes.
            if (! $this->isCodeNode($node)) {
                continue;
            }

            // Create a unique, random ID
            $id = Str::uuid()->toString();

            // Create a new HTML block that just has our placeholder
            $replacement = new HtmlBlock(HtmlBlock::TYPE_6_BLOCK_ELEMENT);
            $replacement->setLiteral("[[replace:$id]]");

            // Replace the code node with our placeholder
            $node->replaceWith($replacement);

            // Create an identical renderer to the main one
            $renderer = new HtmlRenderer($this->environment);

            // Render the code node and stash it away.
            $this->rendered[$id] = $renderer->renderNodes([$node]);
        }
    }

    public function onDocumentRendered(DocumentRenderedEvent $event)
    {
        $search = [];
        $replace = [];

        // Gather up all the placeholders and their real content
        foreach ($this->rendered as $id => $content) {
            $search[] = "[[replace:$id]]";
            $replace[] = $content;
        }

        // The HTML that Commonmark generated
        $content = $event->getOutput()->getContent();

        preg_match_all('/\$(\w+)/', $content, $matches);

        $variables = array_unique($matches[1]);

        $availableData = $this->getData();

        $data = array_filter(
            $availableData,
            function ($key) use($variables) {return in_array($key, $variables);
            },
            ARRAY_FILTER_USE_KEY
        );  

        // First render the output without code blocks.
        $content = Blade::render($content, $data);

        // Then add the code blocks back in.
        $content = Str::replace($search, $replace, $content);

        // And replace the entire response with our new, Blade-processed output.
        $event->replaceOutput(
            new RenderedContent($event->getOutput()->getDocument(), $content)
        );
    }

    protected function isCodeNode($node)
    {
        return $node instanceof FencedCode
            || $node instanceof IndentedCode
            || $node instanceof Code;
    }

    protected function getData(){

        $subbanks = $this->seapay->getAvailableSubbanks();

        return [
            'subbanks' => $subbanks
        ];
    }
}
