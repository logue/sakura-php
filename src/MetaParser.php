<?php

/**
 * メタ情報パースクラス.
 *
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2019 Masashi Yoshikawa
 * @license   MIT
 */

declare(strict_types=1);

namespace Logue\SakuraPhp;

class MetaParser extends AbstractParser implements ParserInterface
{
    /** @var string 発行日 */
    public $pubdate;
    /** @var string 著作権情報 */
    public $copyright;
    /** @var string 対象ファイル*/
    protected $sourceFile = 'php-chunked-xhtml/index.html';

    /**
     * パース
     */
    public function parse(): void
    {
        $this->pubdate = $this->query->execute('.pubdate')[0]->textContent;
        $this->copyright = str_replace(["\r", "\n", '  '], '', $this->query->execute('.copyright')[0]->textContent);
    }

    /**
     * 出力
     */
    public function __toString(): string
    {
        return
        '; PHP マニュアル' . $this->pubdate . '版より生成' . "\r\n" .
        '; ' . $this->copyright . "\r\n\r\n";
    }
}
