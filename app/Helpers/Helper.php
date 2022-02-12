<?php

    namespace App\Helpers;

    use DB;

    class Helper {
        /**
	     * Create document number
	     * 
	     * @param  string $trx_name = Name of Transaction
	     * @param  int $trx_month = Month of Transaction
	     * @param  int $trx_year = Year of Transaction
	     * @param  int $curr_doc_number = Current increment of document number transaction
	     * @return string
	     */
	    public static function create_doc_no($trx_name, $trx_month, $trx_year)
	    {
	        $count = DB::table('tsys_counter_docnumber')
	                     ->where([['trx_name', $trx_name], ['trx_month', intval($trx_month)], ['trx_year', intval($trx_year)]])
	                     ->max('curr_doc_number');                     
	        if ($count == 0) {
	            $current_no = 1;
	            DB::table('tsys_counter_docnumber')->insert([
	                [   
                        'trx_name'          => $trx_name,
	                    'trx_month'         => intval($trx_month), 
	                    'trx_year'          => intval($trx_year), 
	                    'curr_doc_number'   => $current_no, 	                    
	                ]
	            ]);
	        } else {
	            $current_no = $count + 1;
	            DB::table('tsys_counter_docnumber')
	                    ->where([['trx_name', $trx_name], ['trx_month', intval($trx_month)], ['trx_year', intval($trx_year)]])
	                    ->update(['curr_doc_number' => $current_no]
	            );
	        }
	        return $current_no;
	    }

	    public static function left($text, $length)
	    {
	        return substr($text, 0, $length);
	    }

	    public static function right($text, $length)
	    {
	        return substr($text, -$length);
	    }

	    public static function to_float_value($val)
	    {
	        // $val = str_replace(",",".",$val);
	        $val = str_replace(",","",$val);
	        $val = preg_replace('/\.(?=.*\.)/', '', $val);
	        return floatval($val);
	    }

		public static function conversion_unit($id_barang_source, $id_satuan_source, $qty_source)
	    {

	    }
        
        public static function month_to_text($bulan)
        {
            if($bulan==1){
                $text = 'JANUARI';
            }elseif($bulan==2){
                $text = 'FEBRUARI';
            }elseif($bulan==3){
                $text = 'MARET';
            }elseif($bulan==4){
                $text = 'APRIL';
            }elseif($bulan==5){
                $text = 'MEI';
            }elseif($bulan==6){
                $text = 'JUNI';
            }elseif($bulan==7){
                $text = 'JULI';
            }elseif($bulan==8){
                $text = 'AGUSTUS';
            }elseif($bulan==9){
                $text = 'SEPTEMBER';
            }elseif($bulan==10){
                $text = 'OKTOBER';
            }elseif($bulan==11){
                $text = 'NOVEMBER';
            }elseif($bulan==12){
                $text = 'DESEMBER';
            }
            return $text;
        }
    }
?>