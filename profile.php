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
$officerName = isset($_SESSION['user']['OFFICER_NAME']) ? $_SESSION['user']['OFFICER_NAME'] : 'Default User';
$branchCode = isset($_SESSION['user']['BRANCH_CODE']) ? $_SESSION['user']['BRANCH_CODE'] : 'DefaultBranch';

?>

<!-- component -->
<style>
    :root {
        --main-color: #4a76a8;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
</style>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



<div class="bg-gray-100">
    <!-- component -->
    <?php
    include "./navbar.php";
    ?>

    <div class="container p-5 mx-auto my-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="p-3 bg-white border-t-4 border-green-400">
                    <div class="overflow-hidden image">
                        <img class="w-full h-auto mx-auto"
                            src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                            alt="">
                    </div>
                    <h1 class="my-1 text-xl font-bold leading-8 text-gray-900">Jane Doe</h1>
                    <h3 class="leading-6 text-gray-600 font-lg text-semibold">Owner at Her Company Inc.</h3>
                    <p class="text-sm leading-6 text-gray-500 hover:text-gray-600">Lorem ipsum dolor sit amet
                        consectetur adipisicing elit.
                        Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p>
                    <ul
                        class="px-3 py-2 mt-3 text-gray-600 bg-gray-100 divide-y rounded shadow-sm hover:text-gray-700 hover:shadow">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="px-2 py-1 text-sm text-white bg-green-500 rounded">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto">Nov 07, 2016</span>
                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
                <!-- Friends card -->
                <!-- <div class="p-3 bg-white hover:shadow">
                    <div class="flex items-center space-x-3 text-xl font-semibold leading-8 text-gray-900">
                        <span class="text-green-500">
                            <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span>Similar Profiles</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="my-2 text-center">
                            <img class="w-16 h-16 mx-auto rounded-full"
                                src="https://cdn.australianageingagenda.com.au/wp-content/uploads/2015/06/28085920/Phil-Beckett-2-e1435107243361.jpg"
                                alt="">
                            <a href="#" class="text-main-color">Kojstantin</a>
                        </div>
                        <div class="my-2 text-center">
                            <img class="w-16 h-16 mx-auto rounded-full"
                                src="https://avatars2.githubusercontent.com/u/24622175?s=60&amp;v=4"
                                alt="">
                            <a href="#" class="text-main-color">James</a>
                        </div>
                        <div class="my-2 text-center">
                            <img class="w-16 h-16 mx-auto rounded-full"
                                src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                alt="">
                            <a href="#" class="text-main-color">Natie</a>
                        </div>
                        <div class="my-2 text-center">
                            <img class="w-16 h-16 mx-auto rounded-full"
                                src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                alt="">
                            <a href="#" class="text-main-color">Casey</a>
                        </div>
                    </div>
                </div> -->
                <!-- End of friends card -->
            </div>
            <!-- Right Side -->
            <div class="w-full h-64 mx-2 md:w-9/12">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="p-3 bg-white rounded-sm shadow-sm">
                    <div class="flex items-center space-x-2 font-semibold leading-8 text-gray-900">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid text-sm md:grid-cols-2">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">First Name</div>
                                <div class="px-4 py-2">Jane</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                <div class="px-4 py-2">Doe</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Gender</div>
                                <div class="px-4 py-2">Female</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Contact No.</div>
                                <div class="px-4 py-2">+11 998001001</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Current Address</div>
                                <div class="px-4 py-2">Beech Creek, PA, Pennsylvania</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Permanant Address</div>
                                <div class="px-4 py-2">Arlington Heights, IL, Illinois</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email.</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-800" href="mailto:jane@example.com">jane@example.com</a>
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Birthday</div>
                                <div class="px-4 py-2">Feb 06, 1998</div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="block w-full p-3 my-4 text-sm font-semibold text-blue-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs">Show
                        Full Information</button>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>

                <!-- Experience and education -->
                <div class="p-3 bg-white rounded-sm shadow-sm">

                    <div class="grid grid-cols-2">
                        <div>
                            <div class="flex items-center mb-3 space-x-2 font-semibold leading-8 text-gray-900">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Experience</span>
                            </div>
                            <ul class="space-y-2 list-inside">
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-xs text-gray-500">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-xs text-gray-500">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-xs text-gray-500">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-xs text-gray-500">March 2020 - Now</div>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="flex items-center mb-3 space-x-2 font-semibold leading-8 text-gray-900">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path fill="#fff"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Education</span>
                            </div>
                            <ul class="space-y-2 list-inside">
                                <li>
                                    <div class="text-teal-600">Masters Degree in Oxford</div>
                                    <div class="text-xs text-gray-500">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Bachelors Degreen in LPU</div>
                                    <div class="text-xs text-gray-500">March 2020 - Now</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
</div>