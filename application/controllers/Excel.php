<?php

class Excel extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
    
    public function index()
    {
        $tmp_name = $_FILES["xlsx"]["tmp_name"];
        $ext = pathinfo($_FILES["xlsx"]["name"]);
        $extension = $ext['extension'];

        if($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv' || $extension == 'txt'){
            if($extension == 'xlsx' || $extension == 'xls'){
                $this->convert_excel($_FILES['xlsx']['tmp_name']);
            } else {
                $csv = $this->csv_to_array($_FILES['xlsx']['tmp_name']);
                $controllo_intestazione = $this->controllo_intestazione($csv);
                if($controllo_intestazione){
                    if($this->controllo_popolamento($csv)){
                        $this->response(['File ricevuto correttamente.'], REST_Controller::HTTP_OK);
                    }
                } else {
                    $this->response(['Intestazioni non corrette o diverse dal file originale.'], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            }
        } else {
            $this->response(['Formato file non supportato.'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
    } 
     
    function convert_excel($file){
        echo 'Converto XLSX';
    }

    function controllo_intestazione($file){
        $row = 1;
        $true = true;
        $i = 0;

            foreach($file as $data){
                if($i === 0){
                    if($data[0] != 'Codice Articolo Fornitore'){
                        $true = false;
                    }

                    if($data[1] != 'Unita di Misura'){
                        $true = false;
                    }

                    if($data[2] != 'Prezzo'){
                        $true = false;
                    }

                    if($data[3] != 'Data Inizio Validita'){
                        $true = false;
                    }

                    if($data[4] != 'Sconto 1'){
                        $true = false;
                    }

                    if($data[5] != 'Sconto 2'){
                        $true = false;
                    }

                    if($data[6] != 'Sconto 3'){
                        $true = false;
                    }

                    if($data[7] != 'Sconto 4'){
                        $true = false;
                    }

                    if($data[8] != 'Sconto 5'){
                        $true = false;
                    }

                    if($data[9] != 'Sconto 6'){
                        $true = false;
                    }
                    
                    if($true){
                        return true;
                    } else {
                        return $this->response(['Intestazioni file non corrette.'], REST_Controller::HTTP_NOT_ACCEPTABLE);
                    }

                }
                
                $i++;
            }

            fclose($handle);
    }

    function csv_to_array($csv){
        ini_set('default_charset','UTF-8');
        $csvToRead = fopen($csv, 'r');
        
        while (! feof($csvToRead)) {
            $csvArray[] = fgetcsv($csvToRead, 1000, ';');
        }

        fclose($csvToRead);
        return $csvArray;
    }


    function controllo_popolamento($file){
        $true = true;
        foreach($file as $k=>$v){
            if($k > 0){
                $codart = $v[0];
                $um = $v[1];
                $prezzo = $v[2];
                $validita = $v[3];
                $sc_1 = $v[4];
                $sc_2 = $v[5];
                $sc_3 = $v[6];
                $sc_4 = $v[7];
                $sc_5 = $v[8];
                $sc_6 = $v[9];


                if($codart){
                    // echo $codart;
                } else {
                    $true = false;
                    return $this->response(['Codice Articolo Fornitore mancante alla riga ' .$k], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }

                if($um){
                    if(!$this->validateUm($um)){
                        $true = false;
                        return $this->response(['Unita di Misura "'.$um.'" non gestita alla riga ' .$k], REST_Controller::HTTP_NOT_ACCEPTABLE);  
                    }
                } else {
                    $true = false;
                    return $this->response(['Unita di Misura mancante alla riga ' .$k], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }

                if($prezzo){
                    // echo $prezzo;
                } else {
                    $true = false;
                    return $this->response(['Prezzo mancante alla riga ' .$k], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }

                if($validita){
                    $correctDate=false;
                    if(!$this->validateDate($validita, 'd/m/y')){
                        $correctDate=true;
                    }
                    if(!$this->validateDate($validita, 'd/m/Y')){
                        $correctDate=true;
                    }
                    if(!$this->validateDate($validita, 'd-m-y')){
                        $correctDate=true;
                    }
                    if(!$this->validateDate($validita, 'd-m-Y')){
                        $correctDate=true;
                    }
                    if(!$this->validateDate($validita, 'Y-m-d')){
                        $correctDate=true;
                    }

                    if(!$correctDate){
                        $true = false;
                        return $this->response(['Formato Data Inizio Validità non riconosciuto ' .$k], REST_Controller::HTTP_NOT_ACCEPTABLE);
                    }

                } else {
                    $true = false;
                    return $this->response(['Data Inizio Validità mancante alla riga ' .$k], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
                
            }
        }

        return $true;

    }

    function validateUm($um){
        $this->load->model('crud');
        $umGestita = $this->crud->um_gestite($um);
        return $umGestita;
    }

    function validateDate($date, $format)
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
     

    	
}