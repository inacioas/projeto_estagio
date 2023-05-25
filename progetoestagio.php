<?php

class Cliente {
    public $nome;
    public $dataNascimento;
    public $enderecos = array();

    public function __construct($nome, $dataNascimento) {
        $this->nome = $nome;
        $this->dataNascimento = $dataNascimento;
    }

    public function adicionarEndereco($endereco) {
        $this->enderecos[] = $endereco;
    }

    public function getIdade() {
        $dataAtual = new DateTime();
        $dataNascimento = new DateTime($this->dataNascimento);
        $intervalo = $dataAtual->diff($dataNascimento);
        return $intervalo->y;
    }
}

class Endereco {
    public $logradouro;
    public $bairro;
    public $cep;
    public $cidade;
    public $tipo;

    public function __construct($logradouro, $bairro, $cep, $cidade, $tipo) {
        $this->logradouro = $logradouro;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->tipo = $tipo;
    }
}

// Configura��o da conex�o com o banco
$host = 'localhost';
$dbname = 'PostgreSql';
$username = 'inacio';
$password = 'Inacio';

try {
    // Conex�o banco de dados
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

    // Novo cliente
    $cliente = new Cliente("In�cio da Mota Fernandes", "1990-05-10");

    // Novos endere�os
    $enderecoComercial = new Endereco("QR 05 Conhunto A casa 44", "Candangol�ndia", "71725-501", "Bras�lia", "comercial");
    $enderecoResidencial = new Endereco("QR 05 Conjunto A casa 44", "Candangol�ndia", "71725-501", "Bras�lia", "residencial");

    // Adicionando endere�os
    $cliente->adicionarEndereco($enderecoComercial);
    $cliente->adicionarEndereco($enderecoResidencial);
	
    // Mostrar informa��es
    echo "Nome do cliente: " . $cliente->nome . "\n";
    echo "Endere�o residencial: \n";
    echo "Logradouro: " . $enderecoResidencial->logradouro . "\n";
    echo "Bairro: " . $enderecoResidencial->bairro . "\n";
    echo "CEP: " . $enderecoResidencial->cep . "\n";
    echo "Cidade: " . $enderecoResidencial->cidade . "\n";
    echo "Endere�o comercial: \n";
    echo "Logradouro: " . $enderecoComercial->logradouro . "\n";
    echo "Bairro: " . $enderecoComercial->bairro . "\n";
    echo "CEP: " . $enderecoComercial->cep . "\n";
    echo "Cidade: " . $enderecoComercial->cidade . "\n";
    echo "Idade: " . $cliente->getIdade() . " anos\n";

    // Retornando endere�o residencial
    $query1 = "SELECT nome, 
	                  data_nascimento, 
					  logradouro, 
					  cep, 
					  bairro, 
					  cidade 
				 FROM Cliente 
				 JOIN Endereco 
				   ON Cliente.id_cliente = Endereco.cliente_id 
				WHERE Cliente.id_cliente = 1 
				  AND tipo_endereco = 'residencial'";
				  
    $result1 = $pdo->query($query1);
    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
    echo "Resultado Select 1:\n";
    echo "Nome: " . $row1['nome'] . "\n";
    echo "Data de Nascimento: " . $row1['data_nascimento'] . "\n";
    echo "Endere�o Residencial: \n";
    echo "Logradouro: " . $row1['logradouro'] . "\n";
    echo "CEP: " . $row1['cep'] . "\n";
    echo "Bairro: " . $row1['bairro'] . "\n";
    echo "Cidade: " . $row1['cidade'] . "\n";

    // Retornando endere�o comercial
    $query2 = "SELECT nome, 
	                  data_nascimento, 
					  logradouro, 
					  cep, 
					  bairro, 
					  cidade 
				 FROM Cliente 
				 JOIN Endereco 
				   ON Cliente.id_cliente = Endereco.cliente_id 
				WHERE Cliente.id_cliente = 1 
				  AND tipo_endereco = 'comercial'";
				  
    $result2 = $pdo->query($query2);
    $row2 = $result2->fetch(PDO::FETCH_ASSOC);
    echo "Resultado Select 2:\n";
    echo "Nome: " . $row2['nome'] . "\n";
    echo "Data de Nascimento: " . $row2['data_nascimento'] . "\n";
    echo "Endere�o Comercial: \n";
    echo "Logradouro: " . $row2['logradouro'] . "\n";
    echo "CEP: " . $row2['cep'] . "\n";
    echo "Bairro: " . $row2['bairro'] . "\n";
    echo "Cidade: " . $row2['cidade'] . "\n";

    // Retornando todos os campos
    $query3 = "SELECT nome, 
	                  data_nascimento, 
					  logradouro, 
					  cep, 
					  bairro, 
					  cidade 
				 FROM Cliente 
				 JOIN Endereco 
				   ON Cliente.id_cliente = Endereco.cliente_id 
				WHERE Cliente.id_cliente = 1";
				
    $result3 = $pdo->query($query3);
    echo "Resultado Select 3:\n";
    while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
        echo "Nome: " . $row3['nome'] . "\n";
        echo "Data de Nascimento: " . $row3['data_nascimento'] . "\n";
        echo "Endere�o: \n";
        echo "Logradouro: " . $row3['logradouro'] . "\n";
        echo "CEP: " . $row3['cep'] . "\n";
        echo "Bairro: " . $row3['bairro'] . "\n";
        echo "Cidade: " . $row3['cidade'] . "\n";
        echo "\n";
    }

} catch (PDOException $e) {
    echo "Erro de conex�o com o banco de dados: " . $e->getMessage();
}

?>