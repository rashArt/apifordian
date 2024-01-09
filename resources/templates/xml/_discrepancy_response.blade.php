<cac:DiscrepancyResponse>
    @isset($billingReference)
        <cbc:ReferenceID>{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->number)}}</cbc:ReferenceID>
    @endisset
    <cbc:ResponseCode>{{preg_replace("/[\r\n|\n|\r]+/", "", $discrepancycode)}}</cbc:ResponseCode>
    @isset($discrepancycode)
        @if($request['type_document_id'] == 4)
            @inject('Discrepancy', 'App\CreditNoteDiscrepancyResponse')
        @else
            @inject('Discrepancy', 'App\DebitNoteDiscrepancyResponse')
        @endif
        <cbc:Description>{{$Discrepancy->findOrFail($discrepancycode)['name']}}</cbc:Description>
    @endisset
</cac:DiscrepancyResponse>
