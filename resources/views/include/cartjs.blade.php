<script>
    const totalDisplay = document.getElementById('totaldisplay'),
        totalCartCheck = document.getElementById('total_cart-check'),
        coin = document.querySelector('#use_coin');
    const voucherCodeInput = document.getElementById('voucher_code-input');
    const applyVoucherBtn = document.getElementById('btn_apply-voucher');
    const btnDeleteCartList = document.querySelectorAll('.removecart');
    const dataCoin = document.querySelector('#data_coin');
    const listDataCart = document.querySelectorAll('.cart_content-box .list .item');
    const messageApllyVoucher = document.querySelector('#message_voucher');
    // text discount
    const discountInnerText = document.querySelector("#discount_voucher");
    // nếu như trường hợp chỉ đổi change coin mà không nhập voucher thì sẽ lấy cái giá giảm này để trừ
    const discountTempValue = discountInnerText?.getAttribute('data-discount');
    const subTotal = document.querySelector('#pricechange');
    // data cart content box khi hết sp trong giỏ hàng set lại null
    const cartContent = document.querySelector('.cart_content');
    const data = {
        voucherCode: voucherCodeInput?.value,
        totalCartCheck: totalDisplay?.getAttribute('data-price'),
        coin: parseInt(dataCoin?.getAttribute('data-coin'))
    }
    const toPrice = (value) => {
        return new Intl.NumberFormat().format(value);
    };

    coin?.addEventListener('change', (ev) => {
        if (ev.target.checked) {
            data.coin = parseInt(ev.target.value)
        } else {
            data.coin = 0
        }
        console.log(data);
        ApplyVoucherAjax(data);
    })
    const handleCoppy = (selector) => {
        const listBtn = document.querySelectorAll(`${selector}`);
        listBtn.forEach((e) => {
            e.addEventListener("click", () => {
                const code = e.getAttribute("data-code");
                navigator.clipboard.writeText(code).then(() => {
                    Snackbar.show({
                        text: `Sao chép mã giảm giá  ${code} thành công`,
                        showAction: false,
                        pos: "top-right",
                        duration: "4000",
                        backgroundColor: "#000",
                    });
                });
            });
        });
    };
    handleCoppy(".voucher_content-box .item .right .coppy .btn-cp");


    const handleApplyVoucher = () => {
        applyVoucherBtn?.addEventListener('click', () => {
            data.voucherCode = voucherCodeInput.value;
            console.log(data);
            ApplyVoucherAjax(data)
        })
    }
    handleApplyVoucher();

    async function ApplyVoucherAjax(data) {
        const url = '{{ route('apply-voucher') }}';
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify(data),
            });
            const result = await response.json();
            if (typeof result.message !== "undefined") {
                messageApllyVoucher.innerText = result.message;
            }
            if (!result.success) {
                messageApllyVoucher.style.color = "red"
                return;
            } else if (result.success === "warning") {
                messageApllyVoucher.style.color = "#fcb941"
                discountInnerText.setAttribute('data-discount', result.discount);
            } else if (result.success === "null") {
                messageApllyVoucher.innerText = "";
            } else {
                messageApllyVoucher.style.color = "green"
                discountInnerText.setAttribute('data-discount', result.discount);
            }
            discountInnerText.innerText = `-${toPrice(result.discount||discountTempValue)}đ`;
            const priceFinal = parseInt(result.totalCartCheck) - (result.discount || discountTempValue) - result
                .coin;
            totalDisplay.innerText = `${toPrice(priceFinal)}đ`;
            console.log(result);
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function ChangeQuantity() {
        const btnPlusList = document.querySelectorAll('.quantityonchange .next'),
            btnMinusList = document.querySelectorAll('.quantityonchange .pre'),
            quantityValueList = document.querySelectorAll('.quantityonchange .sl'),
            cartIdList = document.querySelectorAll('.quantityonchange .cart_id');

        quantityValueList.forEach((e, i) => {
            btnPlusList[i].addEventListener('click', async () => {
                e.value = parseInt(e.value) + 1;
                try {
                    const response = await UpdateQuatityCartAjax({
                        id: parseInt(cartIdList[i]?.value),
                        quantity: parseInt(e.value)
                    })
                    messagePopup(response);
                    // đổi giá gốc
                    data.totalCartCheck = response.priceNew;
                    // đổi subtotal
                    document.querySelector('#pricechange').innerText = toPrice(response
                        .priceNew) + 'đ';
                    // đổi total
                    totalDisplay.innerText = toPrice(response.priceNewDiscount) + 'đ';
                } catch (error) {
                    console.log(error);
                }
            })
            btnMinusList[i].addEventListener('click', async () => {
                e.value = parseInt(e.value) - 1;
                try {
                    const response = await UpdateQuatityCartAjax({
                        id: parseInt(cartIdList[i]?.value),
                        quantity: parseInt(e.value)
                    })
                    messagePopup(response);
                    // đổi giá gốc
                    data.totalCartCheck = response.priceNew;
                    data.voucherCode = ""

                    // đổi voucher
                    document.querySelector("#discount_voucher").innerText = "-" + toPrice(
                        response
                        .discount_amount) + 'đ'
                    // đổi subtotal
                    document.querySelector('#pricechange').innerText = toPrice(response
                        .priceNew) + 'đ';
                    // đổi total
                    totalDisplay.innerText = toPrice(response.priceNewDiscount) + 'đ';
                    // message voucher set null
                    messageApllyVoucher.innerText = ""
                    voucherCodeInput.value = ""

                } catch (error) {
                    console.log(error);
                }
                if (parseInt(e.value) < 1) {
                    listDataCart[i].remove();
                    DeteleCartAjax({
                        id: parseInt(cartIdList[i]?.value)
                    })
                }
            })
        })
    }
    ChangeQuantity();

    async function UpdateQuatityCartAjax(data) {
        const url = '{{ route('update-quantity-cart') }}';
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify(data),
            });
            const result = await response.json();
            return result;


        } catch (error) {
            console.error('Error:', error);
        }

    }
    async function DeteleCartAjax(data) {
        const url = '{{ route('deletecart') }}';
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify(data),
            });
            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error:', error);
        }
    }
    const handleBtnDeleteCart = () => {
        const listIdCart = document.querySelectorAll('.quantityonchange .cart_id');
        btnDeleteCartList.forEach((e, i) => {
            e.addEventListener('click', async () => {
                listDataCart[i].remove();
                try {
                    const response = await DeteleCartAjax({
                        id: parseInt(listIdCart[i]?.value)
                    })
                    messagePopup(response);
                    if (response.count === 0) {
                        cartContent.innerHTML = `
                        <div class="custom_cart-empty">
                            <p>Không có sản phẩm trong giỏ hàng</p>
                            <a href='{{ route('shop') }}' class="btn-redirec-shop">Mua sản phẩm</a>
                        </div>
                        `
                    }
                    // // đổi giá gốc
                    data.totalCartCheck = response.priceNew;
                    // // đổi voucher
                    discountInnerText.innerText = `-${toPrice(response.discount_amount)}đ`
                    // đổi subtotal
                    subTotal.innerText = `${toPrice(response.priceNew)}đ`;
                    // // đổi total
                    totalDisplay.innerText = toPrice(response.priceNewDiscount) + 'đ';
                    // // message voucher set null
                    messageApllyVoucher.innerText = ""
                    voucherCodeInput.value = ""
                    data.voucherCode = ""
                } catch (error) {
                    console.log(error);
                }

            })
        })
    }
    handleBtnDeleteCart();
    const messagePopup = async (response) => {
        if (response.message) {
            await navigator.clipboard.writeText(response.message).then(() => {
                Snackbar.show({
                    text: `${response.message}`,
                    showAction: false,
                    pos: "top-right",
                    duration: "4000",
                    backgroundColor: "#000",
                });
            });
        }
    }
</script>
