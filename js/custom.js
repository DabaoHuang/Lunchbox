$(function() {

    // inital

    var CaculateTotalPrice = 0;
    if( $("span.CaculateDollars").length )
        CaculateTotalPrice = parseInt($("span.CaculateDollars").html());

    $(':text').on('click',function(){
        $(this).select();
    });

    $('[data-toggle="tooltip"]').tooltip();

    setInterval(function(){
        $("span.CaculateTime span.time").each(function() {
            $(this).html( parseInt($(this).html())-1 );
            if(parseInt($(this).html()) <= 0 && $(this).attr('option-redirect') != 'false' ) window.location = '/';
            else if(parseInt($(this).html()) <= 0) {
                let BackToParent = $(this).parent();
                $(this).remove();
                BackToParent.append('&nbsp;已截止');
            }
        });
    },1000);

    // Click

    $("button#RegisterBtn").on('click',function(){
        window.location = "/register";
    });

    $("button#SignUpBtn").on('click',function(e){

        const Register = $("form#RegisterForm");

        $.ajax({
            type: "post",
            url: "/member/RegisterCheck",
            data: Register.serialize(),
            dataType: 'text',
            beforeSubmit: function() {
                $("button#SignUpBtn").attr('disabled', 'disabled');
            },
            success: function(response) {
                if(response != 'ok') {
                    alert(response);
                } else Register.submit();
                $("button#SignUpBtn").removeAttr('disabled');
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });

    $("input[name=showmenu]").on('click', function(){
        let id = $(this).attr('data-id');
        $("div.r-menu-"+id).toggleClass('r-menu-show');
    });

    $("input[name=PrintPage]").on('click',function(){
        window.print();
    });

    $("input[name=release]").on('click',function() {
        let id = $(this).attr('data-id');

        if( !confirm('確定要發起非常召集嗎？') ) {
            return '';
        }

        $.ajax({
            type: "post",
            url: "/Restaurant/event",
            data: {
                'restaurant_id': id,
                'start_time': $("input#start_time").val(),
                'end_time': $("input#end_time").val()
            },
            dataType: "text",
            beforeSubmit: function() {
                $("input[name=release]").attr('disabled','disabled');
            },
            success: function (response) {
                $("input[name=release]").removeAttr('disabled');
                if( response == 'ok' )
                    window.location = '/';
                else alert(response);
            }
        });
    });

    $("li.list-group-item.OrderLink").on('click',function(){
        let id = $(this).attr('data-id');
        window.location = '/order/' + id;
    });

    $("a.OrderQtyMinus").on('click',function(){
        let id = $(this).find('i.fa-minus').attr('data-id');
        let num = $("input.OrderQtyInput"+id).val();
        $("input.OrderQtyInput"+id).val((parseInt(num)-1 >= 0) ? parseInt(num)-1 : 0);
        CaculateItemPrice();
    });

    $("a.OrderQtyPlus").on('click',function(){
        let id = $(this).find('i.fa-plus').attr('data-id');
        let num = $("input.OrderQtyInput"+id).val();
        $("input.OrderQtyInput"+id).val(parseInt(num)+1);
        CaculateItemPrice();
    });

    $("button#OrderSubmit").on('click', function(){
       var CheckQty = 0;
       $("input[class^=OrderQtyInput]").each(function(){
            CheckQty += parseInt($(this).val());
       }); 

       if( CheckQty === 0)
        alert('請至少填寫一項商品後再送出！');
       else
        document.getElementById('OrderForm').submit();
    });

    $("input[class^=OrderQtyInput]").keyup(function(e){
        let node = /^\d+$/;
        if( node.test($(this).val()) == false )
            $(this).val(0);
        CaculateItemPrice();
    });

    $("button.showitemlist").on('click', function() {
        let id = $(this).attr('data-id');
        $("li.list-order-"+id).toggleClass('list-order-show');
    });

    // TODO: (BUG) 收合 User 訂單時，商品也要收合
    $("li.list-event").on('click',function(){
        let id = $(this).attr('data-id');
        $("li.list-member-"+id).toggleClass('list-member-show');
    });
});

function CaculateItemPrice() {
    var CaculateTotalPrice = 0;
    $("input[class^=OrderQtyInput]").each(function(){
        let id = $(this).attr('data-id');
        let num = $(this).val();
        CaculateTotalPrice += (parseInt(num) * parseInt( $("input.ItemPrice"+id).val() ));
    });
    $("span.CaculateDollars").html(CaculateTotalPrice);
} // end function

window.onload = function() {    
}