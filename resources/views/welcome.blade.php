<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lamaran Energeek</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @if(Session::has('success'))
    <script type="text/javascript">
        function massge() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Berhasil!',
                html: 'Lamaran Berhasil dikirim.',
                showConfirmButton: true,
                timer: 2500
            })
        }
        window.onload = massge;
    </script>
    @endif
    <div id="validation-errors"></div>
    <form method="POST" action="{{route('candidate.store')}}">
        @csrf
        <h2>Apply Lamaran</h2>
        <div class="form-group fullname">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" id="fullname" placeholder="Cth. Jhonathan Akbar" name="name">
            <div class="text-err">
                @error('name')
                <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                </svg>
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group jabatan">
            <label for="jabatan">Jabatan</label>
            <select class="js-example-basic-single" name="job" id="jabatan" data-placeholder="Pilih Jabatan">
                <option value="" disabled selected hidden>Pilih Jabatan</option>
            </select>
            <div class="text-err">
                @error('job')
                <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                </svg>
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group telepon">
            <label for="phone">Telepon</label>
            <input type="text" name="phone" id="phone" placeholder="Cth. 0893239851289">
            <div class="text-err">
                @error('phone')
                <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                </svg>
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group email">
            <label for="email">Email Address</label>
            <input type="text" name="email" id="email" placeholder="Cth. energeekmail@gmail.com">
            <div class="text-err">
                @error('email')
                <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                </svg>
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group date">
            <label for="year">Tahun Lahir</label>
            <input type="number" name="year" id="year" placeholder="Pilih tahun" min="1980" max="2020">
            <div class="text-err">
                @error('year')
                <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                </svg>
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group skill">
            <label for="skill">Skill Set</label>
            <select class="js-example-basic-multiple" name="skill" id="skill" multiple="multiple" data-placeholder="Pilih skill">
            </select>
        </div>
        <div class="form-group submit-btn" id="myBtn">
            <input type="submit" value="Submit">
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get("{{ route('job.index') }}", function(response) {
                for (var key in response.data) {
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", response.data[key].id);
                    var t = document.createTextNode(response.data[key].name);
                    x.appendChild(t);
                    document.getElementById("jabatan").appendChild(x);
                };
            });
            $.get("{{ route('skill.index') }}", function(response) {
                for (var key in response.data) {
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", response.data[key].id);
                    var t = document.createTextNode(response.data[key].name);
                    x.appendChild(t);
                    document.getElementById("skill").appendChild(x);
                };
            });
        });
    </script>
</body>

</html>