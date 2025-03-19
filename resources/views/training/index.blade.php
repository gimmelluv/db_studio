<x-layout>
    <h1>Training SQL Queries</h1>

    <form id="query-form">
        @csrf <!-- CSRF-токен для защиты от атак -->
        <textarea id="query" name="query" rows="4" cols="50" placeholder="Введите SQL-запрос"></textarea>
        <br>
        <button type="submit">Выполнить запрос</button>
    </form>

    <h2>Результат:</h2>
    <pre id="result"></pre>

    <script>
        document.getElementById('query-form').addEventListener('submit', async function (e) {
            e.preventDefault(); // Предотвращаем стандартное поведение формы

            const query = document.getElementById('query').value;

            const response = await fetch('/training/execute-query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF-токен
                },
                body: JSON.stringify({ query })
            });

            const data = await response.json();

            if (data.success) {
                document.getElementById('result').textContent = JSON.stringify(data.results, null, 2);
            } else {
                document.getElementById('result').textContent = 'Ошибка: ' + data.error;
            }
        });
    </script>
</x-layout>