// config
const createStore = (reducer) => {
    let state = reducer(undefined, {})
    const subscribers = []
    return {
        getState: () => state,
        dispatch: (action) => {
            state = reducer(state, action)
            subscribers.forEach(subscriber => subscriber())
        },
        subscribe: (subscriber)=> {
            subscribers.push(subscriber)
        }
    }
}
const formatCurrency = (amount) => {
    return amount.toLocaleString("vi-VN") + " đ";
}
const ADD_TO_CART = 'ADD_TO_CART';
const UPDATE_QUANTITY = 'UPDATE_QUANTITY';
const REMOVE_FROM_CART = 'REMOVE_FROM_CART';
const FETCH_CART_SUCCESS = 'FETCH_CART_SUCCESS';
const CLEAR_CART = 'CLEAR_CART';
const SHIP = 25000
// actions
const addToCart = (item) => ({
    type: ADD_TO_CART,
    payload: item
});
const updateQuantity = (itemId, quantity) => ({
    type: UPDATE_QUANTITY,
    payload: { itemId, quantity }
});
const removeFromCart = (itemId) => ({
    type: REMOVE_FROM_CART,
    payload: itemId
});
const clearCart = () => ({
    type: CLEAR_CART,
});
// api
class cartApi {
    async fetch() {
        try {
            const response = await axios.get('/cart/list');
            const cartItems = response.data;
            store.dispatch({ type: 'FETCH_CART_SUCCESS', payload: cartItems });
        } catch (err) {
            console.log(err);
        }
    }
    async create(values) {
        try {
            const response = await axios.post('/cart/add',
                {
                    "_token": token,
                    id_product: values.id_product,
                    quantity: values.quantity,
                    options: values.options,
                }
            );
            return response.data
        } catch (err) {
            console.log(err);
        }
    }
    async update(idItem,quantity) {
        try {
            const response = await axios.put('/cart/update/'+ idItem,
                {
                    "_token": token,
                    quantity: quantity,
                }
            );
            return response.data
        } catch (err) {
            console.log(err);
        }
    }
    async delete(id_item) {
        try {
            const response = await axios.delete('/cart/delete-item/'+id_item);
            return response.data;
        } catch (err) {
            console.log(err);
        }
    }
    async clear() {
        try {
            const response = await axios.delete('/cart/clear');
            return response.data;
        } catch (err) {
            console.log(err);
        }
    }
}
// reducer
const initialState = {
    cartItems: [],
};
class cartReducers extends cartApi{
    constructor(state, action) {
        super();
        this.state = state
        this.action = action
    }
    reducerFetchCartSuccess() {
        return {
            ...this.state,
            cartItems: this.action.payload,
        };
    }
    reducerAddToCart() {
        const existingItem = this.state.cartItems.find(item => {
            if (item.id_item === this.action.payload.id_item) {
                if (item.options && this.action.payload.options) {
                    for (const key in this.action.payload.options) {
                        if (item.options[key] !== this.action.payload.options[key]) {
                            return false;
                        }
                    }
                    return true;
                } else {
                    return true;
                }
            }
            return false;
        });

        if (existingItem) {
            return {
                ...this.state,
                cartItems: this.state.cartItems.map(item => {
                    if (item.id_item === existingItem.id_item && JSON.stringify(item.options) === JSON.stringify(existingItem.options)) {
                        return {
                            ...item,
                            quantity: this.action.payload.quantity,
                        };
                    }
                    return item;
                }),
            };
        } else {
            return {
                ...this.state,
                cartItems: [...this.state.cartItems, this.action.payload],
            };
        }
    }
    reducerUpdateQuantity() {
        return {
            ...this.state,
            cartItems: this.state.cartItems.map(item => {
                if (item.id_item === this.action.payload.itemId) {
                    return {
                        ...item,
                        quantity: this.action.payload.quantity,
                    };
                }
                return item;
            }),
        };
    }
    reducerRemoveFromCart() {
        return {
            ...this.state,
            cartItems: this.state.cartItems.filter(item => item.id_item !== this.action.payload),
        };
    }
    reducerClearCart() {
        return {
            ...this.state,
            cartItems: [],
        };
    }
    async reducerDefault() {
        await this.fetch()
        // renderData();
        return this.state;
    }
}
const cartReducer = (state = initialState, action) => {
    const cartReduce = new cartReducers(state, action)
    switch (action.type) {
        case FETCH_CART_SUCCESS:
            return cartReduce.reducerFetchCartSuccess()
        case ADD_TO_CART:
            return cartReduce.reducerAddToCart()
        case UPDATE_QUANTITY:
            return cartReduce.reducerUpdateQuantity()
        case REMOVE_FROM_CART:
            return cartReduce.reducerRemoveFromCart()
        case CLEAR_CART:
            return cartReduce.reducerClearCart()
        default:
            return cartReduce.reducerDefault()
    }
}
// store
const store = window.store = createStore(cartReducer);
store.subscribe(() => renderData())
// handle
const addItem = () => {
    let quantity    = parseInt($('#quantity').val());
    let id_product  = $('#id_product').val();
    let selectSize  = $('#size').find(":selected");
    let selectColor = $('#color').find(":selected");
    if(quantity < 1){
        toast({ title: "Error !", message: 'Quantity must be greater than 0 !', type: "error", duration: 3000 });
    }
    else if(id_product == ''){
        toast({ title: "Error !", message: 'Please choose product !', type: "error", duration: 3000 });
    }
    else if(selectSize.val() == ''){
        toast({ title: "Error !", message: 'Please choose size !', type: "error", duration: 3000 });
    }
    else if(selectColor.val() == ''){
        toast({ title: "Error !", message: 'Please choose color !', type: "error", duration: 3000 });
    }
    else {
        $('#addCart').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`).attr('disabled',true)
        let values = {
            id_product: id_product,
            quantity: quantity,
            options: { size: selectSize.text(), color: selectColor.text() }
        }
        const res = new cartApi().create(values)
        res.then(data => {
            toast({ title: "Success !", message: 'Item add to cart !', type: "success", duration: 3000 });
            store.dispatch(addToCart(data));
            $('.js-panel-cart').addClass('show-header-cart');
            $('#addCart').html("Add to cart").attr('disabled',false)
            setTimeout(() => { $('.js-panel-cart').removeClass('show-header-cart'); },3000)
        })
    }
};
const deleteItem = (id_item) => {
    const res = new cartApi().delete(id_item)
    res.then(data => {
        store.dispatch(removeFromCart(id_item));
    })
}
const updateQty = (id_item, quantity) => {
    if(quantity === 0 ){
        deleteItem(id_item)
    }
    else {
        const res = new cartApi().update(id_item, quantity)
        res.then(value => {
            toast({ title: "Success !", message: 'Update quantity success', type: "success", duration: 5000
            });
            store.dispatch(updateQuantity(id_item, quantity))
        })
    }
}
const applyCoupon = (subtotal,ship) => {
    $('#show_input_coupon').html(`
        <button class="btn btn-primary" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    `)
    $('#coupon_code').attr('disabled',true)
    let coupon = $('#coupon_code').val();
    axios.post('/check-code', {
            "_token": token,
            code: coupon,
        }
    )
    .then(res => {
        if(res.data.status === true){
            let discount = res.data.discount
            $('#value_coupon').val(coupon)
            $('#value_coupon_discount').val(discount)
            $('#show_coupon').html(`
                <p>Coupon ( ${coupon} )</p>
                <del>${discount} %</del>
            `)
            $('#coupon').html(`
                <div class="alert alert-success d-flex justify-content-between align-items-center">
                    <span> Apply successfully coupon: ${coupon}</span>
                    <button id="cancel-coupon">x</button>
                </div>
            `)
            $('#total_checkout').html(formatCurrency((subtotal + ship) - ((subtotal + ship) / 100) * discount));
            $('#value_total').val((subtotal + ship) - ((subtotal + ship) / 100) * discount)
            $(document).on('click','#cancel-coupon',function() {
                $('#coupon-success').html('')
                $('#coupon').html(`
                <div class="input-group">
                    <input type="text" required id="coupon_code" class="form-control" placeholder="Coupon code" style="margin-right: 10px">
                    <div class="input-group-append" id="show_input_coupon">
                        <button type="button" id="applyCoupon" class="btn btn-secondary">Apply</button>
                    </div>
                </div>
            `)
                $('#show_coupon').html(` `)
                $('#total_checkout').html(formatCurrency((subtotal + ship)));
                $('#value_total').val(subtotal + ship)
            });
        }
        else {
            toast({
                title: "Oh no !",
                message: 'Coupon Invalid',
                type: "warning",
                duration: 5000
            });
            $('#show_input_coupon').html(`
                <button type="button" id="applyCoupon" class="btn btn-secondary">Apply</button>
            `)
            $('#coupon_code').attr('disabled',false)
        }
    })
    .catch(err => {
        console.log(err)
    })
}
$(function() {
    $(document).on('click','#addCart',function () {
        addItem()
    });
    $(document).on('click','#clear-cart',function() {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled',true)
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want clear cart ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#myTbody')
                    .html(`
                    <tr class="table_row">
                        <td class="column-1 text-center" colspan="6">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </td>
                    </tr>
                `)
                    .attr('disabled',true)
                    .removeClass('btn-danger')
                const res= new cartApi().clear()
                res.then(data => {
                    console.log(data)
                    store.dispatch(clearCart())
                })
            }
            else {
                $(this).html('Clear cart').attr('disabled',false)
            }
        })
    });
    $(document).on('click','#reload-cart', async function() {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled',true)
        $('#clear-cart').attr('disabled',true)
        $('#myTbody').html(`<tr class="table_row"><td class="column-1 text-center" colspan="6"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&emsp;Loading ...</td></tr>`)
        const cartAPI = new cartApi()
        await cartAPI.fetch()
        $(this).html('Reload cart').attr('disabled',false)
        $('#clear-cart').attr('disabled',false)
    });
    $(document).on('click','#checkout', function() {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled',true)
    });
    $(document).on('click', '.decrement', function() {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled',true).removeClass('hov-btn3')
        let quantity = parseInt($(this).attr('data-quantity-item'));
        let id_item = parseInt($(this).attr('data-id-item'));
        updateQty(id_item, quantity - 1);
    });
    $(document).on('click', '.increment', function() {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled',true).removeClass('hov-btn3')
        let quantity = parseInt($(this).attr('data-quantity-item'));
        let id_item = parseInt($(this).attr('data-id-item'));
        updateQty(id_item, quantity + 1);
    });
    $(document).on('click', '.delete-item', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want clear cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled',true).removeClass('btn-danger')
                let id_item = parseInt($(this).attr('data-id'));
                deleteItem(id_item)
            }
        })
    });
});
// view
const renderSlideCart = (cartItems,subtotal) => {
    let slideCart
    if (cartItems.length > 0) {
        slideCart = cartItems.map(item => {
            return `
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="${item.product.image}" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt p-t-8">
                        <p class="header-cart-item-name hov-cl1 trans-04">
                            ${item.product.name}
                        </p>
                        <span class="header-cart-item-info">
                            <small class="text-muted">${item.quantity} x ${formatCurrency(item.product.price)}</small>
                        </span>
                        <span class="header-cart-item-info text-muted">
                           <small class="text-muted">Color: ${item.options.color}&nbsp;|&nbsp;Size: ${item.options.size}</small>
                        </span>
                    </div>
                </li>
            `;
        }).join('');
        $('#checkout').show()
    }
    else {
        slideCart = `<li class="header-cart-item flex-w flex-t m-b-12">No item !</li>`
        $('#checkout').remove()
    }
    $('#header-cart-list').html(slideCart)
    $('#total').html(formatCurrency(subtotal));
}
const renderPageCart = (cartItems,subtotal) => {
    let itemsCart
    if (cartItems.length > 0) {
        itemsCart = cartItems.map(item => {
            return `
                <tr class="table_row">
                    <td class="column-1" style="width: 200px">
                        <div class="d-flex align-items-center">
                            <img width="50px" src="${item.product.image}" alt="IMG">&emsp;
                            <div>
                                <p>${item.product.name}</p>
                                <small>${formatCurrency(item.product.price)}</small>
                            </div>
                        </div>
                    </td>
                    <td class="column-2">
                        <div class="text-container">
                            <small class="text-muted">
                                Color: ${item.options.color}
                                <br>
                                Size: ${item.options.size}
                            </small>
                        </div>
                    </td>
                    <td class="column-3">
                        <div class="wrap-num-product flex-w">
                            <button data-id-item="${item.id_item}" ${item.quantity === 1 ? 'disabled' : ''}  data-quantity-item="${item.quantity}" class="decrement btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"><i class="fs-16 zmdi zmdi-minus"></i></button>
                            <input class="mtext-104 cl3 txt-center num-product" type="number" disabled name="product_quantity" value="${item.quantity}" min="1">
                            <button data-id-item="${item.id_item}" data-quantity-item="${item.quantity}" class="increment btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"><i class="fs-16 zmdi zmdi-plus"></i></button>
                        </div>
                    </td>
                    <td class="column-4">${formatCurrency(item.product.price * item.quantity)}</td>
                    <td class="column-5">
                        <button data-id="${item.id_item}" class="delete-item btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        }).join('');
        $('#checkout').show()
        $('#clear-cart').show()
        $('#reload-cart').show()
    }
    else {
        itemsCart = `<tr class="table_row"><td class="column-1 text-center" colspan="6">No items !</td></tr>`;
        $('#checkout').remove()
        $('#clear-cart').remove()
        $('#reload-cart').remove()
    }
    $('#myTbody').html(itemsCart);
    $('#total2').html(formatCurrency(subtotal));
}
const renderCheckOut = (cartItems,subtotal) => {
    $('#coupon').html(`
        <div class="input-group">
            <input type="text" id="coupon_code" class="form-control" placeholder="Coupon code" style="margin-right: 10px">
            <div class="input-group-append" id="show_input_coupon">
                <button type="button" id="applyCoupon" class="btn btn-secondary">Apply</button>
            </div>
        </div>
    `)
    let checkoutItems
    checkoutItems = cartItems.map(item => {
        return `
            <li class="list-group-item d-flex justify-content-between align-items-center lh-condensed">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="${item.product.image}" alt="" class="rounded" width="50" height="50"/>
                    <div style="margin-left: 5px">
                        <h6 class="my-0">${item.product.name}</h6>
                        <small class="text-muted">Size: ${item.options.size}</small>&nbsp;|&nbsp;<small class="text-muted">Color: ${item.options.color}</small>&nbsp;|&nbsp;<small class="text-muted">Quantity: ${item.quantity}</small>
                    </div>
                </div>
                <span class="text-muted">${ formatCurrency(item.product.price)}</span>
            </li>
        `
    })
    $('#checkout-cart').html(checkoutItems)
    $('#shipping').html(formatCurrency(SHIP));
    $('#subtotal').html(formatCurrency(subtotal));
    $('#total_checkout').html(formatCurrency(subtotal + SHIP));
    $('#value_total').val(subtotal + SHIP)
    $('#btn-order').html(`<button class="btn btn-dark btn-lg btn-block" id="process_order" type="button">Order</button>`)
    $(document).on('click','#applyCoupon', () => { applyCoupon(subtotal,SHIP) });
}
const renderData = () => {
    const { cartItems } = store.getState();
    let subtotal = cartItems.reduce((accumulator, item) => {
        return accumulator + parseInt(item.product.price) * parseInt(item.quantity);
    }, 0)
    renderSlideCart(cartItems,subtotal);
    renderPageCart(cartItems,subtotal);
    renderCheckOut(cartItems,subtotal);
    $('#itemCount').html(cartItems.length);
    $('#header-cart').attr('data-notify', cartItems.length);
    $('#header-mobile-cart').attr('data-notify', cartItems.length);
};
const processOrder = async(values) => {
    try {
        const response = await axios.post('/order/process',
            {
                "_token": token,
                "data": values,
            }
        );
        return response.data
    } catch (err) {
        console.log(err);
    }
}
$(document).on('click','#process_order', () => {
    // customer
    let name    = $('#name');
    let email   = $('#email');
    let phone   = $('#phone');
    let address = $('#address');
    let note    = $('#note');
    let coupon_code = $('#value_coupon')
    let code = $('#coupon_code')
    let button_apply_coupon = $('#applyCoupon')
    if(name.val() !== '' && email.val() !== '' && phone.val() !== '' && address.val() !== ''){
        name.attr('readonly',true)
        email.attr('readonly',true)
        phone.attr('readonly',true)
        address.attr('readonly',true)
        note.attr('readonly',true)
        code.attr('readonly',true)
        button_apply_coupon.attr('disabled',true)
        $('.pay_method').attr('disabled',true)
        $('#btn-order').html(`
            <button class="btn btn-secondary btn-lg btn-block" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Processing ...
            </button>
        `)
        let user = {
            name: name.val(),
            email: email.val(),
            phone: phone.val(),
            address: address.val(),
        }
        // promotion
        let coupon_code_discount = parseInt($('#value_coupon_discount').val())
        let discount = coupon_code.val() !== '' ? { coupon: coupon_code.val(), discount: coupon_code_discount } : null
        // subtotal
        const { cartItems } = store.getState();
        let subtotal = cartItems.reduce((accumulator, item) => {
            return accumulator + parseInt(item.product.price) * parseInt(item.quantity);
        }, 0)
        // final
        let values = {
            customer: user,
            note: note.val() ,
            ship: SHIP,
            payment_method: parseInt($('input[name="payment_method"]:checked').val()),
            discount: discount,
            items: store.getState().cartItems,
            total: parseInt($('#value_total').val()),
            subtotal: subtotal
        }
        // process order
        processOrder(values)
            .then(data => { data.url ? window.location.href = data.url : toast('Error', 'Order error !', 'error') })
            .catch(err => {
                name.attr('readonly',false)
                email.attr('readonly',false)
                phone.attr('readonly',false)
                address.attr('readonly',false)
                note.attr('readonly',false)
                code.attr('readonly',false)
                button_apply_coupon.attr('disabled',false)
                $('.pay_method').attr('disabled',false)
                console.log(err)
            })
    }
    else {
        Swal.fire( 'Warning !', 'Please fill in all information!', 'warning')
    }
});
