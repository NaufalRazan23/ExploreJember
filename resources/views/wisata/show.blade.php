@extends('layouts.app')

@section('title', $destination->name)

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $destination->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Images and Details -->
        <div class="lg:col-span-2">
            <!-- Featured Image -->
            @if($destination->featured_image)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                         alt="{{ $destination->name }}"
                         class="w-full h-96 object-cover rounded-xl shadow-lg">
                </div>
            @endif

            <!-- Gallery -->
            @if($destination->gallery && count($destination->gallery) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Galeri Foto</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($destination->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="{{ $destination->name }}"
                                 class="w-full h-32 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi</h3>
                <div class="prose prose-blue max-w-none">
                    <p class="text-gray-700 leading-relaxed">{{ $destination->description }}</p>
                </div>
            </div>

            <!-- Facilities -->
            @if($destination->facilities && count($destination->facilities) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Fasilitas</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($destination->facilities as $facility)
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column - Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $destination->name }}</h1>
                <div class="flex items-center mb-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        {{ $destination->category->name }}
                    </span>
                </div>

                <!-- Info Items -->
                <div class="space-y-4">
                    <!-- Address -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Alamat</p>
                            <p class="text-sm text-gray-600">{{ $destination->address }}</p>
                        </div>
                    </div>

                    <!-- Entry Fee -->
                    @if($destination->entry_fee)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Harga Tiket</p>
                                <p class="text-sm text-gray-600">Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Opening Hours -->
                    @if($destination->opening_hours)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Jam Buka</p>
                                <p class="text-sm text-gray-600">{{ $destination->opening_hours }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Contact -->
                    @if($destination->contact_number)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Kontak</p>
                                <p class="text-sm text-gray-600">{{ $destination->contact_number }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Website -->
                    @if($destination->website)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Website</p>
                                <a href="{{ $destination->website }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">
                                    Kunjungi Website
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Map Button -->
                @if($destination->latitude && $destination->longitude)
                    <div class="mt-6">
                        <a href="https://maps.google.com/?q={{ $destination->latitude }},{{ $destination->longitude }}"
                           target="_blank"
                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            Lihat di Google Maps
                        </a>
                    </div>
                @endif

                <!-- Visit Form Button (Only for Users) -->
                @auth
                    @if(auth()->user()->isUser())
                        <div class="mt-6">
                            <button onclick="openVisitFormModal()" id="visitFormButton"
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
                    @else
                        <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <span class="text-red-700 font-medium">Hanya user yang bisa mengisi form kunjungan.</span>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="mt-4 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-600 font-medium">Silakan login sebagai user untuk mengisi form kunjungan.</span>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Related Destinations -->
    @if($relatedWisata->count() > 0)
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">Wisata Serupa</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedWisata as $related)
                    <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        @if($related->featured_image)
                            <div class="relative h-32 overflow-hidden">
                                <img src="{{ asset('storage/' . $related->featured_image) }}"
                                    alt="{{ $related->name }}"
                                    class="w-full h-full object-cover transform transition duration-300 group-hover:scale-110">
                            </div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $related->name }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($related->description, 60) }}</p>
                            <a href="{{ route('wisata.show', $related) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
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
// Modal Functions
function openVisitFormModal() {
    document.getElementById('visitFormModal').classList.remove('hidden');
    loadExistingData();
}

function closeVisitFormModal() {
    document.getElementById('visitFormModal').classList.add('hidden');
    document.getElementById('visitForm').reset();
    document.getElementById('groupSizeContainer').classList.add('hidden');
}

// Toggle group size field based on visit type
function toggleGroupSize() {
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
function validateTimes() {
    const arrivalTime = document.getElementById('arrival_time').value;
    const departureTime = document.getElementById('departure_time').value;
    const errorElement = document.getElementById('time-error');
    const submitButton = document.querySelector('#visitForm button[type="submit"]');

    if (arrivalTime && departureTime) {
        if (departureTime <= arrivalTime) {
            errorElement.classList.remove('hidden');
            submitButton.disabled = true;
            return false;
        } else {
            errorElement.classList.add('hidden');
            submitButton.disabled = false;
            return true;
        }
    }
    return true;
}

// Load existing form data if user has already filled the form
function loadExistingData() {
    @if($userVisitForm)
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
    @endif
}

// Submit form via AJAX
document.getElementById('visitForm').addEventListener('submit', function(e) {
    e.preventDefault();

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

// Delete form function
@if($userVisitForm)
function deleteVisitForm() {
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
document.getElementById('visitFormModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVisitFormModal();
    }
});
</script>
@endsection
