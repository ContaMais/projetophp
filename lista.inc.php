<?php
$base = mysqli_connect('localhost', 'root', '', 'meu_projeto') or die("erro de conexão");
mysqli_set_charset($base, 'utf8');

$regra1 = "SELECT * FROM cadastro WHERE estado = 'SP' ORDER BY nome";
$res = mysqli_query($base, $regra1);

echo "<h2> Cadastros de usuários do estado de SP </h2>
<table>
<tr>
  <td>Nome</td>
  <td>E-mail</td>
  <td>Cidade</td>
  <td>Comentário</td>
  <td></td>
  <td></td>
</tr>";

while ($mostrar = mysqli_fetch_array($res)) {
    $nomeSafe = htmlspecialchars($mostrar['nome'], ENT_QUOTES);
    echo "<tr>
      <td>" . $mostrar['nome'] . "</td>
      <td>" . $mostrar['email'] . "</td>
      <td>" . $mostrar['cidade'] . "</td>
      <td>" . $mostrar['comentarios'] . "</td>
      <td><a href='apagar.php?a=" . urlencode($mostrar['nome']) . "' onclick='confirmarExclusao(event, \"" . $nomeSafe . "\", this.href)'>apagar</a></td>
      <td><a href='editar.php?a=" . urlencode($mostrar['nome']) . "'>editar</a></td>
    </tr>";
}
echo "</table>";

$regra2 = "SELECT * FROM cadastro WHERE estado <> 'SP' ORDER BY nome";
$res2 = mysqli_query($base, $regra2);

echo "<h2> Cadastros de usuários de Outros Estados </h2>
<table>
<tr>
  <td>Nome</td>
  <td>E-mail</td>
  <td>Cidade</td>
  <td>Comentário</td>
  <td></td>
  <td></td>
</tr>";

while ($mostrar = mysqli_fetch_array($res2)) {
    $nomeSafe = htmlspecialchars($mostrar['nome'], ENT_QUOTES);
    echo "<tr>
      <td>" . $mostrar['nome'] . "</td>
      <td>" . $mostrar['email'] . "</td>
      <td>" . $mostrar['cidade'] . "</td>
      <td>" . $mostrar['comentarios'] . "</td>
      <td><a href='apagar.php?a=" . urlencode($mostrar['nome']) . "' onclick='confirmarExclusao(event, \"" . $nomeSafe . "\", this.href)'>apagar</a></td>
      <td><a href='editar.php?a=" . urlencode($mostrar['nome']) . "'>editar</a></td>
    </tr>";
}
echo "</table>";
?>

<div id="modalOverlay" class="modal-overlay">
  <div class="modal-box">
    <div id="modalFaseConfirmar">
      <h3 class="modal-title">Confirmar exclusão</h3>
      <p class="modal-text">Tem certeza de que deseja excluir o cadastro de <strong id="modalNomeUser"></strong>?</p>
      <div class="modal-buttons">
        <button type="button" class="btn-cancelar" onclick="fecharModal()">Cancelar</button>
        <button type="button" class="btn-apagar" onclick="iniciarContagemExclusao()">Sim, apagar</button>
      </div>
    </div>

    <div id="modalFaseDesfazer" style="display: none;">
      <h3 class="modal-title">A apagar registo...</h3>
      <p class="modal-text">A excluir o cadastro em <span id="contadorSegundos">3</span>s.</p>
      <div class="progress-bar-bg">
        <div id="progressBar" class="progress-bar-fill"></div>
      </div>
      <div class="modal-buttons" style="justify-content: center; margin-top: 15px;">
        <button type="button" class="btn-desfazer" onclick="cancelarExclusao()">Desfazer ação</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Sorteia posições diferentes para os orbes a cada atualização de página
window.addEventListener('DOMContentLoaded', () => {
    const estiloDinamico = document.createElement('style');
    
    // Gera coordenadas aleatórias para o Orbe 1 (Roxo) e Orbe 2 (Azul) mantendo distância
    const x1 = Math.floor(Math.random() * 35) - 10; // entre -10% e 25% da tela
    const y1 = Math.floor(Math.random() * 35) - 10;
    
    const x2 = Math.floor(Math.random() * 35) + 55; // entre 55% e 90% da tela (lado oposto)
    const y2 = Math.floor(Math.random() * 35) + 55;

    estiloDinamico.innerHTML = `
        body::before {
            top: ${y1}vh !important;
            left: ${x1}vw !important;
        }
        body::after {
            top: ${y2}vh !important;
            left: ${x2}vw !important;
            bottom: auto !important;
            right: auto !important;
        }
    `;
    document.head.appendChild(estiloDinamico);
});

let urlParaExcluir = '';
let timeoutId = null;

function confirmarExclusao(event, nome, url) {
    event.preventDefault();
    urlParaExcluir = url;
    document.getElementById('modalNomeUser').innerText = nome;
    
    document.getElementById('modalFaseConfirmar').style.display = 'block';
    document.getElementById('modalFaseDesfazer').style.display = 'none';
    document.getElementById('modalOverlay').classList.add('active');
}

function fecharModal() {
    document.getElementById('modalOverlay').classList.remove('active');
    urlParaExcluir = '';
}

function iniciarContagemExclusao() {
    document.getElementById('modalFaseConfirmar').style.display = 'none';
    document.getElementById('modalFaseDesfazer').style.display = 'block';
    
    const progressBar = document.getElementById('progressBar');
    progressBar.style.transition = 'none';
    progressBar.style.width = '100%';
    
    setTimeout(() => {
        progressBar.style.transition = 'width 3s linear';
        progressBar.style.width = '0%';
    }, 50);

    let tempoRestante = 3;
    const contadorElem = document.getElementById('contadorSegundos');
    contadorElem.innerText = tempoRestante;
    
    const intervalContador = setInterval(() => {
        tempoRestante--;
        if (tempoRestante >= 1) {
            contadorElem.innerText = tempoRestante;
        } else {
            clearInterval(intervalContador);
        }
    }, 1000);

    timeoutId = setTimeout(() => {
        window.location.href = urlParaExcluir;
    }, 3000);
}

function cancelarExclusao() {
    clearTimeout(timeoutId);
    fecharModal();
}
</script>