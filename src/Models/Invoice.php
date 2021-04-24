<?php

namespace furkankadioglu\eFatura\Models;

use furkankadioglu\eFatura\Exceptions\ValidatorException;
use furkankadioglu\eFatura\Traits\Exportable;
use NumberToWords\NumberToWords;
use Ramsey\Uuid\Uuid;

class Invoice
{

    use Exportable;

    protected $uuid;
    protected $documentNumber = "";
    protected $date;
    protected $time;
    protected $currency;
    protected $currencyRate;
    protected $invoiceType;
    protected $whichType;
    protected $taxOrIdentityNumber;
    protected $invoiceAcceptorTitle;
    protected $invoiceAcceptorName;
    protected $invoiceAcceptorLastName;
    protected $buildingName;
    protected $buildingNumber;
    protected $doorNumber;
    protected $town;
    protected $taxAdministration;
    protected $country;
    protected $avenueStreet;
    protected $district;
    protected $city;
    protected $postNumber;
    protected $telephoneNumber;
    protected $faxNumber;
    protected $email;
    protected $website;
    protected $refundTable;
    protected $specialBaseAmount;      // Özel Matrah Tutarı 😅
    protected $specialBasePercent;     // Özel Matrah Oranı 😅
    protected $specialBaseTaxAmount;   // Özel Matrah Vergi Tutarı 😅
    protected $taxType;
    protected $itemOrServiceList;
    protected $type;
    protected $base;                   // Matrah
    protected $itemOrServiceTotalPrice;
    protected $totalDiscount;
    protected $calculatedVAT;
    protected $taxTotalPrice;
    protected $includedTaxesTotalPrice;
    protected $paymentPrice;
    protected $note;
    protected $orderNumber = "";
    protected $orderData = "";
    protected $waybillNumber = "";       // İrsaliye
    protected $waybillDate = "";
    protected $receiptNumber = "";
    protected $voucherDate = "";
    protected $voucherTime = "";
    protected $voucherType = "";
    protected $zReportNumber = "";
    protected $okcSerialNumber = "";

    public function __construct($data = [])
    {
        $this->mapWithEnglishKeys($data);
        $this->insertChecks($data);
    }

