
 <!-- Main Modal -->
<div id="pm-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-lg bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:text-white">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Create New Peminjam
            </h3>
            <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2 dark:hover:bg-gray-700 dark:hover:text-white" data-modal-toggle="pm-modal" aria-label="Close modal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="2">
                    <path d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

  
              <!-- Modal Body -->
              <form action="{{ route('admin.peminjam.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4">
                  @csrf
  
                  <!-- Nama Lengkap -->
                  <div>
                      <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                      <input type="text" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Enter full name" required>
                  </div>
  
                  <!-- User ID -->
                  <div>
                      <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User ID</label>
                      <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                          <option value="" disabled selected>Select user</option>
                          @foreach($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                      </select>
                  </div>
  
                  <!-- Email -->
                  <div>
                      <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                      <select name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                          <option value="" disabled selected>Select email</option>
                          @foreach($users as $user)
                              <option value="{{ $user->email }}">{{ $user->email }}</option>
                          @endforeach
                      </select>
                  </div>
  
                  <!-- Location Fields -->
                  <div>
                      <label for="provinsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Province</label>
                      <select id="provinsi" name="provinsi" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                          <option value="">Select province</option>
                      </select>
                      <input type="hidden" name="provinsi_name" id="provinsi_name" value="{{ $peminjam->location['provinsi'] ?? '' }}">
                  </div>
  
                  <div>
                      <label for="kabupaten" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Regency</label>
                      <select id="kabupaten" name="kabupaten" required disabled class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                          <option value="">Select regency</option>
                      </select>
                      <input type="hidden" name="kabupaten_name" id="kabupaten_name" value="{{ $peminjam->location['kabupaten'] ?? '' }}">
                  </div>
  
                  <div>
                      <label for="kecamatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">District</label>
                      <select id="kecamatan" name="kecamatan" required disabled class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                          <option value="">Select district</option>
                      </select>
                      <input type="hidden" name="kecamatan_name" id="kecamatan_name" value="{{ $peminjam->location['kecamatan'] ?? '' }}">
                  </div>
  
                  <!-- Address -->
                  <div>
                      <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                      <textarea name="alamat" id="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Enter full address" required></textarea>
                  </div>
  
                  <!-- Phone -->
                  <div>
                      <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                      <input type="number" name="phone" id="phone" pattern="^\d{10,15}$" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Enter phone number" required>
                  </div>
  
                  <!-- Photo -->
                  <div>
                      <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
                      <input type="file" name="photo" id="photo" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                  </div>
  
                  <!-- Submit Button -->
                  <div class="flex justify-end">
                      <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                          Create Peminjam
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
  
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      fetchProvinces();
  
      document.getElementById('provinsi').addEventListener('change', function () {
          const provinceName = this.options[this.selectedIndex].text;
          document.getElementById('provinsi_name').value = provinceName; // Set nama provinsi
          fetchRegencies(this.value);
      });
  
      document.getElementById('kabupaten').addEventListener('change', function () {
          const regencyName = this.options[this.selectedIndex].text;
          document.getElementById('kabupaten_name').value = regencyName; // Set nama kabupaten
          fetchDistricts(this.value);
      });
  
      document.getElementById('kecamatan').addEventListener('change', function () {
          const districtName = this.options[this.selectedIndex].text;
          document.getElementById('kecamatan_name').value = districtName; // Set nama kecamatan
      });
  });
  
  function fetchProvinces() {
      fetch('/admin/location/get-provinces')
          .then(response => response.json())
          .then(data => {
              const provinceSelect = document.getElementById('provinsi');
              provinceSelect.innerHTML = '<option value="">Select province</option>';
              data.forEach(province => {
                  const option = document.createElement('option');
                  option.value = province.id;
                  option.textContent = province.name;
                  provinceSelect.appendChild(option);
              });
          })
          .catch(() => {
              alert('Gagal memuat provinsi. Silakan coba lagi nanti.');
          });
  }
  
  function fetchRegencies(provinceId) {
      if (!provinceId) return;
      fetch(`/admin/location/get-kabupaten/${provinceId}`)
          .then(response => response.json())
          .then(data => {
              const regencySelect = document.getElementById('kabupaten');
              regencySelect.innerHTML = '<option value="">Select regency</option>';
              data.forEach(regency => {
                  const option = document.createElement('option');
                  option.value = regency.id;
                  option.textContent = regency.name;
                  regencySelect.appendChild(option);
              });
              regencySelect.disabled = false;
          })
          .catch(() => {
              alert('Gagal memuat kabupaten. Silakan coba lagi nanti.');
          });
  }
  
  function fetchDistricts(regencyId) {
      if (!regencyId) return;
      fetch(`/admin/location/get-kecamatan/${regencyId}`)
          .then(response => response.json())
          .then(data => {
              const districtSelect = document.getElementById('kecamatan');
              districtSelect.innerHTML = '<option value="">Select district</option>';
              data.forEach(district => {
                  const option = document.createElement('option');
                  option.value = district.id;
                  option.textContent = district.name;
                  districtSelect.appendChild(option);
              });
              districtSelect.disabled = false;
          })
          .catch(() => {
              alert('Gagal memuat kecamatan. Silakan coba lagi nanti.');
          });
  }
  </script>
  