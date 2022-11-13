<?php
include "AvObjects.php";
/*
 * To change this template, choose Tools | templates
 * and open the template in the editor.
 */

final class Tarif extends AvObjects {

    public function __construct() {
        parent::__construct();

        
        // Default nasabah, dianggep nasabah umum
        $this->_prop["kode_kelompok"]="1";

        // Default jumlah, 1
        $this->_prop["jumlah"]="1";

        $this->_prop["kode_tarif"]="";

        $this->_prop["kode_klas"]="";

        $this->_prop["kode_bagian"]="";

        //$this->_prop["cito"]="";

    } // end of public function __construct()

    public function hitung() {
        $hasil=array();
        $inputnya=$this->getAllProp();
              

        // kalo non-askes langsung dikasi 0 buat bill askes & jatah..
        switch ($this->get("kode_kelompok")) {
            case "1":
            case "2" :
            case "3" :
            case "4" :
            case "5" :
                $tarifAskes=$this->_hitungTarifAskes();
                $tarifJatah=$this->_hitungTarifJatah();
            break;
            case "6" :
                $tarifAskes=array();
                $tarifJatah=array();

                $tarifAskes["bill_rs_askes"] = "0";
                $tarifAskes["bill_dr1_askes"] = "0";
                $tarifAskes["bill_dr2_askes"] = "0";
                //$tarifAskes["bill_dr3_askes"] = "0";

                $tarifJatah["bill_rs_jatah"] = "0";
                $tarifJatah["bill_dr1_jatah"] = "0";
                $tarifJatah["bill_dr2_jatah"] = "0";
                //$tarifJatah["bill_dr3_jatah"] = "0";
                $tarifJatah["kode_master_tarif_detail_jatah"] = "";

                //echo "di dalam yg non-askes<br>\n";
            break;
            default :
        }

        $tarifCurrent=$this->_hitungTarifCurrent();

        if (!is_array($inputnya)) $inputnya = array();
        if (!is_array($tarifCurrent)) $tarifCurrent = array();
        if (!is_array($tarifAskes)) $tarifAskes = array();
        if (!is_array($tarifJatah)) $tarifJatah = array();
        $hasil=array_merge($inputnya, $tarifCurrent, $tarifAskes, $tarifJatah);

        unset($this->_prop["cito"]);

        return $hasil;
    } // end of public function hitung()

    private function _hitungTarifAskes() {
        $hasil=array();
        //echo "dalam _hitungTarifAskes()<br>\n";

        $hasil["bill_rs_askes"] = "0";
        $hasil["bill_dr1_askes"] = "0";
        $hasil["bill_dr2_askes"] = "0";
        //$hasil["bill_dr3_askes"] = "0";

        return $hasil;
    } // end of private function _hitungTarifAskes()

    private function _hitungTarifJatah() {
        $hasil=array();

        $hasil["bill_rs_jatah"] = "0";
        $hasil["bill_dr1_jatah"] = "0";
        $hasil["bill_dr2_jatah"] = "0";
        //$hasil["bill_dr3_jatah"] = "0";
        $hasil["kode_master_tarif_detail_jatah"] = "";

        return $hasil;
    } // end of private function _hitungTarifJatah()

    private function _hitungTarifCurrent() {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);

        $hasil=array();

        $rTarif = $db->get_where('mt_tarif_v', array('kode_tarif' => $this->get("kode_tarif"), 'kode_klas' => $this->get("kode_klas"), 'status' => 1))->row();
        