    public function mapWithTurkishKeys($data)
    {
        $this->uuid = isset($data["faturaUuid"]) ? $data["faturaUuid"] : Uuid::uuid1()->toString();
        $this->documentNumber = isset($data["belgeNumarasi"]) ? $data["belgeNumarasi"] : "";
        $this->date = isset($data["faturaTarihi"]) ? $data["faturaTarihi"] : "";
        $this->time = isset($data["saat"]) ? $data["saat"] : "";
        $this->currency = isset($data["paraBirimi"]) ? $data["paraBirimi"] : "";
        $this->currencyRate = isset($data["dovzTLkur"]) ? $data["dovzTLkur"] : "";
        $this->invoiceType = isset($data["faturaTipi"]) ? $data["faturaTipi"] : "";
        $this->whichType = isset($data["hangiTip"]) ? $data["hangiTip"] : "5000/30000";
        $this->taxOrIdentityNumber = isset($data["vknTckn"]) ? $data["vknTckn"] : "11111111111";
        $this->invoiceAcceptorTitle = isset($data["aliciUnvan"]) ? $data["aliciUnvan"] : "";
        $this->invoiceAcceptorName = isset($data["aliciAdi"]) ? $data["aliciAdi"] : "";
        $this->invoiceAcceptorLastName = isset($data["aliciSoyadi"]) ? $data["aliciSoyadi"] : "";
        $this->buildingName = isset($data["binaAdi"]) ? $data["binaAdi"] : "";
        $this->buildingNumber = isset($data["binaNo"]) ? $data["binaNo"] : "";
        $this->doorNumber = isset($data["kapiNo"]) ? $data["kapiNo"] : "";
        $this->town = isset($data["kasabaKoy"]) ? $data["kasabaKoy"] : "";
        $this->taxAdministration = isset($data["vergiDairesi"]) ? $data["vergiDairesi"] : "";
        $this->country = isset($data["ulke"]) ? $data["ulke"] : "";
        $this->avenueStreet = isset($data["bulvarcaddesokak"]) ? $data["bulvarcaddesokak"] : "";
        $this->district = isset($data["mahalleSemtIlce"]) ? $data["mahalleSemtIlce"] : "";
        $this->city = isset($data["sehir"]) ? $data["sehir"] : "";
        $this->postNumber = isset($data["postaKodu"]) ? $data["postaKodu"] : "";
        $this->telephoneNumber = isset($data["tel"]) ? $data["tel"] : "";
        $this->faxNumber = isset($data["fax"]) ? $data["fax"] : "";
        $this->email = isset($data["eposta"]) ? $data["eposta"] : "";
        $this->website = isset($data["websitesi"]) ? $data["websitesi"] : "";
        $this->refundTable = isset($data["iadeTable"]) ? $data["iadeTable"] : [];
        $this->specialBaseAmount = isset($data["ozelMatrahTutari"]) ? $data["ozelMatrahTutari"] : "0";
        $this->specialBasePercent = isset($data["ozelMatrahOrani"]) ? $data["ozelMatrahOrani"] : "0";
        $this->specialBaseTaxAmount = isset($data["ozelMatrahVergiTutari"]) ? $data["ozelMatrahVergiTutari"] : "0";
        $this->taxType = isset($data["vergiCesidi"]) ? $data["vergiCesidi"] : "";
        $this->itemOrServiceList = isset($data["malHizmetTable"]) ? $data["malHizmetTable"] : [];
        $this->type = isset($data["tip"]) ? $data["tip"] : "İskonto";
        $this->base = isset($data["matrah"]) ? $data["matrah"] : "";
        $this->itemOrServiceTotalPrice = isset($data["malhizmetToplamTutari"]) ? $data["malhizmetToplamTutari"] : "";
        $this->totalDiscount = isset($data["toplamIskonto"]) ? $data["toplamIskonto"] : "";
        $this->calculatedVAT = isset($data["hesaplanankdv"]) ? $data["hesaplanankdv"] : "";
        $this->taxTotalPrice = isset($data["vergilerToplami"]) ? $data["vergilerToplami"] : "";
        $this->includedTaxesTotalPrice = isset($data["vergilerDahilToplamTutar"]) ? $data["vergilerDahilToplamTutar"] : "";
        $this->paymentPrice = isset($data["odenecekTutar"]) ? $data["odenecekTutar"] : "";
        $this->note = isset($data["not"]) ? $data["not"] : "";
        $this->orderNumber = isset($data["siparisNumarasi"]) ? $data["siparisNumarasi"] : "";
        $this->orderData = isset($data["siparisTarihi"]) ? $data["siparisTarihi"] : "";
        $this->waybillNumber = isset($data["irsaliyeNumarasi"]) ? $data["irsaliyeNumarasi"] : "";
        $this->waybillDate = isset($data["irsaliyeTarihi"]) ? $data["irsaliyeTarihi"] : "";
        $this->receiptNumber = isset($data["fisNo"]) ? $data["fisNo"] : "";
        $this->voucherDate = isset($data["fisTarihi"]) ? $data["fisTarihi"] : "";
        $this->voucherTime = isset($data["fisSaati"]) ? $data["fisSaati"] : "";
        $this->voucherType = isset($data["fisTipi"]) ? $data["fisTipi"] : "";
        $this->zReportNumber = isset($data["zRaporNo"]) ? $data["zRaporNo"] : "";
        $this->okcSerialNumber = isset($data["okcSeriNo"]) ? $data["okcSeriNo"] : "";

        $this->insertChecks($data);
    }

