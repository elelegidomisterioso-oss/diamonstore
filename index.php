<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIAMOND STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@900&display=swap');
        body { background: #020617; color: white; font-family: sans-serif; }
        .font-gamer { font-family: 'Orbitron', sans-serif; }
        .card { background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 20px; transition: 0.3s; }
        .card:hover { border-color: #facc15; }
    </style>
</head>
<body class="p-6">
    <div class="max-w-4xl mx-auto">
        <header class="text-center mb-10">
            <h1 class="font-gamer text-3xl text-yellow-400">DIAMOND STORE</h1>
        </header>

        <div class="bg-slate-900 p-6 rounded-3xl border border-white/10 mb-8">
            <input id="player-id" type="number" placeholder="TU ID DE JUGADOR" class="w-full bg-black/40 p-4 rounded-xl text-xl font-bold text-yellow-500 outline-none border border-white/5">
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="card p-6 flex justify-between items-center cursor-pointer" onclick="pagar('100')">
                <div>
                    <h3 class="text-2xl font-black">700 💎</h3>
                    <p class="text-yellow-500 font-bold">$100 MXN</p>
                </div>
                <button class="bg-blue-600 px-6 py-2 rounded-lg font-bold">COMPRAR</button>
            </div>
            
            <div class="card p-6 flex justify-between items-center cursor-pointer" onclick="pagar('200')">
                <div>
                    <h3 class="text-2xl font-black">1,500 💎</h3>
                    <p class="text-yellow-500 font-bold">$200 MXN</p>
                </div>
                <button class="bg-blue-600 px-6 py-2 rounded-lg font-bold">COMPRAR</button>
            </div>
        </div>

        <p id="status" class="mt-8 text-center text-sm text-slate-500 font-bold italic uppercase"></p>
    </div>

    <script>
        function pagar(monto) {
            const id = document.getElementById('player-id').value;
            if(!id) { alert("Pon tu ID"); return; }
            
            const status = document.getElementById('status');
            status.innerText = "Cargando ticket de OXXO...";

            // Enviamos los datos directamente al PHP
            const formData = new FormData();
            formData.append('monto', monto);
            formData.append('player_id', id);

            fetch('pagar.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.external_resource_url) {
                    window.location.href = data.external_resource_url;
                } else {
                    alert("Error: El servidor no respondió correctamente.");
                    status.innerText = "Error en el servidor";
                }
            })
            .catch(err => {
                alert("Error real: + err");
                status.innerText = "Error de conexión";
            });
        }
    </script>
</body>
</html>
