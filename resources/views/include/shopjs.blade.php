<script>
    const option = {
        sort: undefined,
        categories: [],
        price: "",
        colors: [],
        sizes: [],
        page: 1,
    };
    // mới vào trang web gọi lần đầu để đổ sp lên giao diện
    handleSortAndFilter(option);
    // biến sử dụng
    const ENDPOINT = window.location.href,
        urlPublic = ENDPOINT.split("shop.html")[0],
        listProduct = document.querySelector(".products_content-box .productlist"),
        listCateFilter = document.querySelectorAll("#filter_categories .form-group input"),
        priceFilter = document.querySelectorAll("#filter_price .option"),
        listColor = document.querySelectorAll("#filter_colors .color-group"),
        listColorFilter = document.querySelectorAll("#filter_colors .color-group input"),
        listSizeFilter = document.querySelectorAll("#filter_sizes .form-group input"),
        listSort = document.querySelector("#sort_product"),
        btnLoadMore = document.querySelector(".btn-load");

    // các array chứa categoriID,ColorID,SizeId
    let arrCategories = [],
        arrColors = [],
        arrSize = [];

    // Lắng nghe sự kiện change của sắp xếp
    listSort.addEventListener("change", (e) => {
        option.sort = e.target.value;
        option.page = 1;
        handleSortAndFilter(option);
    });

    // Lắng nghe sự kiện click của item giá
    priceFilter.forEach((e) => {
        e.addEventListener("click", () => {
            priceFilter.forEach((el) => {
                el.classList.remove("active");
            });
            const dataPrice = e.getAttribute("data-price");
            if (option.price === dataPrice) {
                option.price = "";
                e.classList.remove("active");
            } else {
                option.price = dataPrice;
                e.classList.add("active");
            }
            option.page = 1;
            handleSortAndFilter(option);
        });
    });

    // Lắng nghe sự kiện onchage
    const handleOnChangeFilter = (listChange, arr, key) => {
        listChange.forEach((e, i) => {
            if (key === "colors") {
                e.addEventListener("click", () => {
                    listColor[i].classList.toggle("active");
                });
            }
            e.addEventListener("change", (ev) => {
                if (ev.target.checked) {
                    arr.push(ev.target.value);
                } else {
                    const index = arr.indexOf(ev.target.value);
                    if (index !== -1) {
                        arr.splice(index, 1);
                    }
                }
                // key là tên key ở trong object
                option[key] = arr;
                // khi xảy ra onchange fillter thì đổi page về 1 để ko bị lỗi loadmore
                option.page = 1;
                handleSortAndFilter(option);
            });
        });
    };
    // gọi hàm change khi filter
    handleOnChangeFilter(listCateFilter, arrCategories, "categories");
    handleOnChangeFilter(listColorFilter, arrColors, "colors");
    handleOnChangeFilter(listSizeFilter, arrSize, "sizes");

    // Call Api Để Lấy Sản Phẩm Theo Bộ lọc và sắp xếp
    async function handleSortAndFilter(data) {
        const url = '{{ route('shoppage') }}';
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(data),
        });
        const result = await response.json();
        listProduct.innerHTML = "";
        result.data.data.forEach((item) => {
            const thumbnail = JSON.parse(item.image),
                bindparam = `${item.slug}-${item.code}.html`,
                product = ` 
                     <div class="item">
                        <div class="thumnail">
                            <img src="${urlPublic}uploads/${thumbnail[0]}" alt="" />
                        </div>
                        <div class="content">
                            <a href="${urlPublic}product/${bindparam} "class="name">
                                ${item.name}
                            </a>
                            <p class="price">
                                ${item.discount > 0? 
                                    `<span class="sale">${toPrice(item.pricesale)}đ</span>  
                                    <span class="root">${toPrice(item.price)}đ</span>`
                                : `<span class="sale">${toPrice(item.price)}đ</span>`
                                }
                            </p>
                        </div>
                    </div>`;
            listProduct.innerHTML += product;
        });
        if (result.page >= Math.ceil(result.total / result.data.per_page)) {
            btnLoadMore.style.display = "none";
        } else {
            btnLoadMore.style.display = "block";
        }
        if (result.total === 0) {
            document.querySelector(".message").innerHTML = result.message;
        } else {
            document.querySelector(".message").innerHTML = "";
        }
    }
    // Bắt sự kiện click btn-loadmore
    btnLoadMore.addEventListener("click", function() {
        option.page++;
        loadMore(option);
    });
    // Hàm loadmore
    async function loadMore(option) {
        const url = '{{ route('shoppage') }}'
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(option),
        });
        const result = await response.json();
        result.data.data.forEach((item) => {
            const thumbnail = JSON.parse(item.image),
                bindparam = `${item.slug}-${item.code}.html`,
                product = ` 
                <div class="item">
                        <div class="thumnail">
                            <img src="${urlPublic}uploads/${thumbnail[0]}" alt="" />
                        </div>
                        <div class="content">
                            <a href="${urlPublic}product/${bindparam} "class="name">
                                ${item.name}
                            </a>
                            <p class="price">
                                ${item.discount > 0? 
                                    `<span class="sale">${toPrice(item.pricesale)}đ</span>  
                                    <span class="root">${toPrice(item.price)}đ</span>`
                                : `<span class="sale">${toPrice(item.price)}đ</span>`
                                }
                            </p>
                        </div>
                    </div>`;
            listProduct.innerHTML += product;
        });
        // nếu page hiện tại lớn hơn hoặc bằng tổng số sản phẩm / số sp  trên 1 trang thì ẩn btn
        if (result.page >= Math.ceil(result.total / result.data.per_page)) {
            btnLoadMore.style.display = "none";
        } else {
            btnLoadMore.style.display = "block";
        }
        if (result.total === 0) {
            document.querySelector(".message").innerHTML = result.message;
        } else {
            document.querySelector(".message").innerHTML = "";
        }
    }
    // Hàm đổi giá -> vnđ
    const toPrice = (value) => {
        return new Intl.NumberFormat().format(value);
    };
    // Hàm sao chép mã giảm giá
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
    handleCoppy(".btn-cp");
    // Hàm Xử lý Bộ lọc ở tablet,mobile
    const handleBtnFilter = () => {
        const filterBtn = document.querySelector(".products_content-filter .item:first-child"),
            display = document.querySelector(".products_content-filter");
        filterBtn.addEventListener("click", () => {
            display.classList.toggle("active");
        });
    };
    handleBtnFilter();
    
</script>
