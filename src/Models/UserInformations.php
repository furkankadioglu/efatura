<?php 

namespace furkankadioglu\eFatura\Models;

use furkankadioglu\eFatura\Traits\Exportable;

class UserInformations {

    use Exportable;

    protected $vknTckn; // Read only 🚨
    protected $unvan;
    protected $ad;
    protected $soyad;
    protected $sicilNo;
    protected $mersisNo;
    protected $vergiDairesi;
    protected $cadde;
    protected $apartmanAdi;
    protected $apartmanNo;
    protected $kapiNo;
    protected $kasaba;
    protected $ilce;
    protected $il;
    protected $postaKodu;
    protected $ulke;
    protected $telNo;
    protected $faksNo;
    protected $ePostaAdresi;
    protected $webSitesiAdresi;
    protected $isMerkezi;

    /**
     * Initialize function
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        if($data != null)
        {
            $this->vknTckn = isset($data["vknTckn"]) ? $data["vknTckn"] : null;
            $this->unvan = isset($data["unvan"]) ? $data["unvan"] : null;
            $this->ad = isset($data["ad"]) ? $data["ad"] : null;
            $this->soyad = isset($data["soyad"]) ? $data["soyad"] : null;
            $this->sicilNo = isset($data["sicilNo"]) ? $data["sicilNo"] : null;
            $this->mersisNo = isset($data["mersisNo"]) ? $data["mersisNo"] : null;
            $this->vergiDairesi = isset($data["vergiDairesi"]) ? $data["vergiDairesi"] : null;
            $this->cadde = isset($data["cadde"]) ? $data["cadde"] : null;
            $this->apartmanAdi = isset($data["apartmanAdi"]) ? $data["apartmanAdi"] : null;
            $this->apartmanNo = isset($data["apartmanNo"]) ? $data["apartmanNo"] : null;
            $this->kapiNo = isset($data["kapiNo"]) ? $data["kapiNo"] : null;
            $this->kasaba = isset($data["kasaba"]) ? $data["kasaba"] : null;
            $this->ilce = isset($data["ilce"]) ? $data["ilce"] : null;
            $this->il = isset($data["il"]) ? $data["il"] : null;
            $this->postaKodu = isset($data["postaKodu"]) ? $data["postaKodu"] : null;
            $this->ulke = isset($data["ulke"]) ? $data["ulke"] : null;
            $this->telNo = isset($data["telNo"]) ? $data["telNo"] : null;
            $this->faksNo = isset($data["faksNo"]) ? $data["faksNo"] : null;
            $this->ePostaAdresi = isset($data["ePostaAdresi"]) ? $data["ePostaAdresi"] : null;
            $this->webSitesiAdresi = isset($data["webSitesiAdresi"]) ? $data["webSitesiAdresi"] : null;
            $this->isMerkezi = isset($data["isMerkezi"]) ? $data["isMerkezi"] : null;
        }
    }

    /**
     * Export all variables
     *
     * @return array
     */
    public function export()
    {
        return [
            "vknTckn" => $this->vknTckn,
            "unvan" => $this->unvan,
            "ad" => $this->ad,
            "soyad" => $this->soyad,
            "sicilNo" => $this->sicilNo,
            "mersisNo" => $this->mersisNo,
            "vergiDairesi" => $this->vergiDairesi,
            "cadde" => $this->cadde,
            "apartmanAdi" => $this->apartmanAdi,
            "apartmanNo" => $this->apartmanNo,
            "kapiNo" => $this->kapiNo,
            "kasaba" => $this->kasaba,
            "ilce" => $this->ilce,
            "il" => $this->il,
            "postaKodu" => $this->postaKodu,
            "ulke" => $this->ulke,
            "telNo" => $this->telNo,
            "faksNo" => $this->faksNo,
            "ePostaAdresi" => $this->ePostaAdresi,
            "webSitesiAdresi" => $this->webSitesiAdresi,
            "isMerkezi" => $this->isMerkezi
        ];
    }

    /**
     * Get the value of vknTckn (This field readonly!)
     */ 
    public function getVknTckn()
    {
        return $this->vknTckn;
    }


    /**
     * Get the value of unvan
     */ 
    public function getUnvan()
    {
        return $this->unvan;
    }

    /**
     * Set the value of unvan
     *
     * @return  self
     */ 
    public function setUnvan($unvan)
    {
        $this->unvan = $unvan;

        return $this;
    }

    /**
     * Get the value of ad
     */ 
    public function getAd()
    {
        return $this->ad;
    }

    /**
     * Set the value of ad
     *
     * @return  self
     */ 
    public function setAd($ad)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get the value of soyad
     */ 
    public function getSoyad()
    {
        return $this->soyad;
    }

    /**
     * Set the value of soyad
     *
     * @return  self
     */ 
    public function setSoyad($soyad)
    {
        $this->soyad = $soyad;

        return $this;
    }

    /**
     * Get the value of sicilNo
     */ 
    public function getSicilNo()
    {
        return $this->sicilNo;
    }

    /**
     * Set the value of sicilNo
     *
     * @return  self
     */ 
    public function setSicilNo($sicilNo)
    {
        $this->sicilNo = $sicilNo;

        return $this;
    }

