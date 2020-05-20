<?php

namespace furkankadioglu\eFatura;

use furkankadioglu\eFatura\Models\Country;
use furkankadioglu\eFatura\Models\CurrencyType;
use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\Models\InvoiceType;
use furkankadioglu\eFatura\Models\UnitType;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class InvoiceTest extends TestCase
{
    /**
     * @test
     */
    public function setAndGetAllInvoiceVariables()
    {
        $client = new InvoiceManager();
        $inv = new Invoice();
        $uuid = Uuid::uuid1()->toString();
        $inv->setUuid($uuid);
        $this->assertEquals($uuid, $inv->getUuid());
        $inv->setDocumentNumber("DocumentNumber");
        $this->assertEquals("DocumentNumber", $inv->getDocumentNumber());
        $inv->setDate("Date");
        $this->assertEquals("Date", $inv->getDate());
        $inv->setTime("Time");
        $this->assertEquals("Time", $inv->getTime());
        $inv->setCurrency("Currency");
        $this->assertEquals("Currency", $inv->getCurrency());
        $inv->setCurrencyRate("CurrencyRate");
        $this->assertEquals("CurrencyRate", $inv->getCurrencyRate());
        $inv->setInvoiceType("InvoiceType");
        $this->assertEquals("InvoiceType", $inv->getInvoiceType());
        $inv->setTaxOrIdentityNumber("TaxOrIdentityNumber");
        $this->assertEquals("TaxOrIdentityNumber", $inv->getTaxOrIdentityNumber());
        $inv->setInvoiceAcceptorTitle("InvoiceAcceptorTitle");
        $this->assertEquals("InvoiceAcceptorTitle", $inv->getInvoiceAcceptorTitle());
        $inv->setInvoiceAcceptorName("InvoiceAcceptorName");
        $this->assertEquals("InvoiceAcceptorName", $inv->getInvoiceAcceptorName());
        $inv->setInvoiceAcceptorLastName("InvoiceAcceptorLastName");
        $this->assertEquals("InvoiceAcceptorLastName", $inv->getInvoiceAcceptorLastName());
        $inv->setBuildingName("BuildingName");
        $this->assertEquals("BuildingName", $inv->getBuildingName());
        $inv->setBuildingNumber("BuildingNumber");
        $this->assertEquals("BuildingNumber", $inv->getBuildingNumber());
        $inv->setDoorNumber("DoorNumber");
        $this->assertEquals("DoorNumber", $inv->getDoorNumber());
        $inv->setTown("Town");
        $this->assertEquals("Town", $inv->getTown());
        $inv->setTaxAdministration("TaxAdministration");
        $this->assertEquals("TaxAdministration", $inv->getTaxAdministration());
        $inv->setCountry("Country");
        $this->assertEquals("Country", $inv->getCountry());
        $inv->setAvenueStreet("AvenueStreet");
        $this->assertEquals("AvenueStreet", $inv->getAvenueStreet());
        $inv->setDistrict("District");
        $this->assertEquals("District", $inv->getDistrict());
        $inv->setCity("City");
        $this->assertEquals("City", $inv->getCity());
        $inv->setPostNumber("PostNumber");
        $this->assertEquals("PostNumber", $inv->getPostNumber());
        $inv->setTelephoneNumber("TelephoneNumber");
        $this->assertEquals("TelephoneNumber", $inv->getTelephoneNumber());
        $inv->setFaxNumber("FaxNumber");
        $this->assertEquals("FaxNumber", $inv->getFaxNumber());
        $inv->setEmail("Email");
        $this->assertEquals("Email", $inv->getEmail());
        $inv->setWebsite("Website");
        $this->assertEquals("Website", $inv->getWebsite());
        $inv->setRefundTable("RefundTable");
        $this->assertEquals("RefundTable", $inv->getRefundTable());
        $inv->setSpecialBaseAmount("SpecialBaseAmount");
        $this->assertEquals("SpecialBaseAmount", $inv->getSpecialBaseAmount());
        $inv->setSpecialBasePercent("SpecialBasePercent");
        $this->assertEquals("SpecialBasePercent", $inv->getSpecialBasePercent());
        $inv->setSpecialBaseTaxAmount("SpecialBaseTaxAmount");
        $this->assertEquals("SpecialBaseTaxAmount", $inv->getSpecialBaseTaxAmount());
        $inv->setTaxType("TaxType");
        $this->assertEquals("TaxType", $inv->getTaxType());
        $inv->setItemOrServiceList("ItemOrServiceList");
        $this->assertEquals("ItemOrServiceList", $inv->getItemOrServiceList());
        $inv->setType("Type");
        $this->assertEquals("Type", $inv->getType());
        $inv->setBase("Base");
        $this->assertEquals("Base", $inv->getBase());
        $inv->setItemOrServiceTotalPrice("ItemOrServiceTotalPrice");
        $this->assertEquals("ItemOrServiceTotalPrice", $inv->getItemOrServiceTotalPrice());
        $inv->setTotalDiscount("TotalDiscount");
        $this->assertEquals("TotalDiscount", $inv->getTotalDiscount());
        $inv->setCalculatedVAT("CalculatedVAT");
        $this->assertEquals("CalculatedVAT", $inv->getCalculatedVAT());
        $inv->setTaxTotalPrice("TaxTotalPrice");
        $this->assertEquals("TaxTotalPrice", $inv->getTaxTotalPrice());
        $inv->setIncludedTaxesTotalPrice("IncludedTaxesTotalPrice");
        $this->assertEquals("IncludedTaxesTotalPrice", $inv->getIncludedTaxesTotalPrice());
        $inv->setPaymentPrice("PaymentPrice");
        $this->assertEquals("PaymentPrice", $inv->getPaymentPrice());
        $inv->setNote("Note");
        $this->assertEquals("Note", $inv->getNote());
        $inv->setOrderNumber("OrderNumber");
        $this->assertEquals("OrderNumber", $inv->getOrderNumber());
        $inv->setOrderData("OrderData");
        $this->assertEquals("OrderData", $inv->getOrderData());
        $inv->setWaybillNumber("WaybillNumber");
        $this->assertEquals("WaybillNumber", $inv->getWaybillNumber());
        $inv->setWaybillDate("WaybillDate");
        $this->assertEquals("WaybillDate", $inv->getWaybillDate());
        $inv->setReceiptNumber("ReceiptNumber");
        $this->assertEquals("ReceiptNumber", $inv->getReceiptNumber());
        $inv->setVoucherDate("VoucherDate");
        $this->assertEquals("VoucherDate", $inv->getVoucherDate());
        $inv->setVoucherTime("VoucherTime");
        $this->assertEquals("VoucherTime", $inv->getVoucherTime());
        $inv->setVoucherType("VoucherType");
        $this->assertEquals("VoucherType", $inv->getVoucherType());
        $inv->setZReportNumber("ZReportNumber");
        $this->assertEquals("ZReportNumber", $inv->getZReportNumber());
        $inv->setOkcSerialNumber("OkcSerialNumber");
        $this->assertEquals("OkcSerialNumber", $inv->getOkcSerialNumber());
    }

    /**
     * @test
     */
    public function checkConstants()
    {
        $this->assertEquals("Birleşik Krallik", Country::BIRLESIK_KRALLIK);
        $this->assertEquals("TRY", CurrencyType::TURK_LIRASI);
        $this->assertEquals("HKSKOMISYONCU", InvoiceType::HAL_TIPI_FATURA_KOMISYONCU);
        $this->assertEquals("DAY", UnitType::GUN);
    }
}
