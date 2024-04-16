<?php

namespace App\Markdown;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;

class BadgeExtension implements ExtensionInterface
{
    protected Environment $environment;

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $this->environment = $environment;

        $environment->addEventListener(
            DocumentParsedEvent::class,
            [$this, 'onDocumentParsed'],
        );
    }

    public function onDocumentParsed(DocumentParsedEvent $event)
    {
        // Walk through every node in the document
        foreach ($event->getDocument()->iterator() as $node) {
        }
    }
}
