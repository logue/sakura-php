<?php

/**
 * キーワードパースクラス.
 *
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2019 Masashi Yoshikawa
 * @license   MIT
 */

declare(strict_types=1);

namespace Logue\SakuraPhp;

use SplFileObject;

class KeywordParser extends AbstractParser implements ParserInterface
{
    /** @var string 元のファイル */
    protected $sourceFile = 'reserved.keywords.html';

    /** @var string 出力ファイル名 */
    protected $outputFile = 'php-keyword.kwd';

    /** @var array */
    public $keywords = [];

    /**
     * パース
     */
    public function parse(): void
    {
        $keywords = [];
        $dom = $this->query->execute('.link, .function');
        foreach ($dom as $node) {
            $keywords[] = trim(preg_replace('/\((.+)?\)$/', '', $node->textContent));
        }
        $this->keywords = array_unique($keywords);
    }

    /**
     * 出力
     */
    public function __toString(): string
    {
        return implode("\r\n", $this->keywords);
    }
}
