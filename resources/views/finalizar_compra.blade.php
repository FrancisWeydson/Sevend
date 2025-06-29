<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padaria Sevend 4 - Finalizar Compra</title>
    <link rel="stylesheet" href="{{url('css/finalizar.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
</head>
<body>
    <div class="container">
        <div class="checkout-header">
            <img src="{{url('img/LOGO.png')}}" alt="Padaria Doce Sabor Logo" onerror="this.src='/api/placeholder/150/80'">
            <h1>Finalizar Compra</h1>
        </div>

        <div class="checkout-wrapper">
            <div class="checkout-form">
                <div class="section">
                    <div class="section-title">
                        🏠 Endereço de entrega
                        <button class="edit-button" onclick="toggleSection('address')">Mudar</button>
                    </div>
                    <div id="address-summary">
                        <p><strong>Endereço:</strong> {{ $cliente->logra_cliente }}, {{ $cliente->numLogra_cliente }} - {{ $cliente->bairro_cliente }}, {{ $cliente->cidade_cliente }} - {{ $cliente->uf_cliente }}, {{ $cliente->cep_cliente }}</p>
                    </div>
                    <div id="address-form" style="display: none;">
                        <input type="hidden" id="id_cliente" value="{{ $cliente->id_cliente }}">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" data-mask="00000-000" data-mask-selectonfocus="true" class="form-control" value="{{ $cliente->cep_cliente }}" maxlength="9" onblur="pesquisacep(this.value);">
                        </div>
                        <div class="address-details">
                            <div class="form-group">
                                <label for="num">Numero</label>
                                <input type="text" id="num" name="num" class="form-control" value="{{ $cliente->numLogra_cliente }}">
                            </div>
                            <div class="form-group">
                                <label for="comp">Complemento:</label>
                                <input type="text" id="comp" name="comp" class="form-control" value="{{ $cliente->complemento_cliente }}">
                            </div>
                            <div class="form-group">
                                <label for="logra">Endereço</label>
                                <input type="text" id="logra" name="logra" class="form-control" value="{{ $cliente->logra_cliente }}">
                            </div>
                            <div class="form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" id="bairro" name="bairro" class="form-control" value="{{ $cliente->bairro_cliente }}">
                            </div>
                            <div class="form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" name="cidade" class="form-control" value="{{ $cliente->cidade_cliente }}">
                            </div>
                            <div class="form-group">
                                <label for="uf">Estado</label>
                                <input type="text" id="uf" name="uf" class="form-control" value="{{ $cliente->uf_cliente }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn-salvar-end" >Salvar</button>
                        </div>
                    </div>
                    <div class="delivery-info">
                        <span>Entrega normal: 3h</span>
                        <span>Prazo de entrega: até 3 horas </span>
                    </div>
                </div>


                <div class="section">
                    <div class="section-title">
                        💳 Pagamento
                        <button class="edit-button" onclick="toggleSection('payment')">Mudar</button>
                    </div>
                    <div id="payment-summary">
                        <p><strong>Método:</strong> Pix</p>
                        <p><strong>Cupom:</strong> Nenhum</p>
                    </div>
                    <div id="payment-form" style="display: none;">
                        <p class="payment-message">Você tem um cupom de desconto? Digite-o agora</p>
                        <div class="form-group">
                            <label for="coupon">Cupom</label>
                            <input type="text" id="coupon" class="form-control" placeholder="Digite o código do cupom">
                        </div>
                        <p class="payment-message">Como você deseja pagar?</p>
                        <div class="opcoes selected">
                            <span>Pix</span>
                        </div>
                        <div class="opcoes">
                            <span>Cartão de crédito</span>
                        </div>
                        <div class="opcoes">
                            <span>Boleto bancário</span>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn-salvar-pay" >Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">🧾 Resumo dos Produtos</div>
                    @foreach($carrinho as $produto)
                        <div class="product-card">
                            <img src="{{ asset($produto->img_produto) }}">
                            <div class="product-details">
                                <p class="product-title">{{ $produto->nome_produto }}</p>
                                <p class="product-price">R${{ $produto->preco_total_carrinho }}</p>
                                <p class="product-qty">Quantidade: {{ $produto->qntd_carrinho }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

            <div class="checkout-summary">
                <div class="summary-title">Resumo do pedido</div>
                @foreach($carrinho as $resumo)
                    <div class="item">
                        <span>{{ $resumo->nome_produto }} ({{ $resumo->qntd_carrinho }} unidade(s))</span>
                        <span>R$ {{ $resumo->preco_total_carrinho }}</span>
                    </div>
                @endforeach

                <div class="summary-subtotal">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>R$ {{ $total }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Frete</span>
                        <span>R$ 00,00</span>
                    </div>
                    <div class="summary-row">
                        <span>Desconto</span>
                        <span>R$ 00,00</span>
                    </div>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <span>R${{ $total }}</span>
                </div>

                <form action="{{ route('sevend.pedido.store', Auth::guard('web')->user()->id_cliente) }}" method="get">
                    <button type="submit" class="checkout-button">Finalizar compra</button>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.opcoes').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.opcoes').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                this.classList.add('selected');
            });
        });

        function toggleSection(section) {
            const summary = document.getElementById(section + '-summary');
            const form = document.getElementById(section + '-form');

            if (form.style.display === 'none') {
                form.style.display = 'block';
                summary.style.display = 'none';
            } else {
                form.style.display = 'none';
                summary.style.display = 'block';
            }
        }
    </script>
    <script>
        
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('logra').value=("");
                document.getElementById('bairro').value=("");
                document.getElementById('cidade').value=("");
                document.getElementById('uf').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('logra').value=(conteudo.logradouro);
                document.getElementById('bairro').value=(conteudo.bairro);
                document.getElementById('cidade').value=(conteudo.localidade);
                document.getElementById('uf').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
            
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('logra').value="...";
                    document.getElementById('bairro').value="...";
                    document.getElementById('cidade').value="...";
                    document.getElementById('uf').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    //alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

    </script>
    <script>
        $(".btn-salvar-end").click(function () {
            let cliente = $("#id_cliente").val();
            let logra = $("#logra").val();
            let num = $("#num").val();
            let cep = $("#cep").val();
            let bairro = $("#bairro").val();
            let cidade = $("#cidade").val();
            let uf = $("#uf").val();
            let complemento = $("#comp").val();

            $.ajax({
                url: `/api/cliente/edit/${cliente}`,
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    logra: logra,
                    num: num,
                    cep: cep,
                    bairro: bairro,
                    cidade: cidade,
                    uf: uf,
                    complemento: complemento 
                },
                success: function (response) {
                    $("#address-summary").html(
                        `<p><strong>Endereço:</strong> ${logra}, ${num} - ${bairro}, ${cidade} - ${uf}, ${cep}</p>`
                    );

                    // Esconde o formulário e exibe o resumo
                    $("#address-form").hide();
                    $("#address-summary").show();
                },
                error: function (xhr, status, error) {
                    console.error('Erro:', xhr.responseText);
                    alert('Erro ao adicionar o produto ao carrinho. Verifique o console para mais detalhes.');
                }
            });
        });
    </script>
</body>
</html>