    public function mapWithEnglishKeys($data)
    {
        $this->uuid = isset($data["uuid"]) ? $data["uuid"] : Uuid::uuid1()->toString();
        $this->documentNumber = isset($data["documentNumber"]) ? $data["documentNumber"] : "";
        $this->date = isset($data["date"]) ? $data["date"] : "";
        $this->time = isset($data["time"]) ? $data["time"] : "";
        $this->currency = isset($data["currency"]) ? $data["currency"] : "";
        $this->currencyRate = isset($data["currencyRate"]) ? $data["currencyRate"] : "";
        $this->invoiceType = isset($data["invoiceType"]) ? $data["invoiceType"] : "";
        $this->whichType = isset($data["whichType"]) ? $data["whichType"] : "5000/30000";
        $this->taxOrIdentityNumber = isset($data["taxOrIdentityNumber"]) ? $data["taxOrIdentityNumber"] : "11111111111";
        $this->invoiceAcceptorTitle = isset($data["invoiceAcceptorTitle"]) ? $data["invoiceAcceptorTitle"] : "";
        $this->invoiceAcceptorName = isset($data["invoiceAcceptorName"]) ? $data["invoiceAcceptorName"] : "";
        $this->invoiceAcceptorLastName = isset($data["invoiceAcceptorLastName"]) ? $data["invoiceAcceptorLastName"] : "";
        $this->buildingName = isset($data["buildingName"]) ? $data["buildingName"] : "";
        $this->buildingNumber = isset($data["buildingNumber"]) ? $data["buildingNumber"] : "";
        $this->doorNumber = isset($data["doorNumber"]) ? $data["doorNumber"] : "";
        $this->town = isset($data["town"]) ? $data["town"] : "";
        $this->taxAdministration = isset($data["taxAdministration"]) ? $data["taxAdministration"] : "";
        $this->country = isset($data["country"]) ? $data["country"] : "";
        $this->avenueStreet = isset($data["avenueStreet"]) ? $data["avenueStreet"] : "";
        $this->district = isset($data["district"]) ? $data["district"] : "";
        $this->city = isset($data["city"]) ? $data["city"] : "";
        $this->postNumber = isset($data["postNumber"]) ? $data["postNumber"] : "";
        $this->telephoneNumber = isset($data["telephoneNumber"]) ? $data["telephoneNumber"] : "";
        $this->faxNumber = isset($data["faxNumber"]) ? $data["faxNumber"] : "";
        $this->email = isset($data["email"]) ? $data["email"] : "";
        $this->website = isset($data["website"]) ? $data["website"] : "";
        $this->refundTable = isset($data["refundTable"]) ? $data["refundTable"] : [];
        $this->specialBaseAmount = isset($data["specialBaseAmount"]) ? $data["specialBaseAmount"] : "0";
        $this->specialBasePercent = isset($data["specialBasePercent"]) ? $data["specialBasePercent"] : "0";
        $this->specialBaseTaxAmount = isset($data["specialBaseTaxAmount"]) ? $data["specialBaseTaxAmount"] : "0";
        $this->taxType = isset($data["taxType"]) ? $data["taxType"] : "";
        $this->itemOrServiceList = isset($data["itemOrServiceList"]) ? $data["itemOrServiceList"] : [];
        $this->type = isset($data["type"]) ? $data["type"] : "İskonto";
        $this->base = isset($data["base"]) ? $data["base"] : "";
        $this->itemOrServiceTotalPrice = isset($data["itemOrServiceTotalPrice"]) ? $data["itemOrServiceTotalPrice"] : "";
        $this->totalDiscount = isset($data["totalDiscount"]) ? $data["totalDiscount"] : "";
        $this->calculatedVAT = isset($data["calculatedVAT"]) ? $data["calculatedVAT"] : "";
        $this->taxTotalPrice = isset($data["taxTotalPrice"]) ? $data["taxTotalPrice"] : "";
        $this->includedTaxesTotalPrice = isset($data["includedTaxesTotalPrice"]) ? $data["includedTaxesTotalPrice"] : "";
        $this->paymentPrice = isset($data["paymentPrice"]) ? $data["paymentPrice"] : "";
        $this->note = isset($data["note"]) ? $data["note"] : "";
        $this->orderNumber = isset($data["orderNumber"]) ? $data["orderNumber"] : "";
        $this->orderData = isset($data["orderData"]) ? $data["orderData"] : "";
        $this->waybillNumber = isset($data["waybillNumber"]) ? $data["waybillNumber"] : "";
        $this->waybillDate = isset($data["waybillDate"]) ? $data["waybillDate"] : "";
        $this->receiptNumber = isset($data["receiptNumber"]) ? $data["receiptNumber"] : "";
        $this->voucherDate = isset($data["voucherDate"]) ? $data["voucherDate"] : "";
        $this->voucherTime = isset($data["voucherTime"]) ? $data["voucherTime"] : "";
        $this->voucherType = isset($data["voucherType"]) ? $data["voucherType"] : "";
        $this->zReportNumber = isset($data["zReportNumber"]) ? $data["zReportNumber"] : "";
        $this->okcSerialNumber = isset($data["okcSerialNumber"]) ? $data["okcSerialNumber"] : "";

        $this->insertChecks($data);
    }

