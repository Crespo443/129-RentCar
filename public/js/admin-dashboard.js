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
    document.getElementById("modalTitle").textContent =
        `Tandai Sebagai Telah Dikembalikan - ${carName}`;
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

    // Map display status to database value
    const statusMap = {
        Menunggu: "menunggu",
        Dikonfirmasi: "dikonfirmasi",
        Aktif: "sedang_berlangsung",
        Selesai: "selesai",
        Dibatalkan: "dibatalkan",
    };

    const dbStatus = statusMap[currentStatus] || "menunggu";
    document.getElementById("status").value = dbStatus;

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
    document.getElementById("currentPayment").textContent = currentPayment;

    // Map display payment to database value
    const paymentMap = {
        "Belum Bayar": "belum_bayar",
        DP: "dp",
        Lunas: "lunas",
    };

    const dbPayment = paymentMap[currentPayment] || "belum_bayar";
    document.getElementById("payment_status").value = dbPayment;

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
    paymentStatus,
    reservationStatus,
) {
    // Store reservation data globally
    window.currentReservationId = reservationId;
    window.currentReservation = {
        reservationId,
        carName,
        paymentStatus,
        reservationStatus,
    };

    const modal = document.getElementById("actionsModal");
    const carNameElement = document.getElementById("actionsCarName");

    // Set car name
    carNameElement.textContent = `Mobil: ${carName}`;

    // Show modal
    modal.classList.remove("hidden");

    // Setup button click handlers
    document.getElementById("editStatusLink").onclick = function () {
        closeActionsModal();
        openStatusModal(reservationId, carName, reservationStatus);
    };

    document.getElementById("editPaymentLink").onclick = function () {
        closeActionsModal();
        openPaymentModal(reservationId, carName, paymentStatus);
    };

    document.getElementById("markReturnedBtn").onclick = function () {
        closeActionsModal();
        openReturnModal(reservationId, carName);
    };
}

function closeActionsModal() {
    document.getElementById("actionsModal").classList.add("hidden");
}

function cancelReservation() {
    if (!window.currentReservationId) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "ID Reservasi tidak ditemukan",
            confirmButtonColor: "#3085d6",
        });
        return;
    }

    Swal.fire({
        title: "Batalkan Reservasi?",
        text: "Apakah Anda yakin ingin membatalkan reservasi ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Batalkan!",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]',
            ).content;

            Swal.fire({
                title: "Memproses...",
                text: "Mohon tunggu",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            fetch(`/admin/reservations/${window.currentReservationId}/cancel`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            })
                .then((response) => {
                    console.log("Response status:", response.status);
                    return response.json();
                })
                .then((data) => {
                    console.log("Response data:", data);
                    if (data.success) {
                        closeActionsModal();
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            confirmButtonColor: "#3085d6",
                            timer: 2000,
                        }).then(() => {
                            // Force hard reload to get fresh data
                            window.location.href =
                                window.location.href.split("?")[0] +
                                "?t=" +
                                new Date().getTime();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: data.message || "Gagal membatalkan reservasi",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text:
                            "Terjadi kesalahan saat membatalkan reservasi: " +
                            error.message,
                        confirmButtonColor: "#3085d6",
                    });
                });
        }
    });
}

