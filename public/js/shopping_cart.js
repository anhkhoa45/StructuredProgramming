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
        checkProductQuantity(sCartProductList).then(function(response) {
            let productQuantities = response.data;
            let prods = 0;
            productListElm.empty();

            for(let i = 0; i < sCartProductList.length; i++) {
                let productQuantity = productQuantities.find(function(p) {return p.id === sCartProductList[i].id}).quantity
                let validQuantity = sCartProductList[i].quantity <= productQuantity;
                let tooltipStr = 'data-toggle="tooltip" data-placement="left" title="Không đủ số lượng hàng"';

                let prodElm = $(
                    `<tr>
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
	                            <input class="form-control prod-qua ${validQuantity ? '' : 'is-invalid'}" 
	                                   ${validQuantity ? '' : tooltipStr}
	                                   type="text" value="${sCartProductList[i].quantity}" disabled>
	                            <button type="button" class="btn bg-trans btn-sm btn-inc"
	                                    ${sCartProductList[i].quantity >= productQuantity ? 'disabled ' + tooltipStr : ''}>
	                            	<span class="oi oi-plus"></span>
	                            </button>
	                        </form>
	                    </td>
	                    <td>${sCartProductList[i].price}$</td>
	                    <td>${sCartProductList[i].price * sCartProductList[i].quantity}$</td>
	                    <td><span class="oi oi-trash btn btn-trans btn-del"></span></td>
	                </tr>`
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
        });
	}

	function checkProductQuantity(prods) {
        return axios.get('/api/product/check-quantity', {
            params: {
                product_ids: prods.map(function(p) {return p.id})
            }
        });
    }

	function addProduct({id, thumbnail, name, price, quantity}){
        checkProductQuantity([{id: id}]).then(function(response) {
            let productQuantity = response.data[0].quantity;

            let i = 0;
            for(i = 0; i < sCartProductList.length; i++) {
                if(sCartProductList[i].id === id){
                    if(productQuantity < sCartProductList[i].quantity + quantity){
                        alert('Không đủ hàng trong kho, thêm sản phẩm thất bại');
                        return;
                    }
                    sCartProductList[i].quantity += quantity;
                    break;
                }
            }

            if(i === sCartProductList.length) {
                if (productQuantity < quantity) {
                    alert('Không đủ hàng trong kho, thêm sản phẩm thất bại');
                    return;
                }
                sCartProductList.push({id, thumbnail, name, price, quantity});
            }

            render();
            alert("Đã thêm sản phẩm vào giỏ");
        })

	}

	function saveProductList(){
	    localStorage.setItem('shoppingCart', JSON.stringify(sCartProductList));
    }
})();

