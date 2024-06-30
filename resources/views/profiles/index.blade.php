@include('components.navbar')

    @section('title', 'AdminPage')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AdminPage - Profile</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            .rounded-full {
                width: 100px; /* Sesuaikan dengan ukuran yang Anda inginkan */
                height: 100px; /* Sesuaikan dengan ukuran yang Anda inginkan */
                object-fit: cover;
            }
            .modal {
                display: none;
                position: fixed;
                z-index: 50;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 600px;
            }
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">Profile</h2>
                </div>
    
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
    
                @if($profile)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center">
                                @if($profile->foto_profile)
                                    <img src="{{ asset('storage/' . $profile->foto_profile) }}" alt="Profile Picture" class="w-32 h-32 rounded-full mr-4">
                                @else
                                    <img src="{{ asset('images/user.png') }}" alt="Default Profile Picture" class="w-32 h-32 rounded-full mr-4">
                                @endif
                                <div>
                                    <h3 class="text-xl font-semibold">{{ $profile->nama_member }}</h3>
                                    <p class="text-gray-600">{{ $profile->email }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p><strong>Date of Birth:</strong> {{ $profile->tanggal_lahir }}</p>
                                <p><strong>Gender:</strong> {{ $profile->jenis_kelamin }}</p>
                                <p><strong>Work:</strong> {{ $profile->pekerjaan }}</p>
                                <p><strong>Address:</strong> {{ $profile->alamat }}</p>
                            </div>
                            <div class="mt-4">
                                <button id="editProfileBtn" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</button>
                                <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-center">
                        <a href="{{ route('profiles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Profile</a>
                    </div>
                @endif
            </div>
        </div>
    
        <!-- Modal -->
        <div id="editProfileModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Edit Profile</h3>
                @if($profile)
                    <form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_member" class="block text-gray-700">Name:</label>
                            <input type="text" id="nama_member" name="nama_member" value="{{ $profile->nama_member }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email:</label>
                            <input type="email" id="email" name="email" value="{{ $profile->email }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="block text-gray-700">Date of Birth:</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $profile->tanggal_lahir }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="block text-gray-700">Gender:</label>
                            <input type="text" id="jenis_kelamin" name="jenis_kelamin" value="{{ $profile->jenis_kelamin }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="pekerjaan" class="block text-gray-700">Work:</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" value="{{ $profile->pekerjaan }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="block text-gray-700">Address:</label>
                            <input type="text" id="alamat" name="alamat" value="{{ $profile->alamat }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="foto_profile" class="block text-gray-700">Profile Picture:</label>
                            <input type="file" id="foto_profile" name="foto_profile" class="w-full px-3 py-2 border rounded">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                    </form>
                @endif
            </div>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        </div>
    
        <script>
            // Get the modal
            var modal = document.getElementById("editProfileModal");
    
            // Get the button that opens the modal
            var btn = document.getElementById("editProfileBtn");
    
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
    
            // When the user clicks the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }
    
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
    
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </body>
    </html>
    