
    function defaultField() {
        $("#accNumContainer,#accNameContainer,#refNumContainer").hide();
    }

    function displayOptionField(selectedOption) {
        switch (selectedOption) {
            case "1":
                $("#financialContainer").show();
                break;

            case "2":
                break;

            case "3":
            case "4":
                $("#financialContainer").show();
                break;
            default:
                $("#financialContainer").hide();
                break;
        }
    }


    function display_comment(selectedOption){
        console.log(selectedOption);
        switch (selectedOption) {
            case "Rejected":
                $("#commentContainer").show();
                break;
            default: 
                $("#commentContainer").hide();
                break;
        }
    }



    function displayWalletField(selectedOption) {
        console.log(selectedOption);
        switch (selectedOption) {
            case "2": //gcash
            case "11":
                $("#refNumContainer").show();
                // $("#refNumContainer,#accNumContainer,#accNameContainer").show();
                break;

            case "21":
                
                break;
        }
    }

    //general function to access attributes
    var fetchDetails = function (url, itemId,successCallback) {
        if (itemId) {
            $.ajax({
                url: `${BASE_URL}${url}`,
                type: "POST",
                data: { id: itemId },
                dataType: "json",
                success: successCallback,
                error: function () {
                    alert("Failed to fetch item details");
                },
            });
        } else {
        
        }
    };


    $("#paymentMode").on("change", function () {
        defaultField();
        const selectedOption = $(this).val();
        const paymentMethodDropdown = $("#paymentMethod");
        paymentMethodDropdown.empty();
        paymentMethodDropdown.append(new Option("", ""));

        fetchDetails("Transaction/Transaction/get_method", selectedOption, function (data) {
            if (Array.isArray(data) && data.length > 0) {
                data.forEach(option => {
                    const optionElement = document.createElement("option");
                    optionElement.value = option.id;
                    optionElement.textContent = option.financial_service_provider;
                    paymentMethodDropdown.append(optionElement);
                });
            } else {
                
                paymentMethodDropdown.append(new Option("No payment methods available", ""));
            }

        
        });

        displayOptionField(selectedOption);
    
    });


    $("#paymentMethod").on("change", function () {
        defaultField();
        const selectedOption = $(this).val();
        displayWalletField(selectedOption);
        
    });
 const payment = $('#paymentStatus');
    console.log(payment);
    $("#paymentStatus").on("change", function() {
        const selectedOption = $(this).val();
        display_comment(selectedOption);
    });