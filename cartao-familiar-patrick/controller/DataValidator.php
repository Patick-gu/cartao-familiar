<?php

class DataValidator
{
    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('E-mail inválido.');
        }

        return $email;
    }

    public static function validatePhone($phone)
    {
        if (!preg_match('/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/', $phone)) {
            throw new ValidationException('Telefone inválido.');
        }

        return $phone;
    }

    public static function validateCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            throw new ValidationException('CPF inválido.');
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {
                throw new ValidationException('CPF inválido.');
            }
        }

        return $cpf;
    }

    public static function validateCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            throw new ValidationException('CNPJ inválido.');
        }

        $tamanho = strlen($cnpj) - 2;
        $numeros = substr($cnpj, 0, $tamanho);
        $digitos = substr($cnpj, $tamanho);

        $soma = 0;
        $pos = $tamanho - 7;

        for ($i = $tamanho; $i >= 1; $i--) {
            $soma += $numeros[$tamanho - $i] * $pos--;
            if ($pos < 2) {
                $pos = 9;
            }
        }

        $resultado = $soma % 11 < 2 ? 0 : 11 - $soma % 11;

        if ($resultado != $digitos[0]) {
            throw new ValidationException('CNPJ inválido.');
        }

        $tamanho = $tamanho + 1;
        $numeros = substr($cnpj, 0, $tamanho);
        $soma = 0;
        $pos = $tamanho - 7;

        for ($i = $tamanho; $i >= 1; $i--) {
            $soma += $numeros[$tamanho - $i] * $pos--;
            if ($pos < 2) {
                $pos = 9;
            }
        }

        $resultado = $soma % 11 < 2 ? 0 : 11 - $soma % 11;

        if ($resultado != $digitos[1]) {
            throw new ValidationException('CNPJ inválido.');
        }

        return $cnpj;
    }

    public static function validateZipCode($zip_code)
    {
        if (!preg_match('/^\d{5}-\d{3}$/', $zip_code)) {
            throw new ValidationException('CEP inválido.');
        }

        return $zip_code;
    }

    public static function validateBirth_date($data){
        // Verifica se a data está no formato YYYY-MM-DD
        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $data);

        // Verifica se a data é válida e se o formato está correto
        if ($d && $d->format($format) === $data) {
            // Verifica se a data não é futura
            if ($d > new DateTime()) {
                return "A data de nascimento não pode ser no futuro.";
            }
            return true; // Data válida
        } else {
            return "Data inválida. Use o formato YYYY-MM-DD.";
        }
    }

    public static function validateRedeSocial($url) {
        // Remove espaços em branco
        $url = trim($url);
        // Verifica se a URL é válida
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Adicione lógica para verificar se a URL é de uma rede social específica
            if (preg_match('/(facebook\.com|instagram\.com|tiktok\.com)/', $url)) {
                return true; // URL válida para uma rede social
            } else {
                return "URL não corresponde a uma rede social válida.";
            }
        } else {
            return "URL inválida.";
        }
    }

}



class ValidationException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