// Open actions modal
function openActionsModal(
    reservationId,
    carName,
    paymentStatus,
    reservationStatus,
) {
    const modal = document.getElementById("actionsModal");
    const carNameElement = document.getElementById("actionsCarName");
    const editStatusLink = document.getElementById("editStatusLink");
    const editPaymentLink = document.getElementById("editPaymentLink");
    const markReturnedBtn = document.getElementById("markReturnedBtn");
    const cancelReservationBtn = document.getElementById(
        "cancelReservationBtn",
    );

    // Store current reservation ID globally
    window.currentReservationId = reservationId;

    if (carNameElement) {
        carNameElement.textContent = `Mobil: ${carName}`;
    }

    // Set up modal buttons
    if (editStatusLink) {
        editStatusLink.onclick = function (e) {
            e.preventDefault();
            closeActionsModal();
            openStatusModal(reservationId, carName, reservationStatus);
        };
    }

    if (editPaymentLink) {
        editPaymentLink.onclick = function (e) {
            e.preventDefault();
            closeActionsModal();
            openPaymentModal(reservationId, carName, paymentStatus);
        };
    }

    if (markReturnedBtn) {
        markReturnedBtn.onclick = function () {
            closeActionsModal();
            openReturnModal(reservationId, carName);
        };
    }

    // Show modal
    if (modal) {
        modal.classList.remove("hidden");
    }
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

// Form submission handlers with backend integration
document.addEventListener("DOMContentLoaded", function () {
    const statusForm = document.getElementById("statusForm");
    if (statusForm) {
        statusForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const newStatus = document.getElementById("status").value;
            const reservationId = window.currentEditData?.reservationId;

            console.log("Submitting status update:", {
                reservationId,
                newStatus,
            });

            if (!reservationId) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "ID Reservasi tidak ditemukan",
                    confirmButtonColor: "#3085d6",
                });
                return;
            }

            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]',
            ).content;

            Swal.fire({
                title: "Memproses...",
                text: "Mohon tunggu",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            fetch(`/admin/reservations/${reservationId}/update-status`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({ status: newStatus }),
            })
                .then((response) => {
                    console.log("Response status:", response.status);
                    return response.json();
                })
                .then((data) => {
                    console.log("Response data:", data);
                    if (data.success) {
                        closeStatusModal();
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            confirmButtonColor: "#3085d6",
                            timer: 2000,
                        }).then(() => {
                            // Force hard reload to get fresh data
                            window.location.href =
                                window.location.href.split("?")[0] +
                                "?t=" +
                                new Date().getTime();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: data.message || "Gagal mengupdate status",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text:
                            "Terjadi kesalahan saat mengupdate status: " +
                            error.message,
                        confirmButtonColor: "#3085d6",
                    });
                });
        });
    }

    const paymentForm = document.getElementById("paymentForm");
    if (paymentForm) {
        paymentForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const newPayment = document.getElementById("payment_status").value;
            const reservationId = window.currentEditData?.reservationId;

            console.log("Submitting payment update:", {
                reservationId,
                newPayment,
            });

            if (!reservationId) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "ID Reservasi tidak ditemukan",
                    confirmButtonColor: "#3085d6",
                });
                return;
            }

            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]',
            ).content;

            Swal.fire({
                title: "Memproses...",
                text: "Mohon tunggu",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            fetch(`/admin/reservations/${reservationId}/update-payment`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({ payment_status: newPayment }),
            })
                .then((response) => {
                    console.log("Response status:", response.status);
                    return response.json();
                })
                .then((data) => {
                    console.log("Response data:", data);
                    if (data.success) {
                        closePaymentModal();
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            confirmButtonColor: "#3085d6",
                            timer: 2000,
                        }).then(() => {
                            // Force hard reload to get fresh data
                            window.location.href =
                                window.location.href.split("?")[0] +
                                "?t=" +
                                new Date().getTime();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text:
                                data.message ||
                                "Gagal mengupdate status pembayaran",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text:
                            "Terjadi kesalahan saat mengupdate status pembayaran: " +
                            error.message,
                        confirmButtonColor: "#3085d6",
                    });
                });
        });
    }

    const returnForm = document.getElementById("returnForm");
    if (returnForm) {
        returnForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const returnDate =
                document.getElementById("actual_return_date").value;
            const returnNotes = document.getElementById("return_notes").value;
            const reservationId = window.currentEditData?.reservationId;

            console.log("Submitting return:", {
                reservationId,
                returnDate,
                returnNotes,
            });

            if (!reservationId) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "ID Reservasi tidak ditemukan",
                    confirmButtonColor: "#3085d6",
                });
                return;
            }

            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]',
            ).content;

            Swal.fire({
                title: "Memproses...",
                text: "Mohon tunggu",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            fetch(`/admin/reservations/${reservationId}/mark-returned`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    actual_return_date: returnDate,
                    return_notes: returnNotes,
                }),
            })
                .then((response) => {
                    console.log("Response status:", response.status);
                    return response.json();
                })
                .then((data) => {
                    console.log("Response data:", data);
                    if (data.success) {
                        closeReturnModal();
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            confirmButtonColor: "#3085d6",
                            timer: 2000,
                        }).then(() => {
                            // Force hard reload to get fresh data
                            window.location.href =
                                window.location.href.split("?")[0] +
                                "?t=" +
                                new Date().getTime();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text:
                                data.message ||
                                "Gagal menandai mobil sebagai dikembalikan",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text:
                            "Terjadi kesalahan saat menandai mobil sebagai dikembalikan: " +
                            error.message,
                        confirmButtonColor: "#3085d6",
                    });
                });
        });
    }
});
