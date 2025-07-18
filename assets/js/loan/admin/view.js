const appModal = document.getElementById("modalCenter");
appModal.addEventListener("click", function (event) {
  const wizardCreateApp = appModal.querySelector("#wizard-create-app");
  if (wizardCreateApp) {
    const wizardCreateAppNextList = [].slice.call(
      wizardCreateApp.querySelectorAll(".btn-next")
    );
    const wizardCreateAppPrevList = [].slice.call(
      wizardCreateApp.querySelectorAll(".btn-prev")
    );
    const createAppStepper = new Stepper(wizardCreateApp, { linear: !0 });
    if (wizardCreateAppNextList) {
      wizardCreateAppNextList.forEach((wizardCreateAppNext) => {
        wizardCreateAppNext.addEventListener("click", (event) => {
          createAppStepper.next();

        });
      });
    }

    if (wizardCreateAppPrevList) {
      wizardCreateAppPrevList.forEach((wizardCreateAppPrev) => {
        wizardCreateAppPrev.addEventListener("click", (event) => {
          createAppStepper.previous();
       
        });
      });
    }
  }


});
const approve_application = document.querySelector(".button-approve");
approve_application.addEventListener("click", function (e) {
  e.preventDefault();
  Swal.fire({
    text: "Are you sure you want to approve the user's application?",
    icon: "warning",
    showCancelButton: !0,
    buttonsStyling: !1,
    confirmButtonText: "Yes, Approve!",
    cancelButtonText: "No, cancel",
    customClass: {
      confirmButton: "btn btn-primary me-2",
      cancelButton: "btn btn-label-secondary",
    },
  }).then(function (result) {
    if (result.value) {
      const member_id = approve_application.getAttribute("data-application-id");
      $.ajax({
        url: `${BASE_URL}Loan/approve`,
        type: "POST",
        async: !0,
        data: {
          member_id: member_id,
          loan_id: loan_id.value,
          amount_due: amount_due.value,
          payment_term: payment_term.value,
        },
        dataType: "json",
        success: function (response) {
          if (response.status) {
            Swal.fire({
              text: "You have successfully approved the user application",
              icon: "success",
              buttonsStyling: !1,
              confirmButtonText: "Ok, got it!",
              customClass: { confirmButton: "btn fw-bold btn-primary" },
            }).then(function () {
              window.location.href = BASE_URL + "Loan/index_admin";
              dt.draw();
            });
          } else {
            Swal.fire({
              text: response.message,
              icon: "error",
              buttonsStyling: !1,
              confirmButtonText: "Ok, got it!",
              customClass: { confirmButton: "btn btn-primary" },
            });
          }
        },
        error: function (error) {
          Swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" },
          });
        },
      });
    } else if (result.dismiss === "cancel") {
      Swal.fire({
        text: "The application was not approved.",
        icon: "error",
        buttonsStyling: !1,
        confirmButtonText: "Ok, got it!",
        customClass: { confirmButton: "btn fw-bold btn-primary" },
      });
    }
  });
});
const reject_application = document.querySelector(".button-reject");
reject_application.addEventListener("click", function (e) {
  e.preventDefault();
  Swal.fire({
    text: "Are you sure you want to reject the user's application?",
    icon: "warning",
    showCancelButton: !0,
    buttonsStyling: !1,
    confirmButtonText: "Yes, Reject!",
    cancelButtonText: "No, cancel",
    customClass: {
      confirmButton: "btn btn-primary me-2",
      cancelButton: "btn btn-label-secondary",
    },
  }).then(function (result) {
    if (result.value) {
      const id = approve_application.getAttribute("data-application-id");
      const remarks = document.getElementById("remarks-reject").value;
      $.ajax({
        url: `${BASE_URL}Loan/reject`,
        type: "POST",
        async: !0,
        data: { id: loan_id.value, remarks: remarks },
        dataType: "json",
        success: function (response) {
          if (response.status) {
            Swal.fire({
              text: "You have successfully rejected the user's application",
              icon: "success",
              buttonsStyling: !1,
              confirmButtonText: "Ok, got it!",
              customClass: { confirmButton: "btn fw-bold btn-primary" },
            }).then(function () {
              window.location.href = BASE_URL + "Applicant/index";
              dt.draw();
            });
          } else {
            Swal.fire({
              text: response.message,
              icon: "error",
              buttonsStyling: !1,
              confirmButtonText: "Ok, got it!",
              customClass: { confirmButton: "btn btn-primary" },
            });
          }
        },
        error: function (error) {
          Swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" },
          });
        },
      });
    } else if (result.dismiss === "cancel") {
      Swal.fire({
        text: "The application was not approved.",
        icon: "error",
        buttonsStyling: !1,
        confirmButtonText: "Ok, got it!",
        customClass: { confirmButton: "btn fw-bold btn-primary" },
      });
    }
  });
});

