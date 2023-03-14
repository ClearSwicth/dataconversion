<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearSwitch\DataConversion\DataType;


use ClearsWitch\DataConversion\DataConversion;

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
                $data->data='暂只支持数组，xml,json 的转换';
        }
    }
}
