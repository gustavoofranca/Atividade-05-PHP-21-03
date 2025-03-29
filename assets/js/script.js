/**
 * Script principal para o sistema Gusta's Burguer
 */

document.addEventListener('DOMContentLoaded', function () {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Inicializar popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    // Função para confirmar exclusão
    window.confirmarExclusao = function (mensagem, url) {
        if (confirm(mensagem)) {
            window.location.href = url;
        }
        return false;
    }

    // Função para atualizar quantidade de itens no pedido
    window.atualizarQuantidade = function (input, preco) {
        var quantidade = parseInt(input.value);
        var subtotalElement = document.getElementById('subtotal-' + input.dataset.id);

        if (quantidade < 1) {
            input.value = 1;
            quantidade = 1;
        }

        var subtotal = quantidade * preco;
        subtotalElement.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');

        // Recalcular total do pedido
        calcularTotalPedido();
    }

    // Função para calcular o total do pedido
    function calcularTotalPedido() {
        var subtotais = document.querySelectorAll('[id^="subtotal-"]');
        var total = 0;

        subtotais.forEach(function (element) {
            var valor = element.textContent.replace('R$ ', '').replace(',', '.');
            total += parseFloat(valor);
        });

        var totalElement = document.getElementById('total-pedido');
        if (totalElement) {
            totalElement.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
        }
    }
});