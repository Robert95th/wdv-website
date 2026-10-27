<x-admin-layout>
    <!-- Wrap everything in Alpine data to control the modal -->
    <div class="py-8 bg-[#fcfbf7] min-h-screen" x-data="propertyModal()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="font-serif-custom text-2xl text-navy">Manage Properties</h2>
                    <p class="text-sm text-gray-500 mt-1">Add, edit, or remove assets from the public sale list.</p>
                </div>
                <!-- Trigger Create Modal -->
                <button @click="openCreateModal()" class="bg-navy text-white px-5 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Property
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
                    <div class="px-3 py-3 col-span-2"><span class="text-sm font-bold text-gray-800">Property Details</span></div>
                    <div class="px-3 py-3"><span class="text-sm font-bold text-gray-800">Category</span></div>
                    <div class="px-3 py-3"><span class="text-sm font-bold text-gray-800">Status</span></div>
                    <div class="px-3 py-3 text-right"><span class="text-sm font-bold text-gray-800">Actions</span></div>
                </div>

                <!-- Data Rows -->
                <div class="divide-y divide-gray-200">
                    @forelse($properties as $property)
                    <div class="grid grid-cols-1 md:grid-cols-5 items-center hover:bg-gray-50 transition duration-150 ease-in-out py-4 md:py-0 group">

                        <!-- Property Details (Image + Title) -->
                        <div class="px-3 py-2 md:py-4 col-span-2 flex items-center gap-4">
                            <div class="shrink-0">
                                @php
                                $primaryImage = $property->images->where('is_primary', true)->first() ?? $property->images->first();
                                @endphp

                                @if($primaryImage)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="Thumb" class="w-16 h-12 object-cover rounded-sm border border-gray-200">
                                    @if($property->images->count() > 1)
                                        <span class="absolute -top-2 -right-2 bg-navy text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-white">
                                            +{{ $property->images->count() - 1 }}
                                        </span>
                                    @endif
                                </div>
                                @else
                                <div class="w-16 h-12 bg-gray-200 rounded-sm border border-gray-200 flex items-center justify-center text-xs text-gray-400">No img</div>
                                @endif
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-navy">{{ Str::limit($property->title, 50) }}</span>
                                <span class="block text-xs text-gray-500 mt-0.5">{{ Str::limit($property->description, 60) }}</span>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="px-3 py-2 md:py-4 flex justify-between md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Category</span>
                            <span class="inline-block bg-[#efe8d5] text-[#8c7a5b] px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap">{{ $property->category }}</span>
                        </div>

                        <!-- Status -->
                        <div class="px-3 py-2 md:py-4 flex justify-between md:block">
                            <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Status</span>
                            <div class="flex flex-col items-end md:items-start gap-2">
                                @if($property->view_status)
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Active</span>
                                @else
                                <span class="inline-block px-2 py-1 bg-gray-200 text-gray-600 text-xs font-semibold rounded-full">Archived</span>
                                @endif

                                <!-- Document Link -->
                                @if($property->document_path)
                                <a href="{{ asset('storage/' . $property->document_path) }}" target="_blank" class="text-xs text-blue-600 hover:underline flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Document
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-3 py-3 md:py-4 flex justify-end gap-3 mt-2 md:mt-0 border-t border-gray-100 md:border-0">
                            <button @click="openEditModal({{ $property->load('images') }})" class="text-sm font-medium text-[#b8935a] hover:text-navy transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this property and all its images?');">
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
                        No properties found. Click "Add Property" to get started.
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($properties->hasPages())
                <div class="mt-6 pt-6 border-t border-gray-200">
                    {{ $properties->links() }}
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
                        <h3 class="text-xl font-serif-custom text-gold" x-text="isEditMode ? 'Edit Property' : 'Add New Property'"></h3>
                        <button @click="isOpen = false" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form :action="isEditMode ? '/cmp/properties/' + formData.id : '/cmp/properties'" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                        @csrf
                        <!-- Method spoofing for PUT request -->
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Property Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" x-model="formData.title" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                                <select name="category" x-model="formData.category" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border bg-white">
                                    <option value="">Select Category</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Farmland">Farmland</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Vehicles">Vehicles</option>
                                    <option value="Movables">Movables</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" x-model="formData.description" rows="3" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Auctioneer</label>
                                <input type="text" name="auctioneer" x-model="formData.auctioneer" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date & Time</label>
                                <input type="text" name="date_and_time" x-model="formData.date_and_time" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Venue</label>
                                <input type="text" name="venue" x-model="formData.venue" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            </div>
                        </div>

                        <!-- Image Upload Area -->
                        <div class="bg-gray-50 p-4 border border-gray-200 rounded-sm">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Property Images</label>
                            
                            <!-- Show Existing Images (Only in Edit Mode) -->
                            <template x-if="isEditMode && formData.images.length > 0">
                                <div class="mb-4">
                                    <p class="text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wider">Current Images</p>
                                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                                        <template x-for="img in formData.images" :key="img.id">
                                            <div class="relative group">
                                                <!-- Main Thumbnail -->
                                                <img :src="'/storage/' + img.image_path" class="w-full h-20 object-cover rounded border border-gray-300">
                                                
                                                <!-- Primary Star -->
                                                <div x-show="img.is_primary" class="absolute top-1 left-1 bg-[#b8935a] text-white p-1 rounded-sm shadow-sm" title="Primary Image">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                </div>

                                                <!-- Delete Button (Submits a form) -->
                                                <form :action="'/cmp/properties/images/' + img.id" method="POST" class="absolute top-1 right-1" onsubmit="return confirm('Delete this image?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white p-1 rounded-sm opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-red-600" title="Delete Image">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <!-- Upload New Images -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wider">Upload New Images</label>
                                <input type="file" name="images[]" accept="image/*" multiple class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2 border bg-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-navy file:text-white hover:file:bg-gray-800">
                                <p class="text-xs text-gray-500 mt-1">Select one or multiple images. Max 5MB each.</p>
                            </div>
                        </div>

                        <!-- Document Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Property Document (PDF/Word)</label>
                            <input type="file" name="document" accept=".pdf,.doc,.docx" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2 border bg-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-navy file:text-white hover:file:bg-gray-800">
                            <p class="text-xs text-gray-500 mt-1">Max 10MB. Allowed: PDF, DOC, DOCX.</p>

                            <template x-if="isEditMode && formData.document_path">
                                <div class="mt-2 text-sm text-gray-600 flex items-center gap-2">
                                    <span>Current file:</span>
                                    <a :href="'/storage/' + formData.document_path" target="_blank" class="text-[#b8935a] hover:underline font-medium">View Document</a>
                                </div>
                            </template>
                        </div>

                        <div class="flex items-center gap-3 bg-gray-50 p-3 border border-gray-200 rounded-sm">
                            <input type="hidden" name="view_status" value="1">
                            <input type="checkbox" name="view_status" id="view_status" value="0" x-model="formData.archive" class="rounded border-gray-300 text-navy focus:ring-[#b8935a] w-5 h-5">
                            <label for="view_status" class="text-sm font-medium text-gray-700 cursor-pointer">Archive this property (Hide from public site)</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="isOpen = false" class="bg-white text-navy border border-navy px-5 py-2 text-sm font-medium rounded-sm hover:bg-gray-50 transition">Cancel</button>
                            <button type="submit" class="bg-navy text-white px-5 py-2 text-sm font-medium rounded-sm hover:bg-gray-800 transition shadow-sm" x-text="isEditMode ? 'Update Property' : 'Save Property'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine Logic -->
    <script>
        function propertyModal() {
            return {
                isOpen: false,
                isEditMode: false,
                formData: {
                    id: null,
                    title: '',
                    category: '',
                    description: '',
                    auctioneer: '',
                    date_and_time: '',
                    venue: '',
                    document_path: '',
                    archive: false,
                    images: [] // Array to hold existing images
                },
                openCreateModal() {
                    this.isEditMode = false;
                    this.formData = {
                        id: null,
                        title: '',
                        category: '',
                        description: '',
                        auctioneer: '',
                        date_and_time: '',
                        venue: '',
                        document_path: '',
                        archive: false,
                        images: []
                    };
                    this.isOpen = true;
                },
                openEditModal(property) {
                    this.isEditMode = true;
                    this.formData = {
                        id: property.id,
                        title: property.title,
                        category: property.category,
                        description: property.description,
                        auctioneer: property.auctioneer,
                        date_and_time: property.date_and_time,
                        venue: property.venue,
                        document_path: property.document_path,
                        archive: property.view_status == 0,
                        images: property.images || [] // Pass the images array to Alpine
                    };
                    this.isOpen = true;
                }
            }
        }
    </script>
</x-admin-layout>