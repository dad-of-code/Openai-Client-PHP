<?php

/**
 * Copyright (c) 2022 Tectalic (https://tectalic.com)
 *
 * For copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * Please see the README.md file for usage instructions.
 */

declare(strict_types=1);

namespace Tectalic\OpenAi\Models\Embeddings;

use Tectalic\OpenAi\Models\AbstractModel;

final class CreateResponseItem extends AbstractModel
{
    /** @var int */
    public $index;

    /** @var string */
    public $object;

    /** @var int[]|float[] */
    public $embedding;
}
