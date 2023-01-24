<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;

use EndorphinStudio\Detector\Detector;

/**
 * Class Result
 * Class with result of detection
 * @package EndorphinStudio\Detector\Data
 */
class Result implements \JsonSerializable
{
    /**
     * @var Detector
     */
    private $detector;
    private $version = '1.3';

    public function getCoreVersion(): string
    {
        if(!is_null($this->detector) && method_exists($this->detector, 'getVersion')) {
            return $this->detector->getVersion();
        }
        return '4.0.4';
    }

    public function getModulesVersions(): array
    {
        return [
            'endorphin-studio/browser-detector-data' => $this->version
        ];
    }

    public function getDetectorVersion(): string
    {
        return 'method'.__METHOD__.' is deprecated; soon it will be removed';
    }

    public function getDataVersion(): string
    {
        return 'method'.__METHOD__.' is deprecated; soon it will be removed';
    }

    /**
     * Get User Agent
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /** @var string UserAgent */
    protected $userAgent = null;

    /**
     * @var Os Result of os detection
     */
    protected $os;
    /**
     * @var Browser Result of browser detection
     */
    protected $browser;
    /**
     * @var Device Result of device detection
     */
    protected $device;

    /**
     * @var boolean true if device is touch
     */
    protected $isTouch = false;
    /**
     * @var boolean true if device is mobile
     */
    protected $isMobile = false;

    /**
     * True if user is touch
     * @return bool
     */
    public function isTouch(): bool
    {
        return $this->isTouch;
    }

    /**
     * Setter
     * @param bool $isTouch
     */
    public function setIsTouch(bool $isTouch)
    {
        $this->isTouch = $isTouch;
    }

    /**
     * True if user is mobile
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->isMobile;
    }

    /**
     * Setter
     * @param bool $isMobile
     */
    public function setIsMobile(bool $isMobile)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * True if user is tablet
     * @return bool
     */
    public function isTablet(): bool
    {
        return $this->isTablet;
    }

    /**
     * Setter
     * @param bool $isTablet
     */
    public function setIsTablet(bool $isTablet)
    {
        $this->isTablet = $isTablet;
    }

    /** @var boolean true if user is tablet */
    protected $isTablet = false;

    /**
     * Result constructor.
     * @param string $userAgent User Agent
     */
    public function __construct(string $userAgent, Detector $detector = null)
    {
        $this->os = new Os($this);
        $this->device = new Device($this);
        $this->browser = new Browser($this);
        $this->userAgent = $userAgent;
        $this->detector = $detector;
    }

    /**
     * Get result of os detection
     * @return Os
     */
    public function getOs(): Os
    {
        return $this->os;
    }

    /**
     * Get result of browser detection
     * @return Browser
     */
    public function getBrowser(): Browser
    {
        return $this->browser;
    }

    /**
     * Get result of device detection
     * @return Device
     */
    public function getDevice(): Device
    {
        return $this->device;
    }

    /**
     * Get result of robot detection
     * @return Robot
     */
    public function getRobot(): Robot
    {
        return $this->robot;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}