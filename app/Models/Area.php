<?php

namespace App\Models;

class Area extends Model
{

    /**
     * 区域类型
     */
    const TYPE_PROVINCE = 1; // 省
    const TYPE_CITY = 2; // 市
    const TYPE_COUNTY = 3; // 区

    /**
     * 主键
     *
     * @var int
     */
    public $id;

    /**
     * 类型
     *
     * @var int
     */
    public $type;

    /**
     * 编码
     *
     * @var string
     */
    public $code;

    /**
     * 名称
     *
     * @var string
     */
    public $name;

    public function getSource(): string
    {
        return 'kg_area';
    }

}
