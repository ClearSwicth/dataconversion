<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */
namespace ClearSwitch\DataConversion\DataType;
use ClearSwitch\DataConversion\DataConversion;

/**
 * Interface BaseType
 * @package ClearSwitch\DataType
 */
interface BaseType
{
    /**
     * Date: 2021/4/1 6:08 下午
     * @param DataConversion $data
     * @return mixed
     * @author daikai
     */
    public function Conversion(DataConversion $data);
}