        //if (isset($this->_prop["cito"]) && ($this->get("cito")!="" || $this->get("cito")!="0")) {
        if (isset($this->_prop["cito"]) && ($this->get("cito")=="1")) {
            //$hasil=$this->_hitungTarifCito($rTarif->fields);
            $hasil_cito=$this->_hitungTarifCito($rTarif->bill_rs,$rTarif->bill_dr1,$rTarif->bill_dr2,$rTarif->bill_dr3,$rTarif->bill_perawat,$rTarif->kamar_tindakan,$rTarif->biaya_lain,$rTarif->obat,$rTarif->alkes,$rTarif->alat_rs,$rTarif->adm,$rTarif->overhead,$rTarif->bhp,$rTarif->pendapatan_rs);
            $hasil["bill_rs"] = $hasil_cito["bill_rs"];
            $hasil["bill_dr1"] = $hasil_cito["bill_dr1"];
            $hasil["bill_dr2"] = $hasil_cito["bill_dr2"];
            $hasil["bill_dr3"] = $hasil_cito["bill_dr3"];
            //$hasil["bill_perawat"] = $hasil_cito["bill_perawat"];
            $hasil["kamar_tindakan"] = $hasil_cito["kamar_tindakan"];
            $hasil["biaya_lain"] = $hasil_cito["biaya_lain"];
            $hasil["obat"] = $hasil_cito["obat"];
            $hasil["alkes"] = $hasil_cito["alkes"];
            $hasil["alat_rs"] = $hasil_cito["alat_rs"];
            $hasil["adm"] = $hasil_cito["adm"];
            $hasil["bhp"] = $hasil_cito["bhp"];
            $hasil["pendapatan_rs"] = $hasil_cito["pendapatan_rs"];
        } else {
            $hasil["bill_rs"] = $rTarif->bill_rs * $this->get("jumlah");
            $hasil["bill_dr1"] = $rTarif->bill_dr1 * $this->get("jumlah");
            $hasil["bill_dr2"] = $rTarif->bill_dr2 * $this->get("jumlah");
            $hasil["bill_dr3"] = $rTarif->bill_dr3 * $this->get("jumlah");
            //$hasil["bill_perawat"] = $rTarif->Fields("bill_perawat") * $this->get("jumlah");
            $hasil["kamar_tindakan"] = $rTarif->kamar_tindakan * $this->get("jumlah");
            $hasil["biaya_lain"] = $rTarif->biaya_lain * $this->get("jumlah");
            $hasil["obat"] = $rTarif->obat * $this->get("jumlah");
            $hasil["alkes"] = $rTarif->alkes * $this->get("jumlah");
            $hasil["alat_rs"] = $rTarif->alat_rs * $this->get("jumlah");
            $hasil["adm"] = $rTarif->adm * $this->get("jumlah");
            $hasil["overhead"] = $rTarif->overhead * $this->get("jumlah");
            $hasil["bhp"] = $rTarif->bhp * $this->get("jumlah");
            $hasil["pendapatan_rs"] = $rTarif->pendapatan_rs * $this->get("jumlah");

            if($this->get("kode_kelompok")=='10'){
                $cek01=$rTarif->bill_kjs;
                $cek02=$rTarif->bill_bs_rs;
                $cek03=$rTarif->bill_bs_dr;
                if($cek01!='' || $cek02!='' || $cek03!='' ){
                    $hasil["bill_kjs"] = $rTarif->bill_kjs * $this->get("jumlah");
                    $hasil["bill_bs_rs"] = $rTarif->bill_bs_rs * $this->get("jumlah");
                    $hasil["bill_bs_dr"] = $rTarif->bill_bs_dr * $this->get("jumlah");
                }else{
                    $hasil["bill_bs_rs"] = $rTarif->bill_rs * $this->get("jumlah");
                    $hasil["bill_bs_dr"] = $rTarif->bill_dr1 * $this->get("jumlah");
                }
                $hasil["status_nk"] = "1";
            }
        }

        $hasil["kode_master_tarif_detail"] = $rTarif->kode_master_tarif_detail;
        $hasil["nama_tindakan"] = $rTarif->nama_tarif;
        $hasil["jenis_tindakan"] = $rTarif->jenis_tindakan;

        return $hasil;
    } // end of private function _hitungTarifCurrent()

    private function _hitungTarifCito($params,$bill_dr1,$bill_dr2,$bill_dr3,$bill_perawat,$kamar_tindakan,$biaya_lain,$obat,$alkes,$alat_rs,$adm,$overhead,$bhp,$pendapatan_rs) {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        
        $hasil=array();

        $nilai_cito=$db->get_where('pm_mt_kenaikancito', array('kode_bagian' => $this->get("kode_bagian")))->row();        
        $kenaikan_cito = ($nilai_cito->prosentase * 0.01) + 1;
        
        $bill_rs=$params * $kenaikan_cito;
        $bill_dr1=$bill_dr1 * $kenaikan_cito;
        $bill_dr2=$bill_dr2 * $kenaikan_cito;
        $bill_dr3=$bill_dr3 * $kenaikan_cito;
        $bill_perawat=$bill_perawat * $kenaikan_cito;
        $kamar_tindakan=$kamar_tindakan * $kenaikan_cito;
        $biaya_lain=$biaya_lain * $kenaikan_cito;
        $obat=$obat * $kenaikan_cito;
        $alkes=$alkes * $kenaikan_cito;
        $obat=$obat * $kenaikan_cito;
        $alat_rs=$alat_rs * $kenaikan_cito;
        $adm=$adm * $kenaikan_cito;
        $overhead=$overhead * $kenaikan_cito;
        $bhp=$bhp * $kenaikan_cito;
        $pendapatan_rs=$pendapatan_rs * $kenaikan_cito;
        
        $hasil["bill_rs"] = ceil($bill_rs) ;
        $hasil["bill_dr1"] = ceil($bill_dr1);
        $hasil["bill_dr2"] = ceil($bill_dr2);
        $hasil["bill_dr3"] = ceil($bill_dr3);
        $hasil["bill_perawat"] = ceil($bill_perawat);
        $hasil["kamar_tindakan"] = ceil($kamar_tindakan);
        $hasil["biaya_lain"] = ceil($biaya_lain);
        $hasil["obat"] = ceil($obat);
        $hasil["alkes"] = ceil($alkes);
        $hasil["alat_rs"] = ceil($alat_rs);
        $hasil["adm"] = ceil($adm);
        $hasil["overhead"] = ceil($overhead);
        $hasil["bhp"] = ceil($bhp);
        $hasil["pendapatan_rs"] = ceil($pendapatan_rs);

        return $hasil;
    } // end of private function _hitungTarifCito()

}

?>