    /**
     * Data insert checks
     *
     * @param array $data
     * @return void
     */
    private function insertChecks($data)
    {
        if (isset($data["uuid"])) {
            if (!Uuid::isValid($data["uuid"])) {
                throw new ValidatorException("UUID Hatalı");
            }
        }

        if (isset($data["faturaUuid"])) {
            if (!Uuid::isValid($data["faturaUuid"])) {
                throw new ValidatorException("UUID Hatalı");
            }
        }
    }

    /**
     * Base export function for guzzle post
     *
     * @return array
     */
    public function export()
    {
        return [
            "faturaUuid" => $this->uuid,
            "belgeNumarasi" => $this->documentNumber,
            "faturaTarihi" => $this->date,
            "saat" => $this->time,
            "paraBirimi" => $this->currency,
            "dovzTLkur" => $this->currencyRate,
            "faturaTipi" => $this->invoiceType,
            "hangiTip" =>  $this->whichType,
            "vknTckn" => $this->taxOrIdentityNumber,
            "aliciUnvan" => $this->invoiceAcceptorTitle,
            "aliciAdi" => $this->invoiceAcceptorName,
            "aliciSoyadi" => $this->invoiceAcceptorLastName,
            "binaAdi" => $this->buildingName,
            "binaNo" => $this->buildingNumber,
            "kapiNo" => $this->doorNumber,
            "kasabaKoy" => $this->town,
            "vergiDairesi" => $this->taxAdministration,
            "ulke" => $this->country,
            "bulvarcaddesokak" => $this->avenueStreet,
            "mahalleSemtIlce" => $this->district,
            "sehir" => $this->city,
            "postaKodu" => $this->postNumber,
            "tel" => $this->telephoneNumber,
            "fax" => $this->faxNumber,
            "eposta" => $this->email,
            "websitesi" => $this->website,
            "iadeTable" => $this->refundTable,
            "ozelMatrahTutari" => $this->specialBaseAmount,
            "ozelMatrahOrani" => $this->specialBasePercent,
            "ozelMatrahVergiTutari" => $this->specialBaseTaxAmount,
            "vergiCesidi" => $this->taxType,
            "malHizmetTable" => $this->itemOrServiceList,
            "tip" => $this->type,
            "matrah" => $this->base,
            "malhizmetToplamTutari" => $this->itemOrServiceTotalPrice,
            "toplamIskonto" => $this->totalDiscount,
            "hesaplanankdv" => $this->calculatedVAT,
            "vergilerToplami" => $this->taxTotalPrice,
            "vergilerDahilToplamTutar" => $this->includedTaxesTotalPrice,
            "odenecekTutar" => $this->paymentPrice,
            "not" => $this->note,
            "siparisNumarasi" => $this->orderNumber,
            "siparisTarihi" => $this->orderData,
            "irsaliyeNumarasi" => $this->waybillNumber,
            "irsaliyeTarihi" => $this->waybillDate,
            "fisNo" => $this->receiptNumber,
            "fisTarihi" => $this->voucherDate,
            "fisSaati" => $this->voucherTime,
            "fisTipi" => $this->voucherType,
            "zRaporNo" => $this->zReportNumber,
            "okcSeriNo" => $this->okcSerialNumber,
        ];
    }

