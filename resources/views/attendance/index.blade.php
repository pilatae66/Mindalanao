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
	<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
    </div>

    <center><video width="1280" height="720" style="border:black 1px solid; background:black" id="preview"></video></center>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            axios.post('/api/attendance', {
                userId:content,
                type: 'Out'
            }).then(res => {
                console.log(res)
                swal.fire({
                    type: 'success',
                    title: 'You have been successfully signed in!',
                    showConfirmButton: false,
                    timer: 3000
                })
            }).catch(err => {
                console.log(err)
                if (err == 'Error: Request failed with status code 500') {
                    swal.fire({
                        type: 'error',
                        title: 'User not found!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
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
