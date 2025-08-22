$(document).ready(function () {
    getDashboardCardsData();
    getDashboardChartsData();
});

function getDashboardCardsData() {
    $.ajax({
        url: "../actions/get-dashboard-cards-data.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var formattedProfit =
                    "₱" +
                    parseFloat(response.totalProfit).toLocaleString("en", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                var formattedSales =
                    "₱" +
                    parseFloat(response.totalSales).toLocaleString("en", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                var formattedBookings = parseFloat(
                    response.totalBookings
                ).toLocaleString("en");
                var formattedCustomers = parseFloat(
                    response.totalCustomers
                ).toLocaleString("en");

                $("#profitCounts").text(formattedProfit);
                $("#todaySalesAmount").text(formattedSales);
                $("#totalBookings").text(formattedBookings);
                $("#totalCustomers").text(formattedCustomers);
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}

function getDashboardChartsData() {
    $.ajax({
        url: "../actions/get-dashboard-charts-data.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                // Bookings Chart - Bar Graph
                var bookingsOptions = {
                    chart: {
                        type: "bar",
                        height: 350,
                        width: "100%",
                        toolbar: {
                            show: false,
                        },
                    },
                    series: [
                        {
                            name: "Bookings",
                            data: response.bookingsData,
                        },
                    ],
                    xaxis: {
                        categories: response.months,
                        title: {
                            text: "Months",
                        },
                    },
                    yaxis: {
                        title: {
                            text: "Number of Bookings",
                        },
                    },
                    title: {
                        text: "2024 Monthly Bookings",
                        align: "center",
                    },
                    responsive: [
                        {
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 250,
                                },
                                xaxis: {
                                    labels: {
                                        show: true,
                                    },
                                },
                                yaxis: {
                                    labels: {
                                        show: true,
                                    },
                                },
                            },
                        },
                    ],
                };

                var bookingsChart = new ApexCharts(
                    document.querySelector("#bookingsChart"),
                    bookingsOptions
                );
                bookingsChart.render();

                // Revenue Chart - Line Graph
                var revenueOptions = {
                    chart: {
                        type: "line",
                        height: 350,
                        width: "100%",
                        toolbar: {
                            show: false,
                        },
                    },
                    series: [
                        {
                            name: "Revenue",
                            data: response.revenueData,
                        },
                    ],
                    xaxis: {
                        categories: response.months,
                        title: {
                            text: "Months",
                        },
                    },
                    yaxis: {
                        title: {
                            text: "Total Revenue (₱)",
                        },
                    },
                    title: {
                        text: "2024 Monthly Revenue",
                        align: "center",
                    },
                    responsive: [
                        {
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 250,
                                },
                                xaxis: {
                                    labels: {
                                        show: true,
                                    },
                                },
                                yaxis: {
                                    labels: {
                                        show: true,
                                    },
                                },
                            },
                        },
                    ],
                };

                var revenueChart = new ApexCharts(
                    document.querySelector("#revenueChart"),
                    revenueOptions
                );
                revenueChart.render();
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}
