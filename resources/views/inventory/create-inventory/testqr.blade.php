<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Barcode Scanner</h3>
    <button id="start-scan-btn">Start Scan</button>
    <button id="stop-scan-btn">Stop Scan</button>
    <video id="scanner" style="width: 100%; height: 400px;"></video>
    <form id="scanned-codes-form">
        <div id="scanned-codes-container"></div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/@zxing/library@0.17.1"></script>
    <script>
        let codeReader = null;
        const scannedCodes = [];

        function initCodeReader() {
            if (!codeReader) {
                codeReader = new ZXing.BrowserMultiFormatReader();
            }
        }

        function startScanning() {
            initCodeReader();
            codeReader
                .decodeFromInputVideoDevice(undefined, 'scanner')
                .then(result => {
                    if (!scannedCodes.includes(result.text)) {
                        scannedCodes.push(result.text);
                        const container = $('#scanned-codes-container');
                        container.append(`<div><label>Scanned code:</label><input type="text" name="scanned_codes[]" value="${result.text}"><button>hello</button></div>`);
                        alert('Code scanned: ' + result.text);
                        stopScanning(); // останавливаем сканер
                        startScanning(); // запускаем сканер снова
                    } else {
                        alert('Code already scanned: ' + result.text);
                        stopScanning(); // останавливаем сканер
                        startScanning(); // запускаем сканер снова
                    }
                })
                .catch(err => console.error(err));
        }

        function stopScanning() {
            if (codeReader) {
                codeReader.reset();
            }
        }

        $('#start-scan-btn, #stop-scan-btn').on('click', function(e) {
            e.preventDefault();
            if (this.id === 'start-scan-btn') {
                startScanning();
            } else {
                stopScanning();
            }
        });

        $('#scanned-codes-form').on('submit', function(e) {
            e.preventDefault();
            alert('Submitting scanned codes: ' + JSON.stringify(scannedCodes));
        });
    </script>
</body>

</html>
