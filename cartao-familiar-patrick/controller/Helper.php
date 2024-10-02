<?php

class Helper
{
    /**
     *
     * @param type array $dataAmericana
     * @return string
     */
    public static function datetoBR($dataAmericana)
    {
        if ($dataAmericana) {
            return date('d/m/Y H:i:s', strtotime($dataAmericana));
        }
    }

    public static function datetoUS($dataBrasil)
    {
        $d = explode('/', $dataBrasil);
        $d[2] = empty($d[2]) ? '' : $d[2];
        $d[1] = empty($d[1]) ? '' : $d[1];
        $d[0] = empty($d[0]) ? '' : $d[0];
        $dtOK = $d[2] . '-' . $d[1] . '-' . $d[0];
        return $dtOK;
    }

    /**
     * Returns the emulated SQL string
     *
     * @param $sql
     * @param $parameters
     * @return mixed
     */
    static public function pdoDebugger($sql, $values)
    {
        /**
         * Declara��o de vari�veis
         */
        $keys = array();
        /**
         * Perceorrendo array de valores
         */
        foreach ($values as $key => $value) {
            /**
             * Check if named parameters (':param') or anonymous parameters ('?') are used
             */
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }
            /**
             * bring parameter into human-readable format
             */
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }
        /**
         * Substituindo no comando sql
         */
        $sql = preg_replace($keys, $values, $sql, 1, $count);
        /**
         * Retorno
         */
        return $sql;
    }

    public static function validaEmail($email)
    {
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        $pattern = $conta . $domino . $extensao;
        if (preg_match($pattern, $email))
            return true;
        else
            return false;
    }

    public static function sanitizeString(string $string)
    {
        $newString = preg_replace('/[@\.\,\;\:\(\)\+\$\#\%\&\*]+/', '', $string);

        $newString = strtolower(
            preg_replace(
                array(
                    "/(á|à|ã|â|ä|Á|À|Ã|Â|Ä)/",
                    "/(é|è|ê|ë|É|È|Ê|Ë|&)/",
                    "/(í|ì|î|ï|Í|Ì|Î|Ï)/",
                    "/(ó|ò|õ|ô|ö|Ó|Ò|Õ|Ô|Ö)/",
                    "/(ú|ù|û|ü|Ú|Ù|Û|Ü)/",
                    "/(ñ|Ñ)/",
                    "/(ç|Ç)/"
                ),
                explode(",", "a,e,i,o,u,n,c"),
                $newString
            )
        );

        $newString = str_replace('/', '-', $newString);

        return $newString;
    }

    public static function sanitizeStringToURL(string $string)
    {
        $newString = preg_replace('/[@\.\,\;\:\(\)\+\$\#\%\&\*]+/', '', $string);

        $newString = strtolower(
            preg_replace(
                array(
                    "/(á|à|ã|â|ä|Á|À|Ã|Â|Ä)/",
                    "/(é|è|ê|ë|É|È|Ê|Ë|&)/",
                    "/(í|ì|î|ï|Í|Ì|Î|Ï)/",
                    "/(ó|ò|õ|ô|ö|Ó|Ò|Õ|Ô|Ö)/",
                    "/(ú|ù|û|ü|Ú|Ù|Û|Ü)/",
                    "/(ñ|Ñ)/",
                    "/(ç|Ç)/"
                ),
                explode(",", "a,e,i,o,u,n,c"),
                $newString
            )
        );

        $newString = str_replace('/', '-', $newString);

        $newString = str_replace(' ', '-', $newString);

        $words = explode('-', $newString);

        foreach ($words as $key => $w) {
            if (empty($w)) {
                unset($words[$key]);
            }
        }

        $url = implode('-', $words);

        return $url;
    }

    public static function generateUfOptions($selectedUf = null)
    {
        // Lista de estados brasileiros
        $states = [
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AP" => "Amapá",
            "AM" => "Amazonas",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "DF" => "Distrito Federal",
            "ES" => "Espírito Santo",
            "GO" => "Goiás",
            "MA" => "Maranhão",
            "MG" => "Minas Gerais",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "PA" => "Pará",
            "PB" => "Paraíba",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "PR" => "Paraná",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RO" => "Rondônia",
            "RR" => "Roraima",
            "RS" => "Rio Grande do Sul",
            "SC" => "Santa Catarina",
            "SE" => "Sergipe",
            "SP" => "São Paulo",
            "TO" => "Tocantins"
        ];

        // Inicia com a primeira opção padrão
        $html = '<option value="">UF:</option>' . PHP_EOL;

        // Itera sobre os estados para gerar os <option>
        foreach ($states as $code => $name) {
            $selected = ($selectedUf === $code) ? ' selected' : '';
            $html .= "<option value=\"$code\"$selected>$code</option>" . PHP_EOL;
        }

        return $html;
    }
    public static function getAllPlans($selectedPlans = null)
    {
        $plans=[
            "1"=> "basico",
            "2"=> "pro",
            "3"=> "premium"
            ];
        foreach ($plans as $code => $name) {
            $selected = ($selectedPlans === $code) ? ' selected' : '';
            $html .= "<option value=\"$code\"$selected>$name</option>" . PHP_EOL;

        }
        return $html;

    }

}




