<?php

/**
 * Copyright (c) 2022 Tectalic (https://tectalic.com)
 *
 * For copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * Please see the README.md file for usage instructions.
 */

declare(strict_types=1);

namespace Tectalic\OpenAi\Models\ImagesVariations;

use Tectalic\OpenAi\Models\AbstractModel;

final class CreateImageResponse extends AbstractModel
{
    /**
     * List of required property names.
     *
     * These properties must all be set when this Model is instantiated.
     */
    protected const REQUIRED = ['created', 'data'];

    /** @var int */
    public $created;

    /** @var \Tectalic\OpenAi\Models\ImagesVariations\CreateImageResponseDataItem[] */
    public $data;
}
