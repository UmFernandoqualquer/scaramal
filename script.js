document.addEventListener("DOMContentLoaded", carregarTabela);

document.getElementById("produtoForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const nome = document.getElementById("nome").value;
    const preco = document.getElementById("preco").value;

    fetch("server.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=insert&nome=${encodeURIComponent(nome)}&preco=${encodeURIComponent(preco)}`
    }).then(() => {
        document.getElementById("nome").value = "";
        document.getElementById("preco").value = "";
        carregarTabela();
    });
});

function carregarTabela() {
    fetch("server.php?action=select")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tabelaBody");
            tbody.innerHTML = "";
            data.forEach(produto => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${produto.id}</td>
                    <td>${produto.nome}</td>
                    <td>R$ ${produto.preco}</td>
                    <td><button onclick="deletar(${produto.id})">Excluir</button></td>
                `;
                tbody.appendChild(row);
            });
        });
}

function deletar(id) {
    fetch("server.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=delete&id=${id}`
    }).then(() => carregarTabela());
}
