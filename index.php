<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    min-height: 100vh;
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
}

/* NAVBAR */
.nav {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px 40px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    background-color: #ffffffaa;
    backdrop-filter: blur(6px);
    border-radius: 0 0 12px 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    gap: 30px;
}

.nav a {
    color: #0d47a1;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.nav a:hover {
    color: #1565c0;
    transform: scale(1.05);
    text-decoration: underline;
}

/* INTRO */
.message {
    padding: 100px 40px 40px;
    text-align: left;
    max-width: 700px;
    margin: 0 auto;
}

.message h1 {
    font-size: 3.5rem;
    color: #0d47a1;
    font-weight: 800;
    line-height: 1.2;
}

/* ANIMAÇÃO IMAGEM */
#img1 {
    margin: 40px auto;
    display: block;
    width: 90%;
    max-width: 700px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    opacity: 0;
    transform: translateY(100px);
    transition: opacity 1.2s ease, transform 1.2s ease;
}

body.loaded #img1 {
    opacity: 1;
    transform: translateY(0);
}

h2 {
    text-align: center;
    color: #0d47a1;
    font-size: 1rem;
    margin-top: 20px;
    margin-bottom: 60px;
}

/* ==== SEÇÃO FITNESS ==== */
#fitnessZone {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, #bbdefb, #90caf9);
    border-radius: 30px 30px 0 0;
    box-shadow: 0 -4px 10px rgba(0,0,0,0.1);
}

#fitnessZone h2 {
    font-size: 2rem;
    color: #0d47a1;
    margin-bottom: 30px;
}

/* Motivação */
#motivacao {
    font-size: 1.3rem;
    margin-bottom: 30px;
    font-style: italic;
    color: #1565c0;
    transition: opacity 0.6s ease;
}

/* Simulador de treino */
#gymMan {
    width: 100px;
    height: 180px;
    background: linear-gradient(to top, #2196f3, #64b5f6);
    border-radius: 20px;
    margin: 0 auto 30px;
    position: relative;
    animation: levantar 2s infinite;
}

#gymMan::before, #gymMan::after {
    content: "";
    position: absolute;
    width: 15px;
    height: 70px;
    background: #1e88e5;
    border-radius: 8px;
    top: 40px;
}

#gymMan::before { left: -20px; animation: bracoEsq 2s infinite; }
#gymMan::after { right: -20px; animation: bracoDir 2s infinite; }

@keyframes levantar {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes bracoEsq {
    0%, 100% { transform: rotate(0deg); }
    50% { transform: rotate(30deg); }
}

@keyframes bracoDir {
    0%, 100% { transform: rotate(0deg); }
    50% { transform: rotate(-30deg); }
}

/* Calculadora */
#calcContainer {
    background: #fff;
    padding: 25px;
    margin: 30px auto;
    max-width: 400px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

#calcContainer input, #calcContainer select, #calcContainer button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

#calcContainer button {
    background-color: #0d47a1;
    color: #fff;
    cursor: pointer;
    border: none;
    transition: 0.3s;
}

#calcContainer button:hover {
    background-color: #1565c0;
}

#resultado {
    margin-top: 10px;
    font-weight: bold;
    color: #0d47a1;
}

/* Responsivo */
@media (max-width: 768px) {
    .message h1 { font-size: 2.4rem; }
}
    </style>
</head>
<body>
    <div class="nav">
        <a href="login.php">👤Login</a>
    </div>

    <div class="message">
        <h1>Bem-vindo <br>ao <br>Saiba mais sobre musculação</h1>
    </div>

    <img id="img1" src="img/foto1.gif" alt="Pessoa treinando musculação">

    <!-- 🔥 SEÇÃO FITNESS INTERATIVA -->
    <section id="fitnessZone">
        <h2>💪 Zona Fitness Interativa</h2>
        <div id="motivacao">"A dor de hoje é o corpo forte de amanhã!"</div>

        <div id="gymMan"></div>

        <div id="calcContainer">
            <h3>🔥 Calculadora de Calorias</h3>
            <input type="number" id="peso" placeholder="Peso (kg)">
            <input type="number" id="altura" placeholder="Altura (cm)">
            <input type="number" id="idade" placeholder="Idade">
            <select id="sexo">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
            </select>
            <button onclick="calcularBMR()">Calcular</button>
            <div id="resultado"></div>
        </div>
    </section>

    <script>
    // Animação inicial
    window.addEventListener("load", () => {
        document.body.classList.add("loaded");
        novaMotivacao();
    });

    // Frases motivacionais aleatórias
    const frases = [
        "Sem dor, sem ganho!",
        "A disciplina supera a motivação!",
        "Você é mais forte do que pensa!",
        "Cada treino é uma vitória!",
        "Seu corpo alcança o que sua mente acredita!",
        "Transforme suor em conquista!",
        "Persistência constrói resultados!"
    ];

    function novaMotivacao() {
        const el = document.getElementById("motivacao");
        const nova = frases[Math.floor(Math.random() * frases.length)];
        el.style.opacity = 0;
        setTimeout(() => {
            el.textContent = `"${nova}"`;
            el.style.opacity = 1;
        }, 500);
        setInterval(() => {
            const nova = frases[Math.floor(Math.random() * frases.length)];
            el.style.opacity = 0;
            setTimeout(() => {
                el.textContent = `"${nova}"`;
                el.style.opacity = 1;
            }, 500);
        }, 7000);
    }

    // Calculadora BMR (Taxa metabólica basal)
    function calcularBMR() {
        const peso = parseFloat(document.getElementById("peso").value);
        const altura = parseFloat(document.getElementById("altura").value);
        const idade = parseFloat(document.getElementById("idade").value);
        const sexo = document.getElementById("sexo").value;
        const res = document.getElementById("resultado");

        if (!peso || !altura || !idade) {
            res.innerHTML = "⚠️ Preencha todos os campos!";
            return;
        }

        let bmr;
        if (sexo === "masculino") {
            bmr = 88.36 + (13.4 * peso) + (4.8 * altura) - (5.7 * idade);
        } else {
            bmr = 447.6 + (9.2 * peso) + (3.1 * altura) - (4.3 * idade);
        }

        res.innerHTML = `🔥 Seu gasto calórico diário aproximado é <strong>${bmr.toFixed(0)} kcal</strong>.`;
    }
    </script>
</body>
</html>
