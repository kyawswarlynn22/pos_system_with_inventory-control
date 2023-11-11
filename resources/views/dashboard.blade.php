@extends('layout.sidebarandnav')

@section('title', 'Dashboard');
@section('body')
    <div class="flex justify-evenly flex-wrap">
        <div class=" relative pl-0  border w-56 rounded-lg shadow-xl">
            <div class="h-full  absolute rounded-tl-lg rounded-bl-lg left-0 w-2 bg-blue-600"></div>
            <p class="mt-2 p-2 text-2xl pl-5">CashSale</p>
            <div class="flex  p-2 pl-5 items-center  justify-between">
                <p class="text-[#3786FB] font-bold text-2xl">{{ $cash }}</p>
                <div class="h-12 bg-blue-600 w-12 rounded-full flex justify-center items-center ">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#ffffff"
                            d="M7 18c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m10 0c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m-9.8-3.2c0 .1.1.2.2.2H19v2H7c-1.1 0-2-.9-2-2c0-.4.1-.7.2-1l1.3-2.4L3 4H1V2h3.3l4.3 9h7l3.9-7l1.7 1l-3.9 7c-.3.6-1 1-1.7 1H8.1l-.9 1.6v.2M9.4 1c.8 0 1.4.6 1.4 1.4s-.6 1.4-1.4 1.4S8 3.2 8 2.4S8.7 1 9.4 1m5.2 8c-.8 0-1.4-.6-1.4-1.4s.6-1.4 1.4-1.4s1.4.6 1.4 1.4S15.3 9 14.6 9M9.2 9L8 7.8L14.8 1L16 2.2L9.2 9" />
                    </svg>
                </div>
            </div>
        </div>
        <div class=" relative  border  w-56 rounded-lg shadow-xl">
            <div class="h-full  absolute rounded-tl-lg rounded-bl-lg left-0 w-2 bg-pink-600"></div>
            <p class="mt-2 p-2 text-2xl pl-5">Expense</p>
            <div class="flex  p-2 pl-5 items-center  justify-between">
                <p class=" text-pink-600 font-bold text-2xl">{{ $expense }}</p>
                <div class="h-12 bg-pink-600 w-12 rounded-full flex justify-center items-center ">
                    <svg width="24" height="24" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="m16.517 14.344l7.705-4.8l10.274 8.688v12.566l-5.967 4.836V23.816l-12.012-9.472Zm9.541-5.086L31.9 5.646l10.46 7.293l-6.433 4.926m.277 10.748l6.296-5.14m-6.296 2.479l6.296-5.14m-6.296 2.48l6.296-5.14m-6.296 2.48l6.296-5.14" />
                            <path
                                d="m35.314 14.172l2.723-2.077l-1.865-1.247l-1.498 1.131M5.5 31.954l13.543 10.4l7.423-5.91" />
                            <path d="m5.5 29.285l13.543 10.4l7.423-5.91" />
                            <path d="m5.604 26.616l13.543 10.401l7.423-5.91" />
                            <path
                                d="m5.59 23.948l13.542 10.4l7.423-5.91m-6.32-4.688c-.226 1.027-1.694 1.554-3.278 1.175h0c-1.584-.378-2.685-1.517-2.459-2.545c.226-1.027 1.694-1.553 3.278-1.175s2.685 1.518 2.459 2.545Z" />
                            <path d="m15.051 15.826l-9.295 5.595l13.331 10.117l7.64-6.015" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class=" relative  border  w-56 rounded-lg shadow-xl">
            <div class="h-full  absolute rounded-tl-lg rounded-bl-lg left-0 w-2 bg-green-600"></div>
            <p class="mt-2 p-2 text-2xl pl-5">Income</p>
            <div class="flex  p-2 pl-5 items-center  justify-between">
                <p class=" text-green-600 font-bold text-2xl">{{ $income }}</p>
                <div class="h-12 bg-green-600 w-12 rounded-full flex justify-center items-center ">
                    <svg width="24" height="24" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="m16.517 14.344l7.705-4.8l10.274 8.688v12.566l-5.967 4.836V23.816l-12.012-9.472Zm9.541-5.086L31.9 5.646l10.46 7.293l-6.433 4.926m.277 10.748l6.296-5.14m-6.296 2.479l6.296-5.14m-6.296 2.48l6.296-5.14m-6.296 2.48l6.296-5.14" />
                            <path
                                d="m35.314 14.172l2.723-2.077l-1.865-1.247l-1.498 1.131M5.5 31.954l13.543 10.4l7.423-5.91" />
                            <path d="m5.5 29.285l13.543 10.4l7.423-5.91" />
                            <path d="m5.604 26.616l13.543 10.401l7.423-5.91" />
                            <path
                                d="m5.59 23.948l13.542 10.4l7.423-5.91m-6.32-4.688c-.226 1.027-1.694 1.554-3.278 1.175h0c-1.584-.378-2.685-1.517-2.459-2.545c.226-1.027 1.694-1.553 3.278-1.175s2.685 1.518 2.459 2.545Z" />
                            <path d="m15.051 15.826l-9.295 5.595l13.331 10.117l7.64-6.015" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class=" relative  border  w-56 rounded-lg shadow-xl">
            <div class="h-full  absolute rounded-tl-lg rounded-bl-lg left-0 w-2 bg-yellow-400"></div>
            <p class="mt-2 p-2 text-2xl pl-5"> Cash In Hand</p>
            <div class="flex  p-2 pl-5  items-center  justify-between">
                <p class="text-yellow-400 font-bold text-2xl ">
                    {{ $income + $cash + $deposit + $paidCredit - $salereturn - $expense - $purchase }}
                </p>
                <div class="h-12 bg-yellow-400 w-12 rounded-full flex justify-center items-center ">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" stroke="#ffffff" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round"
                                d="M12 6v12m3-8.5C15 8.12 13.657 7 12 7S9 8.12 9 9.5s1.343 2.5 3 2.5s3 1.12 3 2.5s-1.343 2.5-3 2.5s-3-1.12-3-2.5" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <div class=" w-3/4 h-96 mt-6 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-start mb-5">
                <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $deposit }}MMK</h5>
                    {{-- <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p> --}}
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                    Deposit Sale 
                    {{-- <svg class="w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg> --}}
                </div>
            </div>
            <div id="tooltip-chart"></div>
        </div>

        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

            <div class="flex justify-between items-start w-full">
            </div>
            <!-- Line Chart -->
            <div class="py-6" id="pie-chart"></div>

            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            </div>
        </div>
    </div>

    <div class="mt-10">
        <p class=" font-semibold text-lg">Activital Log</p>
        <div class="p-5">
            <ul>
                @forelse ($audits as $audit)
                    <div>On {{ $audit->created_at }} {{ $audit->name }} is
                        {{ $audit->event }} old value {{ $audit->old_values }} to {{ $audit->new_values }}</div>
                    {{-- <li>
                        @lang('article.updated.metadata', $audit->getMetadata())

                        @foreach ($audit->getModified() as $attribute => $modified)
                            <ul>
                                <li>@lang('article.' . $audit->event . '.modified.' . $attribute, $modified)</li>
                            </ul>
                        @endforeach
                    </li> --}}
                @empty
                    <p>@lang('article.unavailable_audits')</p>
                @endforelse
            </ul>

        </div>
    </div>

    <script>
        var topProducts = @json($topProducts);
        var products = [];
        var quantity = [];
        // ApexCharts options and config
        for (var i = 0; i < topProducts.length; i++) {
            products.push(topProducts[i].product_name);
            quantity.push(parseFloat(topProducts[i].total_quantity));
        }
        window.addEventListener("load", function() {
            const getChartOptions = () => {
                return {
                    series: quantity,
                    colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                    chart: {
                        height: 420,
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -25
                            }
                        },
                    },
                    labels: products,
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value 
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value 
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                chart.render();
            }
        });
    </script>


    <script>
        // ApexCharts options and config
        window.addEventListener("load", function() {
            let options = {
                // set this option to enable the tooltip for the chart, learn more here: https://apexcharts.com/docs/tooltip/
                tooltip: {
                    enabled: true,
                    x: {
                        show: true,
                    },
                    y: {
                        show: true,
                    },
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -26
                    },
                },
                series: [{
                        name: "Developer Edition",
                        data: [1500, 1418, 1456, 1526, 1356, 1256],
                        color: "#1A56DB",
                    },
                    {
                        name: "Designer Edition",
                        data: [643, 413, 765, 412, 1423, 1731],
                        color: "#7E3BF2",
                    },
                ],
                chart: {
                    height: "100%",
                    maxWidth: "100%",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                legend: {
                    show: true
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                xaxis: {
                    categories: ['01 February', '02 February', '03 February', '04 February', '05 February',
                        '06 February', '07 February'
                    ],
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                    labels: {
                        formatter: function(value) {
                            return '$' + value;
                        }
                    }
                },
            }

            if (document.getElementById("tooltip-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("tooltip-chart"), options);
                chart.render();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection
