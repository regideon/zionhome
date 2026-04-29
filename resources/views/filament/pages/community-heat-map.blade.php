<x-filament-panels::page>

    <style>
        .heat-dot {
            position: absolute;
            width: 64px;
            height: 64px;
            border-radius: 100%;
            filter: blur(20px);
            opacity: 0.6;
        }
    </style>

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Community Heat Map</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">AI-powered view of community issues, risks, and positive feedback.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all text-sm font-medium">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Filters
                </button>
                <button class="bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:opacity-90 active:scale-[0.98] transition-all text-sm font-medium">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Export Report
                </button>
            </div>
        </div>

        {{-- KPI Row --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-red-50 dark:bg-red-900/20 text-red-600 rounded-lg">
                        <span class="material-symbols-outlined">emergency</span>
                    </div>
                    <span class="text-xs font-bold text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded">+2%</span>
                </div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Emergency Reports</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">04</h3>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-orange-50 dark:bg-orange-900/20 text-orange-600 rounded-lg">
                        <span class="material-symbols-outlined">priority_high</span>
                    </div>
                    <span class="text-xs font-bold text-orange-600 bg-orange-50 dark:bg-orange-900/20 px-2 py-1 rounded">-12%</span>
                </div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">High Priority</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">18</h3>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 rounded-lg">
                        <span class="material-symbols-outlined">forum</span>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/20 px-2 py-1 rounded">+5%</span>
                </div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Open Feedback</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">42</h3>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-green-50 dark:bg-green-900/20 text-green-600 rounded-lg">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded">24%</span>
                </div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Resolved This Week</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">126</h3>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 rounded-lg">
                        <span class="material-symbols-outlined">thumb_up</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded">+18%</span>
                </div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Positive Feedback</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">89</h3>
            </div>

        </div>

        {{-- Map + AI Insights --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

            {{-- Map --}}
            <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm flex flex-col">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Subdivision Hotspots</h4>
                    <div class="flex gap-4">
                        <div class="flex items-center gap-1.5 text-xs font-medium text-gray-500">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div> Emergency
                        </div>
                        <div class="flex items-center gap-1.5 text-xs font-medium text-gray-500">
                            <div class="w-3 h-3 rounded-full bg-orange-500"></div> Medium
                        </div>
                        <div class="flex items-center gap-1.5 text-xs font-medium text-gray-500">
                            <div class="w-3 h-3 rounded-full bg-blue-500"></div> Normal
                        </div>
                        <div class="flex items-center gap-1.5 text-xs font-medium text-gray-500">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div> Appreciation
                        </div>
                    </div>
                </div>
                <div class="flex-1 min-h-[480px] relative bg-slate-100 dark:bg-gray-900">
                    {{-- Google Map --}}
                    <div id="community-map" class="w-full min-h-[480px]"></div>

                    <script>
                        function initCommunityMap() {
                            const center = { lat: 14.565706078095253, lng: 121.11927115452661 };

                            const map = new google.maps.Map(document.getElementById('community-map'), {
                                center: center,
                                zoom: 17,
                                mapTypeId: 'roadmap',
                                disableDefaultUI: true,
                                zoomControl: true,
                                mapTypeControl: true,
                                fullscreenControl: true,
                            });

                            const hotspots = [
                                { lat: 14.5662,  lng: 121.1195, color: '#ef4444', radius: 60,  title: 'Emergency: Broken Gate Arm' },
                                { lat: 14.5658,  lng: 121.1198, color: '#f97316', radius: 50,  title: 'High: Noise Complaint' },
                                { lat: 14.5655,  lng: 121.1190, color: '#3b82f6', radius: 40,  title: 'Normal: Water Concern' },
                                { lat: 14.5660,  lng: 121.1185, color: '#22c55e', radius: 45,  title: 'Appreciation: Guard Santos' },
                                { lat: 14.5650,  lng: 121.1200, color: '#f97316', radius: 35,  title: 'Medium: Streetlight Out' },
                            ];

                            hotspots.forEach(({ lat, lng, color, radius, title }) => {
                                new google.maps.Circle({
                                    map,
                                    center: { lat, lng },
                                    radius,
                                    fillColor: color,
                                    fillOpacity: 0.45,
                                    strokeColor: color,
                                    strokeOpacity: 0.7,
                                    strokeWeight: 1.5,
                                    title,
                                });
                            });
                        }
                    </script>
                    <script
                        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&callback=initCommunityMap"
                        async defer>
                    </script>


                    {{-- <div class="w-full h-full min-h-[480px] bg-gradient-to-br from-slate-100 to-slate-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <span class="material-symbols-outlined" style="font-size: 64px; opacity: 0.3;">map</span>
                            <p class="text-sm mt-2 font-medium">Map integration area</p>
                        </div>
                    </div> --}}

                    {{-- Simulated Heatmap dots --}}
                    {{-- <div class="heat-dot bg-red-500 top-1/4 left-1/3 animate-pulse"></div>
                    <div class="heat-dot bg-red-500 top-[28%] left-[35%]"></div>
                    <div class="heat-dot bg-orange-500 bottom-1/4 right-1/4"></div>
                    <div class="heat-dot bg-orange-500 bottom-[22%] right-[26%]"></div>
                    <div class="heat-dot bg-blue-500 top-1/2 left-1/2"></div>
                    <div class="heat-dot bg-blue-500 top-[52%] left-[48%]"></div>
                    <div class="heat-dot bg-green-500 top-1/3 right-1/3"></div> --}}

                    {{-- Zoom Controls --}}
                    <div class="absolute bottom-6 left-6 flex flex-col gap-2">
                        <button class="bg-white dark:bg-gray-800 p-2 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 transition-colors">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-2 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 transition-colors">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                    </div>

                    {{-- View Toggle --}}
                    {{-- <div class="absolute top-4 right-4">
                        <button class="bg-white dark:bg-gray-800 px-3 py-2 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 flex items-center gap-2 text-xs font-bold hover:bg-gray-50 transition-colors text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-sm">layers</span> Satellite View
                        </button>
                    </div> --}}
                </div>
            </div>

            {{-- AI Insights --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm flex flex-col gap-5 h-full">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined">auto_awesome</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">AI Insights</h4>
                    </div>
                    <div class="space-y-3 flex-1">
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border-l-4 border-blue-500">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Water-related concerns increased in Phase 2 this week</p>
                            <p class="text-xs text-gray-500 mt-1 italic">Suggested: Schedule plumbing maintenance check.</p>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border-l-4 border-red-500">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Security reports are clustered near Gate 1</p>
                            <p class="text-xs text-gray-500 mt-1 italic">Suggested: Increase patrol frequency from 10 PM to 4 AM.</p>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border-l-4 border-emerald-500">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Positive feedback increased for guard assistance</p>
                            <p class="text-xs text-gray-500 mt-1 italic">Insight: Employee recognition program candidate.</p>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border-l-4 border-orange-500">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Street light complaints recurring in Fir Street</p>
                            <p class="text-xs text-gray-500 mt-1 italic">Suggested: Replace bulbs with LED higher-durability units.</p>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-lg text-sm font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        View All Predictions
                    </button>
                </div>
            </div>

        </div>

        {{-- Recent Community Feedback Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Community Feedback</h4>
                <div class="flex flex-wrap gap-2">
                    <select class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-xs font-medium px-3 py-2 outline-none focus:ring-2 focus:ring-blue-100 text-gray-600 dark:text-gray-300">
                        <option>All Types</option>
                        <option>Maintenance</option>
                        <option>Security</option>
                        <option>Appreciation</option>
                        <option>Sanitation</option>
                        <option>Billing</option>
                    </select>
                    <select class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-xs font-medium px-3 py-2 outline-none focus:ring-2 focus:ring-blue-100 text-gray-600 dark:text-gray-300">
                        <option>Priority: All</option>
                        <option>Emergency</option>
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>
                    </select>
                    <select class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-xs font-medium px-3 py-2 outline-none focus:ring-2 focus:ring-blue-100 text-gray-600 dark:text-gray-300">
                        <option>Phase: All</option>
                        <option>Phase 1</option>
                        <option>Phase 2</option>
                        <option>Phase 3</option>
                    </select>
                    <button class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <span class="material-symbols-outlined text-sm text-gray-500">calendar_today</span>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Feedback Title</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Assigned Team</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">SLA Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Broken Gate Arm</p>
                                <p class="text-xs text-gray-400">Resident: John Doe</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">Maintenance</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded-full">EMERGENCY</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Phase 1, Gate 1</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Rapid Response A</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-blue-700 bg-blue-50 dark:bg-blue-900/20 px-2 py-1 rounded-full">IN PROGRESS</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-emerald-600 font-medium">On Track (2h left)</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-blue-600 transition-all" title="View Details">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </button>
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-blue-600 transition-all" title="Assign">
                                        <span class="material-symbols-outlined text-lg">person_add</span>
                                    </button>
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-emerald-600 transition-all" title="Resolve">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Noise Complaint (Late Party)</p>
                                <p class="text-xs text-gray-400">Resident: Sarah Miller</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">Security</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-orange-600 bg-orange-50 dark:bg-orange-900/20 px-2 py-1 rounded-full">HIGH</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Phase 3, Block 12</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Night Patrol</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">PENDING</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-red-600 font-medium">Overdue (15m)</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-blue-600 transition-all" title="View Details">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </button>
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-red-600 transition-all" title="Escalate">
                                        <span class="material-symbols-outlined text-lg">priority_high</span>
                                    </button>
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-emerald-600 transition-all" title="Resolve">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Kudos to Guard Santos</p>
                                <p class="text-xs text-gray-400">Resident: Mike Wilson</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full">Appreciation</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/20 px-2 py-1 rounded-full">NORMAL</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Phase 2, Gate 2</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">HR Admin</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-emerald-700 bg-emerald-100 dark:bg-emerald-900/20 px-2 py-1 rounded-full">RESOLVED</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-emerald-600 font-medium">Completed</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-blue-600 transition-all" title="View Details">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </button>
                                    <button class="p-1 hover:bg-white dark:hover:bg-gray-700 rounded shadow-sm text-gray-400 hover:text-gray-600 transition-all" title="Archive">
                                        <span class="material-symbols-outlined text-lg">archive</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs text-gray-400 font-medium">
                <p>Showing 3 of 42 records</p>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded disabled:opacity-50 text-gray-500" disabled>Previous</button>
                    <button class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-gray-500">Next</button>
                </div>
            </div>
        </div>

    </div>

</x-filament-panels::page>