    /**
     * Get summary fields
     *
     * @return array
     */
    public function getSummary()
    {
        return [
            "belgeNumarasi" => $this->documentNumber,
            "aliciVknTckn" => $this->taxOrIdentityNumber,
            "aliciUnvanAdSoyad" => $this->invoiceAcceptorTitle,
            "belgeTarihi" => $this->date,
            "belgeTuru" => "FATURA",
            "ettn" => $this->uuid
        ];
    }


    /**
     * Get the value of uuid
     * 
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of uuid
     *
     * @return  self
     */
    public function setUuid($uuid)
    {
        if (!Uuid::isValid($uuid)) {
            throw new ValidatorException("UUID Hatalı");
        }

        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get the value of documentNumber
     * 
     * @return string
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * Set the value of documentNumber
     *
     * @return  self
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    /**
     * Get the value of date
     * 
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of time
     * 
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of currency
     * 
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @return  self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get the value of currencyRate
     * 
     * @return string
     */
    public function getCurrencyRate()
    {
        return $this->currencyRate;
    }

    /**
     * Set the value of currencyRate
     *
     * @return  self
     */
    public function setCurrencyRate($currencyRate)
    {
        $this->currencyRate = $currencyRate;

        return $this;
    }

    /**
     * Get the value of invoiceType
     * 
     * @return string
     */
    public function getInvoiceType()
    {
        return $this->invoiceType;
    }

    /**
     * Set the value of invoiceType
     *
     * @return  self
     */
    public function setInvoiceType($invoiceType)
    {
        $this->invoiceType = $invoiceType;

        return $this;
    }

    /**
     * Get the value of whichType
     * 
     * @return string
     */
    public function getWhichType()
    {
        return $this->whichType;
    }

    /**
     * Set the value of invoiceType
     *
     * @return  self
     */
    public function setWhichType($whichType)
    {
        $this->whichType = $whichType;

        return $this;
    }

    /**
     * Get the value of taxOrIdentityNumber
     * 
     * @return string
     */
    public function getTaxOrIdentityNumber()
    {
        return $this->taxOrIdentityNumber ? $this->taxOrIdentityNumber : "11111111111";
    }

    /**
     * Set the value of taxOrIdentityNumber
     *
     * @return  self
     */
    public function setTaxOrIdentityNumber($taxOrIdentityNumber)
    {
        $this->taxOrIdentityNumber = $taxOrIdentityNumber;

        return $this;
    }

    /**
     * Get the value of invoiceAcceptorTitle
     * 
     * @return string
     */
    public function getInvoiceAcceptorTitle()
    {
        return $this->invoiceAcceptorTitle;
    }

    /**
     * Set the value of invoiceAcceptorTitle
     *
     * @return  self
     */
    public function setInvoiceAcceptorTitle($invoiceAcceptorTitle)
    {
        $this->invoiceAcceptorTitle = $invoiceAcceptorTitle;

        return $this;
    }

    /**
     * Get the value of invoiceAcceptorName
     * 
     * @return string
     */
    public function getInvoiceAcceptorName()
    {
        return $this->invoiceAcceptorName;
    }

    /**
     * Set the value of invoiceAcceptorName
     *
     * @return  self
     */
    public function setInvoiceAcceptorName($invoiceAcceptorName)
    {
        $this->invoiceAcceptorName = $invoiceAcceptorName;

        return $this;
    }

    /**
     * Get the value of invoiceAcceptorLastName
     * 
     * @return string
     */
    public function getInvoiceAcceptorLastName()
    {
        return $this->invoiceAcceptorLastName;
    }

    /**
     * Set the value of invoiceAcceptorLastName
     *
     * @return  self
     */
    public function setInvoiceAcceptorLastName($invoiceAcceptorLastName)
    {
        $this->invoiceAcceptorLastName = $invoiceAcceptorLastName;

        return $this;
    }

    /**
     * Get the value of buildingName
     * 
     * @return string
     */
    public function getBuildingName()
    {
        return $this->buildingName;
    }

    /**
     * Set the value of buildingName
     *
     * @return  self
     */
    public function setBuildingName($buildingName)
    {
        $this->buildingName = $buildingName;

        return $this;
    }

    /**
     * Get the value of buildingNumber
     * 
     * @return string
     */
    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    /**
     * Set the value of buildingNumber
     *
     * @return  self
     */
    public function setBuildingNumber($buildingNumber)
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    /**
     * Get the value of doorNumber
     * 
     * @return string
     */
    public function getDoorNumber()
    {
        return $this->doorNumber;
    }

    /**
     * Set the value of doorNumber
     *
     * @return  self
     */
    public function setDoorNumber($doorNumber)
    {
        $this->doorNumber = $doorNumber;

        return $this;
    }

    /**
     * Get the value of town
     * 
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set the value of town
     *
     * @return  self
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get the value of taxAdministration
     * 
     * @return string
     */
    public function getTaxAdministration()
    {
        return $this->taxAdministration;
    }

    /**
     * Set the value of taxAdministration
     *
     * @return  self
     */
    public function setTaxAdministration($taxAdministration)
    {
        $this->taxAdministration = $taxAdministration;

        return $this;
    }

    /**
     * Get the value of country
     * 
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of avenueStreet
     * 
     * @return string
     */
    public function getAvenueStreet()
    {
        return $this->avenueStreet;
    }

    /**
     * Set the value of avenueStreet
     *
     * @return  self
     */
    public function setAvenueStreet($avenueStreet)
    {
        $this->avenueStreet = $avenueStreet;

        return $this;
    }

    /**
     * Get the value of district
     * 
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set the value of district
     *
     * @return  self
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get the value of city
     * 
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of postNumber
     * 
     * @return string
     */
    public function getPostNumber()
    {
        return $this->postNumber;
    }

    /**
     * Set the value of postNumber
     *
     * @return  self
     */
    public function setPostNumber($postNumber)
    {
        $this->postNumber = $postNumber;

        return $this;
    }

    /**
     * Get the value of telephoneNumber
     * 
     * @return string
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * Set the value of telephoneNumber
     *
     * @return  self
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;

        return $this;
    }

    /**
     * Get the value of faxNumber
     * 
     * @return string
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * Set the value of faxNumber
     *
     * @return  self
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;

        return $this;
    }

    /**
     * Get the value of email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of website
     * 
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the value of website
     *
     * @return  self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get the value of refundTable
     * 
     * @return string
     */
    public function getRefundTable()
    {
        return $this->refundTable;
    }

    /**
     * Set the value of refundTable
     *
     * @return  self
     */
    public function setRefundTable($refundTable)
    {
        $this->refundTable = $refundTable;

        return $this;
    }

    /**
     * Get the value of specialBaseAmount
     * 
     * @return string
     */
    public function getSpecialBaseAmount()
    {
        return $this->specialBaseAmount;
    }

    /**
     * Set the value of specialBaseAmount
     *
     * @return  self
     */
    public function setSpecialBaseAmount($specialBaseAmount)
    {
        $this->specialBaseAmount = $specialBaseAmount;

        return $this;
    }

    /**
     * Get the value of specialBasePercent
     * 
     * @return string
     */
    public function getSpecialBasePercent()
    {
        return $this->specialBasePercent;
    }

    /**
     * Set the value of specialBasePercent
     *
     * @return  self
     */
    public function setSpecialBasePercent($specialBasePercent)
    {
        $this->specialBasePercent = $specialBasePercent;

        return $this;
    }

    /**
     * Get the value of specialBaseTaxAmount
     * 
     * @return string
     */
    public function getSpecialBaseTaxAmount()
    {
        return $this->specialBaseTaxAmount;
    }

    /**
     * Set the value of specialBaseTaxAmount
     *
     * @return  self
     */
    public function setSpecialBaseTaxAmount($specialBaseTaxAmount)
    {
        $this->specialBaseTaxAmount = $specialBaseTaxAmount;

        return $this;
    }

    /**
     * Get the value of taxType
     * 
     * @return string
     */
    public function getTaxType()
    {
        return $this->taxType;
    }

    /**
     * Set the value of taxType
     *
     * @return  self
     */
    public function setTaxType($taxType)
    {
        $this->taxType = $taxType;

        return $this;
    }

    /**
     * Get the value of itemOrServiceList
     * 
     * @return string
     */
    public function getItemOrServiceList()
    {
        return $this->itemOrServiceList;
    }

    /**
     * Set the value of itemOrServiceList
     *
     * @return  self
     */
    public function setItemOrServiceList($itemOrServiceList)
    {
        $this->itemOrServiceList = $itemOrServiceList;

        return $this;
    }

    /**
     * Get the value of type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of base
     * 
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set the value of base
     *
     * @return  self
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    /**
     * Get the value of itemOrServiceTotalPrice
     * 
     * @return string
     */
    public function getItemOrServiceTotalPrice()
    {
        return $this->itemOrServiceTotalPrice;
    }

    /**
     * Set the value of itemOrServiceTotalPrice
     *
     * @return  self
     */
    public function setItemOrServiceTotalPrice($itemOrServiceTotalPrice)
    {
        $this->itemOrServiceTotalPrice = $itemOrServiceTotalPrice;

        return $this;
    }

    /**
     * Get the value of totalDiscount
     * 
     * @return string
     */
    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }

