<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Padaria</title>
    <link rel="stylesheet" href="{{url('css/dash.css')}}">
    <script src="{{url('js/echart.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.6.0/dist/echarts.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        /* Sidebar (já existe na sua navbar-admin) */
        
        .main-content {
            margin-left: 250px; /* Ajuste conforme sua sidebar */
            padding: 20px;
            width: calc(100% - 250px);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .kpi-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: center;
        }
        
        .kpi-value {
            font-size: 20px;
            font-weight: bold;
            color: #5D4037;
            margin: 5px 0;
        }
        
        .kpi-label {
            font-size: 12px;
            color: #8D6E63;
        }
        
        .chart-container {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 15px;
        }
        
        .chart-title {
            font-size: 14px;
            margin-bottom: 10px;
            color: #5D4037;
            font-weight: 600;
        }
        
        canvas {
            max-height: 200px !important;
        }

      

        .recent-registrations-table {
            overflow-x: auto;
        }

        .recent-registrations-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .recent-registrations-table th {
            background-color: #f5f5f5;
            color: #5D4037;
            padding: 8px 12px;
            text-align: left;
            font-size: 13px;
        }

        .recent-registrations-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        .recent-registrations-table tr:hover {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            color: #8D6E63;
            padding: 15px;
            font-style: italic;
        }
        .titu{
        margin-left: 210px;
            
            
        }
        
    </style>
</head>
<body>
    @include('area_admin.componentes.navbar-admin')

    <div class="main-content">
        <div class="titu">
        <h1 style="font-size: 30px; color: #5D4037; margin-bottom: 15px; ">Dashboard Padaria</h1>
        </div>
        
        <!-- KPIs Compactos -->
        <div class="dashboard-grid">
            <div class="kpi-card">
                <i class="fas fa-user" style="color: #8D6E63;"></i>
                <div class="kpi-value">{{ $totalClientes }}</div>
                <div class="kpi-label">Clientes cadastrados</div>
            </div>
            <div class="kpi-card">
                <i class="fas fa-boxes" style="color: #8D6E63;"></i>
                <div class="kpi-value">{{ $totalProdutos }}</div>
                <div class="kpi-label">Produtos Cadastrados</div>
            </div>
            <div class="kpi-card">
                <i class="fas fa-bread-slice" style="color: #8D6E63;"></i>
                <div class="kpi-value">{{ $produtoMaisProcurado->nome_produto }}</div>
                <div class="kpi-label">Top Produto Pesquisado</div>
            </div>
          
        </div>

        
        <!-- Gráficos Compactos -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            
            <div class="chart-container">
                <div class="chart-title">Produtos por Categoria</div>
                <div id="testegra" style="width: 600px; height:200px"></div>
                <!--canvas id="categoryChart"></!--canvas-->
            </div>
            <div class="chart-container">
                <div class="chart-title">Top 5 Produtos Pesquisados</div>
                <div id="testegra2" style="width: 600px; height:200px"></div>
                <!--canvas   id="topProductsChart"></!--canvas-->
            </div>
            <div class="chart-container" style="height: 300px;">
                <div id="testegra1" style="width: 100%; height: 200px;"></div>
            </div>
        </div>
        
     <div class="chart-container">
    <div class="chart-title">Últimos 5 clientes cadastrados</div>
    <div class="recent-registrations-table">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data Cadastro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimosClientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome_cliente }}</td>
                        <td>{{ $cliente->email_cliente }}</td>
                        <td>{{ \Carbon\Carbon::parse($cliente->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="no-data">Nenhum cliente cadastrado recentemente</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    </div>

    <script>
    // Cores temáticas de padaria


    //grafico correto antigo 
        /*
    // Dados das categorias do banco de dados
    const categorias = @json($categorias);
    

    // Gráfico de Categorias (Dinâmico)

    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: categorias.map(c => c.nome_categoria),
            datasets: [{
                data: categorias.map(c => c.total),
                backgroundColor: padariaColors,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });
    */
   const padariaColors = [
        '#D7CCC8', // creme
        '#A1887F', // marrom claro
        '#8D6E63', // marrom médio
        '#5D4037', // marrom escuro
        '#FBE9E7', // rosado
        '#FFCCBC', // laranja claro
    ];

    //grafico novo 
    const categorias = @json($categorias);

    // Mapeando os dados para ECharts
    const dadosECharts = categorias.map(c => ({
        value: c.total,
        name: c.nome_categoria
    }));

    // Inicializa o gráfico
    var chartDom = document.getElementById('testegra');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c} ({d}%)'
        },
        legend: {
            top: '90%',
            textStyle: {
                color: '#5D4037',
                fontSize: 12
            },
            itemGap: 12,
        },
        color: padariaColors,
        series: [

            
            {
                padding:10,
                name: 'Categorias',
                type: 'pie',
                radius: ['55%', '85%'],
                center: ['50%', '45%'],
                avoidLabelOverlap: false,
                padAngle: 3,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2,
                    shadowBlur: 5,
                    shadowOffsetX: 2,
                    shadowColor: 'rgba(0, 0, 0, 0.1)',
                },
                itemGap: 12,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 18,
                        fontWeight: 'bold',
                        color: '#5D4037'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: dadosECharts
            }
        ]
    };

    option && myChart.setOption(option);

    /*
    // Dados dos produtos mais pesquisados
    const produtosMaisProcurados = @json($produtosMaisProcurados);
    const labelsTopProdutos = produtosMaisProcurados.map(p => p.nome_produto);
    const dataTopProdutos = produtosMaisProcurados.map(p => p.total_pesquisas);

    // Gráfico de produtos mais pesquisados
    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: labelsTopProdutos,
            datasets: [{
                data: dataTopProdutos,
                backgroundColor: '#8D6E63'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });

    // Tratamento para o produto mais procurado (caso não exista)
    const produtoMaisProcurado = @json($produtoMaisProcurado);
    if (produtoMaisProcurado) {
        document.querySelector('.kpi-value:last-child').textContent = produtoMaisProcurado.nome_produto;
    }
    */
