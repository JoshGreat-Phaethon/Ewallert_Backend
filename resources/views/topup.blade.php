<!DOCTYPE html>
<html>
<head>
    <title>Top Up - E-Wallet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow" style="width: 400px;">
        <div class="card-body">
            <h4 class="text-center mb-4">Top Up Saldo</h4>

            <form id="topupForm">
                <div class="mb-3">
                    <label>Jumlah Top Up</label>
                    <input type="number" id="amount" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Top Up
                </button>
            </form>

            <div id="message" class="mt-3 text-center"></div>
        </div>
    </div>
</div>

<script>
document.getElementById('topupForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const token = localStorage.getItem('token');

    if (!token) {
        alert('Silakan login dulu');
        window.location.href = '/login';
        return;
    }

    const amount = document.getElementById('amount').value;

    const response = await fetch('/api/topup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify({
            amount: amount
        })
    });

    const data = await response.json();
    const messageDiv = document.getElementById('message');

    if (response.ok) {
        messageDiv.innerHTML = `<span class="text-success">Top Up berhasil</span>`;
        console.log(data);
    } else {
        messageDiv.innerHTML = `<span class="text-danger">Top Up gagal</span>`;
        console.log(data);
    }
});
</script>

</body>
</html>
