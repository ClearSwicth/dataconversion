<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */

namespace ClearSwitch\DataConversion\DataType;

use ClearSwitch\DataConversion\DataConversion;
class DataXml implements BaseType
{

    /**
     * xml的编码方式
     * @var
     */
   public $charset="UTF-8";
    /**
     * Date: 2021/4/1 3:13 下午
     * @param DataConversion $data
     * @return mixed|void
     * @author daikai
     */
 public function Conversion(DataConversion $data)
  {
      $this->prepare($data);
      if($data->requestDataType=="xml"){
       return $this->data;
      }
      return $this->arrayToXml($data->data);
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
            case "array":
                $data->data=$data->data;
                break;
            case "json":
                $data->data=$data->data;
                break;
            default :
                $data->data='暂只支持数组，xml,json 的转换';

        }
    }

    /**
     * Date: 2021/4/2 9:02 上午
     * @param $arr
     * @param int $dom
     * @param int $item
     * @return false|string
     * @author daikai
     */
    function arrayToXml($arr,$dom=0,$item=0){
        if (!$dom){
            $dom = new \DOMDocument("1.0",$this->charset);
        }
        if(!$item){
            $item = $dom->createElement("request");
            $dom->appendChild($item);
        }
        foreach ($arr as $key=>$val){
            $itemx = $dom->createElement(is_string($key)?$key:"item");
            $item->appendChild($itemx);
            if (!is_array($val)){
                $text = $dom->createTextNode($val);
                $itemx->appendChild($text);
            }else {
                $this->arrayToXml($val,$dom,$itemx);
            }
        }
        return $dom->saveXML();
    }

    public function arrayToXml1($arr){
        $xml = "<root>";
        foreach ($arr as $key=>$val){
            if(is_array($val)){
                $xml.="<".$key.">".$this->arrayToXml($val)."</".$key.">";
            }else{
                $xml.="<".$key.">".$val."</".$key.">";
            }
        }
        $xml.="</root>";
        return $xml;
    }
}
