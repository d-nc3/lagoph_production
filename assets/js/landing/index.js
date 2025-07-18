"use strict";

(function () {



	const nav = document.querySelector(".layout-navbar"),

		heroAnimation = document.getElementById("hero-animation"),

		animationImg = document.querySelectorAll(".hero-dashboard-img"),

		animationElements = document.querySelectorAll(".hero-elements-img"),

		swiperLogos = document.getElementById("swiper-clients-logos"),

		swiperReviews = document.getElementById("swiper-reviews"),

		ReviewsPreviousBtn = document.getElementById("reviews-previous-btn"),

		ReviewsNextBtn = document.getElementById("reviews-next-btn"),

		ReviewsSliderPrev = document.querySelector(".swiper-button-prev"),

		ReviewsSliderNext = document.querySelector(".swiper-button-next"),

		priceDurationToggler = document.querySelector(".price-duration-toggler"),

		priceMonthlyList = [].slice.call(

			document.querySelectorAll(".price-monthly")

		),

		priceYearlyList = [].slice.call(document.querySelectorAll(".price-yearly"));

	const mediaQueryXL = "1200";

	const width = screen.width;

	if (width >= mediaQueryXL && heroAnimation) {

		heroAnimation.addEventListener("mousemove", function parallax(e) {

			animationElements.forEach((layer) => {

				layer.style.transform = "translateZ(1rem)";

			});

			animationImg.forEach((layer) => {

				let x = (window.innerWidth - e.pageX * 2) / 100;

				let y = (window.innerHeight - e.pageY * 2) / 100;

				layer.style.transform = `perspective(1200px) rotateX(${y}deg) rotateY(${x}deg) scale3d(1, 1, 1)`;

			});

		});

		nav.addEventListener("mousemove", function parallax(e) {

			animationElements.forEach((layer) => {

				layer.style.transform = "translateZ(1rem)";

			});

			animationImg.forEach((layer) => {

				let x = (window.innerWidth - e.pageX * 2) / 100;

				let y = (window.innerHeight - e.pageY * 2) / 100;

				layer.style.transform = `perspective(1200px) rotateX(${y}deg) rotateY(${x}deg) scale3d(1, 1, 1)`;

			});

		});

		heroAnimation.addEventListener("mouseout", function () {

			animationElements.forEach((layer) => {

				layer.style.transform = "translateZ(0)";

			});

			animationImg.forEach((layer) => {

				layer.style.transform =

					"perspective(1200px) scale(1) rotateX(0) rotateY(0)";

			});

		});

	}

	if (swiperReviews) {

		new Swiper(swiperReviews, {

			slidesPerView: 1,

			spaceBetween: 5,

			grabCursor: !0,

			autoplay: { delay: 3000, disableOnInteraction: !1 },

			loop: !0,

			loopAdditionalSlides: 1,

			navigation: {

				nextEl: ".swiper-button-next",

				prevEl: ".swiper-button-prev",

			},

			breakpoints: {

				1200: { slidesPerView: 3, spaceBetween: 26 },

				992: { slidesPerView: 2, spaceBetween: 20 },

			},

		});

	}



    const sendEmail = document.getElementById("email-form");



	const fv = FormValidation.formValidation(sendEmail,

		{

			fields: {

				fullName: {

					validators: {

						notEmpty: {

							message: "Full name field is required",

						},



					},

				},

				contactEmail: {

					validators: {

						notEmpty: {

							message: "Contact Email field is required",

						},

					},

				},

                contactMessage: {

					validators: {

						notEmpty: {

							message: "Contact message field is required",

						},

					},

				},

			},

			plugins: {

				trigger: new FormValidation.plugins.Trigger(),

				bootstrap5: new FormValidation.plugins.Bootstrap5({

					// eleValidClass: "",

					// rowSelector: '.col-sm-6'

				}),

				autoFocus: new FormValidation.plugins.AutoFocus(),

				submitButton: new FormValidation.plugins.SubmitButton(),

			},

			init: (instance) => {

				instance.on("plugins.message.placed", function (e) {

					if (e.element.parentElement.classList.contains("input-group")) {

						e.element.parentElement.insertAdjacentElement(

							"afterend",

							e.messageElement

						);

					}

				});

			},

		}

	);



	sendEmail.addEventListener("click", function (e) {

		e.preventDefault();

		fv.validate().then(function (status) {

			if (status === "Valid") {

				showBlockUI();

				$.ajax({

					url: `${BASE_URL}Landing/sendEmail`, // Ensure the correct URL for form submission

					type: "POST",

					data: new FormData(sendEmail),

					contentType: false,

					cache: false,

					processData: false,

					dataType: "json",

					success: function (response) {

						hideBlockUI();



						if (response.status) {

							Swal.fire({

								text: response.message,

								icon: "success",

								buttonsStyling: false,

								confirmButtonText: "Ok, got it!",

								customClass: {

									confirmButton: "btn fw-bold btn-primary",

								},

							}).then(() => {

								window.location.href = BASE_URL + "Admin/Member/index";



							});

						} else {

							Swal.fire({

								text: response.message,

								icon: "error",

								buttonsStyling: false,

								confirmButtonText: "Ok, got it!",

								customClass: {

									confirmButton: "btn btn-primary",

								},

							});

						}

					},

					error: function () {

						hideBlockUI();

						Swal.fire({

							text: "Sorry, looks like there are some errors detected, please try again.",

							icon: "error",

							buttonsStyling: false,

							confirmButtonText: "Ok, got it!",

							customClass: {

								confirmButton: "btn btn-primary",

							},

						});

					},

				});

			}

		});

	});





})();

