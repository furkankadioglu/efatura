<?php 
namespace furkankadioglu\eFatura;

use furkankadioglu\eFatura\Models\Country;
use furkankadioglu\eFatura\Models\CurrencyType;
use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\Models\InvoiceType;
use furkankadioglu\eFatura\Models\UnitType;
use PHPUnit\Framework\TestCase;

class InvoiceManagerTest extends TestCase
{
    /**
     * @test
     */
    public function setAndGetUsername()
    {
        $client = new InvoiceManager;
        $client->setUsername("xxx");
        $this->assertEquals([
            "xxx",
            null
        ], $client->getCredentials());
    }

    /**
     * @test
     */
    public function setAndGetPassword()
    {
        $client = new InvoiceManager;
        $client->setPassword("xxx");
        $this->assertEquals([
            null,
            "xxx"
        ], $client->getCredentials());
    }

    /**
     * @test
     */
    public function setAndGetCredentials()
    {
        $client = new InvoiceManager;
        $client->setCredentials("yyy", "xxx");
        $this->assertEquals([
            "yyy",
            "xxx"
        ], $client->getCredentials());
    }

    /**
     * @test
     */
    public function getUrls()
    {
        $client = new InvoiceManager;
        $client->setDebugMode(true);
        $this->assertEquals("https://earsivportaltest.efatura.gov.tr", $client->getBaseUrl());

        $client->setDebugMode(false);
        $this->assertEquals("https://earsivportal.efatura.gov.tr", $client->getBaseUrl());
    }

     /**
     * @test
     */
    public function createAndSetAnInvoice()
    {
        
        $client = new InvoiceManager();
        $inv = new Invoice();

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
            "iskontoArttm" => "İskonto",
            "iskontoOrani" => 0,
            "iskontoTutari" => "0",
            "iskontoNedeni" => "",
            "malHizmetTutari" => "99",
            "kdvOrani" => 18,
            "kdvTutari" => "15.12",
            "vergininKdvTutari" => "0"
        ];

        $inv->mapWithTurkishKeys($fatura_detaylari);
        $client->setDebugMode(true)->setTestCredentials()->connect();
        $client->setInvoice($inv);
        $client->createDraftBasicInvoice();

        $apiInv = $client->getInvoiceFromAPI();
        $this->assertEquals($fatura_detaylari["faturaTarihi"], $apiInv["faturaTarihi"]);
        
        $managerInv = $client->getInvoice();

        $this->assertEquals($fatura_detaylari["faturaTarihi"], $managerInv->getDate());
    }

    /**
     * @test
     */
    public function getAndCheckToken()
    {
        $client = new InvoiceManager();
        $token = $client->setDebugMode(true)->setTestCredentials()->getTokenFromApi();

        $this->assertNotEquals(null , $token);
        $this->assertNotEquals("" , $token);

    }

    /**
     * @test
     */
    public function getInvoicesFromAPI()
    {
        $client = new InvoiceManager();
        $client->setDebugMode(true)->setTestCredentials()->connect();
        $invoices = $client->getInvoicesFromAPI("01/01/2020", "10/02/2020");
        $this->assertIsArray($invoices);
    }
}