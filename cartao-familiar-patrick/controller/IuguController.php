<?php
class IuguController
{
    private $apiKey;

    public function __construct()
    {
        // Inicializa a chave da API da Iugu
        $this->apiKey = 'sua_chave_api';
    }

    public function createInvoice()
    {
        // Dados da fatura
        $data = [
            'email' => 'cliente@example.com',
            'due_date' => '2024-07-30',
            'items' => [
                [
                    'description' => 'Serviço de Consultoria',
                    'quantity' => 1,
                    'price_cents' => 100000 // Valor em centavos
                ]
            ]
        ];

        // Inicia o cURL
        $ch = curl_init();

        // Configurações do cURL para fazer a requisição POST para a API da Iugu
        curl_setopt($ch, CURLOPT_URL, 'https://api.iugu.com/v1/invoices?api_token=' . $this->apiKey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        // Executa o cURL
        $response = curl_exec($ch);
        curl_close($ch);

        // Decodifica a resposta JSON
        $responseData = json_decode($response, true);

        // Checa se houve sucesso
        if (isset($responseData['id'])) {
            echo "Fatura criada com sucesso! ID: " . $responseData['id'];
        } else {
            echo "Erro ao criar a fatura: " . $responseData['errors'];
        }
    }
}
