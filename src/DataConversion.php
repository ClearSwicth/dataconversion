<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */
 namespace ClearsWitch\DataConversion;
 use ClearSwitch\DataType\BaseType;
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
    private $data;

    /**
     * 传进来数据的类型
     * @var
     */
    private $requestDataType;
    /**
     * @var array
     */
    private $dataClass=[
        'json'=>'ClearSwitch\DataType\DataJson',
        'array'=>'ClearSwitch\DataType\DataArray',
        'xml'=>'ClearSwitch\DataType\DataXml',
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
       $this->conversiontype()->Conversion();
    }

    /**
     * Date: 2021/4/1 3:22 下午
     * @return bool
     * @author daikai
     */
    public function prepare(){
        switch ($this->data){
            case(is_array($this->data)):
                $this->requestDataType='array';
                break;
            case(!empty(json_decode($this->data))):
                $this->requestDataType='josn';
                break;
            case(simplexml_load_string($this->data)):
                $this->requestDataType='xml';
                break;
            default:
                return false;
                break;
        }
        if(!isset($this->dataClass[$this->type])){
            return false;
        }
    }

    /**
     * Date: 2021/4/1 3:22 下午
     * @return mixed
     * @author daikai
     */
    public function conversiontype(){
        //$this->useClass=new $this->dataClass[$this->type]();
        //return $this;
        return new $this->dataClass[$this->type]();
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
