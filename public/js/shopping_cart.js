(function(){
	let sCartProductList = [];
	let productListElm;
	let productCountElm;

	/* ShoppingCart construction
	 * @param cartElm jQuery DOM object to bind shopping cart
	 * @return a shopping cart object
	 */
	window.ShoppingCart = function(cartElm) {
	    sCartProductList = localStorage.getItem('shoppingCart') ? JSON.parse(localStorage.getItem('shoppingCart')) : [];
		productListElm = cartElm.find('.product-list');
		productCountElm = cartElm.find('.product-count');

		// set event to save product list before left page
		$(window).on('unload', function () {
            saveProductList();
        });

		// render product list
        render();

		return {
			sCartProductList,
			render,
			addProduct
		}
	};

	function render(){
		let prods = 0;
		productListElm.empty();

		for(let i = 0; i < sCartProductList.length; i++) {
			let prodElm = $(
				`
					<tr>
	                    <td><img src="${sCartProductList[i].thumbnail}" class="img-cart"></td>
	                    <td>
                            <strong>
                                <a href="/product/detail/${sCartProductList[i].id}">${sCartProductList[i].name}</a>
                            </strong>
                        </td>
	                    <td>
	                        <form class="form-inline quantity-form">
								<button type="button" class="btn bg-trans btn-sm btn-dec"
								        ${sCartProductList[i].quantity <= 1 ? 'disabled' : ''}>
	                            	<span class="oi oi-minus"></span>
	                            </button>
	                            <input class="form-control prod-qua" type="text" value="${sCartProductList[i].quantity}" disabled>
	                            <button type="button" class="btn bg-trans btn-sm btn-inc">
	                            	<span class="oi oi-plus"></span>
	                            </button>
	                        </form>
	                    </td>
	                    <td>${sCartProductList[i].price}$</td>
	                    <td>${sCartProductList[i].price * sCartProductList[i].quantity}$</td>
	                    <td><span class="oi oi-trash btn btn-trans btn-del"></span></td>
	                </tr>
				`
			);

            prodElm.find('.btn-inc').click(function(event) {
                event.stopPropagation();
                sCartProductList[i].quantity++;
                render()
            });
            prodElm.find('.btn-dec').click(function(event) {
                event.stopPropagation();
                sCartProductList[i].quantity--;
                render();
            });
            prodElm.find('.btn-del').click(function(){
                event.stopPropagation();
                sCartProductList.splice(i, 1);
                render();
            });

			productListElm.append(prodElm);
			prods += sCartProductList[i].quantity;
		}
		productCountElm.html(prods);
	}

	function addProduct({id, thumbnail, name, price, quantity}){
		let i = 0;
		for(i = 0; i < sCartProductList.length; i++) {
			if(sCartProductList[i].id === id){
				sCartProductList[i].quantity += quantity;
				break;
			}
		}
		if(i === sCartProductList.length)
			sCartProductList.push({id, thumbnail, name, price, quantity});

		render();
		alert("Them vao gio hang thanh cong");
	}

	function saveProductList(){
	    localStorage.setItem('shoppingCart', JSON.stringify(sCartProductList));
    }
})();

