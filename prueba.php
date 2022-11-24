<?php
//phpinfo();

echo "Ingresa tal cual  ....<br>";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://antsoftfactura.com:81/api/ubl2.1/invoice',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "number": "1353",
    "type_document_id": 1,
    "date": "2022-08-25",
    "time": "03:27:50",
    "resolution_number": "18764021441288",
    "prefix": "EPFE",
    "notes": "CR 9#13-14 MAT-1091\\r\\nMEDIDOR A PAGAR EN 6 CUOTAS\\r\\n",
    "sendmail": false,
    "customer": {
        "identification_number": "28238183",
        "dv": "",
        "name": "EDELMIRA CUEVAS RIVERA",
        "phone": "3125472159",
        "address": "CR 9#13-14",
        "email": "epmmalagafacturacion@gmail.com",
        "merchant_registration": "00000-00",
        "type_document_identification_id": 3,
        "type_organization_id": 1,
        "municipality_id": "896",
        "type_regime_id": 2
    },
    "payment_form": {
        "payment_form_id": 2,
        "payment_method_id": 30,
        "payment_due_date": "2022-08-25",
        "duration_measure": 30
    },
    "allowance_charges": [
        {
            "discount_id": 13,
            "charge_indicator": false,
            "allowance_charge_reason": "DESCUENTO GENERAL",
            "amount": "0.00",
            "base_amount": "148000.00"
        }
    ],
    "legal_monetary_totals": {
        "line_extension_amount": "124369.75",
        "tax_exclusive_amount": "124369.75",
        "tax_inclusive_amount": "148000.00",
        "allowance_total_amount": "0.00",
        "charge_total_amount": "0.00",
        "payable_amount": "148000.00"
    },
    "tax_totals": [
        {
            "tax_id": 1,
            "tax_amount": "23630.25",
            "percent": "19.00",
            "taxable_amount": "124369.75"
        }
    ],
    "invoice_lines": [
        {
            "unit_measure_id": "70",
            "invoiced_quantity": "1.00",
            "line_extension_amount": "124369.75",
            "free_of_charge_indicator": false,
            "allowance_charges": [
                {
                    "charge_indicator": false,
                    "allowance_charge_reason": "DESCUENTO GENERAL",
                    "amount": "0.00",
                    "base_amount": "124369.75"
                }
            ],
            "tax_totals": [
                {
                    "tax_id": 1,
                    "tax_amount": "23630.25",
                    "taxable_amount": "124369.75",
                    "percent": "19.00"
                }
            ],
            "description": "Medidor",
            "code": "27",
            "type_item_identification_id": 4,
            "price_amount": "124369.75",
            "base_quantity": "1.00"
        }
    ],
    "with_holding_tax_total": [],
    "ivaresponsable": "No responsable de IVA",
    "nombretipodocid": "Cedula de Ciudadania",
    "tarifaica": "0"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer e173aecd93bad881dbcf7034241c2def1d2c05f681f860330e3b697b497dd644'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>