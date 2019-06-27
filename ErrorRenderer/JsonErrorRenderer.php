<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ErrorCatcher\ErrorRenderer;

use Symfony\Component\ErrorCatcher\Exception\FlattenException;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class JsonErrorRenderer implements ErrorRendererInterface
{
    private $debug;

    public function __construct(bool $debug = true)
    {
        $this->debug = $debug;
    }

    /**
     * {@inheritdoc}
     */
    public static function getFormat(): string
    {
        return 'json';
    }

    /**
     * {@inheritdoc}
     */
    public function render(FlattenException $exception): string
    {
        $content = [
            'title' => $exception->getTitle(),
            'status' => $exception->getStatusCode(),
            'detail' => $exception->getMessage(),
        ];
        if ($this->debug) {
            $content['exceptions'] = $exception->toArray();
        }

        return (string) json_encode($content);
    }
}
