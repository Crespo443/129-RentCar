// Period filter functionality
const periodFilter = document.getElementById("periodFilter");
if (periodFilter) {
    periodFilter.addEventListener("change", function () {
        const period = this.value;
        const url = new URL(window.location);
        url.searchParams.set("period", period);
        window.location.href = url.toString();
    });
}

function scrollToReservatios() {
    window.scrollTo({
        top: 300,
        behavior: "smooth",
    });
}

function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle("hidden");

    // Close other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(function (element) {
        if (element.id !== dropdownId) {
            element.classList.add("hidden");
        }
    });
}

function openReturnModal(reservationId, carName) {
    document.getElementById(
        "modalTitle"
    ).textContent = `Tandai Sebagai Telah Dikembalikan - ${carName}`;
    // Simpan data untuk digunakan saat submit
    window.currentEditData = { reservationId, carName };
    document.getElementById("returnModal").classList.remove("hidden");
}

function closeReturnModal() {
    document.getElementById("returnModal").classList.add("hidden");
}

// Status Modal Functions
function openStatusModal(reservationId, carName, currentStatus) {
    document.getElementById("statusCarName").textContent = `Mobil: ${carName}`;
    document.getElementById("currentStatus").textContent = currentStatus;
    document.getElementById("status").value = currentStatus;
    // Simpan data untuk digunakan saat submit
    window.currentEditData = { reservationId, carName, currentStatus };
    document.getElementById("statusModal").classList.remove("hidden");
}

function closeStatusModal() {
    document.getElementById("statusModal").classList.add("hidden");
}

// Payment Modal Functions
function openPaymentModal(reservationId, carName, currentPayment) {
    document.getElementById("paymentCarName").textContent = `Mobil: ${carName}`;
    document.getElementById("currentPayment").textContent =
        currentPayment.charAt(0).toUpperCase() + currentPayment.slice(1);
    document.getElementById("payment_status").value = currentPayment;
    // Simpan data untuk digunakan saat submit
    window.currentEditData = { reservationId, carName, currentPayment };
    document.getElementById("paymentModal").classList.remove("hidden");
}

function closePaymentModal() {
    document.getElementById("paymentModal").classList.add("hidden");
}

// Actions Modal Functions
function openActionsModal(
    reservationId,
    carName,
    returnStatus,
    reservationStatus
) {
    // Store reservation data globally
    window.currentReservationId = reservationId;
    window.currentReservation = {
        reservationId,
        carName,
        returnStatus,
        reservationStatus,
    };

    const modal = document.getElementById("actionsModal");
    const carNameElement = document.getElementById("actionsCarName");
    const editStatusLink = document.getElementById("editStatusLink");
    const editPaymentLink = document.getElementById("editPaymentLink");
    const markReturnedBtn = document.getElementById("markReturnedBtn");
    const returnBtnText = document.getElementById("returnBtnText");
    const cancelReservationBtn = document.getElementById(
        "cancelReservationBtn"
    );
    const cancelBtnText = document.getElementById("cancelBtnText");

    // Set car name
    carNameElement.textContent = `Mobil: ${carName}`;

    // Set up modal buttons instead of links
    editStatusLink.onclick = function (e) {
        e.preventDefault();
        closeActionsModal();
        openStatusModal(reservationId, carName, reservationStatus);
    };

    editPaymentLink.onclick = function (e) {
        e.preventDefault();
        closeActionsModal();
        // Ini akan memerlukan data status pembayaran yang sebenarnya
        // Untuk demo ini, kita hardcode 'pending'
        const reservationsData = {
            1: "Paid",
            2: "pending",
            3: "Paid",
            4: "Paid",
            5: "Canceled",
        };
        openPaymentModal(
            reservationId,
            carName,
            reservationsData[reservationId] || "pending"
        );
    };

    // Handle return button
    if (returnStatus === "returned") {
        markReturnedBtn.classList.add("opacity-50", "cursor-not-allowed");
        markReturnedBtn.disabled = true;
        returnBtnText.textContent = "Sudah Dikembalikan";
        markReturnedBtn.onclick = null;
    } else {
        markReturnedBtn.classList.remove("opacity-50", "cursor-not-allowed");
        markReturnedBtn.disabled = false;
        returnBtnText.textContent = "Tandai Sudah Kembali";
        markReturnedBtn.onclick = function () {
            closeActionsModal();
            openReturnModal(reservationId, carName);
        };
    }

    // Handle cancel button based on reservation status
    if (reservationStatus === "Canceled" || reservationStatus === "Ended") {
        cancelReservationBtn.classList.add("opacity-50", "cursor-not-allowed");
        cancelReservationBtn.disabled = true;
        cancelReservationBtn.onclick = null;
        cancelBtnText.textContent =
            reservationStatus === "Canceled"
                ? "Sudah Dibatalkan"
                : "Tidak Bisa Dibatalkan (Selesai)";
    } else {
        cancelReservationBtn.classList.remove(
            "opacity-50",
            "cursor-not-allowed"
        );
        cancelReservationBtn.disabled = false;
        cancelReservationBtn.onclick = cancelReservation;
        cancelBtnText.textContent = "Batalkan Reservasi";
    }

    // Show modal
    modal.classList.remove("hidden");
}

function closeActionsModal() {
    const modal = document.getElementById("actionsModal");
    modal.classList.add("hidden");
}

// Close dropdowns when clicking outside
document.addEventListener("click", function (event) {
    if (
        !event.target.closest('[onclick^="toggleDropdown"]') &&
        !event.target.closest('[id^="dropdown-"]')
    ) {
        document
            .querySelectorAll('[id^="dropdown-"]')
            .forEach(function (dropdown) {
                dropdown.classList.add("hidden");
            });
    }
});

// Close actions modal when clicking outside
const actionsModalElement = document.getElementById("actionsModal");
if (actionsModalElement) {
    actionsModalElement.addEventListener("click", function (event) {
        if (event.target === this) {
            closeActionsModal();
        }
    });
}

// Close return modal when clicking outside
const returnModalElement = document.getElementById("returnModal");
if (returnModalElement) {
    returnModalElement.addEventListener("click", function (event) {
        if (event.target === this) {
            closeReturnModal();
        }
    });
}

// Cancel reservation function
function cancelReservation() {
    if (confirm("Yakin ingin membatalkan reservasi ini?")) {
        closeActionsModal();
        alert("Berhasil! Reservasi berhasil dibatalkan");
        window.location.reload();
    }
}

// Form submission handlers - UI only (no backend)
document.addEventListener("DOMContentLoaded", function () {
    const statusForm = document.getElementById("statusForm");
    if (statusForm) {
        statusForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const newStatus = document.getElementById("status").value;
            closeStatusModal();

            alert(
                `Berhasil! Status reservasi berhasil diubah menjadi ${newStatus}`
            );
            window.location.reload();
        });
    }

    const paymentForm = document.getElementById("paymentForm");
    if (paymentForm) {
        paymentForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const newPayment = document.getElementById("payment_status").value;
            closePaymentModal();

            alert(
                `Berhasil! Status pembayaran berhasil diubah menjadi ${newPayment}`
            );
            window.location.reload();
        });
    }

    const returnForm = document.getElementById("returnForm");
    if (returnForm) {
        returnForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const returnDate =
                document.getElementById("actual_return_date").value;
            const returnNotes = document.getElementById("return_notes").value;
            closeReturnModal();

            alert("Berhasil! Mobil berhasil ditandai sebagai dikembalikan!");
            window.location.reload();
        });
    }
});
