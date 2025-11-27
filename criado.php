<?php
session_start();

// Protege a página – só acessível se estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Página Inicial – Treinos Acessíveis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
    /* Reset básico */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: linear-gradient(135deg, #d4f1e4, #bae8e8);
        color: #024959;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        line-height: 1.6;
        font-size: 18px;
    }

    .nav {
        display: flex;
        justify-content: flex-end;
        padding: 20px 40px;
        background-color: #8ecae6;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        gap: 20px;
    }

    .nav a {
        color: #023047;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: bold;
        padding: 8px 16px;
        border-radius: 6px;
        transition: background 0.3s, color 0.3s;
    }

    .nav a:hover, .nav a:focus {
        background-color: #219ebc;
        color: #fff;
    }

    .container {
        flex: 1;
        max-width: 900px;
        margin: 40px auto;
        padding: 20px 30px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .container.loaded {
        opacity: 1;
        transform: translateY(0);
    }

    h1, h2 {
        color: #023047;
        margin-bottom: 16px;
    }

    h1 {
        font-size: 2.8rem;
        text-align: center;
    }

    h2 {
        font-size: 2rem;
        margin-top: 30px;
    }

    p {
        margin-bottom: 20px;
        color: #034f84;
    }

    .container img {
        width: 100%;
        max-width: 800px;
        border-radius: 12px;
        display: block;
        margin: 20px auto;
    }

    /* Estilo do quiz */
    #quiz {
        margin-top: 40px;
        padding: 20px;
        background-color: #e6f4f1;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .question {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .options button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background-color: #219ebc;
        color: white;
        transition: background 0.3s;
    }

    .options button:hover {
        background-color: #118ab2;
    }

    #nextBtn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #219ebc;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    #nextBtn:hover {
        background-color: #118ab2;
    }

    #score {
        font-size: 1.3rem;
        font-weight: bold;
        color: #023047;
        margin-top: 20px;
    }

    /* Responsivo */
    @media (max-width: 768px) {
        h1 { font-size: 2.2rem; }
        h2 { font-size: 1.7rem; }
    }
    </style>
</head>
<body>
    <div class="nav">
        <a href="sair.php">Sair</a>
    </div>

    <div class="container" id="mainContainer">
        <h1>Bem-vindo à sua jornada esportiva</h1>

        <!-- Sobre -->
        <section id="about">
            <h2>Sobre</h2>
            <p>O esporte é para todos — independentemente de limitações físicas, motoras, sensoriais ou cognitivas...</p>
        </section>

        <!-- Conteúdo -->
        <section id="content">
            
            <img src="img/foto.jpg" alt="Pessoa praticando atividade física " />
        </section>

        <!-- Soluções de Adaptação -->
        <section id="adaptations">
            <h2>Adaptações e Inovações</h2>
            <p>Cada pessoa tem um jeito único de se exercitar...</p>
        </section>

        <!-- 🎯 QUIZ FITNESS -->
        <section id="quiz">
            <h2>🏋️ Quiz Fitness</h2>
            <div id="quizContainer">
                <div id="questionContainer"></div>
                <div id="optionsContainer" class="options"></div>
                <button id="nextBtn" style="display:none;">Próxima</button>
                <div id="score"></div>
            </div>
        </section>

        <!-- Contato -->
        <section id="contact">
            <h2>Contato</h2>
            <ul>
                <li>📞 +55 14 99845-6446</li>
                <li>📧 victorvalentingc@gmail.com</li>
                <li>📸 <a href="https://instagram.com/seu_instagram" target="_blank">@virtuu_y</a></li>
            </ul>
        </section>
    </div>

    <script>
    // Animação de carregamento
    window.addEventListener("load", () => {
        const container = document.getElementById('mainContainer');
        container.classList.add('loaded');
        container.setAttribute('tabindex', '-1');
        container.focus();
    });

    // === QUIZ FITNESS ===
    const questions = [
        {
            question: "Qual músculo principal é trabalhado no agachamento?",
            options: ["Peitoral", "Quadríceps", "Bíceps", "Deltoide"],
            answer: "Quadríceps"
        },
        {
            question: "Qual é o nome da dieta rica em proteínas e com baixo consumo de carboidratos?",
            options: ["Dieta Mediterrânea", "Dieta Vegana", "Dieta Cetogênica", "Dieta Detox"],
            answer: "Dieta Cetogênica"
        },
        {
            question: "Qual dessas máquinas é usada para o exercício de puxada para costas?",
            options: ["Leg Press", "Crossover", "Pulley", "Smith Machine"],
            answer: "Pulley"
        },
        {
            question: "Quem é conhecido como o 'pai do fisiculturismo moderno'?",
            options: ["Arnold Schwarzenegger", "Ronnie Coleman", "Eugene Sandow", "Jay Cutler"],
            answer: "Eugene Sandow"
        },
        {
            question: "Qual suplemento é mais usado para ganho de massa muscular?",
            options: ["Creatina", "Ômega 3", "Cafeína", "Vitamina C"],
            answer: "Creatina"
        }
    ];

    let currentQuestion = 0;
    let score = 0;

    const questionContainer = document.getElementById("questionContainer");
    const optionsContainer = document.getElementById("optionsContainer");
    const nextBtn = document.getElementById("nextBtn");
    const scoreContainer = document.getElementById("score");

    function showQuestion() {
        const q = questions[currentQuestion];
        questionContainer.innerHTML = `<p class="question">${q.question}</p>`;
        optionsContainer.innerHTML = "";
        q.options.forEach(opt => {
            const btn = document.createElement("button");
            btn.textContent = opt;
            btn.onclick = () => selectAnswer(opt);
            optionsContainer.appendChild(btn);
        });
    }

    function selectAnswer(selected) {
        const correct = questions[currentQuestion].answer;
        if (selected === correct) {
            score++;
        }
        Array.from(optionsContainer.children).forEach(btn => {
            btn.disabled = true;
            if (btn.textContent === correct) {
                btn.style.backgroundColor = "#4caf50";
            } else if (btn.textContent === selected) {
                btn.style.backgroundColor = "#f44336";
            }
        });
        nextBtn.style.display = "block";
    }

    nextBtn.addEventListener("click", () => {
        currentQuestion++;
        if (currentQuestion < questions.length) {
            nextBtn.style.display = "none";
            showQuestion();
        } else {
            showScore();
        }
    });

    function showScore() {
        questionContainer.innerHTML = "";
        optionsContainer.innerHTML = "";
        nextBtn.style.display = "none";
        scoreContainer.innerHTML = `🎯 Você acertou ${score} de ${questions.length} perguntas!`;
    }

    // Iniciar o quiz
    showQuestion();
    </script>
</body>
</html>
