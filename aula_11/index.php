<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta CEP - ViaCEP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Consultar Endereço pelo CEP</h1>
        <form method="get" action="">
            <input type="text" name="cep" placeholder="Digite o CEP (somente números)" required pattern="\d{8}">
            <button type="submit">Buscar</button>
        </form>

        <?php
        if (isset($_GET['cep']) && preg_match('/^\d{8}$/', $_GET['cep'])) {
            $cep = $_GET['cep'];
            $url = "https://viacep.com.br/ws/$cep/json/";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['erro'])) {
                echo "<p class='error'>CEP não encontrado.</p>";
            } else {
                // Mapeamento de estado e região
                $ufs = [
                    'AC' => ['Acre', 'Norte'],
                    'AL' => ['Alagoas', 'Nordeste'],
                    'AP' => ['Amapá', 'Norte'],
                    'AM' => ['Amazonas', 'Norte'],
                    'BA' => ['Bahia', 'Nordeste'],
                    'CE' => ['Ceará', 'Nordeste'],
                    'DF' => ['Distrito Federal', 'Centro-Oeste'],
                    'ES' => ['Espírito Santo', 'Sudeste'],
                    'GO' => ['Goiás', 'Centro-Oeste'],
                    'MA' => ['Maranhão', 'Nordeste'],
                    'MT' => ['Mato Grosso', 'Centro-Oeste'],
                    'MS' => ['Mato Grosso do Sul', 'Centro-Oeste'],
                    'MG' => ['Minas Gerais', 'Sudeste'],
                    'PA' => ['Pará', 'Norte'],
                    'PB' => ['Paraíba', 'Nordeste'],
                    'PR' => ['Paraná', 'Sul'],
                    'PE' => ['Pernambuco', 'Nordeste'],
                    'PI' => ['Piauí', 'Nordeste'],
                    'RJ' => ['Rio de Janeiro', 'Sudeste'],
                    'RN' => ['Rio Grande do Norte', 'Nordeste'],
                    'RS' => ['Rio Grande do Sul', 'Sul'],
                    'RO' => ['Rondônia', 'Norte'],
                    'RR' => ['Roraima', 'Norte'],
                    'SC' => ['Santa Catarina', 'Sul'],
                    'SP' => ['São Paulo', 'Sudeste'],
                    'SE' => ['Sergipe', 'Nordeste'],
                    'TO' => ['Tocantins', 'Norte']
                ];

                $uf = $data['uf'];
                $estado = $ufs[$uf][0] ?? 'Desconhecido';
                $regiao = $ufs[$uf][1] ?? 'Desconhecida';

                echo "<div class='resultado'>";
                echo "<p><strong>Logradouro:</strong> {$data['logradouro']}</p>";
                echo "<p><strong>Bairro:</strong> {$data['bairro']}</p>";
                echo "<p><strong>Localidade:</strong> {$data['localidade']}</p>";
                echo "<p><strong>UF:</strong> {$uf}</p>";
                echo "<p><strong>Estado:</strong> {$estado}</p>";
                echo "<p><strong>Região:</strong> {$regiao}</p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
