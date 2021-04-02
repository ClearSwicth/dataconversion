<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearsWitch\DataConversion\DataType;


use ClearsWitch\DataConversion\DataConversion;

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
    public function prepare($data){
        switch ($data->requestDataType){
            case "json":
                $data->data=json_decode($data->data);
                break;
            case "xml":
                $data->data=json_decode(json_encode(simplexml_load_string($data->data),JSON_UNESCAPED_UNICODE),true);
                break;
            case "array":
              $data->data=$data->data;
                break;
            default :
                $data->data='暂只支持数组，xml,json 的转换';

        }
    }
}