</script>

<script>
    const catVendida = @json($categoriasVendidas);
 


    var chartDom = document.getElementById('testegra1');
    var myChart = echarts.init(chartDom);
    var option = {
     
        title: {
            text: ' Categorias mais Vendidas'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c}'
        },
        toolbox: {
            feature: {
                dataView: { readOnly: false },
                restore: {},
                saveAsImage: {}
            }
        },
        legend: {
            top: 30,
            data: catVendida.map(item => item.name)
        },
        series: [
            {
                name: 'Categorias mais vendidas',
                type: 'funnel',
                left: '10%',
                top: 70,
                bottom: 60,
                width: '80%',
                height:'60%',
                min: 0,
                
                
                sort: 'descending',
                label: {
                    show: true,
                    position: 'inside'
                },
                labelLine: {
                    length: 10,
                    lineStyle: {
                        width: 1,
                        type: 'solid'
                    }
                },
                itemStyle: {
                    borderColor: '#fff',
                    borderWidth: 1
                },
                emphasis: {
                    label: {
                        fontSize: 20
                    }
                },
                data: catVendida
            }
        ]
    };

    myChart.setOption(option);
</script>

<script>
  // 2) Dados vindos do backend (via Blade)
  const produtosMaisProcurados = @json($produtosMaisProcurados);
  // Exemplo de cada elemento: { nome_produto: 'Bolo', total_pesquisas: 42 }

  // 3) Montar um array de objetos no formato { name: '...', score: ... }
    const sourceArray = produtosMaisProcurados.map(p => ({
    name: String(p.nome_produto),
    score: Number(p.total_pesquisas)
    }));

  // 4) Inicializa o gráfico
  var chartDom2 = document.getElementById('testegra2');
  var myChart2 = echarts.init(chartDom2);
  var option2;

  option2 = {
    title: {
      text: 'Top 5 Produtos Pesquisados',
      left: 'center',
      textStyle: { color: '#5D4037', fontSize: 14 }
    },
    tooltip: {
      trigger: 'axis',
      axisPointer: { type: 'shadow' }
    },
    dataset: [
      {
        // 5) Aqui definimos explicitamente os nomes de campo que vamos usar
        dimensions: ['name', 'score'],
        source: sourceArray
      },
      {
        // 6) Transform para ordenar do maior (desc) para o menor
        transform: {
          type: 'sort',
          config: { dimension: 'score', order: 'desc' }
        }
      }
    ],
    xAxis: {
      type: 'category',
      axisLabel: {
        rotate: 30,
        color: '#5D4037',
        fontSize: 12,
        interval: 0
      }
    },
    yAxis: {
      type: 'value',
      name: 'Quantidade',
      nameTextStyle: { color: '#5D4037', fontSize: 12 },
      axisLabel: { color: '#5D4037', fontSize: 12 }
    },
    series: [
                

      {
        type: 'bar',
        encode: {
          // 'series encode': indica que 'name' vai para o eixo X e 'score' para o eixo Y
          x: 'name',
          y: 'score'
        },
        datasetIndex: 1, // usa o dataset já ordenado (índice 1)
        itemStyle: {
          color: '#8D6E63'
        },
        label: {
          show: true,
          position: 'top',
          formatter: '{c}',       // exibe o valor em cima de cada barra
          textStyle: { color: '#5D4037', fontSize: 12 }
        }
      }
    ]
  };

  // 7) Aplica as opções ao gráfico
  option2 && myChart2.setOption(option2);
</script>

</body>
</html>