<?php

/**
 * Copyright (c) 2022 Tectalic (https://tectalic.com)
 *
 * For copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * Please see the README.md file for usage instructions.
 */

declare(strict_types=1);

namespace Tectalic\OpenAi\Models\FineTunes;

use Tectalic\OpenAi\Models\AbstractModel;

final class ListResponseItemItem extends AbstractModel
{
    /** @var string */
    public $object;

    /** @var int */
    public $created_at;

    /** @var string */
    public $level;

    /** @var string */
    public $message;
}
