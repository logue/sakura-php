<?php

/**
 * 定数パースクラス.
 *
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2019 Masashi Yoshikawa
 * @license   MIT
 */

declare(strict_types=1);

namespace Logue\SakuraPhp;

use SplFileObject;

class ConstantParser extends AbstractParser implements ParserInterface
{
    /** @var string 元のファイル */
    protected $sourceFile = 'reserved.constants.html';

    /** @var string 出力ファイル名 */
    protected $outputFile = 'php-constant.kwd';

    /** @var array */
    public $constants = [];

    /**
     * パース
     */
    public function parse(): void
    {
        $constants = [];
        $keys = $this->query->execute('dt>strong>code');
        $infos = $this->query->execute('dd>span');
        for ($i = 0; $i <= count($keys); $i++) {
            $key = trim(preg_replace('/\((.+)?\)$/', '', $keys[$i]->textContent));
            $info = trim(str_replace('       ', '', $infos[$i]->textContent));
            if (empty($key)) {
                continue;
            }
            $keywords[$key] = $info;
        }
        $this->keywords = array_unique($keywords);
    }

    /**
     * 出力
     */
    public function __toString(): string
    {
        $ret = [];
        foreach ($this->keywords as $key => $value) {
            $ret[] = $key . ' /// ' . $value;
        }
        return implode("\r\n", $ret);
    }
}
