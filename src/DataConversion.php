<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */
 namespace ClearsWitch\DataConversion;
 use ClearsWitch\DataConversion\DataType\BaseType;

 /**
  * Class DataConversion
  * @package ClearsWitch\DataConversion
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
    private $dataClass=[
        'json'=>'ClearsWitch\DataConversion\DataType\DataJson',
        'array'=>'ClearsWitch\DataConversion\DataType\DataArray',
        'xml'=>'ClearsWitch\DataConversion\DataType\DataXml',
    ];

    /**
     * @var
     */
    private $useClass;

    /**
     * Date: 2021/4/1 3:51 下午
     * @param $data
     * @param $type
     * @author daikai
     */
    public function dataConversion($data,$type){
       $this->data=$data;
       $this->type=strtolower($type);
       $this->prepare();

       return $this->conversiontype()->Conversion($this);
    }

    /**
     * Date: 2021/4/1 3:22 下午
     * @return bool
     * @author daikai
     */
    public function prepare(){
       //print_R(simplexml_load_string($this->data));exit;
        switch ($this->data){
            case(is_array($this->data)):
                $this->requestDataType='array';
                break;
            case(!empty(json_decode($this->data))):
                $this->requestDataType='json';
                break;
            case(!empty(@simplexml_load_string($this->data))):
                $this->requestDataType='xml';
                break;
            default:
                return false;
                break;
        }
        if(!isset($this->dataClass[$this->type])){
           echo  '暂只支持数组，xml,json 的转换';exit;
        }
    }

    /**
     * Date: 2021/4/1 6:21 下午
     * @return BaseType
     * @author daikai
     */
    public function conversiontype(...$args){
        return new $this->dataClass[$this->type]([], ...$args);
    }
    /**
     *统一返回的格式
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return false|string
     * @author daikai
     */
    protected  function black(array $data,$msg='',$code=200){
        $result=[
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}
