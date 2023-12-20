
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.css' integrity='sha512-r0fo0kMK8myZfuKWk9b6yY8azUnHCPhgNz/uWDl2rtMdWJlk7gmd9socvGZdZzICwAkMgfTkVrplDahQ07Gi0A==' crossorigin='anonymous'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css' integrity='sha512-tx5+1LWHez1QiaXlAyDwzdBTfDjX07GMapQoFTS74wkcPMsI3So0KYmFe6EHZjI8+eSG0ljBlAQc3PQ5BTaZtQ==' crossorigin='anonymous'/>
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

        function sendBinary(urlParam, event) {
            event.preventDefault(); // Prevents the default form submission
            var bin = document.getElementById("binaryInput").value;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://192.168.100.82/" + urlParam + "?bin=" + encodeURIComponent(bin), true);
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
        <div class="row border mt-5 bg-light rounded p-2">
            <h1 class="mt-2">LED Display</h1>
            <div class="col-md-4 p-5">
                <a href="http://192.168.100.82/hello" class="btn btn-primary w-100" onclick="return triggerPrint('hello')">Hello World</a>
            </div>
            <div class="col-md-4 p-5">
                <a href="http://192.168.100.82/count" class="btn btn-success w-100" onclick="return triggerPrint('count')">Count 1-100</a>
            </div>
            <div class="col-md-4 p-5">
                <a href="http://192.168.100.82/countDown" class="btn btn-danger w-100" onclick="return triggerPrint('countDown')">Count Down</a>
            </div>
        </div>
        <div class="row border mt-5 bg-light rounded p-2">
        <h1>Binary count ing LED Light</h1>
            <form onsubmit="return sendBinary('binary', event)">
                <div class="input-group">
                <input type="number" class="form-control" placeholder="1-100" id="binaryInput" min="1" max="100">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" ><i class="fa-solid fa-paper-plane"></i></button>
                </div>
                </div>
            </form>
        </div>
        <div class="row mt-5 border bg-light rounded  d-flex p-2">
        <h1 class="mt-2">LCD</h1>
        <span>the text you input in the textarea will appear in LCD Display</span>
            <form onsubmit="return sendMessage('display', event)">
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Comment</label>
                    <input type="text" class="form-control" id="messageInput">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="row mt-5 border bg-light p-3">
            <p class="fw-bold">Potentiometer</p>
            <div class="progress rounded-0 bg-light">
                <div id="potProgressBar" class="progress-bar bg-danger rounded-0" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    0%
                </div>
            </div>
        </div>
</body>
</html>