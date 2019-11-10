<?php

/**
 * パース基底クラス.
 *
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2019 Masashi Yoshikawa
 * @license   MIT
 */

declare(strict_types=1);

namespace Logue\SakuraPhp;

use DomDocument;
use PharData;
use SplFileObject;
use Zend\Dom\Query;

abstract class AbstractParser
{
    /** @var string マニュアルの場所 */
    private $uri = 'https://www.php.net/distributions/manual/php_manual_ja.tar.gz';

    /** @var string マニュアルの一時ファイル名 */
    private $manualFile = 'php_manual.tar.gz';

    /** @var string 対象ファイル*/
    protected $sourceFile;

    /** @var string 一時ディレクトリ */
    private $tmpDir;

    /** @var \Zend\Dom\Query DOMクエリオブジェクト */
    protected $query;

    final public function __construct()
    {
        $this->tmpDir = dirname(__FILE__) . '/../tmp';

        if (file_exists($this->tmpDir) === false) {
            // 一時ディレクトリがない場合作成
            mkdir($this->tmpDir);
        }
        // DomQueryオブジェクト生成
        $query = new Query();
        // HTMLとして処理する
        $query->setDocumentHtml($this->fetch(), 'UTF-8');
        $this->query = $query;

        $this->parse();
    }

    /**
     * パース
     */
    public function parse(): void
    {
    }

    /**
     * 出力
     */
    public function __toString(): string
    {
        return '';
    }

    /**
     * ファイル取得
     *
     * @return string
     */
    private function fetch(): string
    {
        ini_set('memory_limit', '256M');

        $file = $this->tmpDir . '/' . $this->manualFile;

        if (! file_exists($file)) {
            // マニュアルの圧縮ファイルを取得
            file_put_contents($file, file_get_contents($this->uri));
        }

        $sfo = new SplFileObject($file);

        if (! file_exists($this->sourceFile)) {
            // 指定されたファイルのみhtmlディレクイトリに展開
            $zip = new PharData($file);
            $zip->extractTo($this->tmpDir, $this->sourceFile, true);
        }

        return \file_get_contents($this->tmpDir . '/' . $this->sourceFile);
    }
}
