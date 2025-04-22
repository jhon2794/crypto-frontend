<h1>Top 10 Criptomonedas</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Nombre</th>
        <th>Símbolo</th>
        <th>Precio (USD)</th>
    </tr>
    @foreach ($data as $crypto)
        <tr>
            <td>{{ $crypto['name'] }}</td>
            <td>{{ $crypto['symbol'] }}</td>
            <td>${{ number_format($crypto['quote']['USD']['price'], 2) }}</td>
        </tr>
    @endforeach
</table>
