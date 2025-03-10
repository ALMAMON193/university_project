(function ($) {
  "use strict";

  $(document).ready(function () {
    window.addEventListener("scroll", handleProgressBar);
    window.addEventListener("load", handleProgressBar);
    function handleProgressBar() {
      var scrollPosition = window.scrollY + 500;
      var stepsContainer = document.querySelector(".steps--inner");
      var progressLine = document.querySelector(".progress--bar .line");
      var circles = document.querySelectorAll(".circles .circle");

      if (stepsContainer) {
        if (scrollPosition >= stepsContainer.offsetTop) {
          var containerHeight = stepsContainer.clientHeight;
          var progressHeight =
            ((scrollPosition - stepsContainer.offsetTop) / containerHeight) *
            100;

          progressHeight = Math.min(progressHeight, 100);

          progressLine.style.height = progressHeight + "%";

          circles.forEach((circle, index) => {
            var circlePosition = circle.getBoundingClientRect().top;
            if (circlePosition < 500) {
              circle.classList.add("active");
            } else {
              circle.classList.remove("active");
            }
          });
        } else {
          // Reset progress line height to 0 if scrolled back up
          progressLine.style.height = "0";

          // Remove active class from all circles if scrolled back up
          circles.forEach(function (circle) {
            circle.classList.remove("active");
          });
        }
      }
    }

    // hamburger menu
    $(".hamburger-menu, .menu li a").on("click", function () {
      $(
        ".line-top, .line-center, .line-bottom, .menu--search--wrapp"
      ).toggleClass("current");
    });
    // nice select
    $("select").niceSelect();

    $(".owl-carousel.hero--slider").owlCarousel({
      items: 1,
      margin: 20,
      nav: true,
      autoplay: true,
      loop: true,
      touchDrag: false,
      mouseDrag: false,
      navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none"><path d="M11.0312 7.4563L4.03354 14.454L11.0312 21.4517" stroke="#FD7F54" stroke-width="2.30567" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M23.6328 14.4541H4.2306" stroke="#FD7F54" stroke-width="2.30567" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none"><path d="M16.6367 7.4563L23.6344 14.454L16.6367 21.4517" stroke="#FAF9F6" stroke-width="2.30567" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.03516 14.4541H23.4374" stroke="#FAF9F6" stroke-width="2.30567" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
      animateIn: "fadeIn",
      animateOut: "fadeOut",
      smartSpeed: 1200,
    });

    // magnifiq popup
    document.addEventListener("click", function (event) {
      if (event.target.closest("#morePhotosBox")) {
        event.preventDefault();
        $(".gallery")
          .magnificPopup({
            delegate: "a",
            type: "image",
            tLoading: "Loading image #%curr%...",
            mainClass: "mfp-img-mobile",
            gallery: {
              enabled: true,
            },
          })
          .magnificPopup("open");
      }
    });

    // sortedBy
    function sortedBy(elements) {
      var elements = document.querySelectorAll(elements);

      elements.forEach((element) => {
        element.addEventListener("click", function () {
          elements.forEach((element) => {
            element.classList.remove("active");
          });
          element.classList.add("active");
        });
      });
    }
    // call for live auction sort
    sortedBy(".sort--by ul li");

    // Counter
    $(".cars--and--bids--area").each(function () {
      var $this = $(this);
      $this.on("inview", function (event, visible) {
        if (visible) {
          $this.find(".counter").each(function () {
            var $counter = $(this);
            $({ Counter: 0 }).animate(
              { Counter: $counter.text() },
              {
                duration: 1500,
                easing: "swing",
                step: function () {
                  $counter.text(Math.ceil(this.Counter));
                },
              }
            );
          });
          $this.unbind("inview");
        }
      });
    });

    $(".owl-carousel.testimonial--carousel").owlCarousel({
      loop: true,
      rewind: true,
      margin: 20,
      autoplay: true,
      dots: true,
      nav: false,
      stagePadding: 80,
      smartSpeed: 1400,
      responsive: {
        0: {
          items: 1,
          stagePadding: 20,
          margin: 16,
        },
        600: {
          items: 2,
          stagePadding: 20,
        },
        900: {
          items: 2,
        },
      },
    });

    // wishlist
    function wishlist() {
      var allStar = document.querySelectorAll(".bid--info .star");
      allStar.forEach((star) => {
        star.addEventListener("click", function () {
          this.classList.toggle("active");
        });
      });
    }
    wishlist();

    // BidStepForm
    function BidStepForm() {
      const steps = document.querySelectorAll(".step");
      const nextBtn = document.querySelector(".bid-next-button");
      let closeButtons = document.querySelectorAll(".close--pop");
      let cancleButton = document.querySelector(".bid-cancle");
      let currentStep = 0;

      if (steps) {
        steps.forEach((step, index) => {
          if (index !== currentStep) {
            step.style.display = "none";
          }
        });

        if (nextBtn) {
          nextBtn.addEventListener("click", function (e) {
            e.preventDefault();
            steps[currentStep].style.display = "none";
            currentStep++;
            steps[currentStep].style.display = "block";
          });
        }

        function resetForm() {
          currentStep = 0;
          steps.forEach((step, index) => {
            if (index === 0) {
              step.style.display = "block";
            } else {
              step.style.display = "none";
            }
            const errorElement = step.querySelector(".error");
            if (errorElement) {
              errorElement.textContent = "";
            }
          });
        }
        // reset form step
        if (closeButtons) {
          closeButtons.forEach((btn) => {
            btn.addEventListener("click", function () {
              resetForm();
            });
          });
        }
        if (cancleButton) {
          cancleButton.addEventListener("click", function (e) {
            e.preventDefault();
            resetForm();
          });
        }
      }
    }
    BidStepForm();

    // // step form
    // function stepform(
    //   Indicators,
    //   formStep,
    //   NextButton,
    //   PrevButton,
    //   closePop,
    //   subMitButton,
    //   Form
    // ) {
    //   const indicators = document.querySelectorAll(Indicators);
    //   const steps = document.querySelectorAll(formStep);
    //   const nextBtn = document.querySelector(NextButton);
    //   const prevBtn = document.querySelector(PrevButton);
    //   const closeButton = document.querySelector(closePop);
    //   const submitBtn = document.querySelector(subMitButton);
    //   const form = document.getElementById(Form);
    //   let currentStep = 0;

    //   // Function to reset the step form
    //   function resetForm() {
    //     currentStep = 0;
    //     indicators.forEach((indicator, index) => {
    //       if (index === 0) {
    //         indicator.classList.add("active");
    //       } else {
    //         indicator.classList.remove("active");
    //       }
    //     });
    //     steps.forEach((step, index) => {
    //       if (index === 0) {
    //         step.style.display = "block";
    //       } else {
    //         step.style.display = "none";
    //       }
    //       const errorElement = step.querySelector(".error");
    //       if (errorElement) {
    //         errorElement.textContent = "";
    //       }
    //     });
    //   }

    //   // Hide steps except the first one initially
    //   steps.forEach((step, index) => {
    //     if (index !== currentStep) {
    //       step.style.display = "none";
    //     }
    //   });

    //   // Click event for the Next button
    //   if (nextBtn) {
    //     nextBtn.addEventListener("click", function (e) {
    //       e.preventDefault();
    //       if (validateStep(currentStep)) {
    //         if (currentStep < steps.length - 1) {
    //           if (indicators.length) {
    //             indicators[currentStep].classList.remove("active");
    //           }
    //           steps[currentStep].style.display = "none";
    //           currentStep++;
    //           if (indicators.length) {
    //             indicators[currentStep].classList.add("active");
    //           }
    //           steps[currentStep].style.display = "block";
    //         }
    //       }
    //     });
    //   }
    //   // Click event for the Prev button
    //   if (prevBtn) {
    //     prevBtn.addEventListener("click", function (e) {
    //       e.preventDefault();
    //       if (currentStep > 0) {
    //         if (indicators.length) {
    //           indicators[currentStep].classList.remove("active");
    //         }
    //         steps[currentStep].style.display = "none";
    //         currentStep--;
    //         if (indicators.length) {
    //           indicators[currentStep].classList.add("active");
    //         }
    //         steps[currentStep].style.display = "block";
    //       }
    //     });
    //   }

    //   // Click event for the Submit button
    //   if (submitBtn) {
    //     submitBtn.addEventListener("click", function (e) {
    //       e.preventDefault();
    //       if (validateStep(currentStep)) {

    //         if (equipmentEditor) {
    //           const equipmentInput = document.querySelector('textarea[name="equipment"]');
    //           if (equipmentInput) {
    //             equipmentInput.value = equipmentEditor.getData();
    //           }
    //         }


    //         // Use AJAX to submit the form
    //         const formData = new FormData(form);
    //         fetch(form.action, {
    //           method: 'POST',
    //           body: formData,
    //           headers: {
    //             'X-Requested-With': 'XMLHttpRequest'
    //           }
    //         })
    //           .then(response => response.json())
    //           .then(data => {
    //             if (data.success) {
    //               // Handle success, e.g., show a success message or redirect
    //               console.log('Form submitted successfully');
    //               resetForm();
    //             } else {
    //               // Handle server-side validation errors
    //               console.error('Server validation failed');
    //             }
    //           })
    //           .catch(error => {
    //             console.error('Error submitting the form', error);
    //           });
    //       }
    //     });
    //   }

    //   // Function to validate current step
    //   function validateStep(stepIndex) {
    //     const inputs = steps[stepIndex].querySelectorAll(
    //       "input[required], select[required], textarea[required]"
    //     );
    //     let isValid = true;

    //     inputs.forEach((input) => {
    //       if (input.type === "radio") {
    //         const group = document.querySelectorAll(
    //           `input[name="${input.name}"]`
    //         );
    //         if (!Array.from(group).some((radio) => radio.checked)) {
    //           isValid = false;
    //           showError(input, "Please make a selection.");
    //         } else {
    //           showError(input, ""); // Clear error message if validation succeeds
    //         }
    //       } else if (input.tagName === "SELECT") {
    //         if (!input.value.trim()) {
    //           isValid = false;
    //           showError(input, "Please make a selection.");
    //         } else {
    //           showError(input, ""); // Clear error message if validation succeeds
    //         }
    //       } else {
    //         if (input.value.trim() === "") {
    //           isValid = false;
    //           showError(input, "Please fill out this field.");
    //         } else {
    //           showError(input, ""); // Clear error message if validation succeeds
    //         }
    //       }
    //     });

    //     return isValid;
    //   }

    //   // Function to show error message for the specified step
    //   function showError(input, errorMessage) {
    //     if (input.type === "radio") {
    //       const groupName = input.getAttribute("name");
    //       const radioGroup = document.querySelectorAll(
    //         `input[name="${groupName}"]`
    //       );

    //       radioGroup.forEach((radio) => {
    //         const errorElement = radio
    //           .closest(".radio--box")
    //           .querySelector(".error");
    //         if (errorElement) {
    //           errorElement.textContent = errorMessage;
    //         }
    //       });
    //     } else {
    //       const errorElement = input.parentElement.querySelector(".error");
    //       if (errorElement) {
    //         errorElement.textContent = errorMessage;
    //       }
    //     }
    //   }

    //   // Click event for the close button of the popup
    //   if (closeButton) {
    //     closeButton.addEventListener("click", function () {
    //       resetForm();
    //     });
    //   }
    // }

    // Initialize the step forms
    var SellCarpopup = document.querySelector(".car--stepform--popup");
    if (SellCarpopup) {
      stepform(
        ".steps--indicators .indicator",
        ".form--step",
        ".next-btn",
        ".prev--btn",
        ".pop--close",
        ".submit-btn",
        "sellForm"
      );
    }

    // show popup
    function showPopups(popElement, overlayElement, e) {
      e.preventDefault();
      document.querySelector(popElement).classList.add("show");
      document.querySelector(overlayElement).classList.add("show");
    }
    function hidePopup(hideElement, overlayElement) {
      document.querySelector(hideElement).classList.remove("show");
      document.querySelector(overlayElement).classList.remove("show");
    }
    // call for sell popup
    var sellBtn = document.querySelector(".sell--button");
    if (sellBtn) {
      sellBtn.addEventListener("click", function (e) {
        e.preventDefault();
        showPopups(".car--stepform--popup", ".overlay", e);
      });
    }
    var closeButton = document.querySelector(".pop--close");
    if (closeButton) {
      closeButton.addEventListener("click", function (e) {
        hidePopup(".car--stepform--popup", ".overlay", e);
      });
    }

    // place bid popup call

    var placeButton = document.querySelector(".place-bid-button");

    if (placeButton) {
      placeButton.addEventListener("click", function (e) {
        showPopups(".register--bid--popup", ".overlay--black", e);
      });
    }

    var closePopupAll = document.querySelectorAll(".close--pop");

    closePopupAll.forEach((closePopup) => {
      if (closePopup) {
        closePopup.addEventListener("click", function (e) {
          hidePopup(".register--bid--popup", ".overlay--black", e);
        });
      }
    });

    var bidCancle = document.querySelector(".bid-cancle");
    if (bidCancle) {
      bidCancle.addEventListener("click", function (e) {
        hidePopup(".step-bid--popup", ".overlay--black", e);
      });
    }

    // aos init
    AOS.init({
      once: true,
    });

    // video popup
    $(".video--popup a").magnificPopup({
      type: "iframe",
      iframe: {
        patterns: {
          youtube: {
            index: "youtube.com/",

            id: "v=",
            src: "https://www.youtube.com/embed/%id%?autoplay=1",
          },
        },

        srcAction: "iframe_src",
      },
    });

    // bootstrap form validation
    function bootstrapvalidation() {
      var forms = document.querySelectorAll(".needs-validation");

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add("was-validated");
          },
          false
        );
      });
    }
    bootstrapvalidation();

    function uploadProfileImage() {
      var upload = document.getElementById("upload");
      if (upload) {
        upload.addEventListener("change", function (event) {
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById("image-preview").src = e.target.result;
            };
            reader.readAsDataURL(file);
          }
        });
      }
    }
    uploadProfileImage();

    // control language select
    function isMobileDevice() {
      return /Mobi|Android/i.test(navigator.userAgent);
    }

    function updateNiceSelectOptionsForMobile() {
      if (isMobileDevice()) {
        $(".lang--select")
          .find("option")
          .each(function () {
            $(this).text($(this).text().slice(0, 2));
          });

        // Update the Nice Select display
        $(".lang--select").niceSelect("update");
      }
    }

    // Call the function to update options after Nice Select initialization
    updateNiceSelectOptionsForMobile();

    // sell form click handelers
    function handleSellForm() {
      var ModifiedInput = document.getElementById("modified");
      var StockInput = document.getElementById("completely-stock");
      var SagnificatYesInput = document.getElementById("sag-yes");
      var SagnificatNoInput = document.getElementById("sag-no");
      let ModifiedTextarea = document.querySelector(".modification--textarea");
      let SagnificantTextarea = document.querySelector(
        ".sagnificant--textarea "
      );

      if (ModifiedInput) {
        ModifiedTextarea.classList.add("hide");
        SagnificantTextarea.classList.add("hide");

        ModifiedInput.addEventListener("change", function () {
          if (ModifiedInput.checked) {
            ModifiedTextarea.classList.add("show");
          }
        });

        StockInput.addEventListener("change", function () {
          if (StockInput.checked) {
            ModifiedTextarea.classList.remove("show");
          }
        });

        SagnificatYesInput.addEventListener("change", function () {
          if (SagnificatYesInput.checked) {
            SagnificantTextarea.classList.add("show");
          }
        });

        SagnificatNoInput.addEventListener("change", function () {
          if (SagnificatNoInput.checked) {
            SagnificantTextarea.classList.remove("show");
          }
        });
      }
    }
    handleSellForm();

    // dropify
    if ($(".dropify").length > 0) {
      $(".dropify").dropify();
    }
  });
})(jQuery);
