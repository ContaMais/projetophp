(function () {
    function criarBrilhosAleatorios() {
        let container = document.getElementById("glow-container");
        if (!container) {
            container = document.createElement("div");
            container.id = "glow-container";
            document.body.prepend(container);
        } else {
            container.innerHTML = "";
        }

        // Gradientes luminosos com centros de alta densidade de cor
        const esquemasDeCor = [
            "radial-gradient(circle, rgba(147, 51, 234, 0.85) 0%, rgba(124, 58, 237, 0.45) 45%, transparent 70%)", // Roxo vivo
            "radial-gradient(circle, rgba(37, 99, 235, 0.9) 0%, rgba(59, 130, 246, 0.45) 45%, transparent 70%)",   // Azul royal
            "radial-gradient(circle, rgba(168, 85, 247, 0.8) 0%, rgba(99, 102, 241, 0.4) 45%, transparent 70%)",  // Violeta neon
            "radial-gradient(circle, rgba(6, 182, 212, 0.75) 0%, rgba(14, 165, 233, 0.4) 45%, transparent 70%)"    // Ciano elétrico
        ];

        const totalOrbes = 3; // 3 orbes grandes ocupam a tela com harmonia sem sobrecarregar
        const posicoes = [];
        const distanciaMinima = 40; // Distância mínima de 40% entre centros para nunca colidirem

        for (let i = 0; i < totalOrbes; i++) {
            let x = 0, y = 0, tentativas = 0, valido = false;

            while (!valido && tentativas < 80) {
                x = Math.floor(Math.random() * 75) + 5;  // 5% a 80% do ecrã
                y = Math.floor(Math.random() * 75) + 5;  // 5% a 80% do ecrã
                valido = true;

                for (const pos of posicoes) {
                    const dx = pos.x - x;
                    const dy = pos.y - y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < distanciaMinima) {
                        valido = false;
                        break;
                    }
                }
                tentativas++;
            }

            posicoes.push({ x, y });

            const orb = document.createElement("div");
            orb.className = "glow-orb";

            // Dimensões grandes: entre 480px e 640px
            const tamanho = Math.floor(Math.random() * 160) + 480;
            const gradiente = esquemasDeCor[i % esquemasDeCor.length];
            const duracao = (Math.random() * 6 + 16).toFixed(1); // 16s a 22s de animação fluida
            const atraso = (Math.random() * -12).toFixed(1);

            orb.style.width = `${tamanho}px`;
            orb.style.height = `${tamanho}px`;
            orb.style.background = gradiente;
            orb.style.left = `calc(${x}vw - ${tamanho / 2}px)`;
            orb.style.top = `calc(${y}vh - ${tamanho / 2}px)`;
            orb.style.animationDuration = `${duracao}s`;
            orb.style.animationDelay = `${atraso}s`;

            container.appendChild(orb);
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", criarBrilhosAleatorios);
    } else {
        criarBrilhosAleatorios();
    }
})();