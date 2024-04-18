<?php

namespace App\Markdown;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Event\DocumentRenderedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Util\HtmlElement;

class CodeGroupExtension implements ExtensionInterface
{
    public $groupStart = false;

    public $count = 0;

    public $tabs = [];

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(
            DocumentParsedEvent::class,
            [$this, 'onDocumentParsed'],
        );
    }

    public function onDocumentParsed(DocumentParsedEvent $event)
    {
        // Walk through every node in the document
        foreach ($event->getDocument()->iterator() as $node) {

            /**
             * @var HtmlBlock $node
             */

            //  buat tiap x-code-group unique

            // menemukan codegroup
            if ($node instanceof HtmlBlock && $node->getLiteral() === "<x-code-group>") {
                // code group start
                $this->groupStart = true;
                // Reset the tabs for the new code group
                $this->tabs = [];
            }

            // handle ketika terdapat closing tag </x-code-group>
            if ($node instanceof HtmlBlock && $node->getLiteral() === "</x-code-group>") {
                $this->groupStart = false;

                $tabsChildElement = [];
                // Membuat tombol tab untuk setiap tab dalam daftar tabs
                foreach ($this->tabs as $tab) {
                    $ButtonElement = new HtmlElement('button', [
                        'type' => 'button',
                        'class' => 'px-4 py-2 text-sm ',
                        'role' => 'tab',
                        'x-on:click' => "tab = '$tab'",
                        ':class' => "{'border-b-2 border-indigo-500': tab ==='$tab' }"
                    ], new HtmlElement('div', [
                        'class' => 'px-2 whitespace-nowrap rounded-md group-hover:bg-stone-700/60 group-hover:text-stone-200 text-stone-50'
                    ], $tab));

                    array_push($tabsChildElement, $ButtonElement);
                }

                // Insert a new HtmlBlock after the </x-code-group> block
                // containing a <div> with tabs based on $this->tabs
                $tabsElement = new HtmlElement('div', [
                    'class' => 'flex  w-full overflow-x-auto scrollbar-hide text-stone-50 opacity-95 bg-stone-900 px-3 rounded-t-lg pt-1.5'
                ], $tabsChildElement);

                // Create a new HtmlBlock node
                $newHtmlBlock = new HtmlBlock(HtmlBlock::TYPE_6_BLOCK_ELEMENT);

                $newHtmlBlock->setLiteral($tabsElement);

                // revisit node with HtmlBlock <x-code-group>
                $node = $this->findPreviousBlock($node, function ($node) {
                    return $node instanceof HtmlBlock && $node->getLiteral() === "<x-code-group>";
                });

                // insert htmlelement div with tabs after node HtmlBlock <x-code-group> $this->tabs
                $node->insertAfter($newHtmlBlock);
            }

            /**
             * @var FencedCode $node
             */

            // get languages
            if ($this->groupStart && $node instanceof FencedCode) {

                $lang = $node->getInfo();

                preg_match('/title="([^"]+)"/', $lang ?? "", $matches);

                $tab = $matches[1] ?? $node->getInfo();

                array_push($this->tabs, $tab);

                $node->data->set('attributes/x-show', "tab === '$tab'");
                $node->data->set('attributes/title', '');
                $node->data->set('attributes/data-title', $tab);
                $this->count++;
            }
        }
    }

    private function findPreviousBlock($node, $condition)
    {
        // Traverse backwards until finding a node that satisfies the condition
        while ($node = $node->previous()) {
            if ($condition($node)) {
                return $node;
            }
        }
        // If the node satisfying the condition is not found, return null or handle the case accordingly
        return null;
    }
}
