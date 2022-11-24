<cac:BillingReference>
    <cac:InvoiceDocumentReference>
        <cbc:ID>{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->number)}}</cbc:ID>
        @if($typeDocument->id == '11' || $typeDocument->id == '13')
            <cbc:UUID schemeName="CUDS-SHA384">{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->uuid)}}</cbc:UUID>
        @else
            <cbc:UUID schemeName="{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->scheme_name)}}">{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->uuid)}}</cbc:UUID>
        @endif
        <cbc:IssueDate>{{preg_replace("/[\r\n|\n|\r]+/", "", $billingReference->issue_date)}}</cbc:IssueDate>
    </cac:InvoiceDocumentReference>
</cac:BillingReference>
