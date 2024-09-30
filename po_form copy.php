<?php
session_start();
// Include database connection and query functions
include './database.php';
include './Query/allpo_query.php';

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Get the MGR_CODE from the session
$user_code = $_SESSION['user']['OFFIER_ID'];

// Retrieve the officer's name from the session
$officerName = isset($_SESSION['user']['OFFICER_NAME']) ? $_SESSION['user']['OFFICER_NAME'] : 'Default Name';

?>

<!-- component -->
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">

</head>


<body>
    <?php include './navbar.php'; ?>
    <div class="px-6 py-24 bg-white isolate sm:py-32 lg:px-8">

        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Purchase Order </h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Creation of a new purchase order
        </div>



        <form action="#" method="POST" class="max-w-xl mx-auto mt-16 sm:mt-20">


            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

                <!-- NIC Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">NIC</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <!-- topic -->
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-purple-900 sm:text-1xl">Client Details </h2>
                    <br>
                    <!-- Title Field -->
                    <div>
                        <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Title</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Client Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Client Name</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 1 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Address 1</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 2 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Address 2</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 3 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Address 3</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 4 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Address 4</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Occupation Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Occupation</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Income Type Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Income Type</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Date of Birth Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Date of Birth</label>
                        <div class="mt-2.5">
                            <input type="date" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>


                    <!-- Phone No Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Phone No</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Remarks Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Remarks</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
                <br>


                <!-- topic -->
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-purple-900 sm:text-1xl">Facility Details </h2>
                    <br>
                    <!-- Title Field -->
                    <div>
                        <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Product</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Client Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Invoice Amount</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 1 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Downpayment</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 2 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Leasing Amount</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 3 Name Field -->
                    <div>
                        <label for="VAT" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Exposure</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Address 4 Name Field -->
                    <div>
                        <label for="Rate" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Rate</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="Rate"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Occupation Name Field -->
                    <div>
                        <label for="Tenure" class="mt-2.5 block text-sm font-semibold leading-6 text-black">Tenure</label>
                        <div class="mt-2.5">
                            <input type="text" name="vat" id="VAT" autocomplete="VAT"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>


                </div>
                <br>

                <!-- topic -->
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-purple-900 sm:text-1xl">Charges Details </h2>
                    <!-- <p class="mt-2 text-lg leading-8 text-gray-600">Creation of a new purchase order</p> -->
                </div>
                <br>

                <!-- Introducer Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Introducer</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- Services Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Services</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- RMV Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">RMV</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- Insurance Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Insurance</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- Transport Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Transport</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- Other Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Other</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- Stamp Duty Field with Toggle -->
                <div>
                    <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Stamp Duty</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="mt-10 ml-14">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-purple-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="text-sm font-medium text-black-900 ms-3 dark:text-black-300">CAP</span>
                        </label>
                    </div>
                </div>

                <!-- Other fields -->
                <div class="sm:col-span-2">
                    <label for="SSCLTax" class="block text-sm font-semibold leading-6 text-black">SSCL Tax</label>
                    <div class="mt-2.5">
                        <input type="text" name="sscl-tax" id="SSCLTax" autocomplete="SSCLTax"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for=" VAT" class="block text-sm font-semibold leading-6 text-black">VAT</label>
                    <div class="mt-2.5">
                        <input type="text" name="vat" id="VAT" autocomplete="VAT"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for=" TotalTax" class="block text-sm font-semibold leading-6 text-black">Total Tax</label>
                    <div class="mt-2.5">
                        <input type="text" name="total-tax" id="TotalTax" autocomplete="TotalTax"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <br>
            </div>

            <div class="max-w-2xl mx-auto text-left">
                <h2 class="text-2xl font-bold tracking-tight text-purple-900 sm:text-1xl">Facility Details</h2>
                <br>
                <!-- <p class="mt-2 text-lg leading-8 text-gray-600">Creation of a new purchase order</p> -->
            </div>
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

                <!-- Facility Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Facility Amount</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Upfront Amount</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Capitalize Amount</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>




                <div class="sm:col-span-2">
                    <label for=" TotalTax" class="block text-sm font-semibold leading-6 text-black">Monthly Rental</label>
                    <div class="mt-2.5">
                        <input type="text" name="total-tax" id="TotalTax" autocomplete="TotalTax"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>

                </div>


                <!-- topic -->
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-purple-900 sm:text-1xl">Asset Details </h2>
                    <!-- <p class="mt-2 text-lg leading-8 text-gray-600">Creation of a new purchase order</p> -->
                </div>
                <br>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Asset Category</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Asset Type</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Make</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Model</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Year</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>


                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Max. Val Amount</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Max. Period</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Max. Rate</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Upfront Amount Field -->
                <div class="sm:col-span-2">
                    <label for="nic" class="block text-sm font-semibold leading-6 text-black">Registration No.</label>
                    <div class="mt-2.5">
                        <input type="text" name="nic" id="nic" autocomplete="nic"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Buttons Field with Toggle -->
                <div class="grid mx-8 grid-row-2 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <!-- <label for="VAT" class="block text-sm font-semibold leading-6 text-black">Other</label> -->
                        <div class="items-center bg-purple-700 rounded-md mx-30 align-center mt-2.5">
                            <button type="submit"
                                class="block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm">
                                Re-Finance Check
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="items-center bg-purple-700 rounded-md mx-30 align-center mt-2.5">
                            <button type="submit"
                                class="block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm">
                                Supply Pay. Check
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="sm:col-span-2">
                <label for=" TotalTax" class="block text-sm font-semibold leading-6 text-black">Monthly Rental</label>
                <div class="mt-2.5">
                    <input type="text" name="total-tax" id="TotalTax" autocomplete="TotalTax"
                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                </div>

                <div class="items-center mt-10 bg-purple-700 rounded-md mx-30 align-center">
                    <button type="submit"
                        class="block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm">
                        NEXT
                    </button>
                </div>
            </div>

    </div>




    </form>

    </div>

</body>

</html>