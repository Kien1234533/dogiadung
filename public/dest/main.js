// const fetchProduct = (number, selector) => {
//     const product = document.querySelector(`${selector}`);
//     const html = Array.from(Array(number)).map((_, i) => {
//         return `
//             <div class="item">
//             <div class="thumnail">
//             <img src="https://placehold.co/300X250" alt="" />
//             </div>
//             <div class="content">
//             <a href="/detail.html" class="name">Gradient Graphic T-shirt</a>
//             <p class="price">
//                 <span class="sale">150.000đ</span>
//                 <span class="root">250.000đ</span>
//             </p>
//             </div>
//         </div>
//         `;
//     });
//     product.innerHTML = html.join("");
// };
// const handleCoppy = (selector) => {
//     const listBtn = document.querySelectorAll(`${selector}`);
//     listBtn.forEach((e) => {
//         e.addEventListener("click", () => {
//             const code = e.getAttribute("data-code");
//             navigator.clipboard.writeText(code).then(() => {
//                 Snackbar.show({
//                     text: `Sao chép mã giảm giá  ${code} thành công`,
//                     showAction: false,
//                     pos: "top-right",
//                     duration: "4000",
//                     backgroundColor: "#000",
//                 });
//             });
//         });
//     });
// };

// const handleTabs = (option, option2, option3) => {
//     const listtab = document.querySelectorAll(`${option}`),
//         listcontent = document.querySelectorAll(`${option2}`);
//     listtab.forEach((e, i) => {
//         e.addEventListener("click", () => {
//             listtab.forEach((el) => {
//                 el.classList.remove("active");
//             });
//             listcontent.forEach((el2) => {
//                 el2.classList.remove("active");
//             });
//             e.classList.add("active");
//             localStorage.setItem(`${option3}`, JSON.stringify(i));
//             listcontent[i].classList.add("active");
//         });
//     });
// };
// const handleCache = (option, option2, option3) => {
//     const listtab = document.querySelectorAll(`${option}`),
//         listcontent = document.querySelectorAll(`${option2}`);
//     let data = localStorage.getItem(`${option3}`);
//     if (data) {
//         data = JSON.parse(data);
//         listtab[data].classList.add("active");
//         listcontent[data].classList.add("active");
//     } else {
//         listtab[0].classList.add("active");
//         listcontent[0].classList.add("active");
//     }
// };
// const handleOption = (option) => {
//     const listOption = document.querySelectorAll(`${option}`);
//     listOption.forEach((e) => {
//         e.addEventListener("click", () => {
//             listOption.forEach((el) => {
//                 el.classList.remove("active");
//             });
//             e.classList.add("active");
//         });
//     });
// };
// const hanldeQuantity = () => {
//     const number = document.querySelector(".flexbox .quantity .qtt"),
//         next = document.querySelector(".flexbox .quantity .next"),
//         pre = document.querySelector(".flexbox .quantity .pre");
//     next.addEventListener("click", () => {
//         number.value = parseInt(number.value) + 1;
//     });
//     pre.addEventListener("click", () => {
//         if (number.value > 1) {
//             number.value = parseInt(number.value) - 1;
//         }
//     });
// };
// const handlePopupComment = () => {
//     const popup = document.querySelector(".modalcomment"),
//         btnOpen = document.querySelector(".comment .wrapbox .btn-write"),
//         btnClose = document.querySelector(".modalcomment .btn-close");
//     btnOpen.addEventListener("click", () => {
//         popup.classList.add("active");
//     });
//     btnClose.addEventListener("click", () => {
//         popup.classList.remove("active");
//     });
// };
// const handleRenderBlog = (selector) => {
//     const blog = document.querySelector(`${selector}`);
//     const html = Array.from(Array(3)).map((_, i) => {
//         return `
//         <div class="item">
//         <div class="thumnail">
//           <img src="https://placehold.co/200x200" alt="" />
//         </div>
//         <div class="content">
//           <p class="date">Jul 07, 2023</p>
//           <a href="/blogdetail.html" class="name">
//             Reflect the bonds of the Lorem ipsum dolor, sit amet
//             consectetur adipisicing elit. Asperiores odit, culpa
//           </a>
//           <a href="#" class="btn-readmore">Read more</a>
//         </div>
//       </div>
//     `;
//     });
//     blog.innerHTML = html.join("");
// };
// if (window.location.pathname === "/blog.html") {
//     handleRenderBlog(".blog_content-left .--new");
//     handleRenderBlog(".blog_content-left .--featured");
//     handleRenderBlog(".blog_content-left .--recent");
// }
// if (window.location.pathname === "/blogdetail.html") {
//     handleRenderBlog(".blogdetail_content-left .--view");
//     handleRenderBlog(".blogdetail_content-left .--newdetail");
// }

// if (window.location.pathname === "/shopco/public/profile.html") {
// }
// if (window.location.pathname === "/shopco/public/") {
//     handleCoppy(".voucher_content-box .item .right .coppy .btn-cp");
// }
// if (window.location.pathname === "/cart.html") {
//     handleCoppy(".voucher_content-box .item .right .coppy .btn-cp");
// }
