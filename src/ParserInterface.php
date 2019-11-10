<?php

/**
 * パーサーのインターフェース
 *
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2019 Masashi Yoshikawa
 * @license   MIT
 */

declare(strict_types=1);

namespace Logue\SakuraPhp;

interface ParserInterface
{
    /**
     * パース
     */
    public function parse(): void;
    /**
     * 出力
     */
    public function __toString(): string;
}
