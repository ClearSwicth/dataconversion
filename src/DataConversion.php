<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearSwitch\DataConversion;

use ClearSwitch\DoraemonIoc\Container;

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
     * @var array
     */
    private $dataClass = [
        'json' => 'ClearSwitch\DataConversion\DataType\DataJson',
        'array' => 'ClearSwitch\DataConversion\DataType\DataArray',
        'xml' => 'ClearSwitch\DataConversion\DataType\DataXml',
    ];
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
        $this->Container = new Container();
        $this->Container->bind('json', 'ClearSwitch\DataConversion\DataType\DataJson');
        $this->Container->bind('array', 'ClearSwitch\DataConversion\DataType\DataArray');
        $this->Container->bind('xml', 'ClearSwitch\DataConversion\DataType\DataXml');
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
            return $this->Container->make($this->type)->Conversion($this);
        } catch (\Exception $re) {
            return "暂时只支持转换成array,json,xml的格式";
        }
    }

    /**
     * Date: 2023/3/14 下午12:19
     * @throws \Exception
     * @author ClearSwitch
     */
    public function prepare()
    {
        switch ($this->data) {
            case(is_array($this->data)):
                $this->requestDataType = 'array';
                break;
            case(!empty(json_decode($this->data))):
                $this->requestDataType = 'json';
                break;
            case(!empty(@simplexml_load_string($this->data))):
                $this->requestDataType = 'xml';
                break;
            default:
                throw new \Exception("暂时只支持array,json,xml的转换");
                break;
        }
    }


}
