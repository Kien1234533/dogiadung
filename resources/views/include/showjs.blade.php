<script>
    const handleTabs = (option, option2, option3) => {
        const listtab = document.querySelectorAll(`${option}`),
            listcontent = document.querySelectorAll(`${option2}`);
        listtab.forEach((e, i) => {
            e.addEventListener("click", () => {
                listtab.forEach((el) => {
                    el.classList.remove("active");
                });
                listcontent.forEach((el2) => {
                    el2.classList.remove("active");
                });
                e.classList.add("active");
                localStorage.setItem(`${option3}`, JSON.stringify(i));
                listcontent[i].classList.add("active");
            });
        });
    };
    const handleCache = (option, option2, option3) => {
        const listtab = document.querySelectorAll(`${option}`),
            listcontent = document.querySelectorAll(`${option2}`);
        let data = localStorage.getItem(`${option3}`);
        if (data) {
            data = JSON.parse(data);
            listtab[data].classList.add("active");
            listcontent[data].classList.add("active");
        } else {
            listtab[0].classList.add("active");
            listcontent[0].classList.add("active");
        }
    };
    const handleOption = (option) => {
        const listOption = document.querySelectorAll(`${option}`);
        listOption.forEach((e) => {
            e.addEventListener("click", () => {
                listOption.forEach((el) => {
                    el.classList.remove("active");
                });
                e.classList.add("active");
            });
        });
    };
    const hanldeQuantity = () => {
        const number = document.querySelector(".flexbox .quantity .qtt"),
            next = document.querySelector(".flexbox .quantity .next"),
            pre = document.querySelector(".flexbox .quantity .pre");
        next.addEventListener("click", () => {
            number.value = parseInt(number.value) + 1;
        });
        pre.addEventListener("click", () => {
            if (number.value > 1) {
                number.value = parseInt(number.value) - 1;
            }
        });
    };
    // const handlePopupComment = () => {
    //     const popup = document.querySelector(".modalcomment"),
    //         btnOpen = document.querySelector(".comment .wrapbox .btn-write"),
    //         btnClose = document.querySelector(".modalcomment .btn-close");
    //     btnOpen.addEventListener("click", () => {
    //             @auth
    //             popup.classList.add("active");
    //         @else
    //             window.location.href = "{{ route('login') }}";
    //         @endauth
    //     });
    // btnClose.addEventListener("click", () => {
    //     popup.classList.remove("active");
    // });
    // };
    const handleBtnMore = () => {
        const btn = document.querySelector(
                ".description_content-display .content .btn_more-desc"
            ),
            content = document.querySelector(
                ".description_content-display .content"
            );
        if (content.offsetHeight >= 700) {
            content.classList.add("height");
            btn.style.display = "block";
        } else {
            content.classList.remove("height");
            btn.style.display = "none";
        }
        console.log(content.offsetHeight);
    };
    const handleChangeImage = () => {
        const listImage = document.querySelectorAll(
                ".detail_content-photo .photochild .item"
            ),
            imageChange = document.querySelector(
                ".detail_content-photo .thumnail img"
            );
        listImage.forEach((e) => {
            e.addEventListener("click", () => {
                const src = e.getAttribute("data-src");
                const url = imageChange.getAttribute("src").split("uploads/")[0];
                imageChange.setAttribute("src", `${url}/uploads/${src}`);
                listImage.forEach((el) => {
                    el.classList.remove("active");
                });
                e.classList.add("active");
            });
        });
    };
    handleTabs(
        ".description_content-tabs .item",
        ".description_content-display .same",
        "detailTabId"
    );
    handleCache(
        ".description_content-tabs .item",
        ".description_content-display .same",
        "detailTabId"
    );
    handleOption(".color .list .form-group");
    handleOption(".size .list .form-group");
    hanldeQuantity();
    //handlePopupComment();
    handleBtnMore();
    handleChangeImage();
    const loadContent = document.querySelector(
        ".description_content-display .content .btn_more-desc"
    );
    loadContent.addEventListener("click", () => {
        document
            .querySelector(".description_content-display .content")
            .classList.remove("height");
        loadContent.style.display = "none";
    });

    // async function handleSubmit() {
    //     const formAddCart = document.querySelector('#form_add-cart');
    //     formAddCart.addEventListener('submit', async (ev) => {
    //             ev.preventDefault();
    //             // Check if the user is authenticated
    //             @auth
    //             const formData = new FormData(formAddCart);
    //             const formDataObject = {};
    //             formData.forEach((value, key) => {
    //                 formDataObject[key] = value;
    //             });
    //             try {
    //                 const response = await fetch(formAddCart.action, {
    //                     method: formAddCart.method,
    //                     headers: {
    //                         'Content-Type': 'application/json',
    //                         Accept: 'application/json',
    //                         'X-CSRF-TOKEN': formDataObject._token,
    //                     },
    //                     body: JSON.stringify(formDataObject),
    //                 });
    //                 const result = await response.json();
    //                 if (result.message) {
    //                     navigator.clipboard.writeText(result.message).then(() => {
    //                         Snackbar.show({
    //                             text: result.message,
    //                             showAction: false,
    //                             pos: "top-right",
    //                             duration: "3000",
    //                             backgroundColor: "#000",
    //                         });
    //                     });
    //                 }
    //             } catch (error) {
    //                 console.error('Error:', error);
    //             }
    //         @else
    //             window.location.href = "{{ route('login') }}";
    //         @endauth
    //     });
    // }

    // Call the function when the script runs
    // handleSubmit();

    // wishlist
    // const btnWishList = document.querySelector('#btn-wishlist');
    // btnWishList.addEventListener('click', async () => {
    //     const form = document.querySelector("#form_add-cart");
    //     const formData = new FormData(form);
    //     const wishlistObj = {};
    //     formData.forEach((value, key) => {
    //         wishlistObj[key] = value;
    //     });
    //     try {
    //         const res = await handleWishlistAjax(wishlistObj)
    //         console.log(res);
    //         if (res.message) {
    //             navigator.clipboard.writeText(res.message).then(() => {
    //                 Snackbar.show({
    //                     text: res.message,
    //                     showAction: false,
    //                     pos: "top-right",
    //                     duration: "3000",
    //                     backgroundColor: "#000",
    //                 });
    //             });
    //         }
    //     } catch (error) {
    //         console.log(error);
    //     }
    // })

    // async function handleWishlistAjax(data) {
    //     const url = "{{ route('add_wishlist') }}";
    //     const response = await fetch(url, {
    //         method: "POST",
    //         headers: {
    //             'Content-Type': 'application/json',
    //             "Accept": 'application/json',
    //             'X-CSRF-TOKEN': data._token,
    //         },
    //         body: JSON.stringify(data),
    //     });
    //     const result = await response.json();
    //     return result;
    // }
    
</script>
