jQuery(document).ready(function($){
    
    /*Cart*/
    function showCart(cart){
        if($.trim(cart) === '<h3>Корзина пуста</h3>'){
            $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
        }else{
            $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
        }
        $('#cart .modal-body').html(cart);
        $('#cart').modal();
        if($('.cart-sum').text()){
            $('.simpleCart_total').html($('#cart .cart-sum').text());
        }else{
            $('.simpleCart_total').text('Empty Cart');
        }
    }

    $('body').on('click', '.add-to-cart', function(e){
        e.preventDefault();
        const $this = $(this);
        const id = $this.data('id');
        const qty = 1;
        console.log(id, qty);
        
        $.ajax({
            url: baseUrl + 'cart/add/' + id,
            data: {
                id: id,
                qty: qty
            },
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Error');
            }
        });
    });
    
    $('#cart .modal-body').on('click', '.del-item', function(){
        var id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'cart/delete/' + id,
            data: {id: id},
            type: 'GET',
            success: function(res){
                const url = window.location.toString();
                if (url.indexOf('cart/view') !== -1) {
                    window.location = url;
                } else {
                    showCart(res);
                }
            },
            error: function(){
                alert('Error!');
            }
        });
    });
    
    $('body').on('click', '#get-cart', function(e){
        e.preventDefault();
        $.ajax({
            url: baseUrl + 'cart/show',
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Error');
            }
        });
    });
    
    $('#cart .modal-content').on('click', '#clear-cart', function (e) {
        e.preventDefault();
        $.ajax({
            url: baseUrl + 'cart/clear',
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Error');
            }
        });
    });
    /*Cart*/
    
    
    $('#input-sort').on('change', function () {
	window.location = baseUrl + window.location.pathname + '?' + $(this).val();
    });
    
});
