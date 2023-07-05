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
    <div id="validation-errors"></div>
    <form action="">
        <h2>Apply Lamaran</h2>
        <div class="form-group fullname">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" id="fullname" placeholder="Cth. Jhonathan Akbar">
        </div>
        <div class="form-group jabatan">
            <label for="jabatan">Jabatan</label>
            <select class="js-example-basic-single" name="jabatan" id="jabatan" data-placeholder="Pilih Jabatan">
                <option value="" disabled selected hidden>Pilih Jabatan</option>
            </select>
        </div>
        <div class="form-group telepon">
            <label for="phone">Telepon</label>
            <input type="text" id="phone" placeholder="Cth. 0893239851289">
        </div>
        <div class="form-group email">
            <label for="email">Email Address</label>
            <input type="text" id="email" placeholder="Cth. energeekmail@gmail.com">
        </div>
        <div class="form-group date">
            <label for="year">Tahun Lahir</label>
            <input type="number" id="year" placeholder="Pilih tahun" min="1980" max="2020">
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

            $('#myBtn').on('click', function(e) {
                e.preventDefault();
                console.log($('#jabatan').val());
                $.ajax({
                    type: 'POST',
                    url: "{{ route('candidate.store') }}",
                    data: {
                        name: $('#fullname').val(),
                        phone: $('#phone').val(),
                        email: $('#email').val(),
                        year: $('#year').val(),
                        job_id: $('#jabatan').val()
                    },
                    success: function(data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Berhasil!',
                            html: 'Lamaran Berhasil dikirim.',
                            showConfirmButton: true,
                            timer: 2500
                        })
                    },
                    error: function(xhr) {
                        $('#validation-errors').html('');
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div');
                        });
                    },
                });

            });
        });
    </script>
</body>

</html>