    /**
     * Set the value of totalDiscount
     *
     * @return  self
     */
    public function setTotalDiscount($totalDiscount)
    {
        $this->totalDiscount = $totalDiscount;

        return $this;
    }

    /**
     * Get the value of calculatedVAT
     * 
     * @return string
     */
    public function getCalculatedVAT()
    {
        return $this->calculatedVAT;
    }

    /**
     * Set the value of calculatedVAT
     *
     * @return  self
     */
    public function setCalculatedVAT($calculatedVAT)
    {
        $this->calculatedVAT = $calculatedVAT;

        return $this;
    }

    /**
     * Get the value of taxTotalPrice
     * 
     * @return string
     */
    public function getTaxTotalPrice()
    {
        return $this->taxTotalPrice;
    }

    /**
     * Set the value of taxTotalPrice
     *
     * @return  self
     */
    public function setTaxTotalPrice($taxTotalPrice)
    {
        $this->taxTotalPrice = $taxTotalPrice;

        return $this;
    }

    /**
     * Get the value of includedTaxesTotalPrice
     * 
     * @return string
     */
    public function getIncludedTaxesTotalPrice()
    {
        return $this->includedTaxesTotalPrice;
    }

    /**
     * Set the value of includedTaxesTotalPrice
     *
     * @return  self
     */
    public function setIncludedTaxesTotalPrice($includedTaxesTotalPrice)
    {
        $this->includedTaxesTotalPrice = $includedTaxesTotalPrice;

        return $this;
    }

