<?php
/**
 * Created by PhpStorm.
 * User: Inhere
 * Date: 2015/2/7
 * Time: 19:14
 * Use :
 * File: TraitUseOption.php
 */

namespace MyLib\SimpleConfig;

/**
 * Class LiteConfigTrait
 * @package MyLib\SimpleConfig
 * @property array $config 必须在使用的类定义此属性, 在 Trait 中已定义的属性，在使用 Trait 的类中不能再次定义
 */
trait LiteConfigTrait
{
    /**
     * @param $name
     * @return bool
     */
    public function hasConfig($name)
    {
        return array_key_exists($name, $this->config);
    }

    /**
     * Method to get property Options
     * @param   string $name
     * @param   mixed $default
     * @return  mixed
     */
    public function getValue($name, $default = null)
    {
        $value = array_key_exists($name, $this->config) ? $this->config[$name] : $default;

        if ($value && ($value instanceof \Closure)) {
            $value = $value();
        }

        return $value;
    }

    /**
     * Method to set property config
     * @param   string $name
     * @param   mixed $value
     * @return  static  Return self to support chaining.
     */
    public function setValue($name, $value)
    {
        $this->config[$name] = $value;

        return $this;
    }

    /**
     * delete a option
     * @param $name
     * @return mixed|null
     */
    public function delValue($name)
    {
        $value = null;

        if ($this->hasConfig($name)) {
            $value = $this->getValue($name);

            unset($this->config[$name]);
        }

        return $value;
    }

    /**
     * Method to get property Options
     * @param string|null $key
     * @return array
     */
    public function getConfig($key = null)
    {
        if ($key) {
            return $this->getValue($key);
        }

        return $this->config;
    }

    /**
     * Method to set property config
     * @param  array $config
     * @param  bool $merge
     * @return static Return self to support chaining.
     */
    public function setConfig(array $config, $merge = true)
    {
        $this->config = $merge ? array_merge($this->config, $config) : $config;

        return $this;
    }
}
