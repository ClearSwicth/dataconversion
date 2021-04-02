# HTTP Client
json,xml，array 数据之间的转换

## 创建新的请求实例
```php
use ClearsWitch\DataConversion\DataConversion;

/**
 * $data需要的转换的数据（暂时只支持json,xml，array）
 *$type 需要转换的格式（暂时只支持json,xml，array）
 */
$obj=new DataConversion();
$obj->dataConversion($data,$type);
```