    /**
     * Get the value of paymentPrice
     * 
     * @return string
     */
    public function getPaymentPrice()
    {
        return $this->paymentPrice;
    }

    /**
     * Set the value of paymentPrice
     *
     * @return  self
     */
    public function setPaymentPrice($paymentPrice)
    {
        $this->paymentPrice = $paymentPrice;

        return $this;
    }

    /**
     * Get the value of note
     * 
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of orderNumber
     * 
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set the value of orderNumber
     *
     * @return  self
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get the value of orderData
     * 
     * @return string
     */
    public function getOrderData()
    {
        return $this->orderData;
    }

    /**
     * Set the value of orderData
     *
     * @return  self
     */
    public function setOrderData($orderData)
    {
        $this->orderData = $orderData;

        return $this;
    }

    /**
     * Get the value of waybillNumber
     * 
     * @return string
     */
    public function getWaybillNumber()
    {
        return $this->waybillNumber;
    }

    /**
     * Set the value of waybillNumber
     *
     * @return  self
     */
    public function setWaybillNumber($waybillNumber)
    {
        $this->waybillNumber = $waybillNumber;

        return $this;
    }

    /**
     * Get the value of waybillDate
     * 
     * @return string
     */
    public function getWaybillDate()
    {
        return $this->waybillDate;
    }

