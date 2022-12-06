<cac:DiscrepancyResponse>
    @isset($billingReference)
        <cbc:ReferenceID>{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->number)}}</cbc:ReferenceID>
    @endisset
    <cbc:ResponseCode>{{preg_replace("/[\r\n|\n|\r]+/", "", $discrepancycode)}}</cbc:ResponseCode>
    @isset($discrepancydescription)
        <cbc:Description>{{preg_replace("/[\r\n|\n|\r]+/", "", $discrepancydescription)}}</cbc:Description>
    @endisset
</cac:DiscrepancyResponse>
