<?php

use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\InvoiceManager;
use furkankadioglu\eFatura\Models\Country;
use furkankadioglu\eFatura\Models\CurrencyType;
use furkankadioglu\eFatura\Models\InvoiceType;
use furkankadioglu\eFatura\Models\UnitType;

require __DIR__ . '/../vendor/autoload.php';

$client = new InvoiceManager();

// Production environment
$client->setUsername("XXXX")->setPassword("XXXX");


// Test Environment
$client->setDebugMode(true)->setTestCredentials();

echo "<h1>Credentials</h1>";
echo "<pre>";
print_r($client->getCredentials());
echo "</pre>";

$client->connect();



echo "<h1>Main Tree Menu</h1>";
echo "<pre>";
print_r($client->getMainTreeMenuFromAPI());
echo "</pre>";


echo "<h1>Invoices List</h1>";
echo "<pre>";
print_r($client->getInvoicesFromAPI("08/02/2020", "08/02/2020"));
echo "</pre>";


$fatura_detaylari = [
            "belgeNumarasi" => "",
            "faturaTarihi" => "09/02/2020",
            "saat" => "09:07:48",
            "paraBirimi" => CurrencyType::TURK_LIRASI,
            "dovzTLkur" => "0",
            "faturaTipi" => InvoiceType::SATIS,
            "vknTckn" =>  "11111111111",
            "aliciUnvan" => "FURKAN KADIOGLU",
            "aliciAdi" => "FURKAN",
            "aliciSoyadi" => "KADIOGLU",
            "binaAdi" => "",
            "binaNo" => "",
            "kapiNo" => "",
            "kasabaKoy" => "",
            "vergiDairesi" => "MALTEPE",
            "ulke" => Country::TURKIYE,
            "bulvarcaddesokak" => "DENEME SK. DENEME MAH.",
            "mahalleSemtIlce" => "",
            "sehir" => " ",
            "postaKodu" => "",
            "tel" => "",
            "fax" => "",
            "eposta" => "",
            "websitesi" => "",
            "iadeTable" => [],
            "ozelMatrahTutari" => "0",
            "ozelMatrahOrani" => 0,
            "ozelMatrahVergiTutari" => "0",
            "vergiCesidi" => " ",
            "malHizmetTable" => [],
            "tip" => "İskonto",
            "matrah" => 100,
            "malhizmetToplamTutari" => 100,
            "toplamIskonto" => "0",
            "hesaplanankdv" => 18,
            "vergilerToplami" => 18,
            "vergilerDahilToplamTutar" => 118,
            "odenecekTutar" => 118,
            "not" => "xxx",
            "siparisNumarasi" => "",
            "siparisTarihi" => "",
            "irsaliyeNumarasi" => "",
            "irsaliyeTarihi" => "",
            "fisNo" => "",
            "fisTarihi" => "",
            "fisSaati" => " ",
            "fisTipi" => " ",
            "zRaporNo" => "",
            "okcSeriNo" => ""
];

$fatura_detaylari["malHizmetTable"][] = [
    "malHizmet" => "Yazılım Geliştirme",
    "miktar" => 28,
    "birim" => UnitType::GUN,
    "birimFiyat" => "3",
    "fiyat" => "84",
    "iskontoNedeni" => "İskonto",
    "iskontoOrani" => 0,
    "iskontoTutari" => "0",
    "iskontoNedeni" => "",
    "malHizmetTutari" => "99",
    "kdvOrani" => 18,
    "kdvTutari" => "15.12",
    "vergininKdvTutari" => "0"
];

$inv = new Invoice();

$inv->mapWithTurkishKeys($fatura_detaylari);

//$inv->mapWithEnglishKeys($invoiceDetails);


echo "<h1>Invoice Details</h1>";
echo "<pre>";
print_r($inv->export());
echo "</pre>";


echo "<h1>Invoice Details JSON</h1>";
echo "<pre>";
echo json_encode($inv->export());
echo "</pre>";



$client->setInvoice($inv);



//$client->createDraftBasicInvoice()->signDraftInvoiceWithDevice();
//$client->createDraftBasicInvoice()->getInvoiceHTML();
//$client->createDraftBasicInvoice()->cancelInvoice();

$client->createDraftBasicInvoice();

$oldInvoice = new Invoice();
$oldInvoice->setUuid($inv->getUuid());
$client->setInvoice($oldInvoice);
echo "<h1>Get An Invoice Details From API</h1>";
echo "<pre>";
echo json_encode($client->getInvoiceFromAPI());
echo "</pre>";


$userInformations = $client->getUserInformationsData();
echo "<h1>User Informations Data</h1>";
echo "<pre>";
echo json_encode($userInformations->export());
echo "</pre>";


$userInformations = $userInformations->setUnvan("XYZ Yazılım");
$userInformations = $userInformations->setApartmanNo("12");

$client->setUserInformations($userInformations);
$client->sendUserInformationsData();
