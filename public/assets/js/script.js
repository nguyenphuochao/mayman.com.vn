$(document).ready(function () {
    // Tìm kiếm sản phẩm auto submit
    $(".top-menu #fa-magnifying-glass").click(function () {
        $("#search_form").submit();
    });
    // Checkout select
    $(".checkout input[name=payment]").change(function () {
        if ($(this).is(':checked')) {
            $(".checkout .payment-sumary").css('display', 'none');
            $(this).parent().next().slideToggle();
        }
    });
    // Menu mobile
    $(".nav-mobile .menu-mobile-parent").click(function () {
        $(this).parent().next('.menu-mobile-child').slideToggle();
        $(this).toggleClass("fa-angle-down fa-angle-up");
    });
    // Thumbnail image
    $(".detail .thumbnail-image img").click(function () {
        $(".detail .thumbnail-image img").removeClass('active');
        var thumb_img = $(this).attr('src');
        $(".detail .big-img img").attr('src', thumb_img);
        $(this).addClass('active');
    });
    // Slick Thumbnail image
    $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            }
        ]
    });
    // Chức năng  giỏ hàng
    // Thêm giỏ hàng nhiều số lượng ở chi tiết sản phẩm
    $(".detail #add-to-cart").click(function () {
        var product_id = $(this).attr("product-id");
        var qty = $(".detail #qty").val();
        var qty_product = $(".detail #qty_product").val();
        if (qty <= 0) {
            Swal.fire({
                icon: "error",
                title: "Giá trị phải lớn hơn hoặc bằng 1",
            });
            return;
        }
        if (qty > qty_product) {
            Swal.fire({
                icon: "error",
                title: "Số lượng trong kho không đủ. Vui lòng nhập lại",
            });
            return;
        }
        // Gọi ajax xử lí
        $.ajax({
            type: "GET",
            url: "carts/add/detail",
            data: { product_id: product_id, qty: qty },
            success: function (data) {
                console.log(data);
                Swal.fire({
                    title: "Đã thêm vào giỏ hàng!",
                    icon: "success"
                });
                displayCart(data);
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
    // Thêm giỏ hàng số lượng 1 ở trang chủ
    $(".add-to-cart").click(function () {
        var product_id = $(this).attr("product-id");
        $.ajax({
            url: "carts/add",
            type: "GET",
            data: { product_id: product_id, qty: 1 }
        })
            .done(function (data) {
                console.log(data);
                Swal.fire({
                    title: "Đã thêm vào giỏ hàng!",
                    icon: "success"
                });
                displayCart(data);
            });
    });
    // Mua ngay ở trang chi tiết sản phẩm
    $(".detail #buy-now").click(function () {
        // Reset error
        $(".detail input").removeClass("border-danger");
        $(".detail textarea").removeClass("border-danger");
        $(".detail .buy-now-error #error_name").html('');
        $(".detail .buy-now-error #error_phone").html('');
        $(".detail .buy-now-error #error_address").html('');
        var product_id = $(".detail input[name=pro_id]").val();
        var name = $(".detail input[name=name]").val();
        var phone = $(".detail input[name=phone]").val();
        var address = $(".detail textarea[name=address]").val();
        var email = $(".detail input[name=email]").val();
        var note = $(".detail textarea[name=note]").val();
        var price = $(".detail input[name=price]").val();
        var qty = $(".detail #qty").val();

        if (name == '') {
            $(".detail .buy-now-error #error_name").html('Họ và tên là bắt buộc');
            $(".detail input[name=name]").addClass("border-danger");
        }
        if (phone == '') {
            $(".detail .buy-now-error #error_phone").html('Số điện thoại là bắt buộc');
            $(".detail input[name=phone]").addClass("border-danger");
        }
        if (address == '') {
            $(".detail .buy-now-error #error_address").html('Hãy nhập địa chỉ cụ thể như số nhà hoặc xóm.');
            $(".detail textarea[name=address]").addClass("border-danger");
        }
        if (name == '' || phone == '' || address == '') return;
        $.ajax({
            type: "POST",
            url: "buy-now",
            data: {
                "_token": $('#token').val(),
                fullname: name,
                phone: phone,
                address: address,
                note: note,
                email: email,
                price: price,
                product_id: product_id,
                qty: qty,
            },
            success: function (response) {
                $('#exampleModalCenter').modal('hide')
                $('#order_received').modal('show')
                console.log(response);
            }
        });
    });
    // Chức năng search ajax
    $(".top-menu form input[type=text]").keyup(function () {
        var name = $(".top-menu form input[type=text]").val();
        $.ajax({
            type: "GET",
            url: "search",
            data: { name: name },
            success: function (response) {
                if (name.length > 0) {
                    $(".top-menu .list-search-product").removeClass("d-none");
                    $(".top-menu .list-search-product #products").html(response);
                } else {
                    $(".top-menu .list-search-product #products").html('');
                    $(".top-menu .list-search-product").addClass("d-none");
                }

            }
        });
    });
    // Chức năng lọc sản phẩm
    $(".category .show_result_filter").change(function () {
        $(".category form#form_filter_product").submit();
    });
});
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
// Hiển thị giỏ hàng ở trang chủ
function displayCart(data) {
    var cart = JSON.parse(data);
    var count = cart.count;
    var items = cart.items;
    var subtotal = cart.subtotal;
    $(".nav-desktop #cart-items").html(items);
    $(".nav-desktop #count").html(count);
    $(".nav-mobile  #count").html(count);
    $(".nav-desktop #subtotal").html(subtotal);
}
// Hiển thị giỏ hàng ở chi tiết giỏ hàng
function displayCartDetail(data) {
    var cart = JSON.parse(data);
    var count = cart.count;
    var items = cart.items;
    var subtotal = cart.subtotal;
    var total = cart.total;
    $(".cart #cart-items").html(items);
    $(".top-menu #count").html(count);
    $(".cart #subtotal").html(subtotal + ' đ');
    $(".cart #total").html(total + ' đ');
    // Remove cart in detail cart
    if (count <= 0) {
        location.reload();
    }
}
// Xóa 1 giỏ hàng ở trang chủ
function deleteProductInCart(rowId) {
    $.ajax({
        url: `carts/delete/${rowId}`,
        type: "GET",
    })
        .done(function (data) {
            console.log(data);
            displayCart(data);
        });
}
// Xóa 1 giỏ hàng ở chi tiết giỏ hàng
function deleteProductInCartDetail(rowId) {
    $.ajax({
        url: `carts/delete-detail/${rowId}`,
        type: "GET",
    })
        .done(function (data) {
            console.log(data);
            displayCartDetail(data);
        });
}
// Cập nhật giỏ hàng
function updateProductInCart() {
    var quantities = [];
    $('.cart input[name^="quantity"]').each(function () {
        quantities.push($(this).val());
    });
    $.ajax({
        type: "GET",
        url: "carts/update",
        data: {
            quantity: quantities
        },
    })
        .done(function (data) {
            Swal.fire({
                title: "Cập nhật giỏ hàng thành công",
                icon: "success"
            });
            displayCartDetail(data);
        })
}
// Click vào đặt mua ngay
function buyNow() {
    var qty = $(".detail #qty").val();
    var price = $(".detail #price").val();
    if (qty <= 0) {
        Swal.fire({
            icon: "error",
            title: "Giá trị phải lớn hơn hoặc bằng 1",
        });
        $('#exampleModalCenter').addClass('d-none')
        return;
    }
    $.ajax({
        type: "GET",
        url: "dat-mua-ngay",
        data: {
            price: price,
            qty: qty
        },
        success: function (response) {
            $(".detail #subtotal").html(response + 'đ');
            console.log(response);
        }
    });
}
