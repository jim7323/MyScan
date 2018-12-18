function removeCart(elem,$rmCartItemID,$rmCartItemWeight){
    if($rmCartItemID!=''){
        $.ajax({
	        method:"POST",
	        url:"/shopping/rmCartItem",
	        data:{rmPID:$rmCartItemID,rmWeight:$rmCartItemWeight,source:'fixed'},
	        headers:{
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }            
	    })
	    .done(function(delMsg){
	        try{
	        	$rtn=jQuery.parseJSON(delMsg);
                if($rtn['status']=='success'){
                	//刪除成功
                	if($rtn['itemcount']==0){
                		// 購物車沒商品 按鈕都移除
                		$('#previewCart').remove();
                		$('#checkoutBtn').remove();
                		$('#shoppingCart').hide();
                	}
                	else{
                		// 購物車還有商品 更新總額資訊
                        $(elem).parent().parent().parent('tr').remove();
                        $('#cartInfo_weight').html($rtn['itemweight']);
                        $('#cartInfo_price').html($rtn['sumprice']);
                        $('#cartInfo_count').html($rtn['itemcount']);
                	}
                }
                else{
                	//刪除失敗
                	alert('刪除失敗!');
                }
            }
            catch(e){
            	alert('刪除失敗!');
            };
	    }) 
    }
    else{
    	alert('請提供購物車商品編號!');
    }
}

function previewCart(){
    if($('#shoppingCart').css('display')=='none')
        $('#shoppingCart').fadeIn();
    else
        $('#shoppingCart').fadeOut();
}