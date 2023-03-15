<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearSwitch\DataConversion\DataType;


use ClearSwitch\DataConversion\DataConversion;

class DataArray implements BaseType
{
    public function Conversion(DataConversion $data)
    {
        $this->prepare($data);
        return $data->data;
    }

    /**
     * Date: 2021/4/2 9:35 上午
     * @param $data
     * @author daikai
     */
    public function prepare($data)
    {
        switch ($data->requestDataType) {
            case "json":
                $data->data = json_decode($data->data, true);
                break;
            case "xml":
                $data->data = json_decode(json_encode(simplexml_load_string($data->data), JSON_UNESCAPED_UNICODE), true);
                break;
            case "array":
                $data->data;
                break;
            default :
                throw new \Exception("暂时只支持array,json,xml的转换");
                break;
        }
    }
}
