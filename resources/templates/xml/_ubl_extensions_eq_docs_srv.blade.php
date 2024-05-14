<ext:UBLExtensions>
    <?php $id_extension = 0; ?>
    <ext:UBLExtension>
        <ext:ExtensionContent>
            <sts:DianExtensions>
                <sts:InvoiceSource>
                    <cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1">{{preg_replace("/[\r\n|\n|\r]+/", "", $company->country->code)}}</cbc:IdentificationCode>
                </sts:InvoiceSource>
                <sts:SoftwareProvider>
                    <sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" @if (preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '6' || preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '3') schemeID="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->dv)}}" @endif @if (preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '6' || preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '3') schemeName="31" @else schemeName="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification->code)}}" @endif >{{preg_replace("/[\r\n|\n|\r]+/", "", $company->identification_number)}}</sts:ProviderID>
                    <sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{preg_replace("/[\r\n|\n|\r]+/", "", $company->software->identifier_eqdocs)}}</sts:SoftwareID>
                </sts:SoftwareProvider>
                <sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"/>
                <sts:AuthorizationProvider>
                    <sts:AuthorizationProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">800197268</sts:AuthorizationProviderID>
                </sts:AuthorizationProvider>
                @if(isset($QRCode))
                    <sts:QRCode>{{$QRCode}}</sts:QRCode>
                @endif
            </sts:DianExtensions>
        </ext:ExtensionContent>
    </ext:UBLExtension>
    @if(isset($request['software_manufacturer']))
        <?php $id_extension++; ?>
        <ext:UBLExtension>
            <cbc:ID>{{$id_extension}}</cbc:ID>
            <cbc:Name>FabricanteSoftware</cbc:Name>
            <ext:ExtensionContent>
                <FabricanteSoftware>
                    <InformacionDelFabricanteDelSoftware>
                        <Name>NombreApellido</Name>
                        <Value>{{$request['software_manufacturer']['name']}}</Value>
                        <Name>RazonSocial</Name>
                        <Value>{{$request['software_manufacturer']['business_name']}}</Value>
                        <Name>NombreSoftware</Name>
                        <Value>{{$request['software_manufacturer']['software_name']}}</Value>
                    </InformacionDelFabricanteDelSoftware>
                </FabricanteSoftware>
            </ext:ExtensionContent>
        </ext:UBLExtension>
    @endif
    @if(isset($request['spd']))
        @foreach ($request['spd'] as $key => $spd)
            <?php $id_extension++; ?>
            <ext:UBLExtension>
                <cbc:ID schemeID="SPD">{{$id_extension}}</cbc:ID>
                @inject('type_spd', 'App\TypeSPD')
                <cbc:Name>{{preg_replace("/[\r\n|\n|\r]+/", "", $type_spd->findOrFail($spd['agency_information']['type_spd_id'])['name'])}}</cbc:Name>
                <ext:ExtensionAgencyName>{{$user->name}}</ext:ExtensionAgencyName>
                <ext:ExtensionReason>{{$spd['agency_information']['office_lending_company']}}</ext:ExtensionReason>
                <ext:ExtensionContent>
				    <Services_SPD>
					    <ID schemeName="Contrato">{{$spd['agency_information']['contract_number']}}</ID>
    					<IssueDate>{{$spd['agency_information']['issue_date']}}</IssueDate>
	    				<Note>{{$spd['agency_information']['note']}}</Note>
		    			<SenderParty>
                            <cac:PartyIdentification>
                                <ID schemeID="{{preg_replace("/[\r\n|\n|\r]+/", "", $user->company->dv)}}" schemeName="{{preg_replace("/[\r\n|\n|\r]+/", "", $user->company->type_document_identification->code)}}">{{preg_replace("/[\r\n|\n|\r]+/", "", $user->company->identification_number)}}</ID>
                            </cac:PartyIdentification>
                            <PartyName>
                                <Name>{{preg_replace("/[\r\n|\n|\r]+/", "", $user->name)}}</Name>
                            </PartyName>
    					</SenderParty>
                        <SubscriberParty>
                            <PartyName>
                                <Name>{{$spd['subscriber_party']['party_name']}}</Name>
                            </PartyName>
                            <PostalAddress>
                                <StreetName>{{$spd['subscriber_party']['street_name']}}</StreetName>
                                <AdditionalStreetName>{{$spd['subscriber_party']['additional_street_name']}}</AdditionalStreetName>
                                @inject('municipality', 'App\Municipality')
                                <CityName>{{$municipality->findOrFail($spd['subscriber_party']['municipality_id'])['name']}}</CityName>
                                @inject('department', 'App\Department')
                                <CountrySubentity>{{$department->findOrFail($municipality->findOrFail($spd['subscriber_party']['municipality_id'])['department_id'])['name']}}</CountrySubentity>
                                <Country>Colombia</Country>
                                <ResidentialStratum>{{$spd['subscriber_party']['stratum']}}</ResidentialStratum>
                            </PostalAddress>
                            <ElectronicMail>{{$spd['subscriber_party']['email']}}</ElectronicMail>
                        </SubscriberParty>
	    				<SubscriberConsumption>
		    				<DurationOfTheBillingCycle unitOfTime="mes">{{$spd['subscriber_consumption']['duration_of_the_billing_cycle']}}</DurationOfTheBillingCycle>
			    			<Note>{{$spd['subscriber_consumption']['consumption_section_note']}}</Note>
				    		<ConsumptionSection>
					    		<SPDDebitsForPartialConsumption>
						            <SPDDebitForPartialConsumption>
                                        @inject('um', 'App\UnitMeasure')
    									<TotalMeteredQuantity unitCode="{{preg_replace("/[\r\n|\n|\r]+/", "", $um->findOrFail($spd['subscriber_consumption']['total_metered_unit_id'])['code'])}}">{{$spd['subscriber_consumption']['total_metered_quantity']}}"</TotalMeteredQuantity>
	    								<ConsumptionPayableAmount currencyID="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->type_currency->code)}}">{{$spd['subscriber_consumption']['consumption_payable_amount']}}</ConsumptionPayableAmount>
		    							<Consumptionprice>
			    							<Quantity unitCode="{{preg_replace("/[\r\n|\n|\r]+/", "", $um->findOrFail($spd['subscriber_consumption']['total_metered_unit_id'])['code'])}}">{{$spd['subscriber_consumption']['consumption_price_quantity']}}</Quantity>
				    						<PartialLineExtensionAmount currencyID="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->type_currency->code)}}">{{$spd['subscriber_consumption']['partial_line_extension_amount']}}</PartialLineExtensionAmount>
					    				</Consumptionprice>
                                        @if(isset($spd['subscriber_consumption']['descuentos_credito_al_item']))
	    					    			<DescuentosCreditoAlItem>
                                                <?php $id_dci = 0; ?>
                                                @foreach($spd['subscriber_consumption']['descuentos_credito_al_item'] as $key => $dci)
        							    			<DescuentoCreditoAlItem>
                                                        <?php $id_dci++; ?>
	           						    			    <ID>{{$id_dci}}</ID>
    	           							    		<AllowanceReason>{{$dci['allowance_reason']}}</AllowanceReason>
	    	        							    	<Amount>{{$dci['amount']}}</Amount>
                                                    </DescuentoCreditoAlItem>
                                                @endforeach
                                            </DescuentosCreditoAlItem>
                                        @endif
                                        @if(isset($spd['subscriber_consumption']['cargos_debito_al_item']))
	    					    			<CargosDebitoAlItem>
                                                <?php $id_cdi = 0; ?>
                                                @foreach($spd['subscriber_consumption']['cargos_debito_al_item'] as $key => $cdi)
        							    			<CargoDebitoAlItem>
                                                        <?php $id_cdi++; ?>
	           						    			    <ID>{{$id_cdi}}</ID>
    	           							    		<ChargeReason>{{$cdi['charge_reason']}}</ChargeReason>
	    	        							    	<Amount>{{$cdi['amount']}}</Amount>
                                                    </CargoDebitoAlItem>
                                                @endforeach
                                            </CargosDebitoAlItem>
                                        @endif
                                        @if(isset($spd['subscriber_consumption']['unstructured_price']))
                                        @endif
                                        <UnstructuredPrice>
                                            <PriceAmount currencyID="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->type_currency->code)}}">{{$spd['subscriber_consumption']['unstructured_price']['price_amount']}}</PriceAmount>
                                            <BaseQuantity unitCode="{{preg_replace("/[\r\n|\n|\r]+/", "", $um->findOrFail($spd['subscriber_consumption']['total_metered_unit_id'])['code'])}}">{{$spd['subscriber_consumption']['unstructured_price']['base_quantity']}}</BaseQuantity>
                                        </UnstructuredPrice>
                                    </SPDDebitForPartialConsumption>
                                </SPDDebitsForPartialConsumption>
                            </ConsumptionSection>
                        </SubscriberConsumption>
                    </Services_SPD>
                </ext:ExtensionContent>
            </ext:UBLExtension>
        @endforeach
    @endif
    <ext:UBLExtension>
        <ext:ExtensionContent/>
    </ext:UBLExtension>
</ext:UBLExtensions>
