<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
    </div>

    <center><video width="1280" height="720" style="border:black 1px solid; background:black" id="preview"></video></center>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        let isHoliday = false
        let month = {!! Carbon\Carbon::now()->month !!}
        let day = {!! Carbon\Carbon::now()->day !!}
        let year = {!! Carbon\Carbon::now()->year !!}
        scanner.addListener('scan', function (content) {
            $.get(`https://calendarific.com/api/v2/holidays?api_key=3627d152431455cec4ffc4ddf4dba98011a077cc&country=PH&year=${year}&day=${day}&month=${month}`)
            .then(res => {
                console.log(res.response.holidays.length)
                if (res.response.holidays.length > 0) {
                    isHoliday = true
                }
                axios.post('/api/attendance', {
                    userId:content,
                    isHoliday:isHoliday
                }).then(res => {
                    console.log(res)
                    swal.fire({
                        type: 'success',
                        title: 'You have been successfully signed in!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }).catch(err => {
                    console.log(err.response)
                    if (err.response.status == 500) {
                        swal.fire({
                            type: 'error',
                            title: err.response.data.message,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                })
            })
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>
</body>
</html>
