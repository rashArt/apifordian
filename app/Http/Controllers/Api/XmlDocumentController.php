<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ubl21dian\Templates\SOAP\GetXmlByDocumentKey;
use App\Http\Requests\Api\XmlDocumentRequest;

class XmlDocumentController extends Controller
{    
    /**
     * Document.
     *
     * @param string $trackId
     *
     * @return array
     */
    public function document(XmlDocumentRequest $request, $trackId, $GuardarEn = false)
    {
        // User
        $user = auth()->user();
        
        // Company
        $company = $user->company;

        if($request->is_payroll)
            $getXml = new GetXmlByDocumentKey($user->company->certificate->path, $user->company->certificate->password, $user->company->software->url_payroll);
        else
            $getXml = new GetXmlByDocumentKey($user->company->certificate->path, $user->company->certificate->password, $user->company->software->url);
        $getXml->trackId = $trackId;
        $GuardarEn = str_replace("_", "\\", $GuardarEn);

        if ($request->GuardarEn)
          return [
              'message' => 'Consulta generada con éxito',
              'ResponseDian' => $getXml->signToSend($request->GuardarEn.'\\Req-XmlDocument.xml')->getResponseToObject($request->GuardarEn.'\\Rpta-XmlDocument.xml'),
          ];
        else
          return [
              'message' => 'Consulta generada con éxito',
              'ResponseDian' => $getXml->signToSend()->getResponseToObject(),
          ];
    }
}
