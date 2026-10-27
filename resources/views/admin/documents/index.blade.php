<x-admin-layout>
    <!-- Wrap in Alpine to handle the modal state -->
    <div class="py-8 bg-[#fcfbf7] min-h-screen" x-data="documentModal()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Area -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="font-serif-custom text-2xl text-navy">Manage Estate Documents</h2>
                    <p class="text-sm text-gray-500 mt-1">Upload and manage PDF documents linked to specific estate matters.</p>
                </div>
                <!-- Trigger Create Modal -->
                <button @click="openCreateModal()" class="bg-navy text-white px-5 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Upload Document
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
                <div class="hidden md:grid grid-cols-12 border-b-[3px] border-[#b8935a] mb-2">
                    <div class="px-3 py-3 col-span-5">
                        <span class="text-sm font-bold text-gray-800">Document Details</span>
                    </div>
                    <div class="px-3 py-3 col-span-3">
                        <span class="text-sm font-bold text-gray-800">Estate Matter</span>
                    </div>
                    <div class="px-3 py-3 col-span-2">
                        <span class="text-sm font-bold text-gray-800">Visibility</span>
                    </div>
                    <div class="px-3 py-3 col-span-2 text-right">
                        <span class="text-sm font-bold text-gray-800">Actions</span>
                    </div>
                </div>

                <!-- Data Rows -->
                <div class="divide-y divide-gray-200">
                    @forelse($documents as $doc)
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center hover:bg-gray-50 transition duration-150 ease-in-out py-4 md:py-0 group">

                        <!-- Document Details -->
                        <div class="px-3 py-2 md:py-4 col-span-5 flex items-start gap-4">
                            <div class="shrink-0 w-10 h-10 bg-red-50 text-red-600 rounded flex items-center justify-center border border-red-100 mt-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-navy">{{ $doc->title ?? $doc->document_type }}</span>
                                <span class="block text-xs text-gray-500 mt-0.5">{{ $doc->filename }}</span>
                                <span class="inline-block mt-2 bg-[#efe8d5] text-[#8c7a5b] px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider">{{ $doc->document_type }}</span>
                            </div>
                        </div>

                        <!-- Estate Matter -->
                        <div class="px-3 py-2 md:py-4 col-span-3 flex justify-between md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Estate</span>
                            <div class="text-right md:text-left">
                                @if($doc->estateMatter)
                                    <span class="block text-sm font-medium text-gray-800">{{ $doc->estateMatter->estate_matter }}</span>
                                    <span class="block text-xs text-gray-500">{{ $doc->estateMatter->reference }}</span>
                                @else
                                    <span class="text-xs text-gray-400 italic">Not linked</span>
                                @endif
                            </div>
                        </div>

                        <!-- Visibility Status -->
                        <div class="px-3 py-2 md:py-4 col-span-2 flex justify-between md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Visibility</span>
                            <div class="text-right md:text-left">
                                @if($doc->is_public)
                                <span class="inline-block bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold whitespace-nowrap">Public</span>
                                @else
                                <span class="inline-block bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs font-semibold whitespace-nowrap">Private</span>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-3 py-3 md:py-4 col-span-2 flex justify-end gap-3 mt-2 md:mt-0 border-t border-gray-100 md:border-0">
                            
                            <!-- View File Link -->
                            <a href="{{ asset('storage/documents/' . $doc->asset_id . '.pdf') }}" target="_blank" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition flex items-center gap-1" title="View Document">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>

                            <!-- Edit Trigger -->
                            <button @click="openEditModal({{ $doc }})" class="text-sm font-medium text-[#b8935a] hover:text-navy transition flex items-center gap-1" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this document permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition flex items-center gap-1" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>
                    @empty
                    <div class="py-12 text-center text-gray-500 italic">
                        No documents uploaded yet. Click "Upload Document" to get started.
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($documents->hasPages())
                <div class="mt-6 pt-6 border-t border-gray-200">
                    {{ $documents->links() }}
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
                <div x-show="isOpen" x-transition class="relative transform overflow-hidden bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-2xl rounded-lg">

                    <!-- Header -->
                    <div class="bg-navy px-6 py-4 border-b-2 border-gold flex justify-between items-center">
                        <h3 class="text-xl font-serif-custom text-gold" x-text="isEditMode ? 'Edit Document' : 'Upload Document'"></h3>
                        <button @click="isOpen = false" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form :action="isEditMode ? '/cmp/documents/' + formData.id : '/cmp/documents'" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                        @csrf
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <!-- Estate Matter Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estate Matter <span class="text-red-500">*</span></label>
                            <select name="estate_matter_id" x-model="formData.estate_matter_id" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border bg-white">
                                <option value="">Select an Estate Matter...</option>
                                @foreach($matters as $matter)
                                    <option value="{{ $matter->id }}">{{ $matter->reference }} - {{ $matter->estate_matter }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Document Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Document Type <span class="text-red-500">*</span></label>
                                <select name="document_type" x-model="formData.document_type" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border bg-white">
                                    <option value="">Select Type</option>
                                    <option value="Court order">Court order</option>
                                    <option value="Certificate of Appointment">Certificate of Appointment</option>
                                    <option value="Letters of authority">Letters of authority</option>
                                    <option value="Inventory">Inventory</option>
                                    <option value="Filing Notice">Filing Notice</option>
                                    <option value="Liquidation and distribution account">Liquidation and distribution account</option>
                                    <option value="Notice / advertisement">Notice / advertisement</option>
                                    <option value="Correspondence">Correspondence</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Title / Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title / description (optional)</label>
                                <input type="text" name="title" x-model="formData.title" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">PDF File <span class="text-red-500" x-show="!isEditMode">*</span></label>
                            <input type="file" name="file" accept=".pdf" :required="!isEditMode" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2 border bg-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-navy file:text-white hover:file:bg-gray-800">
                            <p class="text-xs text-gray-500 mt-1">Max 10MB. Allowed: PDF only.</p>
                            
                            <!-- Show current document if editing -->
                            <template x-if="isEditMode && formData.filename">
                                <div class="mt-2 text-sm text-gray-600 flex items-center gap-2">
                                    <span>Current file:</span>
                                    <span class="font-medium text-navy" x-text="formData.filename"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Visibility Toggle -->
                        <div class="flex items-center gap-3 bg-gray-50 p-3 border border-gray-200 rounded-sm">
                            <input type="hidden" name="is_public" value="0">
                            <input type="checkbox" name="is_public" id="is_public" value="1" x-model="formData.is_public" class="rounded border-gray-300 text-navy focus:ring-[#b8935a] w-5 h-5">
                            <label for="is_public" class="text-sm font-medium text-gray-700 cursor-pointer">Make this document public (Visible on website)</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="isOpen = false" class="bg-white text-navy border border-navy px-5 py-2 text-sm font-medium rounded-sm hover:bg-gray-50 transition">Cancel</button>
                            <button type="submit" class="bg-navy text-white px-5 py-2 text-sm font-medium rounded-sm hover:bg-gray-800 transition shadow-sm" x-text="isEditMode ? 'Update Document' : 'Upload Document'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine Logic -->
    <script>
        function documentModal() {
            return {
                isOpen: false,
                isEditMode: false,
                formData: {
                    id: null,
                    estate_matter_id: '',
                    document_type: '',
                    title: '',
                    filename: '',
                    is_public: true,
                },
                openCreateModal() {
                    this.isEditMode = false;
                    this.formData = { 
                        id: null, 
                        estate_matter_id: '', 
                        document_type: '', 
                        title: '', 
                        filename: '', 
                        is_public: true 
                    };
                    this.isOpen = true;
                },
                openEditModal(doc) {
                    this.isEditMode = true;
                    this.formData = {
                        id: doc.id,
                        estate_matter_id: doc.estate_matter_id,
                        document_type: doc.document_type,
                        title: doc.title,
                        filename: doc.filename,
                        is_public: doc.is_public == 1
                    };
                    this.isOpen = true;
                }
            }
        }
    </script>
</x-admin-layout>