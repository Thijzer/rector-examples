<?php

require __DIR__.'/../vendor/autoload.php';

use PhpParser\ParserFactory;
use PhpParser\NodeTraverser;
use Misery\Component\NodeVisitors\EchoCounterNodeVisitor;

$parserFactory = new ParserFactory();

$parser = $parserFactory->create(ParserFactory::PREFER_PHP7);
$originalCode = <<<'CODE_SAMPLE'

<?php
echo 'Hello, world!';
echo 'Foo, bar!';
CODE_SAMPLE;

// Parse the original code
$statements = $parser->parse($originalCode);
assert(is_array($statements));

// Traverse all the nodes with EchoCounterNodeVisitor enabled
$traverser = new NodeTraverser();

$echoCounterNodeVisitor = new EchoCounterNodeVisitor();
$traverser->addVisitor($echoCounterNodeVisitor);
$traverser->traverse($statements);

$numberOfEchoes = $echoCounterNodeVisitor->getNumberOfEchos();

echo $numberOfEchoes;