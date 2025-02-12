<?php
declare(strict_types=1);

namespace MyPlot;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\VanillaBlocks;

class PlotLevelSettings
{
    /** @var string $name */
    public $name;
    /** @var Block $roadBlock */
    public $roadBlock;
    /** @var Block $bottomBlock */
    public $bottomBlock;
    /** @var Block $plotFillBlock */
    public $plotFillBlock;
    /** @var Block $plotFloorBlock */
    public $plotFloorBlock;
    /** @var Block $wallBlock */
    public $wallBlock;
    /** @var int $roadWidth */
    public $roadWidth = 7;
    /** @var int $plotSize */
    public $plotSize = 32;
    /** @var int $groundHeight */
    public $groundHeight = 64;
    /** @var int $claimPrice */
    public $claimPrice = 0;
    /** @var int $clearPrice */
    public $clearPrice = 0;
    /** @var int $disposePrice */
    public $disposePrice = 0;
    /** @var int $resetPrice */
    public $resetPrice = 0;
    /** @var int $clonePrice */
    public $clonePrice = 0;
    /** @var bool $restrictEntityMovement */
    public $restrictEntityMovement = true;
    /** @var bool $restrictPVP */
    public $restrictPVP = false;
    /** @var bool $updatePlotLiquids */
    public $updatePlotLiquids = false;
    /** @var bool $allowOutsidePlotSpread */
    public $allowOutsidePlotSpread = false;
    /** @var bool $displayDoneNametags */
    public $displayDoneNametags = false;
    /** @var bool $editBorderBlocks */
    public $editBorderBlocks = true;

    /**
     * PlotLevelSettings constructor.
     *
     * @param string $name
     * @param array $settings
     */
    public function __construct(string $name, array $settings = [])
    {
        $this->name = $name;
        if (count($settings) > 0) {
            $this->roadBlock = self::parseBlock($settings, "RoadBlock", VanillaBlocks::OAK_PLANKS());
            $this->wallBlock = self::parseBlock($settings, "WallBlock", VanillaBlocks::SMOOTH_STONE_SLAB());
            $this->plotFloorBlock = self::parseBlock($settings, "PlotFloorBlock", VanillaBlocks::GRASS());
            $this->plotFillBlock = self::parseBlock($settings, "PlotFillBlock", VanillaBlocks::DIRT());
            $this->bottomBlock = self::parseBlock($settings, "BottomBlock", VanillaBlocks::BEDROCK());
            $this->roadWidth = self::parseNumber($settings, "RoadWidth", 7);
            $this->plotSize = self::parseNumber($settings, "PlotSize", 32);
            $this->groundHeight = self::parseNumber($settings, "GroundHeight", 64);
            $this->claimPrice = self::parseNumber($settings, "ClaimPrice", 0);
            $this->clearPrice = self::parseNumber($settings, "ClearPrice", 0);
            $this->disposePrice = self::parseNumber($settings, "DisposePrice", 0);
            $this->resetPrice = self::parseNumber($settings, "ResetPrice", 0);
            $this->clonePrice = self::parseNumber($settings, "ClonePrice", 0);
            $this->restrictEntityMovement = self::parseBool($settings, "RestrictEntityMovement", true);
            $this->restrictPVP = self::parseBool($settings, "RestrictPVP", false);
            $this->updatePlotLiquids = self::parseBool($settings, "UpdatePlotLiquids", false);
            $this->allowOutsidePlotSpread = self::parseBool($settings, "AllowOutsidePlotSpread", false);
            $this->editBorderBlocks = self::parseBool($settings, "EditBorderBlocks", true);
        }
    }

    /**
     * @param string[] $array
     * @param int|string $key
     * @param Block $default
     *
     * @return Block
     */
    public static function parseBlock(array &$array, int|string $key, Block $default): Block
    {
        if (isset($array[$key])) {
            $id = $array[$key];
            if (is_numeric($id)) {
                $block = BlockFactory::getInstance()->get((int)$id, 0);
            } else {
                $split = explode(":", $id);
                if (count($split) === 2 and is_numeric($split[0]) and is_numeric($split[1])) {
                    $block = BlockFactory::getInstance()->get((int)$split[0], (int)$split[1]);
                } else {
                    $block = $default;
                }
            }
        } else {
            $block = $default;
        }
        return $block;
    }

    /**
     * @param string[] $array
     * @param int|string $key
     * @param int $default
     *
     * @return int
     */
    public static function parseNumber(array &$array, int|string $key, int $default): int
    {
        if (isset($array[$key]) and is_numeric($array[$key])) {
            return (int)$array[$key];
        } else {
            return $default;
        }
    }

    /**
     * @param array $array
     * @param int|string $key
     * @param bool $default
     *
     * @return bool
     */
    public static function parseBool(array &$array, int|string $key, bool $default): bool
    {
        if (isset($array[$key]) and is_bool($array[$key])) {
            return $array[$key];
        } else {
            return $default;
        }
    }
}