    /**
     * Get the value of mersisNo
     */ 
    public function getMersisNo()
    {
        return $this->mersisNo;
    }

    /**
     * Set the value of mersisNo
     *
     * @return  self
     */ 
    public function setMersisNo($mersisNo)
    {
        $this->mersisNo = $mersisNo;

        return $this;
    }

    /**
     * Get the value of vergiDairesi
     */ 
    public function getVergiDairesi()
    {
        return $this->vergiDairesi;
    }

    /**
     * Set the value of vergiDairesi
     *
     * @return  self
     */ 
    public function setVergiDairesi($vergiDairesi)
    {
        $this->vergiDairesi = $vergiDairesi;

        return $this;
    }

    /**
     * Get the value of cadde
     */ 
    public function getCadde()
    {
        return $this->cadde;
    }

    /**
     * Set the value of cadde
     *
     * @return  self
     */ 
    public function setCadde($cadde)
    {
        $this->cadde = $cadde;

        return $this;
    }

    /**
     * Get the value of apartmanAdi
     */ 
    public function getApartmanAdi()
    {
        return $this->apartmanAdi;
    }

    /**
     * Set the value of apartmanAdi
     *
     * @return  self
     */ 
    public function setApartmanAdi($apartmanAdi)
    {
        $this->apartmanAdi = $apartmanAdi;

        return $this;
    }

    /**
     * Get the value of apartmanNo
     */ 
    public function getApartmanNo()
    {
        return $this->apartmanNo;
    }

    /**
     * Set the value of apartmanNo
     *
     * @return  self
     */ 
    public function setApartmanNo($apartmanNo)
    {
        $this->apartmanNo = $apartmanNo;

        return $this;
    }

    /**
     * Get the value of kapiNo
     */ 
    public function getKapiNo()
    {
        return $this->kapiNo;
    }

    /**
     * Set the value of kapiNo
     *
     * @return  self
     */ 
    public function setKapiNo($kapiNo)
    {
        $this->kapiNo = $kapiNo;

        return $this;
    }

    /**
     * Get the value of kasaba
     */ 
    public function getKasaba()
    {
        return $this->kasaba;
    }

    /**
     * Set the value of kasaba
     *
     * @return  self
     */ 
    public function setKasaba($kasaba)
    {
        $this->kasaba = $kasaba;

        return $this;
    }

    /**
     * Get the value of ilce
     */ 
    public function getIlce()
    {
        return $this->ilce;
    }

    /**
     * Set the value of ilce
     *
     * @return  self
     */ 
    public function setIlce($ilce)
    {
        $this->ilce = $ilce;

        return $this;
    }

    /**
     * Get the value of il
     */ 
    public function getIl()
    {
        return $this->il;
    }

    /**
     * Set the value of il
     *
     * @return  self
     */ 
    public function setIl($il)
    {
        $this->il = $il;

        return $this;
    }

    /**
     * Get the value of postaKodu
     */ 
    public function getPostaKodu()
    {
        return $this->postaKodu;
    }

    /**
     * Set the value of postaKodu
     *
     * @return  self
     */ 
    public function setPostaKodu($postaKodu)
    {
        $this->postaKodu = $postaKodu;

        return $this;
    }

    /**
     * Get the value of ulke
     */ 
    public function getUlke()
    {
        return $this->ulke;
    }

    /**
     * Set the value of ulke
     *
     * @return  self
     */ 
    public function setUlke($ulke)
    {
        $this->ulke = $ulke;

        return $this;
    }

    /**
     * Get the value of telNo
     */ 
    public function getTelNo()
    {
        return $this->telNo;
    }

    /**
     * Set the value of telNo
     *
     * @return  self
     */ 
    public function setTelNo($telNo)
    {
        $this->telNo = $telNo;

        return $this;
    }

    /**
     * Get the value of faksNo
     */ 
    public function getFaksNo()
    {
        return $this->faksNo;
    }

    /**
     * Set the value of faksNo
     *
     * @return  self
     */ 
    public function setFaksNo($faksNo)
    {
        $this->faksNo = $faksNo;

        return $this;
    }

    /**
     * Get the value of ePostaAdresi
     */ 
    public function getEPostaAdresi()
    {
        return $this->ePostaAdresi;
    }

    /**
     * Set the value of ePostaAdresi
     *
     * @return  self
     */ 
    public function setEPostaAdresi($ePostaAdresi)
    {
        $this->ePostaAdresi = $ePostaAdresi;

        return $this;
    }

    /**
     * Get the value of webSitesiAdresi
     */ 
    public function getWebSitesiAdresi()
    {
        return $this->webSitesiAdresi;
    }

    /**
     * Set the value of webSitesiAdresi
     *
     * @return  self
     */ 
    public function setWebSitesiAdresi($webSitesiAdresi)
    {
        $this->webSitesiAdresi = $webSitesiAdresi;

        return $this;
    }

    /**
     * Get the value of isMerkezi
     */ 
    public function getIsMerkezi()
    {
        return $this->isMerkezi;
    }

    /**
     * Set the value of isMerkezi
     *
     * @return  self
     */ 
    public function setIsMerkezi($isMerkezi)
    {
        $this->isMerkezi = $isMerkezi;

        return $this;
    }
}