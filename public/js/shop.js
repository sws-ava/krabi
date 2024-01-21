



initCart()

function initCart(){
    let cartList = JSON.parse(localStorage.getItem('cartList'))
    updateListAndTotal(cartList)
    if(cartList && cartList.length > 0){
        document.querySelector('.cartBlock').style.display = 'flex';
    }
}

function updateListAndTotal(cartList){
    let totalBlock = document.getElementById('cartBlockSum')
    if(cartList){
        if(cartList.length > 0){
            let cartTotal = 0
            cartList.map(el => {
                cartTotal += Number(el.count) * Number(el.price)
            })
            document.querySelector('.cartBlock').style.display = 'flex';
            totalBlock.innerText = cartTotal
        }else{
            localStorage.setItem('cartList', '[]')
            totalBlock.innerText = 0
            // document.querySelector('.cartBlock').style.display = 'none';
        }
    }else{
        localStorage.setItem('cartList', '[]')
        totalBlock.innerText = 0
        // document.querySelector('.cartBlock').style.display = 'none';
    }
}

function addToCart(id, price, title){
    let list = localStorage.getItem('cartList')
    if(list){
        let arr = JSON.parse(list)
        if(arr.length > 0){
            let isId = arr.find(el => el.id === id)
            if(isId){
                arr.map((ele) => {
                    if(ele.id === id){
                        ele.count += 1
                        ele.total = ele.count * ele.price
                    }
                })
            }else{
                arr.push({
                    id: id,
                    count: 1,
                    price: price,
                    title: title,
                    total: price
                })
            }
        }else{
            arr.push({
                id: id,
                count: 1,
                price: price,
                title: title,
                total: price
            })
        }
        localStorage.setItem('cartList', JSON.stringify(arr))
        updateListAndTotal(arr)
    }
}






// cart page

// let orderDone = document.getElementById('orderDone')

function showOrderDetails(){
    let block = document.getElementById('orderDetails')
    if(block){
        if(block.style.display === 'block'){
            block.style.display = 'none';
        }else{
            block.style.display = 'block';
        }
    }
}



initCheckout()
function initCheckout(){
    let cartList = localStorage.getItem('cartList')
    cartList = JSON.parse(cartList)
    if(cartList){
        let noItems = document.getElementById('noItems')
        let orderForm = document.getElementById('orderForm')
        if(cartList.length > 0){
            returnCheckoutRows()
            if(noItems){
                noItems.style.display = 'none'
            }
            if(orderForm){
                orderForm.style.display = 'block'
            }
        }else{
            if(noItems){
                noItems.style.display = 'block'
            }
            if(orderForm){
                orderForm.style.display = 'none'
            }
        }
    }
}

function returnCheckoutRows(){
    let cartList = localStorage.getItem('cartList')
    let checkoutList = document.getElementById('checkoutList')
    let cartSumBlock = document.getElementById('cartSum')
    let cartSum = Number(0)

    if(cartList && checkoutList){
        cartList = JSON.parse(cartList)
        let arr = []
        if(cartList.length > 0){
            cartList.map((el) => {
                let row = returnCheckoutRow(el)
                checkoutList.insertAdjacentHTML('afterbegin', row)
                arr.push(row)
                cartSum += el.count * el.price
            })
        }
        cartSumBlock.innerText = cartSum

    }
}

function returnCheckoutRow(el){
    return `<div class="cartItem">
            <span class="itemTitle" style="">
                ${el.title}
            </span>
            <input name="form[${el.id}][id]" value="${el.id}" type="hidden">
            <input name="form[${el.id}][count]" value="${el.count}" type="hidden">
            <input name="form[${el.id}][price]" value="${el.price}" type="hidden">
            <div class="amountBlock">
                <i
                    onclick="decrementItem(${el.id})"
                    style="width: 20px; height: 20px;"
                    class="icons fa-icon fa fa-minus"
                    aria-hidden="true">
                </i>
                <span class="amount">
                    ${el.count}
                </span>
                <i
                    onclick="incrementItem(${el.id})"
                    style="width: 20px; height: 20px;"
                    class="icons fa-icon fa fa-plus"
                    aria-hidden="true">
                </i>
                <span class="price">
                    ${el.price * el.count}
                    грн
                </span>
                <i
                    onclick="removeItem(${el.id})"
                    style="width: 20px; height: 20px;"
                    class="icons trashIcon fa-icon fa fa-trash"
                    aria-hidden="true">
                </i>
            </div>
        </div>`
}


function removeItem(id){
    let cartList = getLocalStorageList()
    let arr = []
    if(cartList.length){
        arr = cartList.filter((el) => el.id != id)
    }
    $('.cartItem').remove();
    localStorage.setItem('cartList', JSON.stringify(arr))
    initCheckout()
}



function decrementItem(id){
    let cartList = getLocalStorageList()
    if(cartList.length){
        $('.cartItem').remove();
        cartList.map(el => {
            if(el.id === id){
                if(el.count > 1){
                    el.count -=1
                }
            }
        })
        localStorage.setItem('cartList', JSON.stringify(cartList))
        initCheckout()
    }

}
function incrementItem(id){
    let cartList = getLocalStorageList()
    if(cartList.length){
        $('.cartItem').remove();
        cartList.map(el => {
            if(el.id === id){
                el.count +=1
            }
        })
        localStorage.setItem('cartList', JSON.stringify(cartList))
        initCheckout()
    }
}

function getLocalStorageList(){
    let cartList = localStorage.getItem('cartList')
    if(cartList){
        cartList = JSON.parse(cartList)
        return cartList
    }
    else{
        return  []
    }
}


function submitForm(){
    $("#orderForm").submit(function () {
        let cartList = localStorage.setItem('cartList', '[]')
    });
}

function personsHandler(flag){
    let input = document.getElementById('persons')
    let inputValue = Number(input.value)
    if(flag === 'minus'){
        if(inputValue > 1){
            inputValue -= 1
        }
    }else if(flag === 'plus'){
        inputValue += 1
    }
    input.value = inputValue
}

