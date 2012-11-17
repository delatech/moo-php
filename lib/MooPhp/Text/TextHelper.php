<?php
/**
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 * @license ISC
 */
namespace MooPhp\Text;

use MooPhp\MooInterface\MooApi;
use MooPhp\MooInterface\Data\Template\Template;
use MooPhp\MooInterface\Data\Types\Font;
use MooPhp\MooInterface\Data\UserData\TextData;
use MooPhp\MooInterface\Data\Template\Items\TextItem;
use MooPhp\MooInterface\Data\Template\Items\MultiLineTextItem;
use MooPhp\MooInterface\Data\FontSpec;
use InvalidArgumentException;

class TextHelper
{

    protected $_api;

    public function __construct(MooApi $api)
    {
        $this->_api = $api;
    }

    public function fitTextData(TextData $textData, Template $template)
    {
        $item = $template->getItemByLinkId($textData->getLinkId());
        if (!$item) {
            throw new \InvalidArgumentException("Item {$textData->getLinkId()} of template does not exist.");
        }
        if (!$item instanceof TextItem) {
            throw new \InvalidArgumentException(
                "Item {$textData->getLinkId()} of template is not a text item. Got: " . get_class($item));
        }
        /**
         * @var TextItem $item
         */
        $size = $this->fitTextToTextItem($textData->getText(), $item, $textData->getPointSize(), $textData->getFont());
        $textData->setPointSize($size);
    }

    public function fitTextToTextItem($text,
                                      \MooPhp\MooInterface\Data\Template\Items\TextItem $item,
                                      $fontSize = null,
                                      Font $font)
    {
        $fontSpec = self::fontSpecFromItem($item, $font->getFamily(), $font->getBold(), $font->getItalic());
        $clippingBox = $item->getClippingBox();

        $maxHeight = $clippingBox->getHeight();
        $maxWidth = $clippingBox->getWidth();

        if (!isset($fontSize)) {
            $fontSize = $item->getPointSize();
        }
        $measure = $this->_api->textMeasure($text, $fontSize, $fontSpec);
        $height = $measure->getTextHeight();
        $width = $measure->getTextWidth();

        $lastLarge = null;

        while ($height > $maxHeight || $width > $maxWidth) {
            $lastLarge = $fontSize;
            $newFontSizeA = null;
            $newFontSizeB = null;
            $newFontSize = $fontSize;
            if ($width > $maxWidth) {
                $newFontSize = $newFontSizeA = ($maxWidth / $width) * $fontSize;
            }
            if ($height > $maxHeight) {
                $newFontSize = $newFontSizeB = ($maxHeight / $height) * $fontSize;
            }
            if (isset($newFontSizeA) && isset($newFontSizeB)) {
                $newFontSize = min($newFontSizeA, $newFontSizeB);
            }
            if ($newFontSize > $fontSize || $fontSize - $newFontSize < 0.5) {
                $newFontSize = $fontSize - 0.5;
            }
            if ($newFontSize < 0) {
                throw new \RuntimeException("Unable to size text to fit.");
            }
            $fontSize = $newFontSize;
            $measure = $this->_api->textMeasure($text, $fontSize, $fontSpec);
            $height = $measure->getTextHeight();
            $width = $measure->getTextWidth();
        }

        if (isset($lastLarge)) {
            $min = $fontSize;
            $max = $lastLarge;
            $wdiff = $maxWidth - $width;
            $hdiff = $maxHeight - $height;
            while (($wdiff > 1 && $hdiff > 0.2) || $height > $maxHeight || $width > $maxWidth) {
                $fontSize = ($min + $max) / 2;
                $measure = $this->_api->textMeasure($text, $fontSize, $fontSpec);
                $height = $measure->getTextHeight();
                $width = $measure->getTextWidth();

                if ($height > $maxHeight || $width > $maxWidth) {
                    $max = $fontSize;
                } else {
                    $min = $fontSize;
                }

                $wdiff = $maxWidth - $width;
                $hdiff = $maxHeight - $height;
            }
        }

        return $fontSize;
    }

    public static function fontSpecFromItem($item, $family = null, $bold = null, $italic = null)
    {
        if (!$item instanceof TextItem && !$item instanceof MultiLineTextItem) {
            throw new InvalidArgumentException("Item is not a variety of text item.");
        }
        $itemFont = $item->getFont();

        $family = isset($family) ? $family : $itemFont->getFamily();
        $bold = isset($bold) ? $bold : $itemFont->getBold();
        $italic = isset($italic) ? $italic : $itemFont->getItalic();

        return new FontSpec($family, $bold, $italic);
    }
}
