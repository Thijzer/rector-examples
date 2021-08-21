<?php

declare(strict_types=1);

namespace Misery\Component\NodeVisitors;

use PhpParser\Node;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\NodeVisitorAbstract;

final class EchoCounterNodeVisitor extends NodeVisitorAbstract
{
    /** @var int $numberOfEchos */
    private $numberOfEchos;
    
    public function beforeTraverse(array $nodes)
    {
        $this->numberOfEchos = 0;
        
        return null;
    }

    /**
    * @return Node|int|null
    */
    public function enterNode(Node $node)
    {
        if ($node instanceof Echo_) {
            $this->numberOfEchos++;
        }

        return null;
    }

    public function getNumberOfEchos(): int
    {
        return $this->numberOfEchos;
    }
}