<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="text-align: center;">
        <h1>Crypto Prices</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('crypto.search') }}">
            <input type="text" name="query" placeholder="Search cryptocurrency..." />
            <button type="submit">Search</button>
        </form>

    
        <div>
            <h2>Top 10 Cryptocurrencies</h2>
            <ul>
                @foreach ($cryptos as $crypto)
                    <li>
                        <strong>{{ $crypto->currency }}</strong> - ${{ number_format($crypto->price, 2) }}
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Contenedor para los gráficos -->
        <canvas id="cryptoChart" width="400" height="200"></canvas>
    </div>
    <script>
        const currencies = ['BTC', 'ETH', 'BNB', 'BSV'];
        const prices = [88116.86, 3200.00, 599.46, 30.26];

        const ctx = document.getElementById('cryptoChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: currencies,
                datasets: [{
                    label: 'Crypto Prices',
                    data: prices,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>

</body>
</html>
