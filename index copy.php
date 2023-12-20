
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.css' integrity='sha512-r0fo0kMK8myZfuKWk9b6yY8azUnHCPhgNz/uWDl2rtMdWJlk7gmd9socvGZdZzICwAkMgfTkVrplDahQ07Gi0A==' crossorigin='anonymous'/>
    <title>Arduino</title>
    <script>
        function triggerPrint(endpoint) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://192.168.100.82/"+ endpoint, true);
            xhr.send();
            return false; // Prevents the default behavior of the link
        }
        function sendMessage(urlParam, event) {
            event.preventDefault(); // Prevents the default form submission
            var message = document.getElementById("messageInput").value;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://192.168.100.82/" + urlParam + "?message=" + encodeURIComponent(message), true);
            xhr.send();
            // Add any further handling logic here
            return false; // Prevents the default behavior of the form
        }

        function updatePotValue(value) {
            document.getElementById('potProgressBar').style.width = value + '%';
            document.getElementById('potProgressBar').innerText = value + '%';
        }

        function fetchPotValue() {
            var script = document.createElement('script');
            script.src = 'http://192.168.100.82/';
            document.head.appendChild(script);
        }

        setInterval(fetchPotValue, 500);

    </script>
</head>

<body>
    <div class="container">
        <div class="row  mt-5">
            <div class="col-md-4 p-5">
                <a href="http://192.168.100.82/hello" class="btn btn-primary w-100" onclick="return triggerPrint('hello')">Hello World</a>
            </div>
            <div class="col-md-4 p-5">
                <a href="http://192.168.100.82/count" class="btn btn-primary w-100" onclick="return triggerPrint('count')">Count 1-100</a>
            </div>
            <div class="col-md-4 p-5">
                <a href="http://192.168.100.82/countDown" class="btn btn-primary w-100" onclick="return triggerPrint('countDown')">Count Down</a>
            </div>
        </div>
        <div class="row">
            <form onsubmit="return sendMessage('display', event)">
                <div class="mb-3">
                    <label for="messageInput" class="form-label">Message:</label>
                    <input type="text" class="form-control" id="messageInput">
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
        <div class="row">
            <div class="progress">
                <div id="potProgressBar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    0%
                </div>
            </div>
        </div>
</body>
</html>