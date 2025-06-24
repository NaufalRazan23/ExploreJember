@extends('layouts.app')

@section('title', $destination->name)

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex items-center text-sm text-gray-600">
        <a href="{{ route('destinations.index') }}" class="hover:text-blue-600 transition-colors duration-200">Destinations</a>
        <span class="mx-2">/</span>
        <a href="{{ route('categories.show', $destination->category) }}" class="hover:text-blue-600 transition-colors duration-200">
            {{ $destination->category->name }}
        </a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $destination->name }}</span>
    </div>

    <div class="max-w-5xl mx-auto">
        <!-- Main Image and Basic Info -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            @if($destination->featured_image)
                <div class="relative h-96">
                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                         alt="{{ $destination->name }}"
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder-destination.jpg') }}'; this.alt='Gambar tidak tersedia';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <div class="flex items-center justify-between">
                            <h1 class="text-4xl font-bold">{{ $destination->name }}</h1>
                            <span class="px-4 py-2 bg-blue-600 bg-opacity-90 backdrop-blur-sm rounded-full text-sm font-medium">
                                {{ $destination->category->name }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-8">
                <!-- Description -->
                <div class="prose max-w-none mb-8">
                    <p class="text-gray-600 text-lg leading-relaxed">{{ $destination->description }}</p>
                </div>

                <!-- Quick Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Opening Hours -->
                    @if($destination->opening_hours)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <span class="p-2 bg-blue-100 text-blue-600 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Opening Hours</h3>
                                    <p class="text-gray-600">{{ $destination->opening_hours }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Entry Fee -->
                    @if($destination->entry_fee)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <span class="p-2 bg-green-100 text-green-600 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </span>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Entry Fee</h3>
                                    <p class="text-gray-600">Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Contact -->
                    @if($destination->contact_number)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <span class="p-2 bg-yellow-100 text-yellow-600 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Contact</h3>
                                    <p class="text-gray-600">{{ $destination->contact_number }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Location and Facilities -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Location -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Location</h2>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="flex items-start text-gray-600">
                                <svg class="w-4 h-4 mr-3 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $destination->address }}
                            </p>
                        </div>
                    </div>

                    <!-- Facilities -->
                    @if($destination->facilities)
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Facilities</h2>
                            <div class="bg-gray-50 rounded-xl p-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($destination->facilities as $facility)
                                        <span class="inline-flex items-center px-3 py-1 bg-white border border-gray-200 rounded-full text-sm text-gray-700">
                                            {{ $facility }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Gallery -->
                @if($destination->gallery)
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Gallery</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($destination->gallery as $image)
                                <div class="aspect-w-16 aspect-h-12 group">
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="Gallery image of {{ $destination->name }}"
                                         class="w-full h-full object-cover rounded-xl transition duration-300 group-hover:opacity-90"
                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder-gallery.jpg') }}'; this.alt='Gambar tidak tersedia';">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Website Link -->
                @if($destination->website)
                    <div class="mt-8 text-center">
                        <a href="{{ $destination->website }}"
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200"
                           target="_blank">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Visit Official Website
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Visit Form Section (Only for Users) -->
        @auth
            @if(auth()->user()->isUser())
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Form Kunjungan</h3>
                        <p class="text-gray-600 mb-6">Bagikan pengalaman kunjungan Anda ke {{ $destination->name }}</p>

                        <div class="mt-6">
                            <button type="button" onclick="openVisitFormModal()" id="visitFormButton"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                @if(isset($userVisitForm) && $userVisitForm)
                                    📝 Edit Form Kunjungan
                                @else
                                    ✍️ Isi Form Kunjungan
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-8">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <span class="text-red-700">Hanya user yang bisa mengisi form kunjungan.</span>
                    </div>
                </div>
            @endif
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-8">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-gray-600">Silakan login sebagai user untuk mengisi form kunjungan.</span>
                </div>
            </div>
        @endauth

        <!-- Back Button -->
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('destinations.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Wisata
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.wisata.edit', $destination) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Wisata
                </a>
            @endif
        </div>
    </div>

<!-- Visit Form Modal -->
@auth
@if(auth()->user()->isUser())
<div id="visitFormModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-lg font-bold text-gray-900">Form Kunjungan - {{ $destination->name }}</h3>
                <button onclick="closeVisitFormModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="visitForm" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Visit Date -->
                    <div>
                        <label for="visit_date" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan *</label>
                        <input type="date" id="visit_date" name="visit_date" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               min="{{ date('Y-m-d') }}">
                    </div>

                    <!-- Visit Type -->
                    <div>
                        <label for="visit_type" class="block text-sm font-medium text-gray-700">Jenis Kunjungan *</label>
                        <select id="visit_type" name="visit_type" required onchange="toggleGroupSize()"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih jenis kunjungan</option>
                            <option value="sendirian">Sendirian</option>
                            <option value="rombongan">Rombongan</option>
                        </select>
                    </div>

                    <!-- Arrival Time -->
                    <div>
                        <label for="arrival_time" class="block text-sm font-medium text-gray-700">Waktu Datang *</label>
                        <input type="time" id="arrival_time" name="arrival_time" required onchange="validateTimes()"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Departure Time -->
                    <div>
                        <label for="departure_time" class="block text-sm font-medium text-gray-700">Waktu Pergi *</label>
                        <input type="time" id="departure_time" name="departure_time" required onchange="validateTimes()"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <p id="time-error" class="text-red-500 text-xs mt-1 hidden">Waktu pergi harus lebih lambat dari waktu datang</p>
                    </div>
                </div>

                <!-- Group Size (Hidden by default) -->
                <div id="groupSizeContainer" class="hidden">
                    <label for="group_size" class="block text-sm font-medium text-gray-700">Jumlah Orang *</label>
                    <input type="number" id="group_size" name="group_size" min="2" max="100"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Minimal 2 orang">
                </div>

                <!-- Suggestions -->
                <div>
                    <label for="suggestions" class="block text-sm font-medium text-gray-700">Saran untuk Tempat Wisata</label>
                    <textarea id="suggestions" name="suggestions" rows="3" maxlength="1000"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Berikan saran untuk pengembangan tempat wisata ini..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 1000 karakter</p>
                </div>

                <!-- Review -->
                <div>
                    <label for="review" class="block text-sm font-medium text-gray-700">Review Tempat Wisata</label>
                    <textarea id="review" name="review" rows="3" maxlength="1000"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Bagikan pengalaman atau review Anda tentang tempat wisata ini..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 1000 karakter</p>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-4">
                    <div>
                        @if($userVisitForm)
                        <button type="button" onclick="deleteVisitForm()"
                                class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Hapus Form
                        </button>
                        @endif
                    </div>
                    <div class="space-x-2">
                        <button type="button" onclick="closeVisitFormModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endauth

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing visit form functionality...');

    // Modal Functions
    window.openVisitFormModal = function() {
        console.log('Opening visit form modal...');
        const modal = document.getElementById('visitFormModal');
        if (modal) {
            modal.classList.remove('hidden');
            loadExistingData();
        } else {
            console.error('Modal element not found!');
        }
    }

    window.closeVisitFormModal = function() {
        console.log('Closing visit form modal...');
        const modal = document.getElementById('visitFormModal');
        const form = document.getElementById('visitForm');
        const groupContainer = document.getElementById('groupSizeContainer');

        if (modal) modal.classList.add('hidden');
        if (form) form.reset();
        if (groupContainer) groupContainer.classList.add('hidden');
    }

    // Toggle group size field based on visit type
    window.toggleGroupSize = function() {
        const visitType = document.getElementById('visit_type').value;
        const groupSizeContainer = document.getElementById('groupSizeContainer');
        const groupSizeInput = document.getElementById('group_size');

        if (visitType === 'rombongan') {
            groupSizeContainer.classList.remove('hidden');
            groupSizeInput.required = true;
        } else {
            groupSizeContainer.classList.add('hidden');
            groupSizeInput.required = false;
            groupSizeInput.value = '';
        }
    }

    // Validate that departure time is after arrival time
    window.validateTimes = function() {
        const arrivalTime = document.getElementById('arrival_time').value;
        const departureTime = document.getElementById('departure_time').value;
        const errorElement = document.getElementById('time-error');
        const submitButton = document.querySelector('#visitForm button[type="submit"]');

        if (arrivalTime && departureTime) {
            if (departureTime <= arrivalTime) {
                if (errorElement) errorElement.classList.remove('hidden');
                if (submitButton) submitButton.disabled = true;
                return false;
            } else {
                if (errorElement) errorElement.classList.add('hidden');
                if (submitButton) submitButton.disabled = false;
                return true;
            }
        }
        return true;
    }

    // Load existing form data if user has already filled the form
    function loadExistingData() {
        @if(isset($userVisitForm) && $userVisitForm)
        try {
            document.getElementById('visit_date').value = '{{ $userVisitForm->visit_date->format('Y-m-d') }}';
            document.getElementById('arrival_time').value = '{{ substr($userVisitForm->arrival_time, 0, 5) }}';
            document.getElementById('departure_time').value = '{{ substr($userVisitForm->departure_time, 0, 5) }}';
            document.getElementById('visit_type').value = '{{ $userVisitForm->visit_type }}';
            document.getElementById('suggestions').value = '{{ $userVisitForm->suggestions }}';
            document.getElementById('review').value = '{{ $userVisitForm->review }}';

            @if($userVisitForm->visit_type === 'rombongan')
            document.getElementById('group_size').value = '{{ $userVisitForm->group_size }}';
            toggleGroupSize();
            @endif
        } catch (error) {
            console.error('Error loading existing data:', error);
        }
        @endif
    }

    // Submit form via AJAX
    const visitForm = document.getElementById('visitForm');
    if (visitForm) {
        visitForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');

            // Validate times before submitting
            if (!validateTimes()) {
                alert('Pastikan waktu pergi lebih lambat dari waktu datang!');
                return;
            }

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');

            // Disable submit button
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';

            fetch('{{ route('user.visit-form.store', $destination) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeVisitFormModal();
                    location.reload(); // Reload to update visitor count
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.message) {
                    alert('Terjadi kesalahan: ' + error.message);
                } else if (error.errors) {
                    // Handle validation errors
                    let errorMessage = 'Validation errors:\n';
                    for (let field in error.errors) {
                        errorMessage += error.errors[field].join('\n') + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('Terjadi kesalahan saat menyimpan form.');
                }
            })
            .finally(() => {
                // Re-enable submit button
                submitButton.disabled = false;
                submitButton.textContent = 'Simpan';
            });
        });
    }

    // Delete form function
    @if(isset($userVisitForm) && $userVisitForm)
    window.deleteVisitForm = function() {
        if (confirm('Apakah Anda yakin ingin menghapus form kunjungan ini?')) {
            fetch('{{ route('user.visit-form.destroy', $destination) }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeVisitFormModal();
                    location.reload(); // Reload to update visitor count
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus form.');
            });
        }
    }
    @endif

    // Close modal when clicking outside
    const modal = document.getElementById('visitFormModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeVisitFormModal();
            }
        });
    }

    console.log('Visit form functionality initialized successfully');
});
</script>
@endsection
