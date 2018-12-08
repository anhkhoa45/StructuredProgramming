(function(){
	let products = []; // {id, thumbnail, name, price, quantity}
	let productListElm;
	let productCountElm;

	/* ShoppingCart construction
	 * @param cartElm jQuery DOM object to bind shopping cart
	 * @return a shopping cart object
	 */
	window.ShoppingCart = function(cartElm) {
	    products = localStorage.getItem('shoppingCart') ? JSON.parse(localStorage.getItem('shoppingCart')) : [];
		productListElm = cartElm.find('.product-list');
		productCountElm = cartElm.find('.product-count');

		// set event to save product list before left page
		$(window).on('unload', function () {
            saveProductList();
        });

		// render product list
        render();

		return {
			products,
			render,
			addProduct
		}
	};

    function checkProductQuantity(prods) {
        return axios.get('/api/product/check-quantity', {
            params: {
                product_ids: prods.map(function(p) {return p.id})
            }
        });
    }

	function render(){
	    if(products.length === 0) {
            productListElm.empty();
            productCountElm.html(0);
	        return;
        }

        checkProductQuantity(products)
            .then(function(response) {
                let productQuantities = response.data;
                let prods = 0;

                productListElm.empty();
                for(let i = 0; i < products.length; i++) {
                    let productQuantity = productQuantities.find(function(p) {return p.id === products[i].id}).quantity
                    let validQuantity = products[i].quantity <= productQuantity;
                    let tooltipStr = 'data-toggle="tooltip" data-placement="left" title="Không đủ số lượng hàng"';

                    let prodElm = $(
                        `<tr>
                            <td><img src="${products[i].thumbnail}" class="img-cart"></td>
                            <td>
                                <strong>
                                    <a href="/product/detail/${products[i].id}">${products[i].name}</a>
                                </strong>
                            </td>
                            <td>
                                <form class="form-inline quantity-form">
                                    <button type="button" class="btn bg-trans btn-sm btn-dec"
                                            ${products[i].quantity <= 1 ? 'disabled' : ''}>
                                        <span class="oi oi-minus"></span>
                                    </button>
                                    <input class="form-control prod-qua ${validQuantity ? '' : 'is-invalid'}" 
                                           ${validQuantity ? '' : tooltipStr}
                                           type="text" value="${products[i].quantity}" disabled>
                                    <button type="button" class="btn bg-trans btn-sm btn-inc"
                                            ${products[i].quantity >= productQuantity ? 'disabled ' + tooltipStr : ''}>
                                        <span class="oi oi-plus"></span>
                                    </button>
                                </form>
                            </td>
                            <td>${products[i].price}$</td>
                            <td>${products[i].price * products[i].quantity}$</td>
                            <td><span class="oi oi-trash btn btn-trans btn-del"></span></td>
                        </tr>`
                    );

                    prodElm.find('.btn-inc').click(function(event) {
                        event.stopPropagation();
                        products[i].quantity++;
                        render();
                    });
                    prodElm.find('.btn-dec').click(function(event) {
                        event.stopPropagation();
                        products[i].quantity--;
                        render();
                    });
                    prodElm.find('.btn-del').click(function(){
                        event.stopPropagation();
                        products.splice(i, 1);
                        render();
                    });

                    productListElm.append(prodElm);
                    prods += products[i].quantity;
                }
                productCountElm.html(prods);
            });
	}

	function addProduct({id, thumbnail, name, price, quantity}){
        checkProductQuantity([{id: id}]).then(function(response) {
            let productQuantity = response.data[0].quantity;

            let i = 0;
            for(i = 0; i < products.length; i++) {
                if(products[i].id === id){
                    if(productQuantity < products[i].quantity + quantity){
                        alert('Không đủ hàng trong kho, thêm sản phẩm thất bại');
                        return;
                    }
                    products[i].quantity += quantity;
                    break;
                }
            }

            if(i === products.length) {
                if (productQuantity < quantity) {
                    alert('Không đủ hàng trong kho, thêm sản phẩm thất bại');
                    return;
                }
                products.push({id, thumbnail, name, price, quantity});
            }

            render();
            alert("Đã thêm sản phẩm vào giỏ");
        });
	}

	function saveProductList(){
	    localStorage.setItem('shoppingCart', JSON.stringify(products));
    }
})();

