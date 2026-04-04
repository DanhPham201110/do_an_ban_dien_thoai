<?php
return [
    [
        "name" => "Thống kê báo cáo",
        "route" => "get.home.index",
        "icon" => "fa-solid fa-house",
    ],
    [
        "name" => "Tài khoản",
        "route" => "",
        "icon" => "fa-solid fa-user",
        "sub" => [
            [
                "name" => "Người dùng",
                "route" => "get.user.index",
            ],
            [
                "name" => "Admin",
                "route" => "get.admin.index",
            ]
        ]
    ],
    [
        "name" => "Giới thiệu",
        "route" => "get.info.index",
        "icon" => "fa-solid fa-house",
    ],
    [
        "name" => "Liên hệ",
        "route" => "get.contacts.index",
        "icon" => "fa-solid fa-address-book",
    ],
    [
        "name" => "Sản phẩm",
        "route" => "",
        "icon" => "fa-solid fa-book",
        "sub" => [
            [
                "name" => "Hãng điện thoại",
                "route" => "get.categories.index",
            ],
            [
                "name" => "Sản phẩm",
                "route" => "get.products.index",
            ],
        ]
    ],
    [
        "name" => "Đơn hàng",
        "route" => "get.orders.index",
        "icon" => "fa-solid fa-cart-shopping",
    ],
//    [
//        "name" => "Thiết lập từ khóa",
//        "route" => "",
//        "icon" => "fa-solid fa-key",
//        "sub" => [
//            [
//                "name" => "Trường học",
//                "route" => "get.schools.index",
//            ],
////            [
////                "name" => "Trình độ học vấn",
////                "route" => "get.education_level.index",
////            ],
//            [
//                "name" => "Chuyên ngành",
//                "route" => "get.majors.index",
//            ],
//            [
//                "name" => "Môn học",
//                "route" => "get.subjects.index",
//            ],
//            [
//                "name" => "Danh mục sách",
//                "route" => "get.book_categories.index",
//            ]
//        ]
//    ],
    [
        "name" => "Truyền thông",
        "route" => "",
        "icon" => "fa-solid fa-rectangle-ad",
        "sub" => [
            [
                "name" => "Danh mục trang",
                "route" => "get.blog_categories.index",
            ],
            [
                "name" => "Blog",
                "route" => "get.blog.index",
            ]
        ]
    ],
//    [
//        "name" => "Hệ thống",
//        "route" => "",
//        "icon" => "fa-solid fa-screwdriver-wrench",
//    ]
];