<x-admin-layout>
    <!-- Wrap in Alpine to handle the modal state -->
    <div class="py-8 bg-[#fcfbf7] min-h-screen" x-data="meetingModal()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Area -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="font-serif-custom text-2xl text-navy">Manage Estates & Meetings</h2>
                    <p class="text-sm text-gray-500 mt-1">Add, edit, or remove estates from the public list.</p>
                </div>
                <!-- Trigger Create Modal -->
                <button @click="openCreateModal()" class="bg-navy text-white px-5 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Estate
                </button>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Message -->
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 shadow-sm">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 sm:p-6">

                <!-- Grid Header (Hidden on Mobile) -->
                <div class="hidden md:grid grid-cols-5 border-b-[3px] border-[#b8935a] mb-2">
                    <div class="px-3 py-3">
                        <span class="text-sm font-bold text-gray-800">Estate / matter</span>
                    </div>
                    <div class="px-3 py-3">
                        <span class="text-sm font-bold text-gray-800">Reference</span>
                    </div>
                    <div class="px-3 py-3">
                        <span class="text-sm font-bold text-gray-800">Status</span>
                    </div>
                    <div class="px-3 py-3">
                        <span class="text-sm font-bold text-gray-800">Next action</span>
                    </div>
                    <div class="px-3 py-3 text-right">
                        <span class="text-sm font-bold text-gray-800">Actions</span>
                    </div>
                </div>

                <!-- Data Rows -->
                <div class="divide-y divide-gray-200">
                    @forelse($meetings as $meeting)
                    <div class="grid grid-cols-1 md:grid-cols-5 items-center hover:bg-gray-50 transition duration-150 ease-in-out py-4 md:py-0 group">

                        <!-- Estate / Matter -->
                        <div class="px-3 py-2 md:py-4 flex flex-col md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Estate / matter</span>
                            <span class="text-sm md:text-base text-gray-800 font-medium leading-relaxed">{{ $meeting->estate_matter }}</span>
                        </div>

                        <!-- Reference -->
                        <div class="px-3 py-2 md:py-4 flex justify-between md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Reference</span>
                            <span class="text-sm md:text-base text-gray-800">{{ $meeting->reference }}</span>
                        </div>

                        <!-- Status / Date -->
                        <div class="px-3 py-2 md:py-4 flex justify-between md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Status</span>
                            <div class="flex flex-col items-end md:items-start gap-2">
                                @if($meeting->view_status)
                                <span class="inline-block bg-[#efe8d5] text-[#8c7a5b] px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap">Visible</span>
                                @else
                                <span class="inline-block bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap">Archived</span>
                                @endif
                                <span class="text-xs text-gray-500 whitespace-nowrap">
                                    {{ $meeting->expiry_date ? \Carbon\Carbon::parse($meeting->expiry_date)->format('d M Y') : 'No date' }}
                                </span>
                            </div>
                        </div>

                        <!-- Next Action & Venue -->
                        <div class="px-3 py-2 md:py-4 flex justify-between md:block gap-4">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider mt-0.5">Next action</span>
                            <div class="text-right md:text-left">
                                <span class="block text-sm md:text-base text-gray-800 leading-relaxed">{{ $meeting->next_action }}</span>
                                <span class="block text-xs text-gray-500 mt-1">{{ Str::limit($meeting->date_and_venue, 30) }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-3 py-3 md:py-4 flex justify-end gap-3 mt-2 md:mt-0 border-t border-gray-100 md:border-0">
                            
                            <!-- Document View Link (If exists) -->
                            @if($meeting->document_path)
                            <a href="{{ asset('storage/' . $meeting->document_path) }}" target="_blank" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition flex items-center gap-1" title="View Document">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                File
                            </a>
                            @endif

                            <!-- Edit Trigger -->
                            <button @click="openEditModal({{ $meeting }})" class="text-sm font-medium text-[#b8935a] hover:text-navy transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.meetings.destroy', $meeting) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this estate?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                    @empty
                    <div class="py-12 text-center text-gray-500 italic">
                        No estates found. Click "Add New Estate" to get started.
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($meetings->hasPages())
                <div class="mt-6 pt-6 border-t border-gray-200">
                    {{ $meetings->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- ========================================== -->
        <!-- THE MODAL -->
        <!-- ========================================== -->
        <div x-show="isOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Backdrop -->
            <div x-show="isOpen" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity" @click="isOpen = false"></div>

            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="isOpen" x-transition class="relative transform overflow-hidden bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-3xl rounded-lg">

                    <!-- Header -->
                    <div class="bg-navy px-6 py-4 border-b-2 border-gold flex justify-between items-center">
                        <h3 class="text-xl font-serif-custom text-gold" x-text="isEditMode ? 'Edit Estate' : 'Add New Estate'"></h3>
                        <button @click="isOpen = false" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form :action="isEditMode ? '/admin/meetings/' + formData.id : '/admin/meetings'" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                        @csrf
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Estate / Matter Name <span class="text-red-500">*</span></label>
                                <input type="text" name="estate_matter" x-model="formData.estate_matter" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reference <span class="text-red-500">*</span></label>
                                <input type="text" name="reference" x-model="formData.reference" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Status <span class="text-red-500">*</span></label>
                                <input type="text" name="status" x-model="formData.status" required placeholder="e.g. Liquidation & distribution" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Next Action <span class="text-red-500">*</span></label>
                                <input type="text" name="next_action" x-model="formData.next_action" required placeholder="e.g. First meeting of creditors" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date & Venue Details</label>
                            <input type="text" name="date_and_venue" x-model="formData.date_and_venue" placeholder="e.g. 14 Oct 2026, Master's Office, Windhoek" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Meeting Date (Sorting)</label>
                                <input type="date" name="expiry_date" x-model="formData.expiry_date" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                                <p class="text-xs text-gray-500 mt-1">Used for sorting and dashboard metrics.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Document (PDF/Word)</label>
                                <input type="file" name="document" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2 border bg-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-navy file:text-white hover:file:bg-gray-800">
                                <p class="text-xs text-gray-500 mt-1">Max 10MB. Allowed: PDF, DOC, DOCX.</p>
                                
                                <!-- Show current document if editing -->
                                <template x-if="isEditMode && formData.document_path">
                                    <div class="mt-2 text-sm text-gray-600 flex items-center gap-2">
                                        <span>Current file uploaded.</span>
                                        <a :href="'/storage/' + formData.document_path" target="_blank" class="text-[#b8935a] hover:underline font-medium">View File</a>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Visibility Toggle -->
                        <div class="flex items-center gap-3 bg-gray-50 p-3 border border-gray-200 rounded-sm">
                            <input type="hidden" name="view_status" value="1">
                            <input type="checkbox" name="view_status" id="view_status" value="0" x-model="formData.archive" class="rounded border-gray-300 text-navy focus:ring-[#b8935a] w-5 h-5">
                            <label for="view_status" class="text-sm font-medium text-gray-700 cursor-pointer">Archive this meeting (Hide from public site)</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="isOpen = false" class="bg-white text-navy border border-navy px-5 py-2 text-sm font-medium rounded-sm hover:bg-gray-50 transition">Cancel</button>
                            <button type="submit" class="bg-navy text-white px-5 py-2 text-sm font-medium rounded-sm hover:bg-gray-800 transition shadow-sm" x-text="isEditMode ? 'Update Estate' : 'Save Estate'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine Logic -->
    <script>
        function meetingModal() {
            return {
                isOpen: false,
                isEditMode: false,
                formData: {
                    id: null,
                    estate_matter: '',
                    reference: '',
                    status: '',
                    next_action: '',
                    date_and_venue: '',
                    expiry_date: '',
                    document_path: '',
                    archive: false,
                },
                openCreateModal() {
                    this.isEditMode = false;
                    this.formData = {
                        id: null,
                        estate_matter: '',
                        reference: '',
                        status: '',
                        next_action: '',
                        date_and_venue: '',
                        expiry_date: '',
                        document_path: '',
                        archive: false
                    };
                    this.isOpen = true;
                },
                openEditModal(meeting) {
                    this.isEditMode = true;

                    // Format expiry_date for the HTML5 date input (YYYY-MM-DD)
                    let formattedDate = '';
                    if (meeting.expiry_date) {
                        // Handle both ISO strings and basic dates
                        formattedDate = meeting.expiry_date.split('T')[0];
                    }

                    this.formData = {
                        id: meeting.id,
                        estate_matter: meeting.estate_matter,
                        reference: meeting.reference,
                        status: meeting.status,
                        next_action: meeting.next_action,
                        date_and_venue: meeting.date_and_venue,
                        expiry_date: formattedDate,
                        document_path: meeting.document_path,
                        archive: meeting.view_status == 0 // If view_status is 0, it's archived
                    };
                    this.isOpen = true;
                }
            }
        }
    </script>
</x-admin-layout>