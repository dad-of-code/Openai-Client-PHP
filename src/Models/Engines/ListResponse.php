<?php

/**
 * Copyright (c) 2022 Tectalic (https://tectalic.com)
 *
 * For copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * Please see the README.md file for usage instructions.
 */

declare(strict_types=1);

namespace Tectalic\OpenAi\Models\Engines;

use Tectalic\OpenAi\Models\AbstractModel;

final class ListResponse extends AbstractModel
{
    /** @var string */
    public $object;

    /** @var \Tectalic\OpenAi\Models\Engines\ListResponseItem[] */
    public $data;
}
