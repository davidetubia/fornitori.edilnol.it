<?php 
class Listini_model extends CI_Model {

    public function check_base($listino, $id_fornitore){
        $tmp_name = $listino["tmp_name"];
        $ext = pathinfo($listino["name"]);
        $extension = $ext['extension'];

        // estensione consentita
        if($extension === 'csv' || $extension === 'pdf' || $extension === 'xls' || $extension === 'xlsx' || $extension === 'zip'){
            $output = [
                'success' => true,
                'title' => 'Listino caricato',
                'subtitle' => 'Listino caricato con successo',
                'button' => 'Guarda i tuoi listini',
                'href' => site_url('fornitore/profilo')
            ];

            $this->upload($listino, $id_fornitore, $extension);

            echo json_encode($output);
        } else {
        // estensione non consentita
            $output = [
                'success' => false,
                'title' => 'File non supportato.',
                'subtitle' => 'Vedi le unità di misura supportate.',
                'button' => 'Riprova',
                'href' => site_url('fornitore')
            ];
            echo json_encode($output);
        }
    }

    public function upload($listino, $id_fornitore, $extension){
        $year = date("Y");
        $path = FCPATH.'/uploads/'.$id_fornitore.'/'.$year;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $name = date("dmY").'-'.$id_fornitore;
        move_uploaded_file($listino['tmp_name'], "$path/$name.$extension");
    }

    public function check_file($listino)
    {
        $tmp_name = $listino["tmp_name"];
        $ext = pathinfo($listino["name"]);
        $extension = $ext['extension'];

        if($extension === 'xlsx' || $extension === 'xls' || $extension === 'csv' || $extension === 'txt'){
            if($extension === 'xlsx' || $extension === 'xls'){
                $this->convert_excel($listino['tmp_name']);
            } else {
                $csv = $this->csv_to_array($listino['tmp_name']);
                $controllo_intestazione = $this->controllo_intestazione($csv);
                if($controllo_intestazione){
                    if($this->controllo_popolamento($csv)){
                        return 'File ricevuto correttamente.';
                    }
                } else {
                    return 'Intestazioni non corrette o diverse dal file originale.';
                }
            }
        } else {
            return 'Formato file non supportato.';
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
                        return 'Intestazioni file non corrette.';
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
                    return 'Codice Articolo Fornitore mancante alla riga ' .$k;
                }

                if($um){
                    if(!$this->validateUm($um)){
                        $true = false;
                        return 'Unita di Misura "'.$um.'" non gestita alla riga ' .$k;  
                    }
                } else {
                    $true = false;
                    return 'Unita di Misura mancante alla riga ' .$k;
                }

                if($prezzo){
                    // echo $prezzo;
                } else {
                    $true = false;
                    return 'Prezzo mancante alla riga ' .$k;
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
                        return 'Formato Data Inizio Validità non riconosciuto ' .$k;
                    }

                } else {
                    $true = false;
                    return 'Data Inizio Validità mancante alla riga ' .$k;
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
