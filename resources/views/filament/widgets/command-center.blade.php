<x-filament-widgets::widget>

    <div class="p-container-padding space-y-gutter-md" style="padding: 0 !important;">
        <!-- Welcome Header -->
        <section>
            <h1 class="font-h1 text-h1 text-slate-900 dark:text-slate-100">
                Good morning, {{ auth()->user()->name }}
            </h1>
            <p class="font-body-md text-body-md text-slate-500 dark:text-slate-400 mt-1">
                Here are the most important things that need your attention today.
            </p>
        </section>
        <!-- 1. Actionable Items Section (Bento Style) -->
        <section class="grid grid-cols-12 gap-card-gap">
            <!-- Payments to Verify -->
            <div class="col-span-12 lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg">
                            <span class="material-symbols-outlined text-[24px]" data-icon="payments" data-weight="fill">payments</span>
                        </div>
                        <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 font-micro-tag text-micro-tag px-2 py-1 rounded">
                            Kailangan ng Action
                        </span>
                    </div>
                    <h3 class="font-h3 text-h3 text-slate-900 dark:text-slate-100">Payments to Verify</h3>
                    <p class="text-4xl font-black text-slate-900 dark:text-slate-100 mt-2">12</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Pending verification (₱120,450.00)</p>
                </div>
                <button class="mt-6 w-full py-2 bg-slate-50 dark:bg-slate-700 text-blue-700 dark:text-blue-400 font-semibold text-sm rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors border border-blue-100 dark:border-blue-800">
                    Review Payments
                </button>
            </div>
            <!-- Urgent Concerns -->
            <div class="col-span-12 lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow border-l-4 border-l-error">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-red-50 dark:bg-red-900/30 text-error rounded-lg">
                            <span class="material-symbols-outlined text-[24px]" data-icon="report" data-weight="fill">report</span>
                        </div>
                        <span class="bg-error-container text-on-error-container font-micro-tag text-micro-tag px-2 py-1 rounded">
                            Urgent
                        </span>
                    </div>
                    <h3 class="font-h3 text-h3 text-slate-900 dark:text-slate-100">Urgent Concerns</h3>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                            Water leak at Block 4, Lot 12
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                            Main gate sensor malfunction
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                            Security breach report at Perimeter B
                        </li>
                    </ul>
                </div>
                <button class="mt-6 w-full py-2 bg-error text-white font-semibold text-sm rounded-lg hover:opacity-90 transition-opacity">
                    View Concerns
                </button>
            </div>
            <!-- Visitor Logs -->
            <div class="col-span-12 lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-tertiary-fixed dark:bg-tertiary-container/30 text-tertiary rounded-lg">
                            <span class="material-symbols-outlined text-[24px]" data-icon="person_search" data-weight="fill">person_search</span>
                        </div>
                        <span class="bg-tertiary-fixed dark:bg-tertiary-container/30 text-tertiary font-micro-tag text-micro-tag px-2 py-1 rounded">
                            Pending Approval
                        </span>
                    </div>
                    <h3 class="font-h3 text-h3 text-slate-900 dark:text-slate-100">Visitor Logs</h3>
                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-500 dark:text-slate-400">JC</div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Juan Dela Cruz</p>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400">Block 2, Lot 5</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500">10m ago</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-500 dark:text-slate-400">MR</div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Maria Reyes</p>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400">Block 8, Lot 1</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500">22m ago</span>
                        </div>
                    </div>
                </div>
                <button class="mt-6 w-full py-2 bg-slate-900 dark:bg-slate-700 text-white font-semibold text-sm rounded-lg hover:bg-slate-800 dark:hover:bg-slate-600 transition-colors">
                    Approve Visitors (5)
                </button>
            </div>
            <!-- Move-in/out -->
            <div class="col-span-12 lg:col-span-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-secondary-fixed dark:bg-secondary-container/30 text-secondary rounded-xl">
                        <span class="material-symbols-outlined text-[24px]" data-icon="local_shipping">local_shipping</span>
                    </div>
                    <div>
                        <span class="bg-secondary-container dark:bg-secondary-container/30 text-on-secondary-fixed-variant font-micro-tag text-micro-tag px-2 py-0.5 rounded">Today</span>
                        <h3 class="font-h3 text-h3 text-slate-900 dark:text-slate-100 mt-1">Move-in/out Requests</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">2 requests pending clearance verification</p>
                    </div>
                </div>
                <button class="px-6 py-2 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold text-sm rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Review Requests
                </button>
            </div>
            <!-- Document Requests -->
            <div class="col-span-12 lg:col-span-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/30 text-primary rounded-xl">
                        <span class="material-symbols-outlined text-[24px]" data-icon="description">description</span>
                    </div>
                    <div>
                        <span class="bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 font-micro-tag text-micro-tag px-2 py-0.5 rounded">Pending</span>
                        <h3 class="font-h3 text-h3 text-slate-900 dark:text-slate-100 mt-1">Document Requests</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">4 homeowners requested clearances</p>
                    </div>
                </div>
                <button class="px-6 py-2 bg-primary-container text-white font-semibold text-sm rounded-lg hover:opacity-90 transition-opacity">
                    Process Documents
                </button>
            </div>
        </section>
        <!-- 2. Full Financial View Section -->
        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="font-h2 text-h2 text-slate-900 dark:text-slate-100">Financial Overview</h2>
                <div class="flex gap-2">
                    <button class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined text-sm" data-icon="file_download">file_download</span>
                        Export Report
                    </button>
                    <button class="px-4 py-2 bg-primary-container text-white text-sm font-semibold rounded-lg shadow-sm">
                        Verify Payments
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-card-gap">
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Collections</p>
                    <div class="flex items-end gap-2 mt-2">
                        <h4 class="text-2xl font-black text-slate-900 dark:text-slate-100 leading-none">₱850,000</h4>
                        <span class="text-xs font-bold text-emerald-600 mb-1 flex items-center">
                            <span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span>12%
                        </span>
                    </div>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-medium">Month-to-date performance</p>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pending Verification</p>
                    <div class="flex items-end gap-2 mt-2">
                        <h4 class="text-2xl font-black text-slate-900 dark:text-slate-100 leading-none">₱120,000</h4>
                        <span class="text-xs font-bold text-amber-500 mb-1">8 receipts</span>
                    </div>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-medium">Requires immediate audit</p>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Overdue Dues</p>
                    <div class="flex items-end gap-2 mt-2">
                        <h4 class="text-2xl font-black text-error leading-none">₱240,000</h4>
                        <span class="text-xs font-bold text-error mb-1">15 units</span>
                    </div>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-medium">Past 30-day grace period</p>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Collection Rate</p>
                    <div class="flex items-end gap-2 mt-2">
                        <h4 class="text-2xl font-black text-slate-900 dark:text-slate-100 leading-none">82%</h4>
                        <div class="w-full bg-slate-100 dark:bg-slate-700 h-1.5 rounded-full mb-1 flex-1">
                            <div class="bg-blue-600 h-full rounded-full" style="width: 82%"></div>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-medium">Target: 95% by month end</p>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-card-gap">
                <!-- Charts -->
                <div class="col-span-12 lg:col-span-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h4 class="font-bold text-slate-900 dark:text-slate-100">Monthly Revenue Trend</h4>
                        <select class="text-xs font-semibold border-slate-200 dark:border-slate-600 rounded-md bg-white dark:bg-slate-700 dark:text-slate-200">
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                        </select>
                    </div>
                    <div class="h-64 flex items-end justify-between px-2 gap-4">
                        <div class="relative h-full w-full flex flex-col">
                            <div class="relative flex-1">
                                <div class="absolute inset-0 flex flex-col justify-between py-2">
                                    <div class="border-b border-slate-100 dark:border-slate-700 w-full"></div>
                                    <div class="border-b border-slate-100 dark:border-slate-700 w-full"></div>
                                    <div class="border-b border-slate-100 dark:border-slate-700 w-full"></div>
                                    <div class="border-b border-slate-100 dark:border-slate-700 w-full"></div>
                                </div>
                                <svg class="absolute inset-0 h-full w-full overflow-visible" preserveaspectratio="none" viewbox="0 0 600 200">
                                    <defs>
                                        <lineargradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                                            <stop offset="0%" stop-color="#004ac6" stop-opacity="0.15"></stop>
                                            <stop offset="100%" stop-color="#004ac6" stop-opacity="0"></stop>
                                        </lineargradient>
                                    </defs>
                                    <path d="M0 160 L120 130 L240 140 L360 80 L480 40 L600 100 V200 H0 Z" fill="url(#chartGradient)"></path>
                                    <path d="M0 160 L120 130 L240 140 L360 80 L480 40 L600 100" fill="none" stroke="#004ac6" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                    <circle cx="0" cy="160" fill="white" r="4" stroke="#004ac6" stroke-width="2"></circle>
                                    <circle cx="120" cy="130" fill="white" r="4" stroke="#004ac6" stroke-width="2"></circle>
                                    <circle cx="240" cy="140" fill="white" r="4" stroke="#004ac6" stroke-width="2"></circle>
                                    <circle cx="360" cy="80" fill="white" r="4" stroke="#004ac6" stroke-width="2"></circle>
                                    <circle cx="480" cy="40" fill="white" r="4" stroke="#004ac6" stroke-width="2"></circle>
                                    <circle cx="600" cy="100" fill="white" r="4" stroke="#004ac6" stroke-width="2"></circle>
                                </svg>
                            </div>
                            <div class="flex justify-between mt-4 px-1">
                                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 w-10 text-center">JAN</span>
                                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 w-10 text-center">FEB</span>
                                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 w-10 text-center">MAR</span>
                                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 w-10 text-center">APR</span>
                                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 w-10 text-center">MAY</span>
                                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 w-10 text-center">JUN</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-span-12 lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                    <h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6">Paid vs Unpaid Dues</h4>
                    <div class="relative w-48 h-48 mx-auto flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full border-[16px] border-slate-100 dark:border-slate-700"></div>
                        <div class="absolute inset-0 rounded-full border-[16px] border-blue-600" style="clip-path: polygon(50% 50%, 50% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 50%);"></div>
                        <div class="text-center">
                            <p class="text-3xl font-black text-slate-900 dark:text-slate-100 leading-none">82%</p>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase mt-1">Collected</p>
                        </div>
                    </div>
                    <div class="mt-8 space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                <span class="text-slate-600 dark:text-slate-400 font-medium">Fully Paid</span>
                            </div>
                            <span class="font-bold text-slate-900 dark:text-slate-100">410 Units</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-slate-200 dark:bg-slate-600"></span>
                                <span class="text-slate-600 dark:text-slate-400 font-medium">Outstanding</span>
                            </div>
                            <span class="font-bold text-slate-900 dark:text-slate-100">90 Units</span>
                        </div>
                    </div>
                </div>
                <!-- Aging Table -->
                <div class="col-span-12 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-700/50 flex justify-between items-center">
                        <h4 class="font-bold text-slate-900 dark:text-slate-100">HOA Dues Aging Table</h4>
                        <button class="text-xs font-bold text-primary hover:underline">View All Billing</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50/50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-bold uppercase text-[11px] tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Resident Name</th>
                                    <th class="px-6 py-4">Unit / Lot</th>
                                    <th class="px-6 py-4">Outstanding Balance</th>
                                    <th class="px-6 py-4">Last Payment</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900 dark:text-slate-100">Ricardo Dalisay</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">B2 L45</td>
                                    <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">₱4,500.00</td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Oct 12, 2023</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Current</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-lg" data-icon="more_vert">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900 dark:text-slate-100">Angel Locsin</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">B5 L12</td>
                                    <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">₱12,800.00</td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Aug 05, 2023</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Overdue</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-lg" data-icon="more_vert">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900 dark:text-slate-100">Dingdong Dantes</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">B1 L03</td>
                                    <td class="px-6 py-4 font-bold text-error">₱28,400.00</td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">May 22, 2023</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-error-container text-on-error-container text-[10px] font-bold px-2 py-0.5 rounded uppercase">Critical</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-lg" data-icon="more_vert">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- 3. Other Operations Section -->
        <section class="space-y-4 pb-12">
            <h2 class="font-h2 text-h2 text-slate-900 dark:text-slate-100">Operational Summary</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-card-gap">
                <!-- Announcements -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600" data-icon="campaign">campaign</span>
                            Recent Announcements
                        </h4>
                        <button class="text-[11px] font-bold text-primary uppercase">New Post</button>
                    </div>
                    <div class="space-y-4">
                        <div class="p-3 bg-slate-50 dark:bg-slate-700 rounded-lg">
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Water Supply Interruption</p>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Temporary water cutoff on Blocks 1 to 5 starting 10:00 PM...</p>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-medium">Posted 2 hours ago</p>
                        </div>
                        <div class="p-3 bg-slate-50 dark:bg-slate-700 rounded-lg opacity-60">
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100">General Assembly Reminder</p>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Reminder for the upcoming homeowners meeting this Sunday...</p>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-medium">Posted yesterday</p>
                        </div>
                    </div>
                </div>
                <!-- Maintenance Summary -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                    <h4 class="font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-amber-600" data-icon="construction">construction</span>
                        Maintenance Summary
                    </h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 border border-slate-100 dark:border-slate-700 rounded-lg text-center">
                            <p class="text-lg font-black text-slate-900 dark:text-slate-100">18</p>
                            <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase">Active Tasks</p>
                        </div>
                        <div class="p-3 border border-slate-100 dark:border-slate-700 rounded-lg text-center">
                            <p class="text-lg font-black text-emerald-600">142</p>
                            <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase">Resolved (30d)</p>
                        </div>
                    </div>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-500 dark:text-slate-400">Streetlight Repairs</span>
                            <span class="font-bold text-amber-600">In Progress</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-500 dark:text-slate-400">Swimming Pool Cleaning</span>
                            <span class="font-bold text-slate-400 dark:text-slate-500">Scheduled</span>
                        </div>
                    </div>
                </div>
                <!-- Occupancy & Events Combined -->
                <div class="space-y-card-gap">
                    <div class="bg-slate-900 text-white rounded-xl p-5 shadow-sm overflow-hidden relative">
                        <div class="relative z-10">
                            <h4 class="font-bold text-white/70 text-xs uppercase tracking-wider">Property Occupancy</h4>
                            <div class="flex items-center gap-6 mt-4">
                                <div>
                                    <p class="text-2xl font-black">412</p>
                                    <p class="text-[10px] text-white/50 font-bold uppercase">Owners</p>
                                </div>
                                <div class="h-8 w-[1px] bg-white/10"></div>
                                <div>
                                    <p class="text-2xl font-black">68</p>
                                    <p class="text-[10px] text-white/50 font-bold uppercase">Tenants</p>
                                </div>
                                <div class="h-8 w-[1px] bg-white/10"></div>
                                <div>
                                    <p class="text-2xl font-black text-amber-400">20</p>
                                    <p class="text-[10px] text-white/50 font-bold uppercase">Vacant</p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -right-4 -bottom-4 opacity-10">
                            <span class="material-symbols-outlined text-[120px]" data-icon="home">home</span>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                        <h4 class="font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-primary" data-icon="event">event</span>
                            Upcoming Events
                        </h4>
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 p-2 rounded flex flex-col items-center min-w-[48px]">
                                <span class="text-xs font-black leading-none">28</span>
                                <span class="text-[10px] font-bold uppercase">OCT</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-slate-100">Halloween Trick or Treat</p>
                                <p class="text-[10px] text-slate-500 dark:text-slate-400">Clubhouse Ground • 4:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-filament-widgets::widget>
