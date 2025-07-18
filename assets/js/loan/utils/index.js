const payment_term = document.getElementById("paymentTerm");
const loan_id = document.getElementById("loanId");
const amount_due = document.getElementById("loanAmount");

//function to display the dates based on the deadlines
function generateMonthlyDates(startDate, months) {
    let datesArray = [];
    let currentDate = new Date(startDate);

    for (let i = 0; i < months; i++) {
        datesArray.push(new Date(currentDate));
        currentDate.setMonth(currentDate.getMonth() + 1);
    }

    return datesArray;
}

let startDate = new Date();
let monthsToAdd = parseInt(payment_term.value, 10) || 0; // Ensure `monthsToAdd` is a number
let monthlyDates = generateMonthlyDates(startDate, monthsToAdd);

const updateCalculations = () => {
    const tableBody = document.getElementById("tableBody");
    const loanAmount = document.getElementById("loanAmount").value;
    const serviceFee = 0.025 * loanAmount;
    const monthlyInterest = parseFloat(0.0225 * loanAmount * monthsToAdd);

    if (!tableBody) return;
    console.log(tableBody);
    tableBody.innerHTML = "";

    const totalCredit =
        parseInt(loanAmount) + parseInt(monthlyInterest) + parseInt(serviceFee);
    

    for (let i = 0; i <= monthlyDates.length; i++) {
        const currentAmount = totalCredit / monthsToAdd;
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${i + 1}</td>
            <td>PHP ${currentAmount.toFixed(2)}</td>
            <td>${monthlyDates[i].toDateString()}</td>`;
        tableBody.appendChild(row);
    }
};