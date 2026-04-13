<?php

namespace Modules\Products\Enums;

class OrderEnum
{
    const CANCEL = -1;
    const WAITING_CONFIRM = 0;
    const CONFIRM = 1;
    const SUCCESS = 2;

    const ARR_STATUS = [
        self::SUCCESS => [
            "text" => "Thành công",
            "textBtn" => "Hoàn thành đơn",
            "class" => "badge bg-success",
        ],
        self::WAITING_CONFIRM => [
            "text" => "Chờ xác nhận",
            "textBtn" => "",
            "class" => "badge bg-light",
        ],
        self::CONFIRM => [
            "text" => "Xác nhận",
            "textBtn" => "Xác nhận đơn",
            "class" => "badge bg-primary",
        ],
        self::CANCEL => [
            "text" => "Hủy",
            "textBtn" => "Hủy đơn",
            "class" => "badge bg-danger",
        ],
    ];
}