    /**
     * Set the value of waybillDate
     *
     * @return  self
     */
    public function setWaybillDate($waybillDate)
    {
        $this->waybillDate = $waybillDate;

        return $this;
    }

    /**
     * Get the value of receiptNumber
     * 
     * @return string
     */
    public function getReceiptNumber()
    {
        return $this->receiptNumber;
    }

    /**
     * Set the value of receiptNumber
     *
     * @return  self
     */
    public function setReceiptNumber($receiptNumber)
    {
        $this->receiptNumber = $receiptNumber;

        return $this;
    }

    /**
     * Get the value of voucherDate
     * 
     * @return string
     */
    public function getVoucherDate()
    {
        return $this->voucherDate;
    }

    /**
     * Set the value of voucherDate
     *
     * @return  self
     */
    public function setVoucherDate($voucherDate)
    {
        $this->voucherDate = $voucherDate;

        return $this;
    }

    /**
     * Get the value of voucherTime
     * 
     * @return string
     */
    public function getVoucherTime()
    {
        return $this->voucherTime;
    }

    /**
     * Set the value of voucherTime
     *
     * @return  self
     */
    public function setVoucherTime($voucherTime)
    {
        $this->voucherTime = $voucherTime;

        return $this;
    }

    /**
     * Get the value of voucherType
     * 
     * @return string
     */
    public function getVoucherType()
    {
        return $this->voucherType;
    }

    /**
     * Set the value of voucherType
     *
     * @return  self
     */
    public function setVoucherType($voucherType)
    {
        $this->voucherType = $voucherType;

        return $this;
    }

    /**
     * Get the value of zReportNumber
     * 
     * @return string
     */
    public function getZReportNumber()
    {
        return $this->zReportNumber;
    }

    /**
     * Set the value of zReportNumber
     *
     * @return  self
     */
    public function setZReportNumber($zReportNumber)
    {
        $this->zReportNumber = $zReportNumber;

        return $this;
    }

    /**
     * Get the value of okcSerialNumber
     * 
     * @return string
     */
    public function getOkcSerialNumber()
    {
        return $this->okcSerialNumber;
    }

    /**
     * Set the value of okcSerialNumber
     *
     * @return  self
     */
    public function setOkcSerialNumber($okcSerialNumber)
    {
        $this->okcSerialNumber = $okcSerialNumber;

        return $this;
    }

    /**
     * Currency transformer
     *
     * @param string $value
     * @return string
     */
    public function currencyTransformerToWords($value)
    {
        $value = (string) str_replace(".", "", $value);
        $number_to_words = new NumberToWords();
        $currency_transformer = $number_to_words->getCurrencyTransformer("tr");
        $words = mb_strtoupper($currency_transformer->toWords($value, "TRY"), 'utf-8');
        return $words;
    }
}
