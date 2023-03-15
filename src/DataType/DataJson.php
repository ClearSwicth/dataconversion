<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearSwitch\DataConversion\DataType;


use ClearSwitch\DataConversion\DataConversion;

class DataJson implements BaseType
{
    public function Conversion(DataConversion $data)
    {
        $this->prepare($data);
        return $data->data;
    }
    /**
     * 都转为数组
     * @param $data
     * @author daikai
     */
    public function prepare($data){
        switch ($data->requestDataType){
            case "json":
                $data->data=$data->data;
                break;
            case "xml":
              $data->data=json_encode(simplexml_load_string($data->data),JSON_UNESCAPED_UNICODE);
                break;
            case "array":
                $data->data=json_encode($data->data,JSON_UNESCAPED_UNICODE);
                break;
            default :
                throw new \Exception("暂时只支持array,json,xml的转换");
                break;
        }
    }
}
