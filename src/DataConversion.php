<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearSwitch\DataConversion;

use ClearSwitch\DoraemonIoc\Container;
use function Doctrine\Common\Cache\Psr6\get;

/**
 * Class DataConversion
 * @package ClearSwitch\DataConversion
 */
class DataConversion
{
    /**
     * 数据类型
     * @var string[]
     */
    private $type;

    /**
     * @var
     */
    public $data;

    /**
     * 传进来数据的类型
     * @var
     */
    public $requestDataType;
    /**
     * 服务容器
     * @var
     */
    private $Container;
    /**
     * @var
     */
    private $useClass;

    public function __construct()
    {
        Container::bind('json', 'ClearSwitch\DataConversion\DataType\DataJson');
        Container::bind('array', 'ClearSwitch\DataConversion\DataType\DataArray');
        Container::bind('xml', 'ClearSwitch\DataConversion\DataType\DataXml');
    }

    /**
     * Date: 2021/4/1 3:51 下午
     * @param $data
     * @param $type
     * @author daikai
     */
    public function dataConversion($data, $type)
    {
        $this->data = $data;
        $this->type = strtolower($type);
        $this->prepare();
        try {
            return Container::make($this->type)->Conversion($this);
        } catch (\Exception $re) {
            throw new \Exception("暂时只支持array,json,xml,urlencoded的转换");
        }
    }

    /**
     * Date: 2023/3/14 下午12:19
     * @throws \Exception
     * @author ClearSwitch
     */
    public function prepare()
    {
        switch (gettype($this->data)) {
            case "array":
                $this->requestDataType = 'array';
                break;
            case "string":
                if (!empty(json_decode($this->data))) {
                    $this->requestDataType = 'json';
                } elseif (!empty(@simplexml_load_string($this->data))) {
                    $this->requestDataType = 'xml';
                } else {
                    throw new \Exception("暂时只支持array,json,xml的转换");
                }
                break;
            default:
                throw new \Exception("暂时只支持array,json,xml的转换");
                break;
        }
    }


}
