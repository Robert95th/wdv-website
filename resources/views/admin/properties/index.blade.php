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
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Property
                </button>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4 font-medium">Image</th>
                                <th class="px-6 py-4 font-medium">Title</th>
                                <th class="px-6 py-4 font-medium">Category</th>
                                <th class="px-6 py-4 font-medium text-center">Status</th>
                                <th class="px-6 py-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($properties as $property)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        @if($property->image)
                                            <img src="{{ $property->image }}" alt="Thumb" class="w-16 h-12 object-cover rounded-sm border border-gray-200">
                                        @else
                                            <div class="w-16 h-12 bg-gray-200 rounded-sm border border-gray-200 flex items-center justify-center text-xs text-gray-400">No img</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-navy">{{ Str::limit($property->title, 40) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $property->category }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($property->view_status)
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Active</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-gray-200 text-gray-600 text-xs font-semibold rounded-full">Archived</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm space-x-3 whitespace-nowrap">
                                        <!-- Trigger Edit Modal -->
                                        <button @click="openEditModal({{ $property }})" class="text-[#b8935a] hover:text-navy font-medium transition">Edit</button>
                                        
                                        <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this property?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">No properties found. Click "Add Property" to get started.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($properties->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
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
                <div x-show="isOpen" x-transition class="relative transform overflow-hidden bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-2xl rounded-lg">
                    
                    <!-- Header -->
                    <div class="bg-navy px-6 py-4 border-b-2 border-gold flex justify-between items-center">
                        <h3 class="text-xl font-serif-custom text-gold" x-text="isEditMode ? 'Edit Property' : 'Add New Property'"></h3>
                        <button @click="isOpen = false" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form :action="isEditMode ? '/admin/properties/' + formData.id : '/admin/properties'" method="POST" class="p-6 space-y-5">
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

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image URL (Optional)</label>
                            <input type="url" name="image" x-model="formData.image" placeholder="https://example.com/image.jpg" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                        </div>

                        <div class="flex items-center gap-3 bg-gray-50 p-3 border border-gray-200 rounded-sm">
                            <input type="hidden" name="view_status" value="1">
                            <!-- If checked, sends 0 -->
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
                    image: '',
                    archive: false,
                },
                openCreateModal() {
                    this.isEditMode = false;
                    this.formData = { id: null, title: '', category: '', description: '', auctioneer: '', date_and_time: '', venue: '', image: '', archive: false };
                    this.isOpen = true;
                },
                openEditModal(property) {
                    this.isEditMode = true;
                    // Convert the boolean view_status to the archive checkbox state
                    this.formData = {
                        ...property,
                        archive: property.view_status == 0 // If view_status is 0, it's archived
                    };
                    this.isOpen = true;
                }
            }
        }
    </script>
</x-admin-layout>