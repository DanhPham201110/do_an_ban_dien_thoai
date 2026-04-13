<?php

namespace Modules\Products\Enums;

class ProductEnum
{
    const STATUS_ACTIVE     = 1;
    const STATUS_NO_ACTIVE  = 0;
    const STATUS_DELETE     = -1;

    const ARR_STATUS = [
        self::STATUS_ACTIVE     => "Hiển thị",
        self::STATUS_NO_ACTIVE  => "Không hiển thị",
    ];

    const ARR_RAM = [
        "4GB",
        "8GB",
        "12GB",
        "16GB",
        "32GB"
    ];

    const ARR_STORAGE = [
        "16GB",
        "32GB",
        "64GB",
        "128GB",
        "256GB",
        "512GB",
        "1TB"
    ];
    const ARR_SORT = [
        "updated_at" => "Thời gian cập nhật",
        "price_desc" => "Giá từ cao tới thấp",
        "price_asc" => "Giá từ thấp tới cao",
    ];
}