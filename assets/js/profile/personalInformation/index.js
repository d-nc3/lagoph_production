var validator,
  form,
  submitButton,
  file,
  preview,
  reader,
  uploadInput,
  previewImage,
  currentImage;

var uploadPfp = function () {
  uploadInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        currentImage.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
  const originalImageSrc = currentImage.src;
  // Reset image to original
  resetButton.addEventListener("click", function () {
    currentImage.src = originalImageSrc;
    uploadInput.value = "";
  });
};

var updateProfile = function () {
  validator = FormValidation.formValidation(form, {
    fields: {
      firstName: {
        validators: {
          notEmpty: {
            message: "This field is required",
          },
        },
      },
      lastName: {
        validators: {
          notEmpty: {
            message: "This field is required",
          },
        },
      },
      middleName: {
        validators: {
          notEmpty: {
            message: "This field is required",
          },
        },
      },
      email: {
        validators: {
          notEmpty: {
            message: "This field is required",
          },
        },
      },
      address: {
        validators: {
          notEmpty: {
            message: "This field is required",
          },
        },
      },
      phoneNumber: {
        validators: {
          notEmpty: {
            message: "This field is required",
          },
        },
      },
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: "",
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
  }).on("core.form.valid", function () {});

  submitButton.addEventListener("click", function (e) {
    e.preventDefault();
    if (validator) {
      validator.validate().then(function (status) {
        if (status === "Valid") {
          showBlockUI();
          const formData = new FormData(form);
          $.ajax({
            url: `${BASE_URL}Settings/editProfile`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
              hideBlockUI();
              if (response.status) {
                Swal.fire({
                  text: `Profile updated successfully!`,
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok, got it!",
                  customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                  },
                }).then(function () {
                  window.location.reload();
                });
              } else {
                Swal.fire({
                  text: response.message || "Something went wrong.",
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
                text: "Sorry, an error occurred. Please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              });
            },
          });
        } else {
          Swal.fire({
            text: "Please fill in all required fields correctly.",
            icon: "warning",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn btn-primary",
            },
          });
        }
      });
    }
  });
};

document.addEventListener("DOMContentLoaded", () => {
  form = document.querySelector("#editProfileInformation");
  submitButton = document.querySelector("#submitButton");
  preview = document.getElementById("photoPreview");
  uploadInput = document.getElementById("upload");
  resetButton = document.getElementById("resetButton");
  uploadInput = document.getElementById("upload");
  currentImage = document.getElementById("currentProfileImage");
  previewImage = document.getElementById("imagePreview");

  if (form) {
    updateProfile();
    uploadPfp();
  }
});
