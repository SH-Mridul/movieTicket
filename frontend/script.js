const container = document.querySelector(".container");
const seats = document.querySelectorAll(".row .seat:not(.sold)");
const count = document.getElementById("count");
const total = document.getElementById("total");
const movieSelect = document.getElementById("movie");
const paymentForm = document.getElementById("paymentForm");
const billingForm = document.getElementById("billingForm");
const bill = document.getElementById("bill");
const billDetails = document.getElementById("billDetails");

populateUI();

let ticketPrice = +movieSelect.value;

// Save selected movie index and price
function setMovieData(movieIndex, moviePrice) {
    localStorage.setItem("selectedMovieIndex", movieIndex);
    localStorage.setItem("selectedMoviePrice", moviePrice);
}

// Update total and count
function updateSelectedCount() {
    const selectedSeats = document.querySelectorAll(".row .seat.selected");
    const seatsIndex = [...selectedSeats].map(seat => [...seats].indexOf(seat));

    localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));
    const selectedSeatsCount = selectedSeats.length;

    count.innerText = selectedSeatsCount;
    total.innerText = selectedSeatsCount * ticketPrice;

    setMovieData(movieSelect.selectedIndex, movieSelect.value);

    // Show payment form if at least one seat is selected
    paymentForm.classList.toggle('hidden', selectedSeatsCount === 0);
}

// Get data from localStorage and populate UI
function populateUI() {
    const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

    if (selectedSeats !== null && selectedSeats.length > 0) {
        seats.forEach((seat, index) => {
            if (selectedSeats.indexOf(index) > -1) {
                seat.classList.add("selected");
            }
        });
    }

    const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

    if (selectedMovieIndex !== null) {
        movieSelect.selectedIndex = selectedMovieIndex;
    }
}

// Movie select event
movieSelect.addEventListener("change", (e) => {
    ticketPrice = +e.target.value;
    setMovieData(e.target.selectedIndex, e.target.value);
    updateSelectedCount();
});

// Seat click event
container.addEventListener("click", (e) => {
    if (e.target.classList.contains("seat") && !e.target.classList.contains("sold")) {
        e.target.classList.toggle("selected");
        updateSelectedCount();
    }
});

// Billing form submission
billingForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const name = document.getElementById("name").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const selectedSeats = document.querySelectorAll(".row .seat.selected");

    // Create bill details
    const seatsList = [...selectedSeats].map((_, index) => `Seat ${index + 1}`).join(', ');
    billDetails.innerHTML = `
        Name: ${name} <br />
        Address: ${address} <br />
        Phone: ${phone} <br />
        Seats: ${seatsList} <br />
        Total: BDT. ${total.innerText}
    `;
    
    // Show the bill
    bill.classList.remove('hidden');

    // Reset the billing form
    billingForm.reset();
    updateSelectedCount(); // Update count after showing the bill
});

// Initial count and total set
updateSelectedCount();
