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

        while ($height > $maxHeight || $width > $maxWidth) {
            if ($width > $maxWidth) {
                $newFontSize = ($maxWidth / $width) * $fontSize;
            } else {
                $newFontSize = ($maxHeight / $height) * $fontSize;
            }
            if ($newFontSize > $fontSize || $newFontSize - $fontSize < 0.001) {
                // Fiddle to avoid any fun with floats
                $newFontSize = $fontSize - 0.001;
            }
            if ($newFontSize < 0) {
                throw new \RuntimeException("Unable to size text to fit.");
            }
            $fontSize = $newFontSize;
            $measure = $this->_api->textMeasure($text, $fontSize, $fontSpec);
            $height = $measure->getTextHeight();
            $width = $measure->getTextWidth();
        }

        return $fontSize;
    }

    public static function fontSpecFromItem($item, $family = null, $bold = null, $italic = null)
    {
        if (!$item instanceof TextItem && !$item instanceof MultiLineTextItem) {
            throw new InvalidArgumentException("Item is not a variety of text item.");
        }
        $itemFont = $item->getFont();

        if (!isset($fontSpec)) {
            $family = $itemFont->getFamily();
            $bold = $itemFont->getBold();
            $italic = $itemFont->getItalic();
        } else {
            $family = $family ? : $itemFont->getFamily();
            $bold = $bold ? : $itemFont->getBold();
            $italic = $italic ? : $itemFont->getItalic();
        }
        return new FontSpec($family, $bold, $italic);
    }
}
