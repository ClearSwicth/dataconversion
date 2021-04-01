<?php
/**
 *
 * User: daikai
 * Date: 2021/4/1
 */
namespace ClearsWitch\DataConversion\DataType;
use ClearsWitch\DataConversion\DataConversion;

/**
 * Interface BaseType
 * @package ClearSwitch\DataType
 */
interface BaseType
{
    /**
     *
     * @param DataConversion $data
     * @return mixed
     * @author daikai
     */
    public function Conversion(DataConversion